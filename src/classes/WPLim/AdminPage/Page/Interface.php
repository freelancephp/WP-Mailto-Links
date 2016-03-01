<?php
/**
 * Interface WPLim_AdminPage_Page_Interface
 *
 * @package  WPLim
 * @category WordPress Library
 * @version  0.4.0
 * @author   Victor Villaverde Laan
 * @link     http://www.freelancephp.net/
 * @link     https://github.com/freelancephp/WPLim
 * @license  MIT license
 */
interface WPLim_AdminPage_Page_Interface_0x4x0
{

    /**
     * @param array $settings
     */
    public function __construct(array $settings);

    public function create();

    /**
     * @return string
     */
    public function getHook();

}

/*?>*/
