<?php
/**
 * Class WPML_Mailto_Link_Fields
 *
 * @package  WPML
 * @category WordPress Plugin
 * @version  2.1.5
 * @author   Victor Villaverde Laan
 * @link     http://www.finewebdev.com
 * @link     https://github.com/freelancephp/WP-Mailto-Links
 * @license  Dual licensed under the MIT and GPLv2+ licenses
 */
final class WPML_Mailto_Link_Fields extends FWP_Settings_Section_Base_1x0x0
{

    /**
     * Initialize
     */
    protected function init()
    {
        $this->set_settings( array(
            'section_id'    => 'wpml-mailto-link-fields',
            'page_id'       => 'wpml-mailto-link-fields',
            'option_name'   => 'wpml-mailto-link-settings',
            'option_group'  => 'wpml-mailto-link-settings',
            'title'         => __( 'Mailto Links', 'wp-mailto-links' ),
            'fields'        => array(
                'apply_settings' => array(
                    'label'             => __( 'Settings for links:', 'wp-mailto-links' ),
                    'class'             => 'js-apply-settings',
                ),
                'title' => array(
                    'label'             => __( 'Set <code>title</code>:', 'wp-mailto-links' ),
                    'class'             => 'wpml-hidden',
                    'default_value'     => '{title}',
                ),
                'class' => array(
                    'label'             => __( 'Add CSS class(es):', 'wp-mailto-links' ),
                    'class'             => 'wpml-hidden',
                ),
                'icon_type' => array(
                    'label'             => __( 'Choose icon type:', 'wp-mailto-links' ),
                    'class'             => 'js-icon-type wpml-hidden',
                ),
                'icon_image' => array(
                    'label'             => __( 'Choose icon image:', 'wp-mailto-links' ),
                    'class'             => 'js-icon-type-child js-icon-type-image wpml-hidden',
                    'default_value'     => '1',
                ),
                'icon_dashicon' => array(
                    'label'             => __( 'Choose dashicon:', 'wp-mailto-links' ),
                    'class'             => 'js-icon-type-child js-icon-type-dashicon wpml-hidden',
                ),
                'icon_fontawesome' => array(
                    'label'             => __( 'Choose FA icon:', 'wp-mailto-links' ),
                    'class'             => 'js-icon-type-child js-icon-type-fontawesome wpml-hidden',
                ),
                'icon_position' => array(
                    'label'             => __( 'Icon position:', 'wp-mailto-links' ),
                    'class'             => 'js-icon-type-depend wpml-hidden',
                    'default_value'     => 'right',
                ),
                'no_icon_for_img' => array(
                    'label'             => __( 'Skip icon with <code>&lt;img&gt;</code>:', 'wp-mailto-links' ),
                    'class'             => 'js-icon-type-depend wpml-hidden',
                    'default_value'     => '1',
                ),
            ),
        ) );

        parent::init();
    }

    /**
     * Show field methods
     */

    protected function show_apply_settings( array $args )
    {
        $this->get_html_fields()->check_with_label(
            $args[ 'key' ]
            , __( 'Apply these settings', 'wp-mailto-links' )
            , '1'
            , ''
        );
    }

    protected function show_title( array $args )
    {
        $this->get_html_fields()->text( $args[ 'key' ], array(
            'class' => 'regular-text',
        ) );

        echo '<p class="description">'
                . __( 'Use this <code>{title}</code> for the original title value '
                .'and <code>{text}</code> for the link text as shown on the page', 'wp-mailto-links' )
                .'</p>';
    }

    protected function show_class( array $args )
    {
        $this->get_html_fields()->text( $args[ 'key' ], array(
            'class' => 'regular-text',
        ) );
    }

    protected function show_icon_type( array $args )
    {
        $this->get_html_fields()->select(
            $args[ 'key' ]
            , array(
                ''              => __( '- no icon -', 'wp-mailto-links' ),
                'image'         => __( 'Image', 'wp-mailto-links' ),
                'dashicon'      => __( 'Dashicon', 'wp-mailto-links' ),
                'fontawesome'   => __( 'Font Awesome', 'wp-mailto-links' ),
            )
        );
    }

