<?php
/**
 * Abstract Plugin class extended by each plugin with it's own settings
 */

namespace CubicMushroom\WordpressCore\Plugin;

use CubicMushroom\WordpressCore\Exception\MissingPropertyException;

/**
 * Abstract Plugin class extended by each plugin with it's own settings
 */
abstract class PluginInfo
{
    /**
     * @var string Name of the plugin
     */
    protected $name;

    /**
     * @var string Identifier of the plugin
     */
    protected $id;

    /**
     * @var string Description of the plugin
     */
    protected $description;

    /**
     * @var string Version of the plugin
     */
    protected $version;

    /**
     * @var string Version number of the bundled core files
     */
    protected $bundledCore;

    /**
     * Method used to check all required properties are defined in child classes
     */
    public function checkRequired()
    {
        $requiredProperties = array('name', 'id', 'version', 'bundledCore');
        foreach ($requiredProperties as $requiredProperty) {
            if (empty($this->{$requiredProperty})) {
                throw new MissingPropertyException(
                    "$requiredProperty property is not defined"
                );
            }
        }
    }


    /******************
     * Getter methods *
     ******************/

    /**
     * Getter for name property
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Getter for id property
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Getter for description property
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Getter for version property
     *
     * @return string
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * Getter for bundledCore property
     *
     * @return string
     */
    public function getBundledCore()
    {
        return $this->bundledCore;
    }
}