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
final class WPML_Admin extends WPDev_Admin_Page_MetaBox
{

    /**
     * Initialize, add action and filter hooks
     */
    public function __construct()
    {
        add_action('init', array($this, 'createAdminPage'));
        add_action('admin_enqueue_scripts', array($this, 'enqueueScripts'));
    }

    /**
     * Add scripts
     */
    public function enqueueScripts()
    {
//        wp_enqueue_script(
//            'plugin-example-admin'
//            , PluginExample::glob('URL') . '/js/admin.js'
//            , array('jquery')
//            , false
//            , true
//        );
    }

    /**
     * Create admin pages
     */
    public function createAdminPage()
    {
        $templatesBasePath = WPML::glob('DIR') . '/templates/admin/page';
        $globals = WPML::plugin()->getAllGlobals();

        // create page
        $adminPage = new WPDev_Admin_Page_MetaBox(array(
            'id'              => $globals['key'] . '-option-page',
            'title'           => __('WP Mailto Links', 'wp-mailto-links'),
            'menuTitle'       => __('Mailto Links', 'wp-mailto-links'),
            'parentSlug'      => null,
            'iconUrl'         => 'dashicons-email',
            'defaultColumns'  => 2,
            'maxColumns'      => 2,
            'pageTemplate'    => $templatesBasePath . '/page.php',
            'templateVars'    => $globals,
        ));

        // create meta boxes
        new WPDev_Admin_MetaBoxes(
            array(
                'style' => array(
                    'title' => __('Style Settings', 'wp-mailto-links'),
                    'context' => 'normal',
                 ),
                'admin' => array(
                    'title' => __('Admin Settings', 'wp-mailto-links'),
                    'context' => 'normal',
                 ),
                'this-plugin' => array(
                    'title' => __('Support', 'wp-mailto-links'),
                    'context' => 'side',
                 ),
                'mail-icon' => array(
                    'title' => __('Mail Icon', 'wp-mailto-links'),
                    'context' => 'side',
                 ),
//                'other-plugins' => array(
//                    'title' => __('Other Plugins', 'wp-mailto-links'),
//                    'context' => 'side',
//                 ),
            )
            , array(
                'adminPage'     => $adminPage,
                'templatesPath' => $templatesBasePath . '/meta-boxes',
                'templateVars'  => $globals,
            )
        );

        // create help tabs
        new WPDev_Admin_HelpTabs(
            array(
                'general' => array(
                    'title' => __('General', 'wp-mailto-links'),
                 ),
                'shortcodes' => array(
                    'title' => __('Shortcodes', 'wp-mailto-links'),
                 ),
                'templatefunctions' => array(
                    'title' => __('Template functions', 'wp-mailto-links'),
                 ),
                'actionhooks' => array(
                    'title' => __('Action Hooks', 'wp-mailto-links'),
                 ),
                'filterhooks' => array(
                    'title' => __('Filter Hooks', 'wp-mailto-links'),
                 ),
                'faq' => array(
                    'title' => __('FAQ', 'wp-mailto-links'),
                 ),
            )
            , array(
                'adminPage'     => $adminPage,
                'templatesPath' => $templatesBasePath . '/help-tabs',
                'templateVars'  => $globals,
            )
        );
    }

}
