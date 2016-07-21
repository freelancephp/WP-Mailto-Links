<?php
/**
 * Class WPML_Protection_Fields
 *
 * @package  WPML
 * @category WordPress Plugin
 * @version  2.1.5
 * @author   Victor Villaverde Laan
 * @link     http://www.finewebdev.com
 * @link     https://github.com/freelancephp/WP-Mailto-Links
 * @license  Dual licensed under the MIT and GPLv2+ licenses
 */
final class WPML_Protection_Fields extends FWP_Settings_Section_Base_1x0x0
{

    /**
     * Initialize
     */
    protected function init()
    {
        $this->set_settings( array(
            'section_id'        => 'wpml-protection-fields',
            'page_id'           => 'wpml-protection-fields',
            'option_name'       => 'wpml-protection-settings',
            'option_group'      => 'wpml-protection-settings',
            'title'             => __( 'Protection', 'wp-mailto-links' ),
            'fields'            => array(
                'protect' => array(
                    'label'         => __( 'Protect mailto links:', 'wp-mailto-links' ),
                    'default_value' => '1',
                ),
                'convert_emails' => array(
                    'label'         => __( 'Protect plain emails:', 'wp-mailto-links' ),
                    'default_value' => '1',
                ),
                'filter_head' => array(
                    'label'         => __( 'Protect <code>&lt;head&gt;</code>:', 'wp-mailto-links' ),
                    'default_value' => '1',
                ),
                'filter_rss' => array(
                    'label'         => __( 'Protect RSS feed:', 'wp-mailto-links' ),
                    'default_value' => '1',
                ),
                'input_strong_protection' => array(
                    'label'         => __( 'Protect input fields:', 'wp-mailto-links' ),
                    'default_value' => '0',
                ),
                'protection_text' => array(
                    'label'         => __( 'Set protection text *:', 'wp-mailto-links' ),
                    'default_value' => '*protected email*',
                ),
            ),
        ) );

        parent::init();
    }

    /**
     * Show field methods
     */

    protected function show_protect( array $args )
    {
        $this->get_html_fields()->check_with_label(
            $args[ 'key' ]
            , __( 'Protect mailto links against spambots', 'wp-mailto-links' )
            , '1'
            , ''
        );
    }

    protected function show_convert_emails( array $args )
    {
        $this->get_html_fields()->select(
            $args[ 'key' ]
            , array(
                '0' => __( 'No, keep plain emails as they are', 'wp-mailto-links' ),
                '1' => __( 'Yes, protect plain emails with protection text *', 'wp-mailto-links' ),
                '2' => __( 'Yes, convert plain emails to mailto links', 'wp-mailto-links' ),
            )
        );
    }

    protected function show_filter_head( array $args )
    {
        $this->get_html_fields()->check_with_label(
            $args[ 'key' ]
            , __( 'Protect email adresses in the <code>&lt;head&gt;</code>-section by replacing them with the protection text *', 'wp-mailto-links' )
            , '1'
            , ''
        );
    }

    protected function show_filter_rss( array $args )
    {
        $this->get_html_fields()->check_with_label(
            $args[ 'key' ]
            , __( 'Protect email addresses in RSS feeds by replacing them with the protection text *', 'wp-mailto-links' )
            , '1'
            , ''
        );
    }

    protected function show_input_strong_protection( array $args )
    {
        $this->get_html_fields()->check_with_label(
            $args[ 'key' ]
            , __( 'Protect prefilled email adresses in input fields', 'wp-mailto-links' )
            , '1'
            , ''
        );

        echo '<p class="description">'
                . __( 'Warning: this option could conflict with certain form plugins. Test it first.', 'wp-mailto-links' )
                .'</p>';
    }

    protected function show_protection_text( array $args )
    {
        $this->get_html_fields()->text( $args[ 'key' ], array(
            'class' => 'regular-text',
        ) );

        echo '<p class="description">'
                . __( 'This text will be shown instead of the protected email addresses', 'wp-mailto-links' )
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

//        $is_valid = $is_valid && in_array( $new_values[ 'apply_all' ], array( '', '1' ) );

        if ( false === $is_valid ) {
            // error when user input is not valid conform the UI, probably tried to "hack"
            $this->add_error( __( 'Something went wrong. One or more values were invalid.', 'wp-mailto-links' ) );
            return $old_values;
        }

        return $update_values;
    }

}

/*?>*/
