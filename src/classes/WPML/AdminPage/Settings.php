<?php
/**
 * Class WPML_AdminPage_Settings
 *
 * @package  WPML
 * @category WordPress Plugins
 * @author   Victor Villaverde Laan
 * @link     http://www.freelancephp.net/
 * @link     https://github.com/freelancephp/WP-Mailto-Links
 * @link     https://wordpress.org/plugins/wp-mailto-links/
 * @license  MIT license
 */
final class WPML_AdminPage_Settings extends WPLim_AdminPage_TemplateBuilder_Abstract_0x4x0
{

    protected function before()
    {
        $templateBasePath = WPML_Plugin::plugin()->getPath('/templates/admin-pages/settings');
        $this->setTemplateBasePath($templateBasePath);
    }

    protected function prepareOption()
    {
        $this->setOption(WPML_Plugin::plugin()->getOption());
    }

    protected function prepareAdminPage()
    {
        $mainMenu = (bool) $this->getOption()->getValue('own_admin_menu');

        $adminPage = new WPLim_AdminPage_Page_MetaBox_0x4x0(array(
            'id'              => 'wp-mailto-links-option-page',
            'title'           => __('WP Mailto Links', 'wp-mailto-links'),
            'menuTitle'       => __('Mailto Links', 'wp-mailto-links'),
            'parentSlug'      => $mainMenu ? null : 'options-general.php',
            'iconUrl'         => 'dashicons-email',
            'defaultColumns'  => 2,
            'maxColumns'      => 2,
            'templatesPath' => $this->getTemplateBasePath(),
            'templateVars'    => array(
                'option' => $this->getOption(),
                'fieldsView' => $this->getFieldsView(),
            ),
        ));

        $this->setAdminPage($adminPage);
    }

    protected function prepareHelpTabs()
    {
        $helpTabs = new WPLim_AdminPage_HelpTabs_0x4x0($this->getAdminPage(), array(
            'templatesPath' => $this->getTemplateBasePath() . '/help-tabs',
            'templateVars'  => array(
                'file' => WPML_Plugin::plugin()->getFile(),
            ),
        ));

        $helpTabs->addHelpTab('general', __('General', 'wp-mailto-links'));
        $helpTabs->addHelpTab('shortcodes', __('Shortcode', 'wp-mailto-links'));
        $helpTabs->addHelpTab('template-tags', __('Template Tags', 'wp-mailto-links'));
        $helpTabs->addHelpTab('filter-hook', __('Filter Hook', 'wp-mailto-links'));
        $helpTabs->addHelpTab('action-hook', __('Action Hook', 'wp-mailto-links'));

        $this->setHelpTabs($helpTabs);
    }

    protected function prepareMetaBoxes()
    {
        $metaBoxes = new WPLim_AdminPage_MetaBoxes_0x4x0($this->getAdminPage(), array(
            'templatesPath' => $this->getTemplateBasePath() . '/meta-boxes',
            'templateVars'  => array(
                'option' => $this->getOption(),
                'fieldsView' => $this->getFieldsView(),
            ),
        ));

        $metaBoxes->addMetaBox('mail-icon', __('Mail Icon', 'wp-mailto-links'));
        $metaBoxes->addMetaBox('admin', __('Admin', 'wp-mailto-links'));

        // side position
        $metaBoxes->addMetaBox('additional-classes', __('Additional Classes', 'wp-mailto-links'), 'side');
        $metaBoxes->addMetaBox('support', __('Support', 'wp-mailto-links'), 'side');

        $this->setMetaBoxes($metaBoxes);
    }

    protected function enqueueScripts()
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
            'dashiconsValue' => $this->getOption()->getValue('dashicons'),
            'fontawesomeValue' => $this->getOption()->getValue('fontawesome'),
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
