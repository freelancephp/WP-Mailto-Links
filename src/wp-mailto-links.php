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
    'key'   => 'plugin-example',
    'FILE'  => __FILE__,
    'DIR'   => __DIR__,
    'URL'   => defined('WPML_BASE_URL') ? constant('WPML_BASE_URL') : plugins_url('', __FILE__),
));

/*?>*/

//if (!defined('WPML_VERSION')) { define('WPML_VERSION', '1.6.0'); }
//if (!defined('WPML_MIN_PHP_VERSION')) { define('WPML_MIN_PHP_VERSION', '5.2.4'); }
//if (!defined('WPML_MIN_WP_VERSION')) { define('WPML_MIN_WP_VERSION', '3.6'); }
//
//// includes
//if (!class_exists('Old_WPDev_Plugin')) {
//    require_once(dirname(__FILE__) . '/classes/Old/WPDev/Plugin.php');
//}
//require_once(dirname(__FILE__) . '/classes/Old/WPML.php');
//
//// wp_version var was used by older WP versions
//if (!isset($wp_version)) {
//    $wp_version = get_bloginfo('version');
//}
//
//// compatibility
//$compatiblePhpVersion = version_compare(phpversion(), WPML_MIN_PHP_VERSION, '>=');
//$compatibleWpVersion = version_compare($wp_version, WPML_MIN_WP_VERSION, '>=');
//
//// create plugin
//Old_WPML::create(array(
//    'key' => 'WP_Mailto_Links',
//    'domain' => 'wp-mailto-links',
//    'optionName' => 'WP_Mailto_Links_options',
//    'adminPage' => 'wp-mailto-links-settings',
//    'file' => __FILE__,
//    'dir' => dirname(__FILE__),
//    'pluginUrl' => plugins_url('', __FILE__),
//    'wpVersion' => $wp_version,
//    'isCompatible' => ($compatiblePhpVersion && $compatibleWpVersion),
//));
