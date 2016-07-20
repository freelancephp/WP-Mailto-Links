<?php
/**
 * Tab Default Content
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

$current_tab = $vars [ 'current_tab' ];
$tab_values = $vars[ 'tabs' ][ $current_tab ];
$fields = $tab_values[ 'fields' ];

settings_fields( $fields->get_setting( 'option_group' ) );
do_settings_sections( $fields->get_setting( 'page_id' ) );
