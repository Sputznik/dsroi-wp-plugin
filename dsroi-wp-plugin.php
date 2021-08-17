<?php
/*
Plugin Name: DSROI WP Plugin
Plugin URI: https://sputznik.com/
Description: DSROI WP Plugin
Version: 1.0.0
Author: Stephen Anil, Sputznik
Author URI: https://sputznik.com/
*/

if( ! defined( 'ABSPATH' ) ){ exit; }

define( 'DSROI_VERSION', time() );
define( 'DSROI_PATH', plugin_dir_path( __FILE__ ) );
define( 'DSROI_URI', plugin_dir_url( __DIR__ ).'dsroi-wp-plugin/' ); // ROOT URL
define( 'DSROI_SINGLE_TEMPLATE', DSROI_PATH."partials/singles/" );

register_activation_hook( __FILE__, array( 'DSROI_PLUGIN_INIT', 'pluginActivation' ) );
register_deactivation_hook( __FILE__, array( 'DSROI_PLUGIN_INIT', 'pluginDeactivation' ) );

$inc_files = array(
  'class-dsroi-base.php',
  'lib/lib.php',
  'admin/admin.php',
  'shortcodes/shortcodes.php'
);

foreach( $inc_files as $inc_file ){
	require_once( $inc_file );
}
