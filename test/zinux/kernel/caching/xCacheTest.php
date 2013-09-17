<?php

namespace zinux\kernel\caching;

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2013-09-08 at 07:22:46.
 */
class xCacheTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var xCache
     */
    protected $object;
    /**
     *
     * @var fileCache
     */
    protected $fileCache;
    /**
     *
     * @var sessionCache
     */
    protected $sessionCache;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new xCache(__CLASS__);
        $this->fileCache = new fileCache(__CLASS__);
        $this->sessionCache = new sessionCache(__CLASS__);
        $this->object->deleteAll();
        $this->fileCache->deleteAll();
        $this->sessionCache->deleteAll();
        $this->assertArrayHasKey($this->sessionCache->getCacheDirectory(), $_SESSION);
        $this->assertFalse(isset($_SESSION[$this->sessionCache->getCacheDirectory()][$this->object->getCacheName()]));
        for($index = 0; $index<10; $index++)
        {
            $this->assertFalse($this->fileCache->isCached("KEY##$index"));
            $this->assertFalse($this->sessionCache->isCached("KEY##$index"));
        }
        for($index = 0; $index<10; $index++)
        {
            $this->object->save("KEY##$index", "VALUE##$index");
        }
        $this->assertNotNull($this->object);
        $this->assertTrue(isset($_SESSION[$this->sessionCache->getCacheDirectory()][$this->object->getCacheName()]));
        $this->assertCount(10, $this->object->fetchAll());
        $this->assertTrue(file_exists($this->fileCache->getCacheFile()));
        for($index = 0; $index<10; $index++)
        {
            $this->assertTrue($this->fileCache->isCached("KEY##$index"));
            $this->assertTrue($this->sessionCache->isCached("KEY##$index"));
        }
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
        
    }

    /**
     * @covers zinux\kernel\caching\xCache::store
     * @todo   Implement testsave().
     */
    public function testsave()
    {
        $this->setUp();
    }

    /**
     * @covers zinux\kernel\caching\xCache::retrieve
     * @todo   Implement testfetch().
     */
    public function testfetch()
    {
        for($index = 0; $index<10; $index++)
        {
            $this->assertEquals($this->fileCache->fetch("KEY##$index"), "VALUE##$index");
            $this->assertEquals($this->sessionCache->fetch("KEY##$index"), "VALUE##$index");
            $this->assertEquals($this->object->fetch("KEY##$index"), "VALUE##$index");
        }
    }

    /**
     * @covers zinux\kernel\caching\xCache::erase
     * @todo   Implement testdelete().
     */
    public function testdelete()
    {
        for($index = 0; $index<10; $index++)
        {
            $this->assertTrue($this->fileCache->isCached("KEY##$index"));
            $this->assertTrue($this->sessionCache->isCached("KEY##$index"));
            $this->assertTrue($this->object->isCached("KEY##$index"));
            $this->object->delete("KEY##$index");
            $this->assertFalse($this->fileCache->isCached("KEY##$index"));
            $this->assertFalse($this->sessionCache->isCached("KEY##$index"));
            $this->assertFalse($this->object->isCached("KEY##$index"));
        }
    }

    /**
     * @covers zinux\kernel\caching\xCache::deleteAll(
     * @todo   Implement testdeleteAll().
     */
    public function testdeleteAll()
    {
        $this->assertArrayHasKey($this->sessionCache->getCacheDirectory(), $_SESSION);
        $this->assertArrayHasKey($this->sessionCache->getCacheName(), $_SESSION[$this->sessionCache->getCacheDirectory()]);
        $this->assertTrue(file_exists($this->fileCache->getCacheFile()));
        $this->object->deleteAll();
        $this->assertArrayHasKey($this->sessionCache->getCacheDirectory(), $_SESSION);
        $this->assertArrayNotHasKey($this->sessionCache->getCacheName(), $_SESSION[$this->sessionCache->getCacheDirectory()]);
        $this->assertFalse(file_exists($this->fileCache->getCacheFile()));
    }

    /**
     * @covers zinux\kernel\caching\xCache::eraseExpired
     * @todo   Implement testdeleteExpired().
     */
    public function testdeleteExpired()
    {
        for($index = 0; $index<10; $index+=2)
        {
            $this->object->setExpireTime("KEY##$index", 3600);
            $this->object->deleteExpired();
            $this->assertCount(10-($index)/2, $this->object->fetchAll());
            $this->assertCount(10-($index)/2, $this->fileCache->fetchAll());
            $this->assertCount(10-($index)/2, $this->sessionCache->fetchAll());
            $this->object->setExpireTime("KEY##$index", -3600);
        }
        $this->assertCount(5, $this->object->fetchAll());
        $this->assertCount(5, $this->fileCache->fetchAll());
        $this->assertCount(5, $this->sessionCache->fetchAll());
    }

    /**
     * @covers zinux\kernel\caching\xCache::isCached
     * @todo   Implement testIsCached().
     */
    public function testIsCached()
    {
        for($index = 0; $index<10; $index++)
        {
            $this->assertTrue($this->fileCache->isCached("KEY##$index"));
            $this->assertTrue($this->sessionCache->isCached("KEY##$index"));
            $this->assertTrue($this->object->isCached("KEY##$index"));
            $this->object->setExpireTime("KEY##$index", 3600);
            $this->assertTrue($this->fileCache->isCached("KEY##$index"));
            $this->assertTrue($this->sessionCache->isCached("KEY##$index"));
            $this->assertTrue($this->object->isCached("KEY##$index"));
            $this->object->setExpireTime("KEY##$index", -3600);
            $this->assertFalse($this->fileCache->isCached("KEY##$index"));
            $this->assertFalse($this->sessionCache->isCached("KEY##$index"));
            $this->assertFalse($this->object->isCached("KEY##$index"));
            $this->object->save("KEY##$index", "VALUE##$index",1);
            $this->assertTrue($this->fileCache->isCached("KEY##$index"));
            $this->assertTrue($this->sessionCache->isCached("KEY##$index"));
            $this->assertTrue($this->object->isCached("KEY##$index"));
            $this->object->setExpireTime("KEY##$index", -1);
            $this->assertFalse($this->fileCache->isCached("KEY##$index"));
            $this->assertFalse($this->sessionCache->isCached("KEY##$index"));
            $this->assertFalse($this->object->isCached("KEY##$index"));
            $this->object->save("KEY##$index", "VALUE##$index",1);
            $this->assertTrue($this->fileCache->isCached("KEY##$index"));
            $this->assertTrue($this->sessionCache->isCached("KEY##$index"));
            $this->assertTrue($this->object->isCached("KEY##$index"));
            $this->assertFalse($this->object->isCached("$index##KEY"));
        }
        $this->assertCount(10, $this->object->fetchAll());
        $this->assertCount(10, $this->fileCache->fetchAll());
        $this->assertCount(10, $this->sessionCache->fetchAll());
    }

    /**
     * @covers zinux\kernel\caching\xCache::retrieveAll
     * @todo   Implement testfetchAll().
     */
    public function testfetchAll()
    {
        $this->assertCount(10, $this->object->fetchAll());
        $this->assertCount(10, $this->fileCache->fetchAll());
        $this->assertCount(10, $this->sessionCache->fetchAll());
        for($index = 0; $index<10; $index+=2)
        {
            $this->object->delete("KEY##$index");
            $this->object->delete("++KEY##$index");
        }
        $this->assertCount(5, $this->object->fetchAll());
        $this->assertCount(5, $this->fileCache->fetchAll());
        $this->assertCount(5, $this->sessionCache->fetchAll());
    }

    /**
     * @covers zinux\kernel\caching\xCache::getCache
     * @todo   Implement testGetCacheName().
     */
    public function testGetCacheName()
    {
        $this->assertEquals(__CLASS__, $this->object->getCacheName());
        $this->assertEquals(__CLASS__, $this->fileCache->getCacheName());
        $this->assertEquals(__CLASS__, $this->sessionCache->getCacheName());
    }

    /**
     * @covers zinux\kernel\caching\xCache::getCacheDirectory
     * @todo   Implement testgetCacheDirectory().
     */
    public function testgetCacheDirectory()
    {
        $this->assertEquals("test", basename($this->object->getCacheDirectory()));
        $this->assertEquals("test", basename($this->fileCache->getCacheDirectory()));
        $this->assertEquals("cache", ($this->sessionCache->getCacheDirectory()));
    }

    /**
     * @covers zinux\kernel\caching\xCache::setCache
     * @todo   Implement testSetCacheName().
     */
    public function testSetCacheName()
    {
        $this->object->setCacheName("Foo");
        $this->assertEquals("Foo", $this->object->getCacheName());
    }

    /**
     * @covers zinux\kernel\caching\xCache::setCachePath
     * @todo   Implement testSetCachePath().
     */
    public function testSetCachePath()
    {
        $this->object->setCachePath($this->object->getCacheDirectory()."~Foo");
        $this->assertEquals("~Foo", basename($this->object->getCacheDirectory()));
        $this->fileCache->setCachePath($this->object->getCacheDirectory());
        $this->fileExists($this->fileCache->getCacheFile());
    }

    /**
     * @covers zinux\kernel\caching\xCache::GetStatisticReportString
     * @todo   Implement testGetStatisticReportString().
     */
    public function testGetStatisticReportString()
    {
        echo PHP_EOL;
        ob_start();
        $c = $this->object->GetStatisticReportString();
        $c = ob_get_contents();
        ob_end_clean();
        echo str_replace("<br />", PHP_EOL, $c);
    }
}