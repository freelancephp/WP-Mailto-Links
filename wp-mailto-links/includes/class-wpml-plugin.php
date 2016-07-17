<?php
/**
 * Class WPML_Plugin
 *
 * @package  WPML
 * @category WordPress Plugin
 * @version  2.1.5
 * @author   Victor Villaverde Laan
 * @link     http://www.finewebdev.com
 * @link     https://github.com/freelancephp/WP-Mailto-Links
 * @license  Dual licensed under the MIT and GPLv2+ licenses
 */
final class WPML_Plugin extends FWP_Plugin_Base_1x0x0
{

    /**
     * Initialize plugin
     * @param string $plugin_file
     * @param string $plugin_dir
     */
    protected function init( $plugin_file, $plugin_dir )
    {
        parent::init( $plugin_file, $plugin_dir );

        $this->create_components();
    }

    /**
     * Create components
     */
    protected function create_components()
    {
        WPML_Register_Scripts::create();

        // network admin page
        $network_page = WPML_Network_Page::create( array(
            'network-settings'          => WPML_Network_Fields::create(),
            'network-admin-settings'    => WPML_Network_Admin_Fields::create(),
        ) );

//        // admin settings page
//        $settings_page = WPEL_Settings_Page::create( $network_page, array(
//            'external-links'    => WPEL_External_Link_Fields::create(),
//            'internal-links'    => WPEL_Internal_Link_Fields::create(),
//            'excluded-links'    => WPEL_Excluded_Link_Fields::create(),
//            'admin'             => WPEL_Admin_Fields::create(),
//            'exceptions'        => WPEL_Exceptions_Fields::create(),
//        ) );

        // front site
        if ( ! is_admin() ) {
            // filter hooks
            FWP_Final_Output_1x0x0::create();
            FWP_Widget_Output_1x0x0::create();

//            // front site
//            WPEL_Front::create( $settings_page );
//            WPEL_Front_Ignore::create( $settings_page );

            $email_encoder = WPML_Email_Encoder::create();
            WPML_Template_Tags::create( $email_encoder );
        }

//        // update procedures
//        WPEL_Update::create();
    }

}

/*?>*/
