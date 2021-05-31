<?php

namespace JdmmSwoft\Mqtt;

class GlobalClass
{
    private static $instance = [];

    public static function get($className) {
        if(empty(self::$instance[$className])) {
            self::$instance[$className] = bean($className);
        }
        return self::$instance[$className];
    }

    /**
     * 获取mqtt。yaml里的配置
     * @author wangc
     * @return array
     */
    public static function setConf(){
        $conf = [
            'server' => config('mqtt.server'),
            'port' => config('mqtt.port'),
            'qos' => config('mqtt.qos'),
            'retain' => config('mqtt.retain',0),
            'clientID' => time(),
            'debug' => config('mqtt.debug'),
            'keepalive' => config('mqtt.keepalive'),
            'cafile' => config('mqtt.cafile'),
            'username' => config('mqtt.username'),
            'password' => config('mqtt.password'),
            'name' => config('mqtt.name')
        ];
        if(!empty(config('mqtt.cafile'))){
            $conf['cafile'] = __DIR__.'/'.config('mqtt.cafile');
        }
        return $conf;
    }
}