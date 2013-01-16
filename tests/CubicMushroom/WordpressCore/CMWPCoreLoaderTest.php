<?php
/**
 * PHPUnit Tests for CMWPCoreLoader class file
 */

namespace CubicMushroom\WordpressCore;

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
     * Test if OK when passing an object extended from the PluginInfo class
     */
    public function testRegisterValidPlugin()
    {
        $dummyPlugin = new \DummyPlugin();
        CMWPCoreLoader::registerPlugin($dummyPlugin);
        $this->assertAttributeContains($dummyPlugin, 'plugins', 'CubicMushroom\WordpressCore\CMWPCoreLoader');
    }

    /**
     * Test if not OK when passing an array
     *
     * @expectedException        PHPUnit_Framework_Error
     * @expectedExceptionMessage Argument 1 passed to CubicMushroom\WordpressCore\CMWPCoreLoader::registerPlugin()
     *                           must be an instance of CubicMushroom\WordpressCore\Plugin\PluginInfo
     */
    public function testRegisterInvalidArrayPlugin()
    {
        $dummyPlugin = array(
            'name' => 'Dummy Plugin'
        );
        CMWPCoreLoader::registerPlugin($dummyPlugin);
    }
}