    protected function show_icon_image( array $args )
    {
        echo '<fieldset>';
        echo '<div class="wpml-icon-type-image-column">';

        for ( $x = 1; $x <= 20; $x++ ) {
            echo '<label>';
            echo $this->get_html_fields()->radio( $args[ 'key' ], strval( $x ) );
            echo '<img src="'. plugins_url( '/public/images/wpml-icons/mail-icon-'. esc_attr( $x ) .'.png', WPML_Plugin::get_plugin_file() ) .'">';
            echo '</label>';
            echo '<br>';

            if ( $x % 5 === 0 ) {
                echo '</div>';
				echo '<div class="wpml-icon-type-image-column">';
            }
        }

        echo '</div>';
        echo '</fieldset>';
    }

    protected function show_icon_dashicon( array $args )
    {
        $dashicons_str = file_get_contents( WPML_Plugin::get_plugin_dir( '/data/json/dashicons.json' ) );
        $dashicons_json = json_decode( $dashicons_str, true );
        $dashicons = $dashicons_json[ 'icons' ];

        $options = array();
        foreach ( $dashicons as $icon ) {
            $options[ $icon[ 'className' ] ] = '&#x'. $icon[ 'unicode' ];
        }

        $this->get_html_fields()->select( $args[ 'key' ], $options, array(
            'style' => 'font-family:dashicons',
        ) );
    }

    protected function show_icon_fontawesome( array $args )
    {
        $fa_icons_str = file_get_contents( WPML_Plugin::get_plugin_dir( '/data/json/fontawesome.json' ) );
        $fa_icons_json = json_decode( $fa_icons_str, true );
        $fa_icons = $fa_icons_json[ 'icons' ];

        $options = array();
        foreach ( $fa_icons as $icon ) {
            $options[ $icon[ 'className' ] ] = '&#x'. $icon[ 'unicode' ];
        }

        $this->get_html_fields()->select( $args[ 'key' ], $options, array(
            'style' => 'font-family:FontAwesome',
        ) );
    }

    protected function show_icon_position( array $args )
    {
        $this->get_html_fields()->select(
            $args[ 'key' ]
            , array(
                'left'  => __( 'Left side of the link', 'wp-mailto-links' ),
                'right' => __( 'Right side of the link', 'wp-mailto-links' ),
            )
        );
    }

    protected function show_no_icon_for_img( array $args )
    {
        $this->get_html_fields()->check_with_label(
            $args[ 'key' ]
            , __( 'No icon for links already containing an <code>&lt;img&gt;</code>-tag.', 'wp-mailto-links' )
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

        $is_valid = $is_valid && in_array( $new_values[ 'apply_settings' ], array( '', '1' ) );
        $is_valid = $is_valid && in_array( $new_values[ 'target_overwrite' ], array( '', '1' ) );
        $is_valid = $is_valid && in_array( $new_values[ 'rel_follow_overwrite' ], array( '', '1' ) );
        $is_valid = $is_valid && in_array( $new_values[ 'rel_noopener' ], array( '', '1' ) );
        $is_valid = $is_valid && in_array( $new_values[ 'rel_noreferrer' ], array( '', '1' ) );
        $is_valid = $is_valid && in_array( $new_values[ 'no_icon_for_img' ], array( '', '1' ) );

        if ( false === $is_valid ) {
            // error when user input is not valid conform the UI, probably tried to "hack"
            $this->add_error( __( 'Something went wrong. One or more values were invalid.', 'wp-mailto-links' ) );
            return $old_values;
        }

        $update_values[ 'target' ]          = sanitize_text_field( $new_values[ 'target' ] );
        $update_values[ 'rel_follow' ]      = sanitize_text_field( $new_values[ 'rel_follow' ] );
        $update_values[ 'title' ]           = sanitize_text_field( $new_values[ 'title' ] );
        $update_values[ 'class' ]           = sanitize_text_field( $new_values[ 'class' ] );
        $update_values[ 'icon_type' ]       = sanitize_text_field( $new_values[ 'icon_type' ] );
        $update_values[ 'icon_image' ]      = sanitize_text_field( $new_values[ 'icon_image' ] );
        $update_values[ 'icon_dashicon' ]   = sanitize_text_field( $new_values[ 'icon_dashicon' ] );
        $update_values[ 'icon_fontawesome' ] = sanitize_text_field( $new_values[ 'icon_fontawesome' ] );
        $update_values[ 'icon_position' ]   = sanitize_text_field( $new_values[ 'icon_position' ] );

        return $update_values;
    }

}

/*?>*/
