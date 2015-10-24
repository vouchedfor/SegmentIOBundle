<?php
namespace Vouchedfor\SegmentIOBundle\Segment;

use Vouchedfor\SegmentIOBundle\Consumer\File;

/**
 * Class FileTest
 * @package Vouchedfor\SegmentIOBundle\Consumer
 */
class FileTest extends \PHPUnit_Framework_TestCase
{
    private $segment;

    public function setup()
    {
        $this->segment = new Segment(new File('',  array('filename' => $this->getFilename())));
    }

    public function tearDown()
    {
        unlink($this->getFilename());
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

        $this->checkWritten('track');
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

        $this->checkWritten('identify');
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

        $this->checkWritten('group');
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

        $this->checkWritten('page');
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

        $this->checkWritten('screen');
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

        $this->checkWritten('alias');
    }

    /**
     * @param $type
     */
    private function checkWritten($type) {
        exec('wc -l ' . $this->getFilename(), $output);
        $out = trim($output[0]);
        $this->assertEquals($out, '1 ' . $this->getFilename());
        $str = file_get_contents($this->getFilename());
        $json = json_decode(trim($str));
        $this->assertEquals($type, $json->type);
    }

    /**
     * @return string
     */
    private function getFilename(){
        return sys_get_temp_dir().DIRECTORY_SEPARATOR.'file_test_analytics.log';
    }
}

