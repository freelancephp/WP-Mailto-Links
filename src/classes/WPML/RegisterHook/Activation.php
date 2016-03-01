<?php
/**
 * Class WPML_RegisterHook_Activation
 *
 * @package  WPML
 * @category WordPress Plugins
 * @author   Victor Villaverde Laan
 * @link     http://www.freelancephp.net/
 * @link     https://github.com/freelancephp/WP-Mailto-Links
 * @link     https://wordpress.org/plugins/wp-mailto-links/
 * @license  MIT license
 */
final class WPML_RegisterHook_Activation extends WPLim_RegisterHook_Activation_Abstract_0x4x0
{

    protected function activate()
    {
        $option = WPML_Plugin::plugin()->getOption();

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

}

/*?>*/
