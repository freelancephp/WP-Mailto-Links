<?php
/**
 * Class WPLim_RenderTemplate_Abstract
 *
 * @package  WPLim
 * @category WordPress Plugin
 * @version  0.4.0
 * @author   Victor Villaverde Laan
 * @link     http://www.freelancephp.net/
 * @link     https://github.com/freelancephp/WPLim
 * @license  MIT license
 */
abstract class WPLim_RenderTemplate_Abstract_0x4x0 implements WPLim_RenderTemplate_Interface_0x4x0
{

    /**
     * @var string
     */
    private $templatesPath = null;

    /**
     * @var string
     */
    private $templateFileExt = null;

    /**
     * @var array
     */
    private $templateVars = array();


    /**
     * @param string $templatesPath
     * @param string $templateFileExt
     * @param array  $templateVars
     */
    public function __construct($templatesPath, $templateFileExt, array $templateVars = array())
    {
        $this->templatesPath = $templatesPath;
        $this->templateFileExt = $templateFileExt;
        $this->templateVars = $templateVars;
    }

    /**
     * @param string $key
     * @return boolean
     */
    public function exists($key)
    {
        $templateFile = $this->getTemplateFile($key);
        $view = new WPLim_View_0x4x0($templateFile);
        return $view->exists();
    }

    /**
     * @param string $key
     * @param array  $additionalTemplateVars
     * @return string
     */
    public function render($key, array $additionalTemplateVars = array())
    {
        $templateFile = $this->getTemplateFile($key);
        $templateVars = array_merge($this->templateVars, $additionalTemplateVars);

        $view = new WPLim_View_0x4x0($templateFile, $templateVars);
        return $view->render();
    }

    /**
     * @param string $key
     * @return string
     */
    private function getTemplateFile($key)
    {
        return $this->templatesPath . '/' . $key . $this->templateFileExt;
    }

}

/*?>*/
