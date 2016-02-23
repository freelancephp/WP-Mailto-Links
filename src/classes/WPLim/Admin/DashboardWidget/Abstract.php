<?php
/**
 * Class WPLim_Admin_DashboardWidget_Abstract
 *
 * Creating an admin dashboard widget
 *
 * @package  WPLim
 * @category WordPress Library
 * @version  0.4.0
 * @author   Victor Villaverde Laan
 * @link     http://www.freelancephp.net/
 * @link     https://github.com/freelancephp/WPLim
 * @license  MIT license
 */
abstract class WPLim_Admin_DashboardWidget_Abstract_0x4x0 implements WPLim_Admin_DashboardWidget_Interface_0x4x0
{

    /**
     * Settings
     * @var array
     */
    protected $settings = array(
        'id'              => '',
        'title'           => '',
        'callback'        => null,
        'callbackControl' => null,
        'callbackUpdate'  => null,
        'option'          => '',    // instanceof WPLim_Option_Interface
        'templatesPath'   => '',
        'templateFileExt' => '.php',
        'templateVars'    => array(),
    );

    /**
     * Constructor
     * @param array $settings
     */
    public function __construct(array $settings)
    {
        $this->settings = array_merge($this->settings, $settings);

        // default callback function
        if (empty($this->settings['callback'])) {
            $this->settings['callback'] = function () {
                $this->showWidget();
            };
        }

        // default control callback function
        if (empty($this->settings['callbackControl'])) {
            $this->settings['callbackControl'] = function () {
                $this->showForm();
            };
        }

        // default update callback function
        if (empty($this->settings['callbackUpdate'])) {
            $this->settings['callbackUpdate'] = function ($newValues, $option) {
                $this->update($newValues, $option);
            };
        }

        add_action('wp_dashboard_setup', function () {
            $this->setup();
        });
    }

    /**
     * Add dashboard widget
     */
    protected function setup()
    {
        // add dashboard widget
        wp_add_dashboard_widget(
            $this->settings['id']
            , $this->settings['title']
            , $this->settings['callback']
            , $this->settings['callbackControl']
        );
    }

    /**
     * Show widget
     */
    protected function showWidget()
    {
        echo $this->renderTemplate('widget');
    }

    /**
     * Show option form
     */
    protected function showForm()
    {
        if ($this->settings['option'] instanceof WPLim_Option_Interface_0x4x0) {
            $optionName = $this->settings['option']->getOptionName();

            if('POST' === $_SERVER['REQUEST_METHOD'] && !empty($_POST[$optionName])) {
                $formValues = array();

                foreach ($_POST[$optionName] as $key => $value) {
                    $formValues[$key] = filter_var($value, FILTER_SANITIZE_STRING);
                }

                call_user_func($this->settings['callbackUpdate'], $formValues, $this->settings['option']);
            }
        }

        echo $this->renderTemplate('form');
    }

    /**
     * Update option values
     * @param array $newValues
     */
    protected function update($newValues, $option)
    {
        foreach ($newValues as $key => $value) {
            $option->setValue($key, $value);
        }

        $option->update();
    }

    /**
     * Render a template
     * @param string $file
     * @return string
     */
    protected function renderTemplate($key) {
        $templateFile = $this->settings['templatesPath'] . '/' . $key . $this->settings['templateFileExt'];

        // tight coupling
        $view = new WPLim_View_0x4x0($templateFile, $this->settings['templateVars']);
        return $view->render();
    }

}

/*?>*/
