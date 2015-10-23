<?php
namespace SegmentIO\SegmentIOBundle\Segment;

use SegmentIO\SegmentIOBundle\Client\Client;

/**
 * Class Segment
 * @package SegmentIO\SegmentIOBundle\Segment
 */
class Segment
{

    private $client;
    private $secret;

    /**
     * Initializes the default client to use. Uses the socket consumer by default.
     * @param  string $secret your project's secret key
     */
    public function __construct($secret)
    {
        $this->secret = $secret;
        $this->client = new Client($secret);
    }

    /**
     * Tracks a user action
     *
     * @param int    $userId
     * @param string $event
     * @param array  $properties
     * @return bool Whether the track call succeeded
     * @throws Exception
     */
    public function track($userId, $event, array $properties)
    {
        if (!$this->isValid()) {
            return false;
        }

        return $this->client->track(
            array(
                'userId' => $userId,
                'event' => $event,
                'properties' => $properties,
            )
        );
    }

    /**
     * Tags traits about the user.
     *
     * @param  int   $userId
     * @param  array $traits
     * @return bool Whether the identify call succeeded
     */
    public function identify($userId, array $traits)
    {
        if (!$this->isValid()) {
            return false;
        }

        return $this->client->identify(
            array(
                'userId' => $userId,
                'traits' => $traits,
            )
        );
    }

    /**
     * Tags traits about the group.
     *
     * @param int   $groupId
     * @param int   $userId
     * @param array $message
     * @return bool Whether the group call succeeded
     */
    public function group($groupId, $userId, array $message)
    {
        if (!$this->isValid()) {
            return false;
        }

        $message['groupId'] = $groupId;
        $message['userId'] = $userId;

        return $this->client->group($message);
    }

    /**
     * Tracks a page view
     *
     * @param  array $properties
     * @return boolean whether the page call succeeded
     */
    public function page(array $properties)
    {
        if (!$this->isValid()) {
            return false;
        }

        return $this->client->page(array('properties' => $properties));
    }

    /**
     * Tracks a screen view
     *
     * @param  array $properties
     * @return boolean whether the screen call succeeded
     */
    public function screen(array $properties)
    {
        if (!$this->isValid()) {
            return false;
        }

        return $this->client->screen(array('properties' => $properties));
    }

    /**
     * Aliases the user id from a temporary id to a permanent one
     *
     * @param int   $userId
     * @param int   $previousId
     * @param array $message
     * @return bool
     */
    public function alias($userId, $previousId, array $message)
    {
        if (!$this->isValid()) {
            return false;
        }

        return $this->client->alias(
            array('userId' => $userId, 'previousId' => $previousId)
        );
    }

    /**
     * Flush the client
     *
     * @return bool|void
     */
    public function flush()
    {
        if (!$this->isValid()) {
            return false;
        }

        return $this->client->flush();
    }

    /**
     * @return bool
     */
    private function isValid()
    {
        return !empty($this->secret);
    }
}
