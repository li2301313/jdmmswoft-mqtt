<?php

namespace JdmmSwoft\Mqtt\Engine;

use Jdmm\Mqtt\Concern\BaseEventBus;
use Jdmm\Mqtt\Data\BaseData;
use Swoft\Bean\Annotation\Mapping\Bean;

/**
 * Class Queue
 * @package JdmmSwoft\Mqtt\Engine
 * @Bean()
 */
class Queue
{
    public function publish(BaseData $baseData, BaseEventBus $baseEventBus, array $conf) {
        return $baseEventBus->publish($baseData,$conf);
    }
}