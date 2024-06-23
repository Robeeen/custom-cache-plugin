<?php

/**
 * Custom Plugin
 *
 * Plugin Name: Custom Cache Plugin
 * Plugin URI:  https://wordpress.org/custom_cache_plugin
 * Description: Enables the wordpress cache and disable.
 * Version:     1.0.0
 * Author:      WordPress Contributors
 * Author URI:  https://github.com/robeen/
 * License:     GPLv2 or later
 * License URI: http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * Text Domain: classic-widgets
 * Domain Path: /languages
 * Requires at least: 4.9
 * Requires PHP: 5.6 or later
 *
 * Reference:https://www.youtube.com/watch?v=JieUhUR4x94
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without
 * even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */

//Exit if not access directly
if ( ! defined( 'ABSPATH' ) ) { die( 'Invalid request.' );}

//plugin Versions
define( 'custom-cache-plugin', '1.0.0' );

//paths
define( 'CACHE_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'CACHE_PLUGIN_URL',  plugin_dir_url(__FILE__) );

include( CACHE_PLUGIN_DIR . 'includes/class-custom-cache-plugin.php');

//Plugin Activation 
register_activation_hook( CACHE_PLUGIN_DIR, 'custom_cache_plugin');

function custom_cache_plugin(){
   $custom_cache = new Custom_Cache();
}
$custom_cache = new Custom_Cache();