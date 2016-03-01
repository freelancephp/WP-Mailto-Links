<?php
/**
 * Class WPLim_TemplateTag_Abstract
 *
 * @package  WPLim
 * @category WordPress Plugin
 * @version  0.4.0
 * @author   Victor Villaverde Laan
 * @link     http://www.freelancephp.net/
 * @link     https://github.com/freelancephp/WPLim
 * @license  MIT license
 */
abstract class WPLim_TemplateTag_Abstract_0x4x0 implements WPLim_TemplateTag_Interface_0x4x0
{

    /**
     * @var array Containing list of DemoWPLim_TemplateTag_Interface_0x4x0
     */
    private static $templateTags = array();

    /**
     * @var string
     */
    protected $tagName = null;


    /**
     * Create the global template function
     * @return void
     */
    public function create()
    {
        if (function_exists($this->tagName)) {
            return;
        }

        // add this object to list
        self::$templateTags[$this->tagName] = $this;

        // create global function
        eval('function ' . $this->tagName . '() {'
                . 'return ' . __CLASS__ . '::_searchCall(__FUNCTION__, func_get_args());'
                . '}');
    }

    /**
     * Should be implemented by childs
     * @return mixed
     */
//    protected function func( /* amount of params depends on concrete implementation */ )
//    {
//    }

    /**
     * @param array $args
     * @return mixed
     */
    private function redirectCall($args)
    {
    	return call_user_func_array(array($this, 'func'), $args);
    }

    /**
     * @param string $tagName
     * @param array  $args
     * @return mixed
     */
    final public static function _searchCall($tagName, array $args)
	{
        $templateTag = self::$templateTags[$tagName];
    	return $templateTag->redirectCall($args);
	}

}

/*?>*/
