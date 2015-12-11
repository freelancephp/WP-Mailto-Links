<?php defined('ABSPATH') OR die('No direct access.');
/*
Plugin Name:    WP Mailto Links - Manage Email Links
Plugin URI:     http://www.freelancephp.net/wp-mailto-links-plugin
Description:    Manage mailto links on your site and protect email addresses from spambots, set mail icon and more.
Author:         Victor Villaverde Laan
Version:        1.6.0
Author URI:     http://www.freelancephp.net
License:        Dual licensed under the MIT and GPL licenses
Text Domain:    wp-mailto-links
Domain Path:    /languages
*/

// autoloader
if (!class_exists('WPDev_Loader')) {
    require_once realpath(__DIR__ . '/classes/WPDev/Loader.php');
}

WPDev_Loader::register();
WPDev_Loader::addPath(__DIR__ . '/classes');

// start plugin
WPML::create(array(
    'key'   => 'wp-mailto-links',
    'FILE'  => __FILE__,
    'DIR'   => __DIR__,
    'URL'   => defined('WPML_BASE_URL') ? constant('WPML_BASE_URL') : plugins_url('', __FILE__),
));

/*?>*/
