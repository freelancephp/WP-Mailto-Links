<?php
/**
 * Class WPML_Register_Scripts
 *
 * @package  WPML
 * @category WordPress Plugin
 * @version  2.1.5
 * @author   Victor Villaverde Laan
 * @link     http://www.finewebdev.com
 * @link     https://github.com/freelancephp/WP-Mailto-Links
 * @license  Dual licensed under the MIT and GPLv2+ licenses
 */
final class WPML_Register_Scripts extends WPRun_Base_1x0x0
{

    /**
     * Action for "wp_enqueue_scripts"
     */
    protected function action_wp_enqueue_scripts()
    {
        $this->register_scripts();
    }

    /**
     * Action for "admin_enqueue_scripts"
     */
    protected function action_admin_enqueue_scripts()
    {
        $this->register_scripts();
    }

    /**
     * Register styles and scripts
     */
    protected function register_scripts()
    {
        $plugin_version = get_option( 'wpml-version' );

        // set style font awesome icons
        wp_register_style(
            'font-awesome'
            , 'https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css'
            , array()
            , $plugin_version
        );

        // set wpml admin script
        wp_register_script(
            'wp-mailto-links-admin'
            , plugins_url( '/public/js/wp-mailto-links-admin.js', WPML_Plugin::get_plugin_file() )
            , array( 'jquery' )
            , $plugin_version
            , true
        );

        // set wpml front script
        wp_register_script(
            'wp-mailto-links'
            , plugins_url( '/public/js/wp-mailto-links.js', WPML_Plugin::get_plugin_file() )
            , array( 'jquery' )
            , $plugin_version
            , true
        );
    }

}

/*?>*/
