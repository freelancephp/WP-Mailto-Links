<?php
/**
 * Class WPML_Exceptions_Fields
 *
 * @package  WPML
 * @category WordPress Plugin
 * @version  2.1.5
 * @author   Victor Villaverde Laan
 * @link     http://www.finewebdev.com
 * @link     https://github.com/freelancephp/WP-Mailto-Links
 * @license  Dual licensed under the MIT and GPLv2+ licenses
 */
final class WPML_Exceptions_Fields extends FWP_Settings_Section_Base_1x0x0
{

    /**
     * Initialize
     */
    protected function init()
    {
        $this->set_settings( array(
            'section_id'        => 'wpml-exceptions-fields',
            'page_id'           => 'wpml-exceptions-fields',
            'option_name'       => 'wpml-exceptions-settings',
            'option_group'      => 'wpml-exceptions-settings',
            'title'             => __( 'Exceptions', 'wp-mailto-links' ),
            'fields'            => array(
                'apply_all' => array(
                    'label'         => __( 'Apply settings on:', 'wp-mailto-links' ),
                    'class'         => 'js-wpml-apply',
                    'default_value' => '1',
                ),
                'apply_post_content' => array(
                    'class'         => 'js-wpml-apply-child wpml-hidden wpml-no-label ',
                    'default_value' => '1',
                ),
                'apply_comments' => array(
                    'class'         => 'js-wpml-apply-child wpml-hidden wpml-no-label',
                    'default_value' => '1',
                ),
                'apply_widgets' => array(
                    'class'         => 'js-wpml-apply-child wpml-hidden wpml-no-label',
                    'default_value' => '1',
                ),
                'ignore_script_tags' => array(
                    'label'         => __( 'Skip <code>&lt;script&gt;</code>:', 'wp-mailto-links' ),
                    'default_value' => '1',
                ),
            ),
        ) );

        parent::init();
    }

    /**
     * Show field methods
     */

    protected function show_apply_all( array $args )
    {
        $this->get_html_fields()->check_with_label(
            $args[ 'key' ]
            , __( 'All contents (the whole page)', 'wp-mailto-links' )
            , '1'
            , ''
        );
    }

    protected function show_apply_post_content( array $args )
    {
        $this->get_html_fields()->check_with_label(
            $args[ 'key' ]
            , __( 'Post content', 'wp-mailto-links' )
            , '1'
            , ''
        );
    }

    protected function show_apply_comments( array $args )
    {
        $this->get_html_fields()->check_with_label(
            $args[ 'key' ]
            , __( 'Comments', 'wp-mailto-links' )
            , '1'
            , ''
        );
    }

    protected function show_apply_widgets( array $args )
    {
        $this->get_html_fields()->check_with_label(
            $args[ 'key' ]
            , __( 'All widgets', 'wp-mailto-links' )
            , '1'
            , ''
        );
    }

    protected function show_ignore_script_tags( array $args )
    {
        $this->get_html_fields()->check_with_label(
            $args[ 'key' ]
            , __( 'Ignore all links in <code>&lt;script&gt;</code> blocks', 'wp-mailto-links' )
            , '1'
            , ''
        );
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

        $is_valid = $is_valid && in_array( $new_values[ 'apply_post_content' ], array( '', '1' ) );
        $is_valid = $is_valid && in_array( $new_values[ 'apply_comments' ], array( '', '1' ) );
        $is_valid = $is_valid && in_array( $new_values[ 'apply_widgets' ], array( '', '1' ) );
        $is_valid = $is_valid && in_array( $new_values[ 'apply_all' ], array( '', '1' ) );
        $is_valid = $is_valid && in_array( $new_values[ 'ignore_script_tags' ], array( '', '1' ) );

        if ( false === $is_valid ) {
            // error when user input is not valid conform the UI, probably tried to "hack"
            $this->add_error( __( 'Something went wrong. One or more values were invalid.', 'wp-mailto-links' ) );
            return $old_values;
        }

        if ( '' !== trim( $new_values[ 'include_urls' ] ) ) {
            $update_values[ 'include_urls' ] = implode( "\n", array_map( 'sanitize_text_field', explode( "\n", $new_values[ 'include_urls' ] ) ) );
        }

        if ( '' !== trim( $new_values[ 'exclude_urls' ] ) ) {
            $update_values[ 'exclude_urls' ] = implode( "\n", array_map( 'sanitize_text_field', explode( "\n", $new_values[ 'exclude_urls' ] ) ) );
        }

        return $update_values;
    }

}

/*?>*/
