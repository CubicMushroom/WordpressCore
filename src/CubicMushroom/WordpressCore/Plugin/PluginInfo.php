<?php
/**
 * Abstract Plugin class extended by each plugin with it's own settings
 */

namespace CubicMushroom\WordpressCore\Plugin;

/**
 * Abstract Plugin class extended by each plugin with it's own settings
 */
abstract class PluginInfo
{
    /**
     * @var string Name of the plugin
     */
    public $name;

    /**
     * @var string Description of the plugin
     */
    public $description;

    /**
     * @var string Version of the plugin
     */
    public $version;

    /**
     * @var string Version number of the bundled core files
     */
    public $bundledCore;
}