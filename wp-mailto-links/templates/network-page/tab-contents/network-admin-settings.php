<?php
/**
 * Tab Network Admin Settings
 *
 * @package  WPML
 * @category WordPress Plugin
 * @version  2.1.5
 * @author   Victor Villaverde Laan
 * @link     http://www.finewebdev.com
 * @link     https://github.com/freelancephp/WP-Mailto-Links
 * @license  Dual licensed under the MIT and GPLv2+ licenses
 *
 * @var array $vars
 *      @option array  "tabs"
 *      @option string "current_tab"
 */

$default_fields_file = WPML_Plugin::get_plugin_dir( '/templates/partials/tab-contents/fields-default.php' );
WPML_Plugin::show_template( $default_fields_file, $vars );

submit_button();
