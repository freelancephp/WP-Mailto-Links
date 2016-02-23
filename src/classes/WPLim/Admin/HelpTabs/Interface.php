<?php
/**
 * Interface WPLim_Admin_HelpTabs_Interface
 *
 * @package  WPLim
 * @category WordPress Library
 * @version  0.4.0
 * @author   Victor Villaverde Laan
 * @link     http://www.freelancephp.net/
 * @link     https://github.com/freelancephp/WPLim
 * @license  MIT license
 */
interface WPLim_Admin_HelpTabs_Interface_0x4x0
{

    /**
     * @param array $settings
     */
    public function __construct(array $settings);

    /**
     * @param string $key
     * @param string $title
     */
    public function addHelpTab($key, $title);

}

/*?>*/
