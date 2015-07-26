<?php
/**
 * Class WPDev_Filter_WidgetOutput
 *
 * Original idea taken from the Widget Logic plugin
 *
 * @singleton
 *
 * @package  WPDev
 * @category WordPress Library
 * @version  1.0.0
 * @author   Victor Villaverde Laan
 * @link     http://www.freelancephp.net/
 * @link     https://github.com/freelancephp/WPDev
 * @credit   https://wordpress.org/plugins/widget-logic/
 * @license  MIT license
 *
 * @example
 *
 *      WPDev_Filter_WidgetOutput::create('wp_widget_output');
 *
 *      add_filter('wp_widget_output', 'wp_replace_b_tags', 10, 1);
 *
 *      function wp_replace_b_tags($content) {
 *          $content = str_replace('<b>', '<strong>', $content);
 *          $content = str_replace('</b>', '</strong>', $content);
 *          return $content;
 *      }
 */
class WPDev_Filter_WidgetOutput
{

    /**
     * Filter name
     * @var string
     */
    protected $filterName = null;

    /**
     * @var string
     */
    protected $wpRegisteredWidgets = null;

    /**
     * @var boolean
     */
    protected static $created = false;

    /**
     * Factory method
     * @param string $filterName
     * @param array &$wpRegisteredWidgets Contains WP global $wp_registered_widgets
     * @return \WPDev_Filter_WidgetOutput
     */
    public static function create($filterName, array & $wpRegisteredWidgets)
    {
        if (self::$created === true) {
            throw new Exception('Widget Output filter already created.');
        }

        self::$created = true;
        return new WPDev_Filter_WidgetOutput($filterName, $wpRegisteredWidgets);
    }

    /**
     * @param string $filterName
     * @param array &$wpRegisteredWidgets
     */
    protected function __construct($filterName, array & $wpRegisteredWidgets)
    {
        $this->filterName = $filterName;
        $this->wpRegisteredWidgets = & $wpRegisteredWidgets;

        add_filter('dynamic_sidebar_params', array($this, 'setCallbacks'), 5);
    }

    /**
     * Set callbacks for all widgets
     */
    public function setCallbacks($sidebarParams) {
        if (is_admin()) {
            return $sidebarParams;
        }

        $widgetId = $sidebarParams[0]['widget_id'];

        $this->wpRegisteredWidgets[$widgetId]['original_callback'] = $this->wpRegisteredWidgets[$widgetId]['callback'];
        $this->wpRegisteredWidgets[$widgetId]['callback'] = array($this, 'widgetCallback');

        return $sidebarParams;
    }

    /**
     * @echo string
     */
    public function widgetCallback() {
        $originalCallbackParams = func_get_args();
        $widgetId = $originalCallbackParams[0]['widget_id'];

        $originalCallback = $this->wpRegisteredWidgets[$widgetId]['original_callback'];
        $this->wpRegisteredWidgets[$widgetId]['callback'] = $originalCallback;

        $widgetIdBase = $this->wpRegisteredWidgets[$widgetId]['callback'][0]->id_base;

        if (is_callable($originalCallback)) {
            ob_start();
            call_user_func_array($originalCallback, $originalCallbackParams);
            $widgetOutput = ob_get_clean();

            echo apply_filters($this->filterName, $widgetOutput, $widgetIdBase, $widgetId);
        }
    }

}
