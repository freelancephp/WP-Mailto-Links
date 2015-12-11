<?php
/**
 * Class WPML_Admin
 *
 * @package  WPML
 * @category WordPress Plugins
 * @author   Victor Villaverde Laan
 * @link     http://www.freelancephp.net/
 * @license  MIT license
 */
final class Old_WPML_Admin extends Old_WPDev_Admin_Page
{
    /**
     * Constructor
     * Init settings, metaboxes, helptabs etc
     */
    public function __construct(Old_WPDev_Option $option)
    {
        $plugin = Old_WPML::plugin();

        $settings = array(
            'file' => $plugin->getGlobal('file'),
            'key' => $plugin->getGlobal('key'),
            'pageKey' => $plugin->getGlobal('adminPage'),
            'pageTitle' => $plugin->__('WP Mailto Links'),
            'menuIcon' => $plugin->getGlobal('pluginUrl') . '/images/icon-wp-mailto-links-16.png',
            'mainMenu' => (bool) $option->getValue('own_admin_menu'),
            'viewVars' => array(
                'optionName' => $plugin->getGlobal('optionName'),
                'values' => $option->getValues(),
                'plugin' => $plugin,
            ),
            'viewPage' => $plugin->getGlobal('dir') . '/views/admin/page.php',
            'viewMetabox' => $plugin->getGlobal('dir') . '/views/admin/metaboxes/{{key}}.php',
            'viewHelptab' => $plugin->getGlobal('dir') . '/views/admin/helptabs/{{key}}.php',
        );

        $metaboxes = array(
            'general' => array(
                'title' => $plugin->__('General Settings'),
                'position' => 'normal',
             ),
            'style' => array(
                'title' => $plugin->__('Style Settings'),
                'position' => 'normal',
             ),
            'admin' => array(
                'title' => $plugin->__('Admin Settings'),
                'position' => 'normal',
             ),
            'this-plugin' => array(
                'title' => $plugin->__('Support'),
                'position' => 'side',
             ),
            'other-plugins' => array(
                'title' => $plugin->__('Other Plugins'),
                'position' => 'side',
             ),
        );

        $helptabs = array(
            'general' => array(
                'title' => $plugin->__('General'),
             ),
            'shortcodes' => array(
                'title' => $plugin->__('Shortcodes'),
             ),
            'templatefunctions' => array(
                'title' => $plugin->__('Template functions'),
             ),
            'actionhooks' => array(
                'title' => $plugin->__('Action Hooks'),
             ),
            'filterhooks' => array(
                'title' => $plugin->__('Filter Hooks'),
             ),
            'faq' => array(
                'title' => $plugin->__('FAQ'),
             ),
        );

        parent::__construct($settings, $metaboxes, $helptabs);

        add_action('admin_init', array($this, 'actionAdminInit'));
    }

    /**
     * WP action callback
     */
    public function actionAdminInit()
    {
        add_action('admin_notices', array($this, 'actionAdminNotices'));
        add_filter('plugin_action_links', array($this, 'filterPluginActionLinks'), 10, 2);
    }

    /**
     * Callback add links on plugin page
     * @param array $links
     * @param string $file
     * @return array
     */
    public function filterPluginActionLinks($links, $file)
    {
        $pluginFile = plugin_basename(Old_WPML::plugin()->getGlobal('file'));
        $compareFile = substr($pluginFile, - strlen($file));

        if ($file == $compareFile) {
            $page = ($this->settings['mainMenu']) ? 'admin.php' : 'options-general.php';

            $settingsLink = '<a href="' . get_bloginfo('wpurl') . '/wp-admin/'
                            . $page . '?page=' . Old_WPML::plugin()->getGlobal('adminPage') . '">'
                            . Old_WPML::plugin()->__('Settings') . '</a>';

            array_unshift($links, $settingsLink);
        }

        return $links;
    }

    /**
     * WP action callback
     * @return void
     */
    public function actionAdminNotices()
    {
        if (!Old_WPML::plugin()->getGlobal('isCompatible')) {
            echo $this->renderView(Old_WPML::plugin()->getGlobal('dir') . '/views/admin/notice-not-compatible.php');
        }

        if (isset($_GET['page']) && $_GET['page'] === Old_WPML::plugin()->getGlobal('adminPage') && is_plugin_active('email-encoder-bundle/email-encoder-bundle.php')) {
            echo $this->renderView(Old_WPML::plugin()->getGlobal('dir') . '/views/admin/notice-eeb-activated.php');
        }
    }

}
