<?php
namespace Vouchedfor\SegmentIOBundle\Consumer;

/**
 *  * Class ConsumerFactory
 *   * @package Vouchedfor\SegmentIOBundle\Consumer
 *    */
class ConsumerFactory
{

    /**
     * @param $type
     * @param $access_token
     * @return null|File|\Vouchedfor\SegmentIOBundle\Consumer\Socket
     * @throws \Exception
     */
    public static function createConsumer($type, $access_token)
    {
        $instance = null;

        switch ($type) {
            case 'socket':
                $instance = new Socket($access_token);
                break;
            case 'file':
                $instance = new File($access_token);
                break;
            case 'batch':
                $instance = new ForkCurl($access_token);
                break;
            default:
                throw new \Exception('Invalid consumer type');
        }

        return $instance;
    }
}
