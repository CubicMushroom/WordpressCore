<?php
/**
 * 
 */

namespace CubicMushroom\WordpressCore;

uses CubicMushroom\WordpressCore\Exceptions\MissingDetailsException;
uses CubicMushroom\WordpressCore\Plugin\PluginInfo;

/**
 * 
 */
class CMWPCoreLoader()
{
    /**
     * @var array Stores each registered plugin
     */
    protected static $plugins = array();

    //
    protected static function registerPlugin(PluginInfo $plugin)
    {
        self::$plugins[] = $plugin;
    }
}