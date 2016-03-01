<?php
/**
 * Class WPML_RegisterHook_Uninstall
 *
 * @package  WPML
 * @category WordPress Plugins
 * @author   Victor Villaverde Laan
 * @link     http://www.freelancephp.net/
 * @link     https://github.com/freelancephp/WP-Mailto-Links
 * @link     https://wordpress.org/plugins/wp-mailto-links/
 * @license  MIT license
 */
final class WPML_RegisterHook_Uninstall extends WPLim_RegisterHook_Uninstall_Abstract_0x4x0
{

    protected function uninstall()
    {
        // remove option values
        WPML_Plugin::plugin()->getOption()->delete();
    }

}

/*?>*/
