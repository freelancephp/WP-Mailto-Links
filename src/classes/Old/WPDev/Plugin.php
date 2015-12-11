<?php
/**
 * Class Old_WPDev_Plugin
 *
 * @package  WPDev
 * @category WordPress Plugins
 * @version  1.0.0
 * @author   Victor Villaverde Laan
 * @link     http://www.freelancephp.net/
 * @link     https://github.com/freelancephp/WPDev
 * @license  MIT license
 */
abstract class Old_WPDev_Plugin
{

    /**
     * @var array
     */
    protected $globals = array(
        'key' => null,
        'domain' => null,
        'optionName' => null,
        'adminPage' => null,
        'file' => null,
        'dir' => null,
        'pluginUrl' => null,
    );

    /**
     * @param array $globals  Optional, only on first call
     */
    public function __construct(array $globals = array())
    {
        spl_autoload_register(array($this, 'autoload'));

        $this->setGlobals($globals);
        $this->init();
    }

    /**
     * @param array $globals
     */
    protected function setGlobals(array $globals)
    {
        foreach ($globals as $key => $value) {
            $this->setGlobal($key, $value);
        }
    }

    /**
     * Init
     */
    abstract protected function init();

    /**
     * Get translation
     * @param string $text
     * @return string
     */
    public function __($text)
    {
        return __($text, $this->getGlobal('domain'));
    }

    /**
     * Echo translation
     * @param string $text
     */
    public function _e($text)
    {
        _e($text, $this->getGlobal('domain'));
    }

    /**
     * Get global setting
     * @param string $key
     * @return mixed|null
     */
    public function getGlobal($key)
    {
        if (key_exists($key, $this->globals)) {
            return $this->globals[$key];
        }

        return null;
    }

    /**
     * Set global setting
     * @param string $key
     * @param mixed $value  Optional
     * @return mixed|null
     */
    public function setGlobal($key, $value = null)
    {
        $this->globals[$key] = $value;
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
        $file = $this->getGlobal('dir') . DIRECTORY_SEPARATOR . 'classes'
                . DIRECTORY_SEPARATOR . $internalPath . '.php';

        if (file_exists($file)) {
            include $file;
        }
    }

}
