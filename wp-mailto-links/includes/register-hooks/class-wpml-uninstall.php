<?php
/**
 * Class WPML_Uninstall
 *
 * @package  WPML
 * @category WordPress Plugin
 * @version  2.1.5
 * @author   Victor Villaverde Laan
 * @link     http://www.finewebdev.com
 * @link     https://github.com/freelancephp/WP-Mailto-Links
 * @license  Dual licensed under the MIT and GPLv2+ licenses
 */
final class WPML_Uninstall extends FWP_Register_Hook_Base_1x0x0
{

    /**
     * @var string
     */
    protected $hook_type = 'uninstall';

    /**
     * Activate network
     * @return void
     */
    protected function network_procedure()
    {
        // network settings
        delete_site_option( 'wpml-network-settings' );
        delete_site_option( 'wpml-network-admin-settings' );
    }

    /**
     * Activate site
     * @return void
     */
    protected function site_procedure()
    {
        // delete options
        delete_option( 'wpml-external-link-settings' );
        delete_option( 'wpml-internal-link-settings' );
        delete_option( 'wpml-excluded-link-settings' );
        delete_option( 'wpml-exceptions-settings' );
        delete_option( 'wpml-admin-settings' );

        delete_option( 'wpml-version' );
        delete_option( 'wpml-show-notice' );
    }

}

/*?>*/
