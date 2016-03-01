<?php
/**
 * Interface WPML_Plugin_Interface
 *
 * @package  WPML
 * @category WordPress Plugins
 * @author   Victor Villaverde Laan
 * @link     http://www.freelancephp.net/
 * @link     https://github.com/freelancephp/WP-Mailto-Links
 * @link     https://wordpress.org/plugins/wp-mailto-links/
 * @license  MIT license
 */
interface WPML_Plugin_Interface extends WPLim_Plugin_Interface_0x4x0
{

    /**
     * @return WPML_Site
     */
    public function getSite();

    /**
     * @return WPLim_Option_Interface
     */
    public function getOption();

}

/*?>*/
