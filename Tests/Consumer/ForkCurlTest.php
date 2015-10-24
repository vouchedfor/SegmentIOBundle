<?php
namespace Vouchedfor\SegmentIOBundle\Segment;

use Vouchedfor\SegmentIOBundle\Consumer\ForkCurl;

/**
 * Class FileTest
 * @package Vouchedfor\SegmentIOBundle\Consumer
 */
class ForkCurlTest extends \PHPUnit_Framework_TestCase
{
    private $segment;

    public function setup()
    {
        $this->segment = new Segment(new ForkCurl('random_key'));
    }

    /**
     * Test track
     */
    public function testTrack()
    {
        $response = $this->segment->track(
            'some-user',
            'File PHP Event - Microtime',
            array('timestamp' => microtime(true),
                'property2' => 'Value 2',
            )
        );

        $this->assertTrue($response);
    }

    /**
     * Test identify
     */
    public function testIdentify()
    {
        $response = $this->segment->identify(
            'Calvin',
            array('loves_php' => false,
                'type' => 'analytics.log',
                'birthday' => time()
            )
        );

        $this->assertTrue($response);
    }

    /**
     * Test group
     */
    public function testGroup()
    {
        $response = $this->segment->group(
            'user-id',
            'group-id',
            array('type' => 'consumer analytics.log test',
            )
        );

        $this->assertTrue($response);
    }

    /**
     * Test page
     */
    public function testPage()
    {
        $response = $this->segment->page(
            'user-id',
            'analytics-php',
            array(
                'url' => 'https://a.url/',
                'referrer' => 'http://google.com',
            )
        );

        $this->assertTrue($response);
    }

    /**
     * Test screen
     */
    public function testScreen()
    {
        $response = $this->segment->screen(
            'user-id',
            'grand theft auto',
            array(
                'url' => 'https://a.url/',
                'referrer' => 'http://google.com',
            )
        );

        $this->assertTrue($response);
    }

    /**
     * Test alias
     */
    public function testAlias()
    {
        $response = $this->segment->alias(
            'previous-id',
            'user-id'
        );

        $this->assertTrue($response);
    }

    /**
     * Test flush batch
     */
    public function testFlushBatch()
    {
        $response = $this->segment->alias(
            'previous-id',
            'user-id'
        );

        $this->assertTrue($response);

        $response = $this->segment->flush();

        $this->assertNull($response);
    }
}

