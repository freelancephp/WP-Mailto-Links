<?php
/**
 * Interface WPLim_Fields_Decorator_View_Interface
 *
 * @package  WPLim
 * @category WordPress Library
 * @version  0.4.0
 * @author   Victor Villaverde Laan
 * @link     http://www.freelancephp.net/
 * @link     https://github.com/freelancephp/WPLim
 * @license  MIT license
 */
interface WPLim_Fields_Decorator_View_Interface_0x4x0 extends WPLim_Fields_Decorator_Interface_0x4x0
{

    /**
     * @param string $key
     * @param string $labelText
     */
    public function label($key, $labelText);

    /**
     * @param string $key
     * @param string $class
     */
    public function textField($key, $class);

    /**
     * @param string $key
     * @param mixed  $checkedValue
     */
    public function checkField($key, $checkedValue);

    /**
     * @param string $key
     * @param mixed  $checkedValue
     */
    public function radioField($key, $checkedValue);

    /**
     * @param string $key
     * @param mixed  $checkedValue
     * @param array  $options
     */
    public function selectField($key, $checkedValue, array $options);

    /**
     * @param string  $text
     * @param string  $value
     * @param boolean $selected
     */
    public function selectOption($text, $value, $selected);

    public function submitButton();

}

/*?>*/
