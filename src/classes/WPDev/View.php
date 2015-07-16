<?php
/**
 * Class WPDev_View
 *
 * @package  WPDev_Plugin
 * @category WordPress Plugins
 * @version  1.0.0
 * @author   Victor Villaverde Laan
 * @link     http://www.freelancephp.net/
 * @license  MIT license
 */
class WPDev_View
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
     * Create view instance (factory method)
     * @param string $file
     * @param array $vars  Optional
     * @return \WPDev_View
     */
    public static function create($file, array $vars = array())
    {
        return new WPDev_View($file, $vars);
    }

    /**
     * Protected constructor to force using create factory
     * @param string $file
     * @param array $vars  Optional
     */
    protected function __construct($file, $vars = array())
    {
        $this->file = $file;
        $this->vars = $vars;
    }

    /**
     * Render a view
     * @param string $file
     * @param boolean $show  Optional, default false
     * @return string  Rendered content
     */
    public function render($show = false) {
        if (!file_exists($this->file)) {
            throw new Exception('The file "' . $this->file . '" does not exists and could not be rendered as view.');
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

        // print content
        if ($show) {
            echo $content;
        }

        return $content;
    }

}
