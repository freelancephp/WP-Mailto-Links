<?php
/**
 * Class WPML_Admin
 *
 * @package  WPML
 * @category WordPress Plugins
 * @author   Victor Villaverde Laan
 * @link     http://www.freelancephp.net/
 * @link     https://github.com/freelancephp/WP-Mailto-Links
 * @link     https://wordpress.org/plugins/wp-mailto-links/
 * @license  MIT license
 */
final class WPML_Admin
{

    public function load()
    {
        $settingsPage = new WPML_AdminPage_Settings();
        $settingsPage->built();
    }

}

/*?>*/
