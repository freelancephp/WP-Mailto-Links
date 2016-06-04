<?php
/**
 * Class WPML_Option_OldSettings
 *
 * Option entry of old version
 *
 * @package  WPML
 * @category WordPress Plugins
 * @version  2.1.3
 * @author   Victor Villaverde Laan
 * @link     http://www.freelancephp.net/
 * @link     https://github.com/freelancephp/WP-Mailto-Links
 * @link     https://wordpress.org/plugins/wp-mailto-links/
 * @license  GPLv2+ license
 */
final class WPML_Option_OldSettings extends MyDevLib_OptionAbstract_0x5x0
{

    /**
     * @var string
     */
    protected $optionGroup = 'WP_Mailto_Links_options';

    /**
     * Recommended optionGroup and optionName have same name
     * @var string
     */
    protected $optionName = 'WP_Mailto_Links_options';

    /**
     * @var array
     */
    protected $defaultValues = array(
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

}

/*?>*/
