<?php
namespace Vouchedfor\SegmentIOBundle\Segment;

use Vouchedfor\SegmentIOBundle\Client\Client;
use Vouchedfor\SegmentIOBundle\Consumer\AbstractConsumer;
use Vouchedfor\SegmentIOBundle\Consumer\Socket;

/**
 * Class Segment
 * @package Vouchedfor\SegmentIOBundle\Segment
 */
class Segment
{

    private $client;
    private $secret;

    /**
     * Initializes the default client to use. Uses the socket consumer by default.
     *
     * @param AbstractConsumer $consumer
     * @param $secret
     */
    public function __construct(AbstractConsumer $consumer, $secret)
    {
        $this->secret = $secret;
        $this->client = new Client($consumer, $secret);
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
        if (!$this->isValid()) {
            return false;
        }

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
     * @param int   $groupId
     * @param int   $userId
     * @param array $traits
     * @return bool Whether the group call succeeded
     */
    public function group($groupId, $userId, array $traits)
    {
        if (!$this->isValid()) {
            return false;
        }

        return $this->getClient()->group(array('groupId' => $groupId,
                                               'userId' => $userId,
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
        if (!$this->isValid()) {
            return false;
        }

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
        if (!$this->isValid()) {
            return false;
        }

        return $this->getClient()->screen(array('userId' => $userId,
                                                'name' => $name,
                                                'properties' => $properties));
    }

    /**
     * Aliases the user id from a temporary id to a permanent one
     *
     * @param int   $userId
     * @param int   $previousId
     * @return bool
     */
    public function alias($userId, $previousId)
    {
        if (!$this->isValid()) {
            return false;
        }

        return $this->getClient()->alias(array('userId' => $userId, 'previousId' => $previousId)
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

        return $this->getClient()->flush();
    }

    /**
     * @return bool
     */
    private function isValid()
    {
        return !empty($this->secret);
    }


    /**
     * @return \Vouchedfor\SegmentIOBundle\Client\Client
     */
    private function getClient()
    {
        return $this->client;
    }
}
