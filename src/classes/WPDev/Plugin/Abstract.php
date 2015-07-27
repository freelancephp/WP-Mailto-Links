<?php
/**
 * Class WPDev_Plugin_Abstract
 *
 * @sinlgeton
 *
 * @package  WPDev
 * @category WordPress Plugins
 * @version  1.0.0
 * @author   Victor Villaverde Laan
 * @link     http://www.freelancephp.net/
 * @link     https://github.com/freelancephp/WPDev
 * @license  MIT license
 */
abstract class WPDev_Plugin_Abstract
{

    /**
     * Name of Plugin class to create singleton instance
     * @var string
     */
    protected static $className = null;

    /**
     * Instance of Plugin class
     * @var \WPDev_Plugin_Abstract
     */
    protected static $instance = null;

    /**
     * @var array
     */
    protected $globals = array(
        'version' => null,
        'key' => null,
        'domain' => null,
        'optionName' => null,
        'adminPage' => null,
        'file' => null,
        'dir' => null,
        'pluginUrl' => null,
    );

    /**
     * Singleton protection
     */
    protected function __construct()
    {
        // autoloader
        spl_autoload_register(array($this, 'autoload'));
    }

    /**
     * Singleton protection
     */
    private function __clone()
    {
    }

    /**
     * Singleton protection
     */
    private function __wakeup()
    {
    }

    /**
     * Get singleton instance
     * @param array $globals  Optional, only on first call
     */
    public static function getInstance(array $globals = array())
    {
        if (self::$instance === null) {
            self::$instance = new static::$className;

            // set globals
            foreach ($globals as $key => $value) {
                self::$instance->globals[$key] = $value;
            }

            self::$instance->init();
        }

        return self::$instance;
    }

    /**
     * Init procedure to implement
     */
    abstract protected function init();

    /**
     * Get translation
     * @param string $text
     * @return string
     */
    public static function __($text)
    {
        return __($text, self::get('domain'));
    }

    /**
     * Echo translation
     * @param string $text
     */
    public static function _e($text)
    {
        echo self::__($text);
    }

    /**
     * Get global setting
     * @param string $key
     * @return mixed|null
     */
    public static function get($key)
    {
        $globals = self::getInstance()->globals;

        if (key_exists($key, $globals)) {
            return $globals[$key];
        }

        return null;
    }

    /**
     * Set global setting
     * @param string $key
     * @param mixed $value  Optional
     * @return mixed|null
     */
    public static function set($key, $value = null)
    {
        self::getInstance()->globals[$key] = $value;
    }

    /**
     * Get absolute url to plugin path
     * @param string $path
     * @return string
     */
    public static function url($path)
    {
        if (substr($path, 0, 1) !== '/') {
            $path = '/' . $path;
        }

        return self::get('pluginUrl') . $path;
    }

    /**
     * autoload callback
     * @param string $className
     * @return void
     */
    protected function autoload($className)
    {
        if (class_exists($className)) {
            return;
        }

        $internalPath = str_replace('_', DIRECTORY_SEPARATOR, $className);
        $file = self::get('dir') . DIRECTORY_SEPARATOR . 'classes'
                . DIRECTORY_SEPARATOR . $internalPath . '.php';

        if (file_exists($file)) {
            include $file;
        }
    }

}
