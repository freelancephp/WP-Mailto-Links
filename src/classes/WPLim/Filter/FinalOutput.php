<?php
/**
 * Class WPLim_Filter_FinalOutput
 *
 * @package  WPLim
 * @category WordPress Library
 * @version  0.4.0
 * @author   Victor Villaverde Laan
 * @link     http://www.freelancephp.net/
 * @link     https://github.com/freelancephp/WPLim
 * @license  MIT license
 */
final class WPLim_Filter_FinalOutput_0x4x0 extends WPLim_Filter_Abstract_0x4x0
{

    /**
     * @var string
     */
    protected $filterName = 'final_output';

    /**
     * @var WPLim_Filter_FinalOutput
     */
    protected static $instance = null;

    /**
     * Constructor
     */
    protected function __construct()
    {
        $bufferStart = function () {
            ob_start(function ($content) {
                return apply_filters($this->filterName, $content);
            });
        };

        add_action('init', $bufferStart, 1);
    }

}

/*?>*/
