<?php

use CubicMushroom\WordpressCore\Component\Plugin\Plugin;

class DummyPlugin extends Plugin
{
    public $name        = 'Dummy Plugin';
    public $id          = 'dummy-plugin';
    public $version     = '1.0';
    public $bundledCore = '1.0';
}