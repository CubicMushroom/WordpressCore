<?php

namespace CubicMushroom\WordpressCore\Component\Plugin;

use CubicMushroom\WordpressCore\Component\Plugin\PluginInfo;
use CubicMushroom\WordpressCore\Component\Plugin\PluginLoader;
use CubicMushroom\WordpressCore\Component\WP;
use CubicMushroom\WordpressCore\Exception\ItemAlreadyExistsException;
use CubicMushroom\WordpressCore\Exception\LoaderAlreadySetException;
use CubicMushroom\WordpressCore\Exception\LoaderNotSetException;
use CubicMushroom\WordpressCore\Exception\MissingPropertyException;

class PluginRegistry
{

    /**
     * Internal store of objects
     */
    protected static $_store = array();

    /**
     * Injected loader object
     */
    protected static $_loader;

    /**
     * @var Flag to indicate whether the plugins_loaded action hook has added
     */
    protected static $hookActive = false;

    /**
     * Inject the PluginLoader object
     */
    public static function setLoader(PluginLoader $loader)
    {
        if (self::isLoaderSet()) {
            throw new LoaderAlreadySetException("Loader has already been set");
        }
        self::$_loader = $loader;
    }

    /**
     * Checks is loader is already set (mainly for testing)
     */
    public static function isLoaderSet()
    {
        return isset(self::$_loader);
    }

    /**
     * Adds an item to the registry
     *
     * @param object  $plugin The object to be stored
     *
     * @return void
     * @throws ItemAlreadyExistsException
     */
    public static function add(PluginInfo $plugin)
    {
        $requiredProperties = array('name', 'id', 'class', 'version', 'bundledCore');
        foreach ($requiredProperties as $requiredProperty) {
            if (empty($plugin->{$requiredProperty})) {
                throw new MissingPropertyException(
                    "'$requiredProperty' property missing from Plugin object"
                );
            }
        }

        // Check is object already exists
        if (!empty(self::$_store[$plugin->id])) {
            throw new ItemAlreadyExistsException(
                "'$name' plugin already exists in the registry"
            );
        }

        // Check the plugin class can be found
        if (! class_exists($plugin->class)) {
            
        }

        // Add to store
        self::$_store[$plugin->id] = $plugin;

        if (empty(self::$hookActive)) {
            // Check we have a loader
            if (! self::isLoaderSet()) {
                throw new LoaderNotSetException(
                    "Loader has not been set. Use PluginRegistry::setLoader() to " .
                    "do this."
                );
            }
            self::$_loader->hook();
        }
    }

    /**
     * Fetches a stored object
     *
     * @param string $name Name of the object to be retrieved from the store
     *
     * @return object
     * @throws \InvalidArgumentException
     */
    public static function get($name)
    {
        if (!self::$contains($name)) {
            throw new \InvalidArgumentException(
                "Registry does not contain an entry for '$name'"
            );
        }

        return self::$_store[$name];
    }

    /**
     * Checks whether registry contains object
     *
     * @param string $name
     *
     * @return bool
     */
    public static function contains($name)
    {
        return isset(self::$_store[$name]);
    }

    /**
     * Removes an object from the registry
     *
     * @param string $name Object to be removed
     *
     * @return void
     * @throws \InvalidArgumentException
     */
    public static function remove($name)
    {
        if (!self::contains($name)) {
            throw new \InvalidArgumentException(
                "Registry does not contain an entry for '$name'"
            );
        }

        unset(self::$_store[$name]);
    }


    public static function pluginsLoaded()
    {
        wp_die('Loaded!!!');
    }



}