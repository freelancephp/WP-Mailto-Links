<?php
/**
 * WordPress Dependencies
 */

/**
 * Helper
 */
function _helperSaveCallAndReturnValue($funcName, $args = array())
{
    WPDev_Test_UnitBase::saveCall($funcName, $args);
    return WPDev_Test_UnitBase::getReturnValue($funcName);
}

/**
 * WP Global Functions
 */

function add_action($hookName, $callback, $priority = null)
{
    return _helperSaveCallAndReturnValue(__FUNCTION__, func_get_args());
}

function apply_filters($filterName, $content)
{
    return _helperSaveCallAndReturnValue(__FUNCTION__, func_get_args());
}

function __($text, $domain = null)
{
    return _helperSaveCallAndReturnValue(__FUNCTION__, func_get_args());
}

function get_option($option, $default = false)
{
    return _helperSaveCallAndReturnValue(__FUNCTION__, func_get_args());
}

function update_option($option, $newValue, $autoload = null)
{
    return _helperSaveCallAndReturnValue(__FUNCTION__, func_get_args());
}

function delete_option($option)
{
    return _helperSaveCallAndReturnValue(__FUNCTION__, func_get_args());
}

function register_setting($optionGroup, $optionName, $sanitizeCallback = null)
{
    return _helperSaveCallAndReturnValue(__FUNCTION__, func_get_args());
}

function unregister_setting($optionGroup, $optionName, $sanitizeCallback = null)
{
    return _helperSaveCallAndReturnValue(__FUNCTION__, func_get_args());
}

function add_menu_page()
{
    return _helperSaveCallAndReturnValue(__FUNCTION__, func_get_args());
}

function add_submenu_page()
{
    return _helperSaveCallAndReturnValue(__FUNCTION__, func_get_args());
}

function wp_enqueue_script()
{
    return _helperSaveCallAndReturnValue(__FUNCTION__, func_get_args());
}

function add_screen_option()
{
    return _helperSaveCallAndReturnValue(__FUNCTION__, func_get_args());
}

function get_current_screen()
{
    return _helperSaveCallAndReturnValue(__FUNCTION__, func_get_args());
}
