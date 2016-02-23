<?php
/**
 * Class WPLim_Fields_Decorator_View
 *
 * @package  WPLim
 * @category WordPress Library
 * @version  0.4.0
 * @author   Victor Villaverde Laan
 * @link     http://www.freelancephp.net/
 * @link     https://github.com/freelancephp/WPLim
 * @license  MIT license
 */
class WPLim_Fields_Decorator_View_0x4x0 extends WPLim_Fields_Decorator_Abstract_0x4x0 implements WPLim_Fields_Decorator_View_Interface_0x4x0
{

    /**
     * Show html label
     * @param string $key
     * @param string $labelText
     */
    public function label($key, $labelText)
    {
        echo '<label for="' . $this->getFieldId($key) . '">
                     ' . $labelText . '
               </label>';
    }

    /**
     * Show text input field
     * @param string $key
     * @param string $class
     */
    public function textField($key, $class = 'regular-text')
    {
        echo '<input type="text"
                    class="' . $class . '"
                    id="' . $this->getFieldId($key) . '"
                    name="' . $this->getFieldName($key) . '"
                    value="' . esc_attr($this->getValue($key)) . '">';
    }

    /**
     * Show a check field
     * @param string $key
     * @param mixed  $checkedValue
     * @param string $class
     */
    public function checkField($key, $checkedValue, $class = '')
    {
        echo '<input type="checkbox"
                    class="' . $class . '"
                    id="' . $this->getFieldId($key) . '"
                    name="' . $this->getFieldName($key) . '"
                    value="' . esc_attr($checkedValue) . '"
                    ' . $this->getCheckedAttr($key, $checkedValue) . '
                    >';
    }

    /**
     * Show a radio field
     * @param string $key
     * @param mixed  $checkedValue
     * @param string $class
     */
    public function radioField($key, $checkedValue, $class = '')
    {
        $id = $this->getFieldId($key) . '-' . sanitize_key($checkedValue);
        
        echo '<input type="radio"
                    class="' . $class . '"
                    id="' . $id . '"
                    name="' . $this->getFieldName($key) . '"
                    value="' . esc_attr($checkedValue) . '"
                    ' . $this->getCheckedAttr($key, $checkedValue) . '
                    >';
    }

    /**
     * Show select field with or without options
     * @param string $key
     * @param mixed  $checkedValue
     * @param array  $options
     * @param string $class
     */
    public function selectField($key, $checkedValue, array $options = array(), $class = '')
    {
        echo '<select class="' . $class . '"
                    class="' . $class . '"
                    id="' . $this->getFieldId($key) . '"
                    name="' . $this->getFieldName($key) . '"
                    >';

        foreach ($options as $value => $text) {
            $this->selectOption($text, $value, ($checkedValue == $value));
        }

        echo '</select>';
    }

    /**
     * Show a select option
     * @param string  $text
     * @param string  $value
     * @param boolean $selected
     */
    public function selectOption($text, $value, $selected = false)
    {
        echo '<option value="' . esc_attr($value) . '"' . ($selected ? ' selected' : '') . '>
                    ' . $text  . '
               </option>';
    }

    /**
     * Show submit button
     */
    public function submitButton()
    {
        echo '<input type="submit"
                    class="button button-primary button-large"
                    value="' . __('Save Changes') . '">';
    }

    /**
     * Get the checked attribute
     * @param string $key
     * @param mixed  $checkedValue
     * @return string
     */
    protected function getCheckedAttr($key, $checkedValue)
    {
        return ($this->getValue($key) == $checkedValue) ? ' checked' : '';
    }

}

/*?>*/
