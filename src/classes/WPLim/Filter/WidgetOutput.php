<?php
/**
 * Class WPLim_Filter_WidgetOutput
 *
 * Original idea and code taken from the Widget Logic plugin
 *
 * @package  WPLim
 * @category WordPress Library
 * @version  0.4.0
 * @author   Victor Villaverde Laan
 * @link     http://www.freelancephp.net/
 * @link     https://github.com/freelancephp/WPLim
 * @credit   https://wordpress.org/plugins/widget-logic/
 * @license  MIT license
 */
final class WPLim_Filter_WidgetOutput_0x4x0 extends WPLim_Filter_Abstract_0x4x0
{

    /**
     * Filter name
     * @var string
     */
    protected $filterName = 'widget_output';

    /**
     * @var WPLim_Filter_WidgetOutput
     */
    protected static $instance = null;

    /**
     * Constructor
     * @global $wp_registered_widgets
     */
    protected function __construct()
    {
        $widgetCallback = function () {
            global $wp_registered_widgets;

            $originalCallbackParams = func_get_args();
            $widgetId = $originalCallbackParams[0]['widget_id'];

            $originalCallback = $wp_registered_widgets[$widgetId]['original_callback'];
            $wp_registered_widgets[$widgetId]['callback'] = $originalCallback;

            $widgetIdBase = $wp_registered_widgets[$widgetId]['callback'][0]->id_base;

            if (is_callable($originalCallback)) {
                ob_start();
                call_user_func_array($originalCallback, $originalCallbackParams);
                $widgetOutput = ob_get_clean();

                echo apply_filters($this->filterName, $widgetOutput, $widgetIdBase, $widgetId);
            }
        };

        $setCallbacks = function ($sidebarParams) use ($widgetCallback) {
            global $wp_registered_widgets;

            if (is_admin()) {
                return $sidebarParams;
            }

            $widgetId = $sidebarParams[0]['widget_id'];

            $wp_registered_widgets[$widgetId]['original_callback'] = $wp_registered_widgets[$widgetId]['callback'];
            $wp_registered_widgets[$widgetId]['callback'] = $widgetCallback;

            return $sidebarParams;
        };

        add_filter('dynamic_sidebar_params', $setCallbacks, 5);
    }

}

/*?>*/
