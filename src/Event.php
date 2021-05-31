<?php
/**
 * Created by PhpStorm.
 * User: DJ
 * Date: 2019/11/9
 * Time: 9:51
 */

namespace JdmmSwoft\Mqtt;


class Event
{
    //发送前
    const PUBLISH_BEFORE = 'jdmm.Mqtt.publish-before';

    //发送后
    const PUBLISH_AFTER  = 'jdmm.Mqtt.publish-after';

    //接收前
    const RECV_BEFORE    = 'jdmm.Mqtt.recv-before';

    //接收后
    const RECV_AFTER     = 'jdmm.Mqtt.recv-after';

    //异常
    const QUEUE_ERROR          = 'jdmm.Mqtt.error';

    //错误
    const QUEUE_EXCEPTION      = 'jdmm.Mqtt.exception';

    public static function publishBefore($param) {
        \Swoft::trigger(self::PUBLISH_BEFORE, [], $param);
    }

    public static function publishAfter($param) {
        \Swoft::trigger(self::PUBLISH_AFTER, [], $param);
    }

    public static function recvBefore($param) {
        \Swoft::trigger(self::RECV_BEFORE, [], $param);
    }

    public static function recvAfter($param) {
        \Swoft::trigger(self::RECV_AFTER, [], $param);
    }

    public static function Error($param) {
        \Swoft::trigger(self::QUEUE_ERROR, [], $param);
    }

    public static function Exception($param) {
        \Swoft::trigger(self::QUEUE_EXCEPTION, [], $param);
    }
}