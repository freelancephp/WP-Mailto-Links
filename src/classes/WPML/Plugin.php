<?php
/**
 * Class WPML_Plugin
 *
 * @package  WPML
 * @category WordPress Plugins
 * @author   Victor Villaverde Laan
 * @link     http://www.freelancephp.net/
 * @license  MIT license
 */
final class WPML_Plugin extends WPLim_Plugin_Abstract_0x4x0 implements WPML_Plugin_Interface
{

    /**
     * This property should also be included in child classes to prevent conflicts
     * @var PluginExample_Plugin_Interface
     */
    protected static $instance = null;

    /**
     * @var WPLim_Option_Interface
     */
    private $option = null;

    /**
     * Init
     */
    protected function init()
    {
        // create option and make it global
        $this->option = new WPLim_Option_0x4x0('wp-mailto-links', array(
            'protect'           => 1,
            'convert_emails'    => 1,
            'filter_body'       => 1,
            'filter_posts'      => 1,
            'filter_comments'   => 1,
            'filter_widgets'    => 1,
            'filter_rss'        => 1,
            'filter_head'       => 1,
            'input_strong_protection' => 0,
            'protection_text'   => '*protected email*',
            'mail_icon'         => '',  // type
            'image'              => 1,  // new
            'dashicons'         => '',  // new
            'fontawesome'       => '',  // new
            'show_icon_before'  => 0,   // new
            'image_no_icon'     => 0,
            'no_icon_class'     => 'no-mail-icon',
            'class_name'        => 'mail-link',
            'security_check'    => 0,
            'own_admin_menu'    => 1,
        ));

        // activation also after upgrade
        register_activation_hook($this->getFile(), array(__CLASS__, 'upgrade'));

        // delete option from DB on uninstall
        register_uninstall_hook($this->getFile(), array(__CLASS__, 'uninstall'));

        // load admin or front site
        if (is_admin()) {
            new WPML_Admin_Page();
        } else {
            new WPML_Site();
        }
    }

    /**
     * @return WPLim_Option_Interface
     */
    public function getOption()
    {
        return $this->option;
    }

    /**
     * Upgrade procedure
     * Convert old to new option values
     */
    public static function upgrade()
    {
        $option = static::plugin()->getOption();

        $defaultOldValues = array(
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

        // get old option name "WP_Mailto_Links_options"
        $oldOption = new WPLim_Option_0x4x0('WP_Mailto_Links_options', $defaultOldValues);
        $oldValues = $oldOption->getValues();

        if (!empty($oldValues)) {
            foreach ($oldValues as $key => $oldValue) {
                // take old value
                if ($key === 'icon') {
                    // old 'icon' contained the image number
                    // new 'mail_icon' contains type (image, dashicons, fontawesome)
                    $newValue = empty($oldValue) ? '' : 'image';
                    $option->setValue('mail_icon', $newValue, false);

                    // mail_icon === 'image' ---> 'image' contains number
                    if (!empty($oldValue)) {
                        $option->setValue('image', $oldValue, false);
                    }
                } else {
                    $option->setValue($key, $oldValue, false);
                }
            }

            $option->update();
            $oldOption->delete();
        }
    }

    /**
     * Uninstall plugin
     */
    public static function uninstall()
    {
        // remove option values
        $this->getOption()->delete();
    }

}

/*?>*/
