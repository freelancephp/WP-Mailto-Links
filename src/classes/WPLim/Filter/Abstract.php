<?php
/**
 * Class WPLim_Filter_Abstract
 *
 * @package  WPLim
 * @category WordPress Library
 * @version  0.4.0
 * @author   Victor Villaverde Laan
 * @link     http://www.freelancephp.net/
 * @link     https://github.com/freelancephp/WPLim
 * @license  MIT license
 *
 * @example
 *      // create filter
 *      WPLim_Filter_SomeOutput::create();
 *
 *      // use wordpress filter method
 *      add_filter('some_output', 'some_filter_func', 10, 1);
 *
 *      // or use helper:
 *     WPLim_Filter_SomeOutput::add('some_filter_func', 10, 1);
 *
 */
abstract class WPLim_Filter_Abstract_0x4x0 implements WPLim_Filter_Interface_0x4x0
{

    /**
     * @var string
     */
    protected $filterName = null;

    /**
     * @var WPLim_Filter_Abstract
     */
    protected static $instance = null;

    /**
     * Singleton creation
     */
    public static function create()
    {
        if (static::$instance === null) {
            static::$instance = new static;
        }
    }

    /**
     * Helper for adding callbacks to the filter
     * 
     * @example
     *
     *      self::add('some_func', 10, 1);
     *
     *      // will execute this code:
     *      add_filter($this->filterName, 'some_func', 10, 1);
     *
     */
    public static function add($callback, $priority = 10, $numberOfAcceptedArguments = 1)
    {
        $arguments = func_get_args();
        array_unshift($arguments, static::$instance->filterName);

        call_user_func_array('add_filter', $arguments);
    }

    /**
     * Constructor
     */
    abstract protected function __construct();

}

/*?>*/
