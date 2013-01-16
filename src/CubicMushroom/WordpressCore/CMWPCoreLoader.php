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

    //
    public static function registerPlugin(PluginInfo $plugin)
    {
        self::$plugins[] = $plugin;
    }
}