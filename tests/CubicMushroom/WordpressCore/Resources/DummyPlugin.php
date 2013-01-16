<?php

use CubicMushroom\WordpressCore\Plugin\PluginInfo;

class DummyPlugin extends PluginInfo
{
    public $name        = 'Dummy Plugin';
    public $id          = 'dummy-plugin';
    public $version     = '1.0';
    public $bundledCore = '1.0';
}