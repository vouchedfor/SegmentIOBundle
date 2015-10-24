<?php
namespace Vouchedfor\SegmentIOBundle\Consumer;

/**
 *  * Class ConsumerFactory
 *   * @package Vouchedfor\SegmentIOBundle\Consumer
 *    */
class ConsumerFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateConsumer()
    {
        $consumer = ConsumerFactory::createConsumer('socket', '');
        $this->assertTrue($consumer instanceof Socket);

        $consumer = ConsumerFactory::createConsumer('file', '');
        $this->assertTrue($consumer instanceof File);
    }

    /**
     * @expectedException        \Exception
     * @expectedExceptionMessage Invalid consumer type
     */
    public function testCreateConsumerException()
    {
        $consumer = ConsumerFactory::createConsumer('unknown_type', '');
        $this->assertTrue($consumer instanceof Socket);
    }
}
