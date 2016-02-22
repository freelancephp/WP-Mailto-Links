<?php
/**
 * Interface WPLim_Widget_Interface
 *
 * @package  WPLim
 * @category WordPress Library
 * @version  0.4.0
 * @author   Victor Villaverde Laan
 * @link     http://www.freelancephp.net/
 * @link     https://github.com/freelancephp/WPLim
 * @license  MIT license
 */
interface WPLim_Widget_Interface_0x4x0
{

    public static function register();

    public function __construct();

    /**
     * @param array $args
     * @param array $instance
     */
    public function widget($args, $instance);

    /**
     * @param array $instance
     */
    public function form($instance);

    /**
     * @param array $newInstance
     * @param array $oldInstance
     */
    public function update($newInstance, $oldInstance);

    /**
     * @param string $key
     * @return mixed
     */
    public function getValue($key);

    /**
     * @param array $instance
     */
    public function setValues($instance);

}

/*?>*/
