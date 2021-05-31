<?php declare(strict_types=1);


namespace JdmmSwoft\Mqtt;

use Jdmm\Mqtt\Adapter\EmqxAdapter;
use Swoft\Bean\Annotation\Mapping\Bean;
use Swoft\Helper\ComposerJSON;
use Swoft\SwoftComponent;

/**
 * Class AutoLoader
 *
 * @since 2.0
 */
class AutoLoader extends SwoftComponent
{
    /**
     * Get namespace and dirs
     *
     * @return array
     */
    public function getPrefixDirs(): array
    {
        return [
            __NAMESPACE__ => __DIR__,
            'Jdmm\\Mqtt' => dirname(dirname(dirname(__DIR__))) . '/jdmm/mqtt/src'
        ];
    }

    /**
     * @return array
     */
    public function metadata(): array
    {
        $jsonFile = dirname(__DIR__).'/composer.json';

        return ComposerJSON::open($jsonFile)->getMetadata();
    }

    /**
     * @return array
     */
    public function beans(): array
    {
        return [
            \JdmmSwoft\Mqtt\Queue::IOT => [
                'class' => EmqxAdapter::class,
                '__option' => [
                    'scope' => Bean::SINGLETON
                ]
            ]
        ];
    }
}