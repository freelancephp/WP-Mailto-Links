<?php
/**
 * Class WPLim_Fields_Decorator_Abstract
 *
 * @package  WPLim
 * @category WordPress Library
 * @version  0.4.0
 * @author   Victor Villaverde Laan
 * @link     http://www.freelancephp.net/
 * @link     https://github.com/freelancephp/WPLim
 * @license  MIT license
 */
abstract class WPLim_Fields_Decorator_Abstract_0x4x0 implements WPLim_Fields_Decorator_Interface_0x4x0
{

    /**
     * @var WPLim_Fields_Interface_0x4x0
     */
    protected $fields = null;

    /**
     * @param WPLim_Fields_Interface_0x4x0  $fields
     */
    public function __construct(WPLim_Fields_Interface_0x4x0 $fields) {
        $this->fields = $fields;
    }

    /**
     * Get value
     * @param string $key
     * @return mixed|null
     */
    public function getValue($key)
    {
        return $this->fields->getValue($key);
    }

    /**
     * Get form field name
     * @param string $key
     * @return string
     */
    public function getFieldName($key)
    {
        return $this->fields->getFieldName($key);
    }

    /**
     * Get form field id
     * @param string $key
     * @return string
     */
    public function getFieldId($key)
    {
        return $this->fields->getFieldId($key);
    }

}

/*?>*/
