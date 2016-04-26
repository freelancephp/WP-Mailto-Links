<?php
/**
 * Class WPRun_Filter_WidgetOutput_0x4x0
 *
 * @package  WPRun
 * @category WordPress Plugin
 * @version  0.4.0
 * @author   Victor Villaverde Laan
 * @link     http://www.freelancephp.net/
 * @link     https://github.com/freelancephp/WPRun-Plugin-Base
 * @license  Dual licensed under the MIT and GPL licenses
 */
final class WPRun_Filter_WidgetOutput_0x4x0 extends WPRun_BaseAbstract_0x4x0
{

    const FILTER_NAME = 'widget_output';

    /**
     * Method automatically attached as callback to the filter "dynamic_sidebar_params"
     * @global array $wp_registered_widgets
     * @param  array $sidebarParams
     * @return array
     */
    protected function filterDynamicSidebarParams($sidebarParams)
    {
         global $wp_registered_widgets;

        if (is_admin()) {
            return $sidebarParams;
        }

        $widgetId = $sidebarParams[0]['widget_id'];

        $wp_registered_widgets[$widgetId]['original_callback'] = $wp_registered_widgets[$widgetId]['callback'];
        $wp_registered_widgets[$widgetId]['callback'] = $this->getCallback('widgetCallback');

        return $sidebarParams;
    }

    /**
     * Widget Callback
     * @global array $wp_registered_widgets
     */
    protected function widgetCallback()
    {
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

            echo apply_filters(self::FILTER_NAME, $widgetOutput, $widgetIdBase, $widgetId);
        }
    }

}

/*?>*/
