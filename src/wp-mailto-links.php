<?php defined('ABSPATH') OR die('No direct access.');
/*
Plugin Name:    WP Mailto Links - Manage Email Links
Version:        2.0.1
Plugin URI:     http://www.freelancephp.net/wp-mailto-links-plugin
Description:    Manage mailto links on your site and protect email addresses from spambots, set mail icon and more.
Author:         Victor Villaverde Laan
Author URI:     http://www.freelancephp.net
License:        Dual licensed under the MIT and GPL licenses
Text Domain:    wp-mailto-links
Domain Path:    /languages
*/
// set constant
if (!defined('WP_MAILTO_LINKS_FILE')) {
    define('WP_MAILTO_LINKS_FILE', __FILE__);
}

// set class auto-loader
if (!class_exists('WPLim_Loader_0x4x0')) {
    require_once __DIR__ . '/classes/WPLim/Loader.php';
}
WPLim_Loader_0x4x0::register();
WPLim_Loader_0x4x0::addPath(__DIR__ . '/classes');

// create plugin
WPML_Plugin::create(array(
    'file'      => WP_MAILTO_LINKS_FILE,
    'dir'       => __DIR__,
    'baseUrl'   => plugins_url('', WP_MAILTO_LINKS_FILE),
));

// uninstall, activation and deactivation hooks
WPML_RegisterHook_Activation::register(WP_MAILTO_LINKS_FILE);
WPML_RegisterHook_Uninstall::register(WP_MAILTO_LINKS_FILE);


/*?>*/
