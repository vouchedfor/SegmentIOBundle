<?php

namespace Vouchedfor\SegmentIOBundle\Segment;

use Vouchedfor\SegmentIOBundle\Consumer\File;
use Vouchedfor\SegmentIOBundle\Consumer\Socket;

/**
 * Class SegmentTest
 * @package Vouchedfor\SegmentIOBundle\Segment
 */
class SegmentTest extends \PHPUnit_Framework_TestCase
{
    private $segment;

    public function setup()
    {
        $this->segment = new Segment(new Socket('random_key'));
    }

    /**
     * Test track
     */
    public function testTrack()
    {
        $response = $this->segment->track(
            2,
            'Test Event',
            array('property1' => 'Value 1',
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
            2,
            array(
                'traits' => array(
                    'name' => 'John Lennon',
                    'email' => 'john.lennon@test.com',
                ),
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
            3,
            2,
            array(
                    'company' => 'Acme Corp',
                    'location' => 'San Francisco',
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
            3,
            'Login page',
            array(
                'url' => 'http://example.com',
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
            3,
            'Signup',
            array(
                'url' => 'http://example.com',
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
            3,
            2
        );

        $this->assertTrue($response);
    }

    /**
     * Test flush
     */
    public function testFlush()
    {
        $response = $this->segment->flush();

        $this->assertNull($response);
    }

    /**
     * Test batch size
     */
    public function testBatchSize() {
        $socket = new Socket('random_key', array('batch_size' => 2));

        $segment = new Segment($socket);

        $this->assertEquals(0, $socket->getQueueSize());

        $segment->track(
            'some-user',
            'File PHP Event - Microtime',
            array('timestamp' => microtime(true),
                'property2' => 'Value 2',
            )
        );

        $this->assertEquals(1, $socket->getQueueSize());

        $segment->identify(
            'Calvin',
            array('loves_php' => false,
                'type' => 'analytics.log',
                'birthday' => time()
            )
        );
        $this->assertEquals(2, $socket->getQueueSize());

        $segment->screen(
            'user-id',
            'grand theft auto',
            array(
                'url' => 'https://a.url/',
                'referrer' => 'http://google.com',
            )
        );

        $this->assertEquals(0, $socket->getQueueSize());
    }

    /**
     * Test queue size
     */
    public function testQueueSize() {
        $socket = new Socket('random_key', array('max_queue_size' => 2));

        $segment = new Segment($socket);

        $response = $segment->track(
            'some-user',
            'File PHP Event - Microtime',
            array('timestamp' => microtime(true),
                'property2' => 'Value 2',
            )
        );
        $this->assertTrue($response);

        $response = $segment->identify(
            'Calvin',
            array('loves_php' => false,
                'type' => 'analytics.log',
                'birthday' => time()
            )
        );
        $this->assertTrue($response);

        $response = $segment->screen(
            'user-id',
            'grand theft auto',
            array(
                'url' => 'https://a.url/',
                'referrer' => 'http://google.com',
            )
        );
        $this->assertTrue($response);

        $response = $segment->alias(
            3,
            2
        );
        $this->assertFalse($response);
    }

    /**
     * Test timeout
     */
    public function testDebugMode() {
        $segment = new Segment(new Socket('random_key', array('timeout' => 1)));

        $response = $segment->track(
            'some-user',
            'File PHP Event - Microtime',
            array('timestamp' => microtime(true),
                'property2' => 'Value 2',
            )
        );
        $this->assertTrue($response);
    }
}

