<?php

namespace JdmmSwoft\Mqtt;

use Jdmm\Mqtt\Concern\BaseEvent;
use Jdmm\Mqtt\Contract\IMessageHandler;
use Jdmm\Mqtt\Data\BaseData;
use Swoft\Bean\Annotation\Mapping\Bean;
use Swoft\Log\Helper\CLog;

/**
 * Class MessageHandler
 * @package JdmmSwoft\Mqtt
 * @Bean()
 */
class MessageHandler implements IMessageHandler
{
    public function handleAsync($message, $eventHandlers)
    {
        try {
            // Event::recvBefore($message->payload);
            $data = BaseData::jsonUnSerialize($message);

            if ($data) {
                // $data->setKey($message->key);
                foreach ($eventHandlers as $handler) {
                    if (is_string($handler)) {
                        $obj = GlobalClass::get($handler);
                        $obj->handleAsync($data);
                    } else {
                        $handler->handleAsync($data);
                    }
                }
            }
            // Event::recvAfter($message->payload);

        } catch (\Exception $e) {
            $exception = 'customer-exception: '. $e->getMessage() . ' at ' . $e->getFile() . ' line ' . $e->getLine();
            Event::Exception($exception);
            CLog::error($exception);
        } catch (\Error $e) {
            $error = 'customer-error: '. $e->getMessage() . ' at ' . $e->getFile() . ' line ' . $e->getLine();
            Event::Error($error);
            CLog::error($error);
        } catch (\Throwable $e) {
            $error = 'customer-throwable: '. $e->getMessage() . ' at ' . $e->getFile() . ' line ' . $e->getLine();
            Event::Error($error);
            CLog::error($error);
        }
    }

}