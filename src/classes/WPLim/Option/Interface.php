<?php
/**
 * Interface WPLim_Option_Interface
 *
 * @package  WPLim
 * @category WordPress Library
 * @version  0.4.0
 * @author   Victor Villaverde Laan
 * @link     http://www.freelancephp.net/
 * @link     https://github.com/freelancephp/WPLim
 * @license  MIT license
 */
interface WPLim_Option_Interface_0x4x0 extends WPLim_Fields_Interface_0x4x0
{

    /**
     * @param string $optionName
     * @param array  $defaultValues
     * @param string $optionGroup
     * @param string $registerHook
     */
    public function __construct($optionName, array $defaultValues = array(), $optionGroup = null, $registerHook = 'admin_init');

    /**
     * @return string
     */
    public function getOptionName();

    /**
     * @param string  $key
     * @param mixed   $value
     * @param boolean $addKeyWhenNonExists
     */
    public function setValue($key, $value, $addKeyWhenNonExists = true);

    /**
     * @param string $key
     * @param mixed  $value
     */
    public function addValue($key, $value);

    /**
     * @return array
     */
    public function getValues();

    public function update();

    public function register();

    public function unregister();

    public function delete();

    public function settingsFields();

}

/*?>*/
