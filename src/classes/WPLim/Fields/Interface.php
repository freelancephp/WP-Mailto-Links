<?php
/**
 * Interface WPLim_Fields_Interface
 *
 * @package  WPLim
 * @category WordPress Library
 * @version  0.4.0
 * @author   Victor Villaverde Laan
 * @link     http://www.freelancephp.net/
 * @link     https://github.com/freelancephp/WPLim
 * @license  MIT license
 */
interface WPLim_Fields_Interface_0x4x0
{

    /**
     * @param string $key
     * @return mixed|null
     */
    public function getValue($key);

    /**
     * @param string $key
     * @return string
     */
    public function getFieldName($key);

    /**
     * @param string $key
     * @return string
     */
    public function getFieldId($key);

}

/*?>*/
