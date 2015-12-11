<?php
/**
 * Class Old_WPDev_Filter_FinalOutput
 *
 * @package  WPDev
 * @category WordPress Library
 * @version  1.0.0
 * @author   Victor Villaverde Laan
 * @link     http://www.freelancephp.net/
 * @link     https://github.com/freelancephp/WPDev
 * @license  MIT license
 *
 * @example
 *      if (! Old_WPDev_Filter_FinalOutput::isCreated()) {
 *          Old_WPDev_Filter_FinalOutput::create('final_output');
 *      }
 *
 *      add_filter('final_output', 'wp_replace_b_tags', 10, 1);
 *
 *      function wp_replace_b_tags($content) {
 *          $content = str_replace('<b>', '<strong>', $content);
 *          $content = str_replace('</b>', '</strong>', $content);
 *          return $content;
 *      }
 */
class Old_WPDev_Filter_FinalOutput
{

    /**
     * Filter name
     * @var string
     */
    private $filterName = 'final_output';

    /**
     * @var \Old_WPDev_Filter_FinalOutput
     */
    private static $instance = null;

    /**
     * Factory method
     * @return \Old_WPDev_Filter_FinalOutput
     */
    public static function create()
    {
        if (self::isCreated()) {
            throw new Exception('Final Output filter already created.');
        }

        self::$instance = new Old_WPDev_Filter_FinalOutput;
        return self::$instance;
    }

    /**
     * Check if already instantiated
     * @return boolean
     */
    public static function isCreated()
    {
        return (self::$instance !== null);
    }

    /**
     * Constructor
     */
    private function __construct()
    {
        add_action('wp', array($this, 'bufferStart'), 1);
    }

    /**
     * Start buffer
     */
    public function bufferStart() {
        ob_start(array($this, 'filterOutput'));
    }

    /**
     * @param string $content
     * @return string
     */
    public function filterOutput($content) {
        return apply_filters($this->filterName, $content);
    }

}
