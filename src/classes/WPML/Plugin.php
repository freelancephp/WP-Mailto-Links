<?php
/**
 * Class WPML_Plugin
 *
 * @package  WPML
 * @category WordPress Plugins
 * @author   Victor Villaverde Laan
 * @link     http://www.freelancephp.net/
 * @link     https://github.com/freelancephp/WP-Mailto-Links
 * @link     https://wordpress.org/plugins/wp-mailto-links/
 * @license  MIT license
 */
final class WPML_Plugin extends WPLim_Plugin_Abstract_0x4x0 implements WPML_Plugin_Interface
{

    /**
     * This property should also be included in child classes to prevent conflicts
     * @var WPML_Plugin_Interface
     */
    protected static $instance = null;

    /**
     * @var WPLim_Option_Interface
     */
    private $option = null;

    /**
     * @var WPML_Site
     */
    private $site = null;


    protected function init()
    {
        $this->loadTextdomain('wp-mailto-links', '/languages');

        $this->setOption(new WPLim_Option_0x4x0('wp-mailto-links', array(
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
            'mail_icon'         => '',  // type
            'image'              => 1,  // new
            'dashicons'         => '',  // new
            'fontawesome'       => '',  // new
            'show_icon_before'  => 0,   // new
            'image_no_icon'     => 0,
            'no_icon_class'     => 'no-mail-icon',
            'class_name'        => 'mail-link',
            'security_check'    => 0,
            'own_admin_menu'    => 1,
        )));

        // load admin or front site
        if (is_admin()) {
            $admin = new WPML_Admin();
            $admin->load();
        } else {
            $this->site = new WPML_Site();
            $this->site->load();
        }
    }

    /**
     * @return WPML_Site
     */
    public function getSite()
    {
        return $this->site;
    }

    /**
     * @return WPLim_Option_Interface_0x4x0
     */
    public function getOption()
    {
        return $this->option;
    }

    /**
     * @param WPLim_Option_Interface_0x4x0 $option
     */
    private function setOption(WPLim_Option_Interface_0x4x0 $option)
    {
        $this->option = $option;
    }

}

/*?>*/
