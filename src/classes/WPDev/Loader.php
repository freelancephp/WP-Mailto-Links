<?php
/**
 * Class WPDev_Loader
 *
 * @package  WPDev
 * @category WordPress Plugins
 * @version  0.4.0
 * @author   Victor Villaverde Laan
 * @link     http://www.freelancephp.net/
 * @link     https://github.com/freelancephp/WPDev
 * @license  MIT license
 */
class WPDev_Loader_04
{

    /**
     * @var array
     */
    protected static $paths = array();

    /**
     * @var boolean
     */
    protected static $registered = false;

    /**
     * @param array $globals  Optional, only on first call
     */
    public static function register()
    {
        if (self::$registered === true) {
            return;
        }

        self::$registered = true;

        spl_autoload_register(array(__CLASS__, 'loadClass'));
    }

    /**
     * Add path for classes
     * @param string $path
     */
    public static function addPath($path)
    {
        self::$paths[] = $path;
    }

    /**
     * Get all paths
     * @return array
     */
    public static function getPaths()
    {
        return self::$paths;
    }

    /**
     * Loads a class file
     * @param string $className
     * @return void
     */
    public static function loadClass($className)
    {
        if (class_exists($className)) {
            return;
        }

        // versionized WPDev class name
        if (strpos($className, 'WPDev_') !== false) {
            // remove version postfix
            $explodeClassName = explode('_', $className);
            array_pop($explodeClassName);

            $pureClassName = implode('_', $explodeClassName);
        } else {
            $pureClassName = $className;
        }

        $internalPath = str_replace('_', DIRECTORY_SEPARATOR, $pureClassName);

        foreach (self::$paths as $path) {
            $file = $path . DIRECTORY_SEPARATOR . $internalPath . '.php';

            if (file_exists($file)) {
                include $file;
                return;
            }
        }
    }

}

/*?>*/
