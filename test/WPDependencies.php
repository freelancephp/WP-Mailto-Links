<?php
include_once 'UnitTestBase.php';

/**
 * Dependencies
 * WordPress functions
 */

function __($text, $domain = null)
{
    UnitTestBase::saveCall(__FUNCTION__, func_get_args());
    return '<translated>' . $text . '</translated>';
}

function add_action($hookName, $callback, $priority = null)
{
    UnitTestBase::saveCall(__FUNCTION__, func_get_args());
}

function apply_filters($filterName, $content)
{
    UnitTestBase::saveCall(__FUNCTION__, func_get_args());
    return '<applied>' . $content . '</applied>';
}

function get_option($option, $default = false)
{
    UnitTestBase::saveCall(__FUNCTION__, func_get_args());
    return array('someKey' => 'someValue', 'anotherKey' => 'anotherValue', 'check' => $option /* a variable value */);
}

function update_option($option, $newValue, $autoload = null)
{
    UnitTestBase::saveCall(__FUNCTION__, func_get_args());
    return true;
}

function delete_option($option)
{
    UnitTestBase::saveCall(__FUNCTION__, func_get_args());
}

function register_setting($optionGroup, $optionName, $sanitizeCallback = null)
{
    UnitTestBase::saveCall(__FUNCTION__, func_get_args());
}

function unregister_setting($optionGroup, $optionName, $sanitizeCallback = null)
{
    UnitTestBase::saveCall(__FUNCTION__, func_get_args());
}

function register_uninstall_hook($file, $callback)
{
    UnitTestBase::saveCall(__FUNCTION__, func_get_args());
}
