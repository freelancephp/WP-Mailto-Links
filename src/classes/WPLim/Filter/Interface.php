<?php
/**
 * Interface WPLim_Filter_Interface
 *
 * @package  WPLim
 * @category WordPress Library
 * @version  0.4.0
 * @author   Victor Villaverde Laan
 * @link     http://www.freelancephp.net/
 * @link     https://github.com/freelancephp/WPLim
 * @license  MIT license
 */
interface WPLim_Filter_Interface_0x4x0
{

    public static function create();

    /**
     * @param callable $callback
     * @param integer  $priority
     * @param integer  $numberOfAcceptedArguments
     */
    public static function add($callback, $priority, $numberOfAcceptedArguments);

}

/*?>*/
