<?php
/**
 * Class WPLim_RegisterHook_Deactivation_Abstract
 *
 * @package  WPLim
 * @category WordPress Plugin
 * @version  0.4.0
 * @author   Victor Villaverde Laan
 * @link     http://www.freelancephp.net/
 * @link     https://github.com/freelancephp/WPLim
 * @license  MIT license
 */
abstract class WPLim_RegisterHook_Deactivation_Abstract_0x4x0 implements WPLim_RegisterHook_Interface_0x4x0
{

    /**
     * @param string $file
     */
    final public static function register($file)
    {
        $concreteClass = get_called_class();

        register_deactivation_hook($file, array($concreteClass, '_redirectCall'));
    }

    /**
     * Internal callback, but needed to be public
     */
    final public static function _redirectCall()
    {
        $concreteClass = get_called_class();

        $registerHook = new $concreteClass;
        $registerHook->deactivate();
    }

    /**
     * Plugin deactivation procedure
     */
    abstract protected function deactivate();

}

/*?>*/
