<?php
/**
 * 
 */

namespace CubicMushroom\WordpressCore;

use CubicMushroom\WordpressCore\Exceptions\MissingDetailsException;
use CubicMushroom\WordpressCore\Component\Plugin\Plugin;

/**
 * 
 */
class CMWPCoreLoader
{
    /**
     * @var array Stores each registered plugin
     */
    static $plugins = array();

    /**
     * Register a plugin with the loader
     *
     * @uses Plugin::check()
     */
    public static function registerPlugin(Plugin $plugin)
    {
        // Check whether the plugin requirements have been met
        $plugin->checkRequired();
        self::$plugins[$plugin->id] = $plugin;

        // Now a plugin has been registered we need to ensure it's accessible after
        // all plugins have been loaded
        add_action('plugins_loaded', array(__CLASS__, 'pluginsLoaded'), 1);
    }

    public static function pluginsLoaded()
    {
        foreach (self::$plugins as $plugin) {
            if (is_callable(array($plugin, 'pluginLoaded'))) {
                $plugin->pluginLoaded();
            }
        }
    }
}