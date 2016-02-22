<?php
/**
 * Class WPML_Admin_Page
 *
 * @package  WPML
 * @category WordPress Plugins
 * @author   Victor Villaverde Laan
 * @link     http://www.freelancephp.net/
 * @license  MIT license
 */
final class WPML_Admin_Page
{

    /**
     * @var WPDev_Admin_Page_Interface
     */
    private $adminPage = null;

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
            , WPML_Plugin::plugin()->getUrl('/js/wp-mailto-links-admin.js')
            , array('jquery')
            , false
            , true
        );
        wp_localize_script('wp-mailto-links-admin', 'wpmlSettings', array(
            'pluginUrl' => WPML_Plugin::plugin()->getUrl(),
            'dashiconsValue' => WPML_Plugin::plugin()->getOption()->getValue('dashicons'),
            'fontawesomeValue' => WPML_Plugin::plugin()->getOption()->getValue('fontawesome'),
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
        $mainMenu = (bool) WPML_Plugin::plugin()->getOption()->getValue('own_admin_menu');

        // create admin page
        $this->adminPage = new WPLim_Admin_Page_MetaBox_0x4x0(array(
            'id'              => 'wp-mailto-links-option-page',
            'title'           => __('WP Mailto Links', 'wp-mailto-links'),
            'menuTitle'       => __('Mailto Links', 'wp-mailto-links'),
            'parentSlug'      => $mainMenu ? null : 'options-general.php',
            'iconUrl'         => 'dashicons-email',
            'defaultColumns'  => 2,
            'maxColumns'      => 2,
            'pageTemplate'    => WPML_Plugin::plugin()->getPath('/templates/admin/page/page.php'),
            'templateVars'    => array(
                'option' => WPML_Plugin::plugin()->getOption(),
            ),
        ));

        // add meta-boxes
        $this->metaBoxes = new WPLim_Admin_MetaBoxes_0x4x0(array(
            'adminPage'     => $this->adminPage,
            'templatesPath' => WPML_Plugin::plugin()->getPath('/templates/admin/page/meta-boxes'),
            'templateVars'    => array(
                'option' => WPML_Plugin::plugin()->getOption(),
            ),
        ));

        $this->metaBoxes->addMetaBox(
            'mail-icon'
            , __('Mail Icon', 'wp-mailto-links')
        );
        $this->metaBoxes->addMetaBox(
            'additional-classes'
            , __('Additional Classes', 'wp-mailto-links')
            , 'side'
        );
        $this->metaBoxes->addMetaBox(
            'admin'
            , __('Admin', 'wp-mailto-links')
        );
        $this->metaBoxes->addMetaBox(
            'support'
            , __('Support', 'wp-mailto-links')
            , 'side'
        );

        // add help-tabs
        $this->helpTabs = new WPLim_Admin_HelpTabs_0x4x0(array(
            'adminPage'     => $this->adminPage,
            'templatesPath' => WPML_Plugin::plugin()->getPath('/templates/admin/page/help-tabs'),
            'templateVars'    => array(
                'file' => WPML_Plugin::plugin()->getFile(),
            ),
        ));

        $this->helpTabs->addHelpTab(
            'general'
            , __('General', 'wp-mailto-links')
        );
        $this->helpTabs->addHelpTab(
            'shortcodes'
            , __('Shortcode', 'wp-mailto-links')
        );
        $this->helpTabs->addHelpTab(
            'template-tags'
            , __('Template Tags', 'wp-mailto-links')
        );
        $this->helpTabs->addHelpTab(
            'filter-hook'
            , __('Filter Hook', 'wp-mailto-links')
        );
        $this->helpTabs->addHelpTab(
            'action-hook'
            , __('Action Hook', 'wp-mailto-links')
        );
    }

}

/*?>*/
