<?php
/**
 * Class WPML_TextDomain
 *
 * @package  WPML
 * @category WordPress Plugins
 * @version  2.1.1
 * @author   Victor Villaverde Laan
 * @link     http://www.freelancephp.net/
 * @link     https://github.com/freelancephp/WP-Mailto-Links
 * @link     https://wordpress.org/plugins/wp-mailto-links/
 * @license  GPLv2+ license
 */
final class WPML_TextDomain extends WPRun_BaseAbstract_0x5x0
{

    /**
     * Action for "plugins_loaded"
     */
    protected function actionPluginsLoaded()
    {
        load_plugin_textdomain('wp-mailto-links', false, WP_MAILTO_LINKS_DIR . '/languages/');
    }

}

/*?>*/
