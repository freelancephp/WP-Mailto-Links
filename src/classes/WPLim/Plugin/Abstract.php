<?php
/**
 * Class WPLim_Plugin_Abstract
 *
 * @package  WPLim
 * @category WordPress Library
 * @version  0.4.0
 * @author   Victor Villaverde Laan
 * @link     http://www.freelancephp.net/
 * @link     https://github.com/freelancephp/WPLim
 * @license  MIT license
 */
abstract class WPLim_Plugin_Abstract_0x4x0 implements WPLim_Plugin_Interface_0x4x0
{

    /**
     * This property should also be included in child classes to prevent conflicts
     * @var WPLim_Plugin
     */
    protected static $instance = null;

    /**
     * @var array
     */
    private $settings = array(
        'file'      => '',  // __FILE__
        'dir'       => '',  // __DIR__
        'baseUrl'   => '',  // Plugin base url
    );

    /**
     * Singleton factory
     * @param array $settings
     */
    public static function create(array $settings)
    {
        if (static::$instance !== null) {
            return;
        }

        static::$instance = new static($settings);
        static::$instance->init();
    }

    /**
     * @return WPLim_Plugin
     */
    public static function plugin()
    {
        return static::$instance;
    }

    /**
     * Constructor
     * @param array $settings
     */
    protected function __construct(array $settings)
    {
        $this->settings = array_merge($this->settings, $settings);
    }

    /**
     * Init plugin
     * Should be implemented
     */
    abstract protected function init();

    /**
     * Get __FILE__
     * @return string
     */
    public function getFile()
    {
        return $this->settings['file'];
    }

    /**
     * Get complete path
     * @return string
     */
    public function getPath($path = '')
    {
        return $this->settings['dir'] . $path;
    }

    /**
     * Get complete url
     * @return string
     */
    public function getUrl($url = '')
    {
        return $this->settings['baseUrl'] . $url;
    }

}

/*?>*/
