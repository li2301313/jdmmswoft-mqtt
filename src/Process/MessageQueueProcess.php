<?php

namespace JdmmSwoft\Mqtt\Process;

use JdmmSwoft\Mqtt\GlobalClass;
use Swoft\Bean\Annotation\Mapping\Bean;
use Swoft\Bean\Annotation\Mapping\Inject;
use Swoft\Process\Process;
use Swoft\Process\UserProcess;
use Swoft\Log\Helper\CLog;
use Swoole\Coroutine;

/**
 * Class MessageQueueProcess
 *
 * @Bean()
 *
 * @package Jdmm\Queue\Process
 */
class MessageQueueProcess extends UserProcess
{
    /**
     * @Inject("mqttQueue")
     *
     * @var \JdmmSwoft\Mqtt\Queue
     */
    protected $msgQueue;

    /**
     * Run
     *
     * @param Process $process
     */
    public function run(Process $process): void
    {
        CLog::info('queue-process start...');
        $this->stdinOut = true;
        try {
            $conf = GlobalClass::setConf();
            $this->msgQueue->startListen($conf);
        } catch (\Error $e) {
            CLog::error('[msgqueue1]' . $e->getMessage().'-'.$e->getFile().'-'.$e->getLine());
        } catch (\Exception $e) {
            CLog::error('[msgqueue2]' . $e->getMessage().'-'.$e->getFile().'-'.$e->getLine());
        }
    }
}