<?php

/*
Plugin Name: Custom Slider

Description: Custom Slider Widget for Elementor.
 
Version: 0.1
 
Author: Tomas
 
Author URI: https://github.com/marin73tomas/koc-custom-elementor-widget-plugin

*/

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
define("KOC_CW_PATH", plugin_dir_url(__FILE__));
include_once("includes/class-koc-widget-builder.php");
