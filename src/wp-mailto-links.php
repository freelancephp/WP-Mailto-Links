<?php defined('ABSPATH') OR die('No direct access.');
/*
Plugin Name:    WP Mailto Links - Manage Email Links
Plugin URI:     http://www.freelancephp.net/wp-mailto-links-plugin
Description:    Manage mailto links on your site and protect email addresses from spambots, set mail icon and more.
Author:         Victor Villaverde Laan
Version:        2.0.1
Author URI:     http://www.freelancephp.net
License:        Dual licensed under the MIT and GPL licenses
Text Domain:    wp-mailto-links
Domain Path:    /languages
*/
// constant
if (!defined('WP_MAILTO_LINKS_FILE')) {
    define('WP_MAILTO_LINKS_FILE', __FILE__);
}

// autoloader
if (!class_exists('WPLim_Loader_0x4x0')) {
    require_once __DIR__ . '/classes/WPLim/Loader.php';
}
WPLim_Loader_0x4x0::register();
WPLim_Loader_0x4x0::addPath(__DIR__ . '/classes');

// start plugin
WPML_Plugin::create(array(
    'file'      => WP_MAILTO_LINKS_FILE,
    'dir'       => __DIR__,
    'baseUrl'   => plugins_url('', WP_MAILTO_LINKS_FILE),
));

/*?>*/
