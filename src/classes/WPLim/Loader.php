<?php
/**
 * Class WPLim_Loader
 *
 * @package  WPLim
 * @category WordPress Plugins
 * @version  0.4.0
 * @author   Victor Villaverde Laan
 * @link     http://www.freelancephp.net/
 * @link     https://github.com/freelancephp/WPLim
 * @license  MIT license
 */
class WPLim_Loader_0x4x0
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

        $pureClassName = self::removeVersionFromClassName($className);

        $internalPath = str_replace('_', DIRECTORY_SEPARATOR, $pureClassName);

        foreach (self::$paths as $path) {
            $file = $path . DIRECTORY_SEPARATOR . $internalPath . '.php';

            if (file_exists($file)) {
                include $file;
                return;
            }
        }
    }

    /**
     * @param string $className
     * @return string
     */
    private static function removeVersionFromClassName($className)
    {
        if (substr($className, 0, 6) === 'WPLim_') {
            // remove version postfix
            $explodeClassName = explode('_', $className);
            array_pop($explodeClassName);

            $pureClassName = implode('_', $explodeClassName);
        } else {
            $pureClassName = $className;
        }

        return $pureClassName;
    }

}

/*?>*/
