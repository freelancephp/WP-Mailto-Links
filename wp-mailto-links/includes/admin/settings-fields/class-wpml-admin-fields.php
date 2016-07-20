<?php
/**
 * Class WPML_Admin_Fields
 *
 * @package  WPML
 * @category WordPress Plugin
 * @version  2.1.5
 * @author   Victor Villaverde Laan
 * @link     http://www.finewebdev.com
 * @link     https://github.com/freelancephp/WP-Mailto-Links
 * @license  Dual licensed under the MIT and GPLv2+ licenses
 */
final class WPML_Admin_Fields extends FWP_Settings_Section_Base_1x0x0
{

    /**
     * Initialize
     */
    protected function init()
    {
        $this->set_settings( array(
            'section_id'        => 'wpml-admin-fields',
            'page_id'           => 'wpml-admin-fields',
            'option_name'       => 'wpml-admin-settings',
            'option_group'      => 'wpml-admin-settings',
            'title'             => __( 'Admin Settings', 'wp-mailto-links' ),
            'fields'            => array(
                'own_admin_menu' => array(
                    'label'         => __( 'Main Admin Menu:', 'wp-mailto-links' ),
                    'default_value' => '1',
                ),
            ),
        ) );

        parent::init();
    }

    /**
     * Show field methods
     */

    protected function show_own_admin_menu( array $args )
    {
        $this->get_html_fields()->check_with_label(
            $args[ 'key' ]
            , __( 'Create own admin menu for this plugin', 'wp-mailto-links' )
            , '1'
            , ''
        );

        echo ' <p class="description">'
                . __( 'Or else it will be added to the "Settings" menu', 'wp-mailto-links' )
                .'</p>';
    }

    /**
     * Validate and sanitize user input before saving to databse
     * @param array $new_values
     * @param array $old_values
     * @return array
     */
    protected function before_update( array $new_values, array $old_values )
    {
        $update_values = $new_values;
        $is_valid = true;

        $is_valid = $is_valid && in_array( $new_values[ 'own_admin_menu' ], array( '', '1' ) );

        if ( false === $is_valid ) {
            // error when user input is not valid conform the UI, probably tried to "hack"
            $this->add_error( __( 'Something went wrong. One or more values were invalid.', 'wp-mailto-links' ) );
            return $old_values;
        }

        return $update_values;
    }

}

/*?>*/
