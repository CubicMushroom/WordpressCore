<?php
/**
 * 
 */

namespace CubicMushroom\WordpressCore;

use CubicMushroom\WordpressCore\Exceptions\MissingDetailsException;
use CubicMushroom\WordpressCore\Plugin\PluginInfo;

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
     * @uses PluginInfo::check()
     */
    public static function registerPlugin(PluginInfo $plugin)
    {
        // Check whether the plugin requirements have been met
        $plugin->checkRequired();
        self::$plugins[] = $plugin;
    }
}