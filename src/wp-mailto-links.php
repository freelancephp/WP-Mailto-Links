<?php defined('ABSPATH') OR die('No direct access.');
/**
 * WP Mailto Links - Manage Email Links
 *
 * @package  WPML
 * @category WordPress Plugin
 * @version  2.0.1
 * @author   Victor Villaverde Laan
 * @link     http://www.freelancephp.net/wp-mailto-links-plugin
 * @license  Dual licensed under the MIT and GPLv2+ licenses
 *
 * @wordpress-plugin
 * Plugin Name:    WP Mailto Links - Manage Email Links
 * Version:        2.0.1
 * Plugin URI:     http://www.freelancephp.net/wp-mailto-links-plugin
 * Description:    Manage mailto links on your site and protect email addresses from spambots, set mail icon and more.
 * Author:         Victor Villaverde Laan
 * Author URI:     http://www.freelancephp.net
 * License:        Dual licensed under the MIT and GPLv2+ licenses
 * Text Domain:    wp-mailto-links
 * Domain Path:    /languages
 */
call_user_func(function () {

    // set constant
    if (!defined('WP_MAILTO_LINKS_FILE')) {
        define('WP_MAILTO_LINKS_FILE', __FILE__);
    }
    if (!defined('WP_MAILTO_LINKS_DIR')) {
        define('WP_MAILTO_LINKS_DIR', __DIR__);
    }

    // set class auto-loader
    if (!class_exists('WPRun_AutoLoader_0x4x0')) {
        require_once WP_MAILTO_LINKS_DIR . '/classes/WPRun/AutoLoader.php';
    }
    WPRun_AutoLoader_0x4x0::register();
    WPRun_AutoLoader_0x4x0::addPath(WP_MAILTO_LINKS_DIR . '/classes');

    /**
     * Create plugin components
     */

    // @todo load_plugin_textdomain

    $option = WPML_Option_Settings::create();

    if (is_admin()) {
        $settingsPage = new WPML_AdminPage_Settings($option);
        $settingsPage->built();
    } else {
        $site = WPML_Site::create($option);
    }

    // create register hooks
    WPML_RegisterHook_Activate::create(WP_MAILTO_LINKS_FILE, $option);
    WPML_RegisterHook_Uninstall::create(WP_MAILTO_LINKS_FILE, $option);

    if (!is_admin()) {
        // create shortcode
        WPML_Shortcode_Mailto::create($site, $option);

        // create template tags
        WPML_TemplateTag_Filter::create($site);
        WPML_TemplateTag_Mailto::create($site, $option);

        // create custom filters final_output and widget_output
        WPRun_Filter_FinalOutput_0x4x0::create();
        WPRun_Filter_WidgetOutput_0x4x0::create();
    }

});


/*?>*/
