<?php

namespace CubicMushroom\WordpressCore\Component\Plugin;

use CubicMushroom\WordpressCore\Component\Plugin\PluginInfo;
use CubicMushroom\WordpressCore\Component\Plugin\PluginLoader;
use CubicMushroom\WordpressCore\Exception\ItemAlreadyExistsException;

class PluginRegistryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Setup the WP mock class
     */
    public function setup()
    {
        if (! PluginRegistry::isLoaderSet()) {
            $loader = $this->getMockClass(
                'CubicMushroom\WordpressCore\Component\Plugin\PluginLoader',
                array('hook')
            );
            PluginRegistry::setLoader(new $loader);
        }
    }

    /**
     * Reset the PluginRegistry 
     */
    public function tearDown()
    {
        $reflectorClass = new \ReflectionClass(
            'CubicMushroom\WordpressCore\Component\Plugin\PluginRegistry'
        );
        $storeProperty = $reflectorClass->getProperty('_store');
        $storeProperty->setAccessible(true);
        $storeProperty->setValue(array());
    }

    /**
     * Tests test are running OK
     */
    public function testTest()
    {
        $this->assertEquals(1, 1);
    }

    /**
     * Test adding an item to the registry is in store
     */
    public function testAddItemInStoreArray()
    {
        $obj = new TestPluginObject;
        PluginRegistry::add($obj);

        $this->assertAttributeContains(
            $obj,
            '_store',
            'CubicMushroom\WordpressCore\Component\Plugin\PluginRegistry'
        );
    }

    /**
     * Test adding an item to the registry is in store keys
     */
    public function testAddItemInStoreArrayKeys()
    {
        $obj = new TestPluginObject;
        PluginRegistry::add($obj);

        // Use reflector class to gain access to protected property
        $reflector = new \ReflectionProperty(
            'CubicMushroom\WordpressCore\Component\Plugin\PluginRegistry',
            '_store'
        );
        $reflector->setAccessible(true);

        // Verify the array key exists in the store
        $this->assertContains(
            'CubicMushroom\WordpressCore\Component\Plugin\TestPluginObject',
            array_keys(
                $reflector->getValue(
                    'CubicMushroom\WordpressCore\Component\Plugin\PluginRegistry',
                    '_store'
                )
            )
        );
    }

    /**
     * Test adding an item to the registry that PluginRegistry::contains() returns
     * true
     */
    public function testContainsAddAndRemove()
    {
        $obj = new TestPluginObject;
        PluginRegistry::add($obj);

        // Check contains
        $this->assertTrue(PluginRegistry::contains(
            'CubicMushroom\WordpressCore\Component\Plugin\TestPluginObject'
        ));

        // Check removal
        PluginRegistry::remove(
            'CubicMushroom\WordpressCore\Component\Plugin\TestPluginObject'
        );
        $this->assertFalse(PluginRegistry::contains(
            'CubicMushroom\WordpressCore\Component\Plugin\TestPluginObject'
        ));
    }

    /**
     * Test adding a second, same class item to the registry
     *
     * @expectedException CubicMushroom\WordpressCore\Exception\ItemAlreadyExistsException
     */
    public function testAddDuplicateItem()
    {
        $obj1 = new TestPluginObject;
        $obj2 = new TestPluginObject;

        PluginRegistry::add($obj1);
        PluginRegistry::add($obj2);
    }

    /**
     * Test with a PluginInfo object with missing parameters
     * @expectedException CubicMushroom\WordpressCore\Exception\MissingPropertyException
     */
    public function testEmptyPluginObject()
    {
        $obj = new TestEmptyPluginObject;

        PluginRegistry::add($obj);
    }

    /**
     * Test with a non-PluginInfo object
     * @expectedException PHPUnit_Framework_Error
     */
    public function testInvalidObjectType()
    {
        $obj = new TestObject;

        PluginRegistry::add($obj);
    }
}

class TestObject
{

}

class TestPluginObject extends PluginInfo
{
    public $name        = 'Something';
    public $id          = 'Something';
    public $class       = 'Something';
    public $version     = 'Something';
    public $bundledCore = '1.0';
}

class TestEmptyPluginObject extends PluginInfo
{

}