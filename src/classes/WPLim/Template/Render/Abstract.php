<?php
/**
 * Class WPLim_Template_Render_Abstract
 *
 * @package  WPLim
 * @category WordPress Library
 * @version  0.4.0
 * @author   Victor Villaverde Laan
 * @link     http://www.freelancephp.net/
 * @link     https://github.com/freelancephp/WPLim
 * @license  MIT license
 */
abstract class WPLim_Template_Render_Abstract_0x4x0 implements WPLim_Template_Render_Interface_0x4x0
{

    public function render($templateFile, $templateVars = array())
    {
        $view = new WPLim_View_0x4x0($templateFile, $templateVars);

        if (!$view->exists()) {
            return false;
        }

        return $view->render();
    }

}

/*?>*/
