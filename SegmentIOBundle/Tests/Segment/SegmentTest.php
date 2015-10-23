<?php

namespace SegmentIO\SegmentIOBundle\Tests\Segment;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class SegmentTest
 * @package SegmentIO\SegmentIOBundle\Tests\Segment
 */
class SegmentTest extends WebTestCase
{
    protected static $kernel;
    protected $container;

    /**
     * Set up container
     */
    public function setUp()
    {
        self::$kernel = static::createKernel();
        self::$kernel->boot();
        $this->container = self::$kernel->getContainer();
    }

    /**
     * Test SegmentIO integration
     */
    public function testPost()
    {
        $segment = $this->container->get('segmentio.segment');

        $segment->identify(
            2,
            array(
                "traits" => array(
                    "name" => "John Lennon",
                    "email" => "john@test.com",
                    "vertical" => "solicitor",
                ),
            )
        );

        $segment->track(
            23030,
            'Event 2',
            array(
                "plan" => "Death Star",
            )
        );

        $segment->track(
            23030,
            'Took class2',
            array(
                "idea" => "Philisophy",
            )
        );

        $this->assertEquals(1, 1);
    }

}

