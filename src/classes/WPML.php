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
     * Factory method
     * @param array $globals  Optional, only on first call
     */
    public static function create(array $globals = array())
    {
        self::$instance = new WPML($globals);
        return self::$instance;
    }

    /**
     * @return \WPML
     */
    public static function plugin()
    {
        return self::$instance;
    }

    /**
     * Init
     */
    protected function init()
    {
        // for translations
        load_plugin_textdomain($this->getGlobal('domain'), false, $this->getGlobal('dir') . '/languages');

        add_action('init', array($this, 'actionInit'), 5);
    }

    /**
     * WP action callback
     */
    public function actionInit()
    {
        $option = $this->createOption();

        if (is_admin()) {
            // create admin
            (new WPML_Admin($option));
        } else {
            // create front
            (new WPML_Front($option));
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

}
