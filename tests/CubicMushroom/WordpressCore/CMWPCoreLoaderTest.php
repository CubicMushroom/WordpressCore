<?php
/**
 * PHPUnit Tests for CMWPCoreLoader class file
 */

namespace CubicMushroom\WordpressCore;

require_once('Resources/DummyEmptyPlugin.php');
require_once('Resources/DummyPlugin.php');

/**
 * PHPUnit Tests for CMWPCoreLoader class
 */
class CMWPCoreLoaderTest extends \PHPUnit_Framework_TestCase
{
    public function testTest()
    {
        $this->assertEquals(1, 1);
    }

    /**
     * Test if not OK when passing an object extended from the Plugin class with missing properties
     * @expectedException        CubicMushroom\WordpressCore\Exception\MissingPropertyException
     */
    public function testRegisterInvalidObjectPlugin()
    {
        $dummyPlugin = new \DummyEmptyPlugin();
        CMWPCoreLoader::registerPlugin($dummyPlugin);
    }

    /**
     * Test if OK when passing an object extended from the Plugin class
     */
    public function testRegisterValidObjectPlugin()
    {
        $dummyPlugin = new \DummyPlugin();
        $dummyPlugin->name = 'Dummy Plugin';
        CMWPCoreLoader::registerPlugin($dummyPlugin);
        $this->assertAttributeContains($dummyPlugin, 'plugins', 'CubicMushroom\WordpressCore\CMWPCoreLoader');
    }

    /**
     * Test if not OK when passing an array
     *
     * @expectedException        PHPUnit_Framework_Error
     * @expectedExceptionMessage Argument 1 passed to CubicMushroom\WordpressCore\CMWPCoreLoader::registerPlugin()
     *                           must be an instance of CubicMushroom\WordpressCore\Component\Plugin\Plugin
     */
    public function testRegisterInvalidArrayPlugin()
    {
        $dummyPlugin = array(
            'name' => 'Dummy Plugin'
        );
        CMWPCoreLoader::registerPlugin($dummyPlugin);
    }
}