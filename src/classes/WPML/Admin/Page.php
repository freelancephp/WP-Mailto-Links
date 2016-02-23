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
    private $page = null;

    /**
     * @var WPLim_Admin_MetaBoxes_Interface
     */
    private $metaBoxes = null;

    /**
     * @var WPLim_Admin_HelpTabs_Interface
     */
    private $helpTabs = null;

    /**
     * @var string
     */
    private $templateBasePath = null;

    /**
     * @var WPLim_Option_Interface_0x4x0
     */
    private $option = null;

    /**
     * @var WPLim_Fields_Decorator_View_0x4x0
     */
    private $fields = null;

    
    public function load()
    {
        $this->prepare();
        $this->createPage();
        $this->createMetaBoxes();
        $this->createHelpTabs();
    
        add_action('admin_enqueue_scripts', function ($hook) {
            if ($hook !== $this->page->getHook()) {
                return;
            }

            $this->enqueueScripts();
        });
    }

    private function prepare()
    {
        $this->templateBasePath = WPML_Plugin::plugin()->getPath('/templates/admin/page');
        $this->option = WPML_Plugin::plugin()->getOption();
        $this->fields = new WPLim_Fields_Decorator_View_0x4x0($this->option);
    }

    private function createPage()
    {
        $mainMenu = (bool) $this->option->getValue('own_admin_menu');

        // create admin page
        $this->page = new WPLim_Admin_Page_MetaBox_0x4x0(array(
            'id'              => 'wp-mailto-links-option-page',
            'title'           => __('WP Mailto Links', 'wp-mailto-links'),
            'menuTitle'       => __('Mailto Links', 'wp-mailto-links'),
            'parentSlug'      => $mainMenu ? null : 'options-general.php',
            'iconUrl'         => 'dashicons-email',
            'defaultColumns'  => 2,
            'maxColumns'      => 2,
            'pageTemplate'    => $this->templateBasePath . '/page.php',
            'templateVars'    => array(
                'option' => $this->option,
                'fields' => $this->fields,
            ),
        ));
    }

    private function createMetaBoxes()
    {
        $this->metaBoxes = new WPLim_Admin_MetaBoxes_0x4x0(array(
            'adminPage'     => $this->page,
            'templatesPath' => $this->templateBasePath . '/meta-boxes',
            'templateVars'  => array(
                'option' => $this->option,
                'fields' => $this->fields,
            ),
        ));

        $this->metaBoxes->addMetaBox('mail-icon', __('Mail Icon', 'wp-mailto-links'));
        $this->metaBoxes->addMetaBox('admin', __('Admin', 'wp-mailto-links'));

        // side position
        $this->metaBoxes->addMetaBox('additional-classes', __('Additional Classes', 'wp-mailto-links'), 'side');
        $this->metaBoxes->addMetaBox('support', __('Support', 'wp-mailto-links'), 'side');
    }

    private function createHelpTabs()
    {
        $this->helpTabs = new WPLim_Admin_HelpTabs_0x4x0(array(
            'adminPage'     => $this->page,
            'templatesPath' => $this->templateBasePath . '/help-tabs',
            'templateVars'  => array(
                'file' => WPML_Plugin::plugin()->getFile(),
            ),
        ));

        $this->helpTabs->addHelpTab('general', __('General', 'wp-mailto-links'));
        $this->helpTabs->addHelpTab('shortcodes', __('Shortcode', 'wp-mailto-links'));
        $this->helpTabs->addHelpTab('template-tags', __('Template Tags', 'wp-mailto-links'));
        $this->helpTabs->addHelpTab('filter-hook', __('Filter Hook', 'wp-mailto-links'));
        $this->helpTabs->addHelpTab('action-hook', __('Action Hook', 'wp-mailto-links'));
    }

    private function enqueueScripts()
    {
        wp_enqueue_script(
            'wp-mailto-links-admin'
            , WPML_Plugin::plugin()->getUrl('/js/wp-mailto-links-admin.js')
            , array('jquery')
            , false
            , true
        );
        wp_localize_script('wp-mailto-links-admin', 'wpmlSettings', array(
            'pluginUrl' => WPML_Plugin::plugin()->getUrl(),
            'dashiconsValue' => $this->option->getValue('dashicons'),
            'fontawesomeValue' => $this->option->getValue('fontawesome'),
        ));

        wp_enqueue_style(
            'font-awesome'
            , 'https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css'
            , array()
            , null
        );
    }

}

/*?>*/
