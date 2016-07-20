<?php
/**
 * WP Mailto Links - Manage Email Links
 *
 * @package  WPML
 * @category WordPress Plugin
 * @version  2.1.5
 * @author   Victor Villaverde Laan
 * @link     http://www.freelancephp.net/wp-mailto-links-plugin
 * @license  Dual licensed under the MIT and GPLv2+ licenses
 *
 * @wordpress-plugin
 * Plugin Name:    WP Mailto Links - Manage Email Links
 * Version:        2.1.5
 * Plugin URI:     http://www.freelancephp.net/wp-mailto-links-plugin
 * Description:    Manage mailto links on your site and protect email addresses from spambots, set mail icon and more.
 * Author:         Victor Villaverde Laan
 * Author URI:     http://www.freelancephp.net
 * License:        Dual licensed under the MIT and GPLv2+ licenses
 * Text Domain:    wp-mailto-links
 * Domain Path:    /languages
 */
if ( ! function_exists( 'wpml_init' ) ):
    function wpml_init()
    {
        // only load in WP environment
        if ( ! defined( 'ABSPATH' ) ) {
            die();
        }

        $plugin_file = defined( 'TEST_WPML_PLUGIN_FILE' ) ? TEST_WPML_PLUGIN_FILE : __FILE__;
        $plugin_dir = dirname( __FILE__ );

        // check requirements
        $wp_version = get_bloginfo( 'version' );
        $php_version = phpversion();

        if ( version_compare( $wp_version, '3.6', '<' ) || version_compare( $php_version, '5.3', '<' ) ) {
            if ( ! function_exists( 'wpml_requirements_notice' ) ) {
                function wpel_requirements_notice()
                {
                    include $plugin_dir .'/templates/requirements-notice.php';
                }

                add_action( 'admin_notices', 'wpml_requirements_notice' );
            }

            return;
        }

        /**
         * Autoloader
         */
        if ( ! class_exists( 'WPRun_Autoloader_1x0x0' ) ) {
            require_once $plugin_dir . '/libs/wprun/class-wprun-autoloader.php';
        }

        $autoloader = new WPRun_Autoloader_1x0x0();
        $autoloader->add_path( $plugin_dir . '/libs/', true );
        $autoloader->add_path( $plugin_dir . '/includes/', true );

        /**
         * Load debugger
         */
        if ( true === constant( 'WP_DEBUG' ) ) {
            FWP_Debug_1x0x0::create( array(
                'log_hooks'  => false,
            ) );
        }

        /**
         * Register Hooks
         */
        global $wpdb;
        WPML_Activation::create( $plugin_file, $wpdb );
        WPML_Uninstall::create( $plugin_file, $wpdb );

        /**
         * Set plugin vars
         */
        WPML_Plugin::create( $plugin_file, $plugin_dir );

    }

    wpml_init();
endif;

/*?>*/
