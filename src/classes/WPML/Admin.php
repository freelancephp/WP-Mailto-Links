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
final class WPML_Admin extends WPDev_Admin_Page_MetaBox_04
{

    /**
     * @var WPDev_Admin_Page_Interface
     */
    protected $adminPage = null;

    /**
     * Initialize, add action and filter hooks
     */
    public function __construct()
    {
        $this->createAdminPage();

        add_action('admin_enqueue_scripts', array($this, 'enqueueScripts'));
    }

    /**
     * Add scripts
     */
    public function enqueueScripts($hook)
    {
        if ($hook !== $this->adminPage->getHook()) {
            return;
        }

        wp_enqueue_script(
            'wp-mailto-links-admin'
            , WPML::glob('URL') . '/js/wp-mailto-links-admin.js'
            , array('jquery')
            , false
            , true
        );
        wp_localize_script('wp-mailto-links-admin', 'wpmlSettings', array(
            'pluginUrl' => WPML::glob('URL'),
            'dashiconsValue' => WPML::glob('option')->getValue('dashicons'),
            'fontawesomeValue' => WPML::glob('option')->getValue('fontawesome'),
        ));

        wp_enqueue_style(
            'font-awesome'
            , 'https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css'
            , array()
            , null
        );
    }

    /**
     * Create admin pages
     */
    public function createAdminPage()
    {
        $mainMenu = (bool) WPML::glob('option')->getValue('own_admin_menu');

        // create admin page
        $adminPage = new WPDev_Admin_Page_Integrated_04(array(
            'id'              => WPML::glob('key') . '-option-page',
            'title'           => __('WP Mailto Links', 'wp-mailto-links'),
            'menuTitle'       => __('Mailto Links', 'wp-mailto-links'),
            'parentSlug'      => $mainMenu ? null : 'options-general.php',
            'iconUrl'         => 'dashicons-email',
            'defaultColumns'  => 2,
            'maxColumns'      => 2,
            'pageTemplate'    => WPML::glob('DIR') . '/templates/admin/page/page.php',
            'templateVars'    => WPML::plugin()->getAllGlobals(),
        ), WPDev_Admin_Page_Integrated_04::TYPE_METABOX_PAGE);

        // add meta-boxes
        $adminPage->addMetaBox(
            'mail-icon'
            , __('Mail Icon', 'wp-mailto-links')
        );
        $adminPage->addMetaBox(
            'additional-classes'
            , __('Additional Classes', 'wp-mailto-links')
            , 'side'
        );
        $adminPage->addMetaBox(
            'admin'
            , __('Admin', 'wp-mailto-links')
        );
        $adminPage->addMetaBox(
            'support'
            , __('Support', 'wp-mailto-links')
            , 'side'
        );

        // add help-tabs
        $adminPage->addHelpTab(
            'general'
            , __('General', 'wp-mailto-links')
        );
        $adminPage->addHelpTab(
            'shortcodes'
            , __('Shortcode', 'wp-mailto-links')
        );
        $adminPage->addHelpTab(
            'template-tags'
            , __('Template Tags', 'wp-mailto-links')
        );
        $adminPage->addHelpTab(
            'filter-hook'
            , __('Filter Hook', 'wp-mailto-links')
        );
        $adminPage->addHelpTab(
            'action-hook'
            , __('Action Hook', 'wp-mailto-links')
        );

        $this->adminPage = $adminPage;
    }

}

/*?>*/
