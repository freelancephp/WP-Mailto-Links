<?php
/**
 * Interface WPLim_AdminPage_MetaBoxes_Interface
 *
 * @package  WPLim
 * @category WordPress Library
 * @version  0.4.0
 * @author   Victor Villaverde Laan
 * @link     http://www.freelancephp.net/
 * @link     https://github.com/freelancephp/WPLim
 * @license  MIT license
 */
interface WPLim_AdminPage_MetaBoxes_Interface_0x4x0
{

    /**
     * @param string   $key
     * @param string   $title
     * @param string   $context
     * @param integer  $priority
     * @param callable $callback
     */
    public function addMetaBox($key, $title, $context, $priority, $callback);

}

/*?>*/
