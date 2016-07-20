<?php
/**
 * Class WPML_Update
 *
 * @package  WPML
 * @category WordPress Plugin
 * @version  2.1.5
 * @author   Victor Villaverde Laan
 * @link     http://www.finewebdev.com
 * @link     https://github.com/freelancephp/WP-Mailto-Links
 * @license  Dual licensed under the MIT and GPLv2+ licenses
 */
final class WPML_Update extends WPRun_Base_1x0x0
{

    /**
     * Initialize
     */
    protected function init()
    {
//        $this->update_from_v1();
//        $this->update_from_v2x1();
    }

    /**
     * Action for "admin_init"
     */
    protected function action_admin_init()
    {
        $this->update_version();
    }

    /**
     * Update version
     * @return void
     */
    private function update_version()
    {
        $plugin_data = get_plugin_data( WPML_Plugin::get_plugin_file() );

        $current_version = $plugin_data[ 'Version' ];
        $saved_version = get_option( 'wpml-version' );

        if ( $current_version !== $saved_version ) {
            update_option( 'wpml-version', $current_version );
        }
    }

    /**
     * Update procedure from version v2.1.x or less
     * @return void
     */
    private function update_from_v2x1()
    {
        $site_already_set = get_option( 'wpml-external-link-settings' );

        if ( $site_already_set ) {
            return;
        }

        // get default values
        $external_link_values = WPML_External_Link_Fields::get_instance()->get_default_values();
        $internal_link_values = WPML_Internal_Link_Fields::get_instance()->get_default_values();
        $excluded_link_values = WPML_Excluded_Link_Fields::get_instance()->get_default_values();
        $exceptions_link_values = WPML_Exceptions_Fields::get_instance()->get_default_values();
        $admin_link_values = WPML_Admin_Fields::get_instance()->get_default_values();

        // Upgrade to version 2
        // check for old option values version < 2.1 or less
        $old_main = get_option( 'wp-mailto-links' );
        $old_seo = get_option( 'wp_external_links-seo' );
        $old_style = get_option( 'wp_external_links-style' );
        $old_extra = get_option( 'wp_external_links-extra' );
        $old_screen = get_option( 'wp_external_links-screen' );

        // convert old to new db option values
        if ( ! empty( $old_main ) || ! empty( $old_seo ) || ! empty( $old_style ) || ! empty( $old_extra ) || ! empty( $old_screen ) ) {
            // helper function
            $val = function ( $arr, $key, $default = '' ) {
                if ( ! isset( $arr[ $key ] ) ) {
                    return $default;
                }

                return (string) $arr[ $key ];
            };

            // mapping
            if ( ! empty( $old_main ) ) {
                $target = $val( $old_main, 'target' );
                $external_link_values[ 'target' ] = str_replace( '_none', '_self', $target );

                $exceptions_link_values[ 'apply_all' ] = $val( $old_main, 'filter_page' );
                $exceptions_link_values[ 'apply_post_content' ] = $val( $old_main, 'filter_posts' );
                $exceptions_link_values[ 'apply_comments' ] = $val( $old_main, 'filter_comments' );
                $exceptions_link_values[ 'apply_widgets' ] = $val( $old_main, 'filter_widgets' );
                $exceptions_link_values[ 'exclude_urls' ] = $val( $old_main, 'ignore' );
                $exceptions_link_values[ 'subdomains_as_internal_links' ] = $val( $old_main, 'ignore_subdomains' );
            }
            if ( ! empty( $old_seo ) ) {
                $external_link_values[ 'rel_follow' ] = ( '1' ==  $val( $old_seo, 'nofollow' ) ) ? 'nofollow' : 'follow';
                $external_link_values[ 'rel_follow_overwrite' ] = $val( $old_seo, 'overwrite_follow' );
                $external_link_values[ 'rel_external' ] = $val( $old_seo, 'external' );

                $title = $val( $old_seo, 'title' );
                $external_link_values[ 'title' ] = str_replace( '%title%', '{title}', $title );
            }
            if ( ! empty( $old_style ) ) {
                if ( $old_style[ 'icon' ] ) {
                    $external_link_values[ 'icon_type' ] = 'image';
                    $external_link_values[ 'icon_image' ] = $val( $old_style, 'icon', '1' );
                }
                $external_link_values[ 'class' ] = $val( $old_style, 'class_name' );
                $external_link_values[ 'no_icon_for_img' ] = $val( $old_style, 'image_no_icon' );
            }
            if ( ! empty( $old_extra ) ) {
                // nothing
            }
            if ( ! empty( $old_screen ) ) {
                $admin_link_values[ 'own_admin_menu' ] = ( 'admin.php' == $val( $old_screen, 'menu_position' ) ) ? '1' : '';
            }

            // delete old values
            delete_option( 'wp_external_links-meta' );
            delete_option( 'wp_external_links-main' );
            delete_option( 'wp_external_links-seo' );
            delete_option( 'wp_external_links-style' );
            delete_option( 'wp_external_links-extra' );
            delete_option( 'wp_external_links-screen' );
        }

        // update new values
        update_option( 'wpml-external-link-settings', $external_link_values );
        update_option( 'wpml-internal-link-settings', $internal_link_values );
        update_option( 'wpml-excluded-link-settings', $excluded_link_values );
        update_option( 'wpml-exceptions-settings', $exceptions_link_values );
        update_option( 'wpml-admin-settings', $admin_link_values );
    }

    /**
     * Update procedure from version v1 or less
     * @return void
     */
    private function update_from_v1()
    {
        $already_updated = get_option( 'wp-mailto-links' );

        if ( $already_updated ) {
            return;
        }

        // get old values
        $old_values = get_option( 'WP_Mailto_Links_options' );

        // set defaults
        $new_values = array(
            'protect'           => 1,
            'convert_emails'    => 1,
            'filter_body'       => 1,
            'filter_posts'      => 1,
            'filter_comments'   => 1,
            'filter_widgets'    => 1,
            'filter_rss'        => 1,
            'filter_head'       => 1,
            'input_strong_protection' => 0,
            'protection_text'   => '*protected email*',
            'mail_icon'         => '',
            'image'              => 1,
            'dashicons'         => '',
            'fontawesome'       => '',
            'show_icon_before'  => 0,
            'image_no_icon'     => 0,
            'no_icon_class'     => 'no-mail-icon',
            'class_name'        => 'mail-link',
            'security_check'    => 0,
            'own_admin_menu'    => 1,
        );

        if ( ! empty( $old_values ) ) {
            foreach ( $old_values as $key => $old_value ) {
                // take old value
                if ( 'icon' === $key ) {
                    // old 'icon' contained the image number
                    // new 'mail_icon' contains type (image, dashicons, fontawesome)
                    $new_value = empty( $old_value ) ? '' : 'image';
                    $new_values[ 'mail_icon' ] = $old_value;

                    // mail_icon === 'image' ---> 'image' contains number
                    if ( ! empty( $old_value ) ) {
                        $new_values[ 'image' ] = $old_value;
                    }

                    continue;
                }

                $new_values[ $key ] = $oldValue;
            }

            delete_option( 'WP_Mailto_Links_options' );
        }

        // update new values
        update_option( 'wp-mailto-links', $new_values );
    }

}

/*?>*/
