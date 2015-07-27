<?php
/**
 * Class WPML
 *
 * @sinlgeton
 *
 * @package  WPML
 * @category WordPress Plugins
 * @author   Victor Villaverde Laan
 * @link     http://www.freelancephp.net/
 * @license  MIT license
 */
class WPML extends WPDev_Plugin_Abstract
{
    /**
     * @var string  Name of Plugin class to create singleton instance
     */
    protected static $className = 'WPML';

    /**
     * Init
     */
    protected function init()
    {
        // load text domain for translations
        load_plugin_textdomain(self::get('domain'), false, self::get('dir') . '/languages');

        add_action('init', array($this, 'actionInit'), 5);
    }

    /**
     * WP action callback
     */
    public function actionInit()
    {
        $optionValues = $this->initOptionValues();

        if (is_admin()) {
            // create admin
            $admin = new WPML_Admin(array(
                'file' => self::get('file'),
                'key' => self::get('key'),
                'pageKey' => self::get('adminPage'),
                'pageTitle' => self::__('WP Mailto Links'),
                'menuIcon' => self::url('images/icon-wp-mailto-links-16.png'),
                'mainMenu' => (bool) $optionValues->get('own_admin_menu'),
                'viewVars' => array('values' => $optionValues->get()),
                'viewPage' => self::get('dir') . '/views/admin/page.php',
                'viewMetabox' => self::get('dir') . '/views/admin/metaboxes/{{key}}.php',
                'viewHelptab' => self::get('dir') . '/views/admin/helptabs/{{key}}.php',
            ));
        } else {
            // create front
            $front = new WPML_Front($optionValues);
        }
    }

    /**
     * Init option values
     */
    protected function initOptionValues()
    {
        $defaultValues = array(
            'version' => null,
            'convert_emails' => 1,
            'protect' => 1,
            'filter_body' => 1,
            'filter_posts' => 1,
            'filter_comments' => 1,
            'filter_widgets' => 1,
            'filter_rss' => 1,
            'filter_head' => 1,
            'input_strong_protection' => 0,
            'protection_text' => '*protected email*',
            'icon' => 0,
            'image_no_icon' => 0,
            'no_icon_class' => 'no-mail-icon',
            'class_name' => 'mail-link',
            'widget_logic_filter' => 0,
            'own_admin_menu' => 0,
        );

        $optionGroup = self::get('key');
        $optionName = self::get('optionName');

        // options instance
        $optionValues = new WPDev_Plugin_OptionValues($optionGroup, $optionName, $defaultValues);

        // check if this is an update
        if ($optionValues->get('version') !== self::get('version')) {
            // update version
            $optionValues->set('version', self::get('version'));
            $optionValues->save();

            // check for old values of 1.x version
            $oldValues = get_option('WP_Mailto_Links_options');

            if ($oldValues) {
                $defaultValues = $oldValues;

                // set new instance with old values as defaults
                $optionValues = new WPDev_Plugin_OptionValues($optionGroup, $optionName, $defaultValues);
            }
        }
        
        return $optionValues;
    }

}
