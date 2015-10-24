<?php
namespace Vouchedfor\SegmentIOBundle\Segment;

use Vouchedfor\SegmentIOBundle\Consumer\Socket;

/**
 * Class SocketTest
 * @package Vouchedfor\SegmentIOBundle\Consumer
 */
class SocketTest extends \PHPUnit_Framework_TestCase
{
    private $consumer;
    private $segment;

    public function setup()
    {
        $this->consumer = $this->getMockBuilder(Socket::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->segment = new Segment($this->consumer);
    }

    /**
     * Test track
     */
    public function testTrack()
    {
        $this->consumer->expects($this->any())
            ->method('track')
            ->willReturn(true);

        $response = $this->segment->track(
            2,
            'Test Event',
            array("property1" => "Value 1",
                  "property2" => "Value 2",
            )
        );

        $this->assertTrue($response);
    }

    /**
     * Test identify
     */
    public function testIdentify()
    {
        $this->consumer->expects($this->any())
            ->method('identify')
            ->willReturn(true);

        $response = $this->segment->identify(
            2,
            array(
                "traits" => array(
                    "name" => "John Lennon",
                    "email" => "john.lennon@test.com",
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
        $this->consumer->expects($this->any())
            ->method('group')
            ->willReturn(true);

        $response = $this->segment->group(
            3,
            2,
            array(
                    "company" => "Acme Corp",
                    "location" => "San Francisco",
            )
        );

        $this->assertTrue($response);
    }

    /**
     * Test page
     */
    public function testPage()
    {
        $this->consumer->expects($this->any())
            ->method('page')
            ->willReturn(true);

        $response = $this->segment->page(
            3,
            'Login page',
            array(
                "url" => "http://example.com",
                "referrer" => "http://google.com",
            )
        );

        $this->assertTrue($response);
    }

    /**
     * Test screen
     */
    public function testScreen()
    {
        $this->consumer->expects($this->any())
            ->method('screen')
            ->willReturn(true);

        $response = $this->segment->screen(
            3,
            'Signup',
            array(
                "url" => "http://example.com",
                "referrer" => "http://google.com",
            )
        );

        $this->assertTrue($response);
    }

    /**
     * Test alias
     */
    public function testAlias()
    {
        $this->consumer->expects($this->any())
            ->method('alias')
            ->willReturn(true);

        $response = $this->segment->alias(
            3,
            2
        );

        $this->assertTrue($response);
    }
}

