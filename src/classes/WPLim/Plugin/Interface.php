<?php
/**
 * Interface WPLim_Plugin_Interface
 *
 * @package  WPLim
 * @category WordPress Library
 * @version  0.4.0
 * @author   Victor Villaverde Laan
 * @link     http://www.freelancephp.net/
 * @link     https://github.com/freelancephp/WPLim
 * @license  MIT license
 */
interface WPLim_Plugin_Interface_0x4x0
{

    /**
     * Create singleton instance
     * @param array $settings
     */
    public static function create(array $settings);
    
    /**
     * @return WPLim_Plugin_Interface
     */
    public static function plugin();

    /**
     * @return string
     */
    public function getFile();

    /**
     * @param string $path
     * @return string
     */
    public function getPath($path = '');

    /**
     * @param string $url
     * @return string
     */
    public function getUrl($url = '');

}

/*?>*/
