<?php
/**
 * Class WPLim_Shortcode_Abstract
 *
 * @package  WPLim
 * @category WordPress Plugin
 * @version  0.4.0
 * @author   Victor Villaverde Laan
 * @link     http://www.freelancephp.net/
 * @link     https://github.com/freelancephp/WPLim
 * @license  MIT license
 */
abstract class WPLim_Shortcode_Abstract_0x4x0 implements WPLim_Shortcode_Interface_0x4x0
{

    /**
     * @var string
     */
    protected $shortcodeName = null;

    /**
     * @var array
     */
    protected $defaultAttributes = array();


    /**
     * Implementation of the shortcode function
     * @param array  $atts
     * @param string $content
     */
    abstract protected function func($atts, $content);

    /**
     * Add shortcode
     */
    public function add()
    {
        add_shortcode($this->shortcodeName, function ($atts, $content = null) {
            $attributes = $atts;

            if (!empty($this->defaultAttributes)) {
                $attributes = shortcode_atts($this->defaultAttributes, $atts);
            }

            return $this->func($attributes, $content);
        });
    }

    /**
     * Remove shortcode
     */
    final public function remove()
    {
        remove_shortcode($this->shortcodeName);
    }

    /**
     * Content has shortcode
     * @param string $content
     * @return boolean
     */
    final public function has($content)
    {
        return has_shortcode($content, $this->shortcodeName);
    }

    /**
     * Check if shortcode was added
     * @return boolean
     */
    final public function exists()
    {
        return shortcode_exists($this->shortcodeName);
    }

    /**
     * Filter all shortcodes on given content
     * @param string  $content
     * @param boolean $ignoreHtml
     * @return string
     */
    final public static function doAllShortcodes($content, $ignoreHtml = false)
    {
        return do_shortcode($content, $ignoreHtml);
    }

}

/*?>*/
