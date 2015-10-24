<?php
namespace Vouchedfor\SegmentIOBundle\Segment;

use Vouchedfor\SegmentIOBundle\Client\Client;
use Vouchedfor\SegmentIOBundle\Consumer\AbstractConsumer;

/**
 * Class Segment
 * @package Vouchedfor\SegmentIOBundle\Segment
 */
class Segment
{

    private $client;

    /**
     * Initializes the default client to use. Uses the socket consumer by default.
     *
     * @param AbstractConsumer $consumer
     */
    public function __construct(AbstractConsumer $consumer)
    {
        $this->client = new Client($consumer);
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
        return $this->getClient()->track(
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
        return $this->getClient()->identify(
            array(
                'userId' => $userId,
                'traits' => $traits,
            )
        );
    }

    /**
     * Tags traits about the group.
     *
     * @param int   $userId
     * @param int   $groupId
     * @param array $traits
     * @return bool Whether the group call succeeded
     */
    public function group($userId, $groupId, array $traits)
    {
        return $this->getClient()->group(array('userId' => $userId,
                                               'groupId' => $groupId,
                                               'traits' => $traits));
    }

    /**
     * Tracks a page view
     *
     * @param int    $userId
     * @param string $name
     * @param  array $properties
     * @return boolean whether the page call succeeded
     */
    public function page($userId, $name, array $properties)
    {
        return $this->getClient()->page(array('userId' => $userId,
                                              'name' => $name,
                                              'properties' => $properties));
    }

    /**
     * Tracks a screen view
     *
     * @param int    $userId
     * @param string $name
     * @param array  $properties
     * @return boolean whether the screen call succeeded
     */
    public function screen($userId, $name, array $properties)
    {
        return $this->getClient()->screen(array('userId' => $userId,
                                                'name' => $name,
                                                'properties' => $properties));
    }

    /**
     * Aliases the user id from a temporary id to a permanent one
     *
     * @param int   $previousId
     * @param int   $userId
     * @return bool
     */
    public function alias($previousId, $userId)
    {
        return $this->getClient()->alias(array('previousId' => $previousId, 'userId' => $userId));
    }

    /**
     * Flush the client
     *
     * @return bool|void
     */
    public function flush()
    {
        return $this->getClient()->flush();
    }

    /**
     * @return \Vouchedfor\SegmentIOBundle\Client\Client
     */
    private function getClient()
    {
        return $this->client;
    }
}
