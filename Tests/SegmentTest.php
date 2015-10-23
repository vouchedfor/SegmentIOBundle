<?php

namespace Vouchedfor\SegmentIOBundle\Segment;

use Vouchedfor\SegmentIOBundle\Client\Client;

/**
 * Class SegmentTest
 * @package Vouchedfor\SegmentIOBundle\Segment
 */
class SegmentTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test valid request
     */
    public function testIdentify()
    {
        date_default_timezone_set('GMT');

        $segment = new Segment('random_secret_key');

        $response = $segment->identify(
            2,
            array(
                "traits" => array(
                    "name" => "John Lennon",
                    "email" => "john@test.com",
                    "vertical" => "solicitor",
                ),
            )
        );

        $this->assertTrue($response);
    }

    /**
     * Test valid request
     */
    public function testTrack()
    {
        date_default_timezone_set('GMT');

        $segment = new Segment('random_secret_key');

        $response = $segment->track(
            23030,
            'Took class2',
            array(
                "idea" => "Philisophy",
            )
        );

        $this->assertTrue($response);
    }
}

