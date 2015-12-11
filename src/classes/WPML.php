<?php
/**
 * Class WPML
 *
 * @package  WPML
 * @category WordPress Plugins
 * @author   Victor Villaverde Laan
 * @link     http://www.freelancephp.net/
 * @license  MIT license
 */
final class WPML extends WPDev_Plugin
{
    /**
     * @var \WPML
     */
    protected static $instance = null;

    /**
     * Init
     */
    protected function init()
    {
        // create option and make it global
        $option = new WPDev_Option($this->getGlobal('key'), array(
            'mail_icon' => null,

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
        ));

        $this->setGlobal('option', $option);

        // delete option from DB on uninstall
        register_uninstall_hook($this->getGlobal('FILE'), array(__CLASS__, 'uninstall'));

        if (is_admin()) {
            new WPML_Admin();
        } else {
            new WPML_FrontSite();
        }
    }

    /**
     * @return \WPDev_Option
     */
    protected function createOption()
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

        $optionGroup = $this->getGlobal('key');
        $optionName = $this->getGlobal('optionName');

        // options instance
        $option = new WPDev_Option($optionGroup, $optionName, $defaultValues);

        // check if this is an update
        if ($option->getValue('version') !== WPML_VERSION) {
            // update version
            $option->setValue('version', WPML_VERSION);
            $option->save();

            // check for old values of 1.x version
            $oldValues = get_option('WP_Mailto_Links_options');

            if ($oldValues) {
                $defaultValues = $oldValues;

                // set new instance with old values as defaults
                $option = new WPDev_Option($optionGroup, $optionName, $defaultValues);
            }
        }
        
        return $option;
    }

    /**
     * Uninstall plugin
     */
    public static function uninstall()
    {
        $this->getGlobal('option')->delete();
    }

}

/*?>*/
