<?php
/**
 * Class WPDev_Filter_FinalOutput
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
 *
 *      WPDev_Filter_FinalOutput::create('wp_final_output');
 *
 *      add_filter('wp_final_output', 'wp_replace_b_tags', 10, 1);
 *
 *      function wp_replace_b_tags($content) {
 *          $content = str_replace('<b>', '<strong>', $content);
 *          $content = str_replace('</b>', '</strong>', $content);
 *          return $content;
 *      }
 */
class WPDev_Filter_FinalOutput
{

    /**
     * Filter name
     * @var string
     */
    protected $filterName = null;

    /**
     * Factory method
     * @param string $filterName
     * @return \WPDev_Filter_FinalOutput
     */
    public static function create($filterName)
    {
        return new WPDev_Filter_FinalOutput($filterName);
    }

    /**
     * @param string $filterName
     */
    protected function __construct($filterName)
    {
        $this->filterName = $filterName;

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
