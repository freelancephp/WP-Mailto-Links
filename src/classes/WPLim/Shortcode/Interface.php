<?php
/**
 * Interface WPLim_Shortcode_Interface
 *
 * @package  WPLim
 * @category WordPress Plugin
 * @version  0.4.0
 * @author   Victor Villaverde Laan
 * @link     http://www.freelancephp.net/
 * @link     https://github.com/freelancephp/WPLim
 * @license  MIT license
 */
interface WPLim_Shortcode_Interface_0x4x0
{

    public function add();

    public function remove();

    /**
     * @param string $content
     * @return boolean
     */
    public function has($content);

    /**
     * @return boolean
     */
    public function exists();

    /**
     * @param string  $content
     * @param boolean $ignoreHtml
     * @return string
     */
    public static function doAllShortcodes($content, $ignoreHtml = false);

}

/*?>*/
