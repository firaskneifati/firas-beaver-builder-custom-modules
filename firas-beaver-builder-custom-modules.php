<?php
/**
 * Plugin Name: Firas Beaver Builder Custom Modules
 * Plugin URI: https://onestepweb.ca
 * Description: Custom Beavor Builder Modules Created By Firas Kneifati.
 * Version: 1.0
 * Author: Firas Kneifati
 * Author URI: https://onestepweb.ca
 */
define( 'FIRAS_BEAVER_MODULES_DIR', plugin_dir_path( __FILE__ ) );
define( 'FIRAS_BEAVER_MODULES_URL', plugins_url( '/', __FILE__ ) );

require_once FIRAS_BEAVER_MODULES_DIR . 'classes/class-firas-custom-beaver-modules-loader.php';