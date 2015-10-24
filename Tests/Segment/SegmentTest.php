<?php

namespace Vouchedfor\SegmentIOBundle\Segment;

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
        $this->segment = new Segment(new Socket('FuKMkOtGZpiTUFJ2M7nQvwx1pi4kTS3c'));
    }

    /**
     * Test track
     */
    public function testTrack()
    {
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
        $response = $this->segment->alias(
            3,
            2
        );

        $this->assertTrue($response);
    }
}

