<?php
/**
 * Class WPLim_View_Abstract
 *
 * @package  WPLim
 * @category WordPress Library
 * @version  0.4.0
 * @author   Victor Villaverde Laan
 * @link     http://www.freelancephp.net/
 * @link     https://github.com/freelancephp/WPLim
 * @license  MIT license
 */
abstract class WPLim_View_Abstract_0x4x0 implements WPLim_View_Interface_0x4x0
{

    /**
     * Path of the file
     * @var string
     */
    protected $file = null;

    /**
     * View vars
     * @var array
     */
    protected $vars = array();


    /**
     * Protected constructor to force using create factory
     * @param string $file
     * @param array  $vars  Optional
     */
    public function __construct($file, array $vars = array())
    {
        $this->file = $file;
        $this->vars = $vars;
    }

    /**
     * View file exists
     * @return boolean
     */
    public function exists()
    {
        return file_exists($this->file);
    }

    /**
     * Render a view
     * @param string $file
     * @return string  Rendered content
     */
    public function render() {
        if (!$this->exists()) {
            throw new Exception('The file "' . $this->file . '" could not be rendered as view (file does not exist or is not readable).');
        }

        // extract vars to global namespace
        extract($this->vars, EXTR_SKIP);

        // start output buffer
        ob_start();

        include $this->file;

        // get the view content
        $content = ob_get_contents();

        // clean output buffer
        ob_end_clean();

        return $content;
    }

}

/*?>*/
