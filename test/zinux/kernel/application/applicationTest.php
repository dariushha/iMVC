<?php

namespace zinux\kernel\application;

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2013-09-08 at 07:22:47.
 */
class applicationTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var application
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new application(PROJECT_ROOT."MOdules");
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
        
    }

    /**
     * @covers zinux\kernel\application\application::Run
     * @todo   Implement testRun().
     */
    public function testRun()
    {
        $this->assertTrue(true);
    }

    /**
     * @covers zinux\kernel\application\application::Shutdown
     * @todo   Implement testShutdown().
     */
    public function testShutdown()
    {
        $this->assertTrue(true);
    }

    /**
     * @covers zinux\kernel\application\application::Startup
     * @todo   Implement testStartup().
     */
    public function testStartup()
    {
        $this->assertTrue(true);
    }

    /**
     * @covers zinux\kernel\application\application::SetConfigFile
     * @todo   Implement testSetConfigFile().
     */
    public function testSetConfigFile()
    {
        $this->assertTrue(true);
    }

}