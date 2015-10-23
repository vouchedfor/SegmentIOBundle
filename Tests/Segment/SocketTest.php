<?php

namespace Vouchedfor\SegmentIOBundle\Segment;

use Vouchedfor\SegmentIOBundle\Consumer\Socket;

/**
 * Class SocketTest
 * @package Vouchedfor\SegmentIOBundle\Consumer
 */
class SocketTest extends \PHPUnit_Framework_TestCase
{
    private $segmentNoKey;
    private $segment;

    public function setup()
    {
        $this->segment = new Segment(new Socket(''), 'random_secret_key');
        $this->segmentNoKey = new Segment(new Socket(''), '');
    }

    /**
     * Test empty secret key
     */
    public function testTrackEmptySecretKey()
    {
        $response = $this->segmentNoKey->track(
            2,
            'Test Event',
            array("property1" => "Value 1",
                "property2" => "Value 2",
            )
        );

        $this->assertFalse($response);
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
     * Test empty secret key
     */
    public function testIdentifyEmptySecretKey()
    {
        $response = $this->segmentNoKey->identify(
            2,
            array(
                "traits" => array(
                    "name" => "John Lennon",
                    "email" => "john@test.com",
                    "vertical" => "solicitor",
                ),
            )
        );

        $this->assertFalse($response);
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
     * Test empty secret key
     */
    public function testGroupEmptySecretKey()
    {
        $response = $this->segmentNoKey->group(
            3,
            2,
            array(
                "company" => "Acme Corp",
                "location" => "San Francisco",
            )
        );

        $this->assertFalse($response);
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
     * Test empty secret key
     */
    public function testPageEmptySecretKey()
    {
        $response = $this->segmentNoKey->page(
            3,
            'Login page',
            array(
                "url" => "http://example.com",
                "referrer" => "http://google.com",
            )
        );

        $this->assertFalse($response);
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
     * Test empty secret key
     */
    public function testScreenEmptySecretKey()
    {
        $response = $this->segmentNoKey->screen(
            3,
            'Signup',
            array(
                "url" => "http://example.com",
                "referrer" => "http://google.com",
            )
        );

        $this->assertFalse($response);
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
     * Test empty secret key
     */
    public function testAliasEmptySecretKey()
    {
        $response = $this->segmentNoKey->alias(
            3,
            2
        );

        $this->assertFalse($response);
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

