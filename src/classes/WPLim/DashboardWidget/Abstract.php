<?php
/**
 * Class WPLim_DashboardWidget_Abstract
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
abstract class WPLim_DashboardWidget_Abstract_0x4x0 implements WPLim_DashboardWidget_Interface_0x4x0
{

    /**
     * Settings
     * @var array
     */
    private $settings = array(
        'id'              => '',
        'title'           => '',
        'callback'        => null,
        'callbackControl' => null,
        'callbackUpdate'  => null,
        'templatesPath'   => '',
        'templateFileExt' => '.php',
        'templateVars'    => array(),
        'fieldsViewClass' => 'WPLim_Fields_Decorator_View_0x4x0',
    );

    /**
     * @var WPLim_Option_Interface
     */
    private $option = null;

    /**
     * @var WPLim_Render_Template_Interface_0x4x0
     */
    private $renderTemplate = null;


    /**
     * Constructor
     */
    final public function __construct()
    {
        $this->init();

        $this->renderTemplate = new WPLim_RenderTemplate_0x4x0(
            $this->settings['templatesPath']
            , $this->settings['templateFileExt']
            , $this->settings['templateVars']
        );
    }

    /**
     * Initialize
     */
    protected function init()
    {
        // to be implemented by child class
    }

    /**
     * Register this widget
     */
    final public function register()
    {
        add_action('wp_dashboard_setup', function () {
            $this->add();
        });
    }

    /**
     * Set settings
     * @param array $settings
     */
    final protected function setSettings(array $settings)
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
                $this->checkSubmitForm();
                $this->showForm();
            };
        }

        // default update callback function
        if (empty($this->settings['callbackUpdate'])) {
            $this->settings['callbackUpdate'] = function ($newValues, $option) {
                $this->update($newValues, $option);
            };
        }
    }

    /**
     * Set option for saving values
     * @param WPLim_Option_Interface_0x4x0 $option
     */
    final protected function setOption(WPLim_Option_Interface_0x4x0 $option)
    {
        $this->option = $option;

        // set fieldsView template var
        $fieldsViewClass = $this->settings['fieldsViewClass'];
        $fieldsView = new $fieldsViewClass($this->getOption());
        $this->settings['templateVars']['fieldsView'] = $fieldsView;
    }

    /**
     * @return WPLim_Option_Interface_0x4x0
     */
    final protected function getOption()
    {
        return $this->option;
    }

    /**
     * Add dashboard widget
     */
    private function add()
    {
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
        echo $this->renderTemplate->render('widget');
    }

    /**
     * Show option form
     */
    protected function showForm()
    {
        echo $this->renderTemplate->render('form');
    }

    /**
     * Submit form
     */
    private function checkSubmitForm()
    {
        $optionName = $this->option->getOptionName();

        if('POST' === $_SERVER['REQUEST_METHOD'] && !empty($_POST[$optionName])) {
            call_user_func($this->settings['callbackUpdate'], $_POST[$optionName], $this->option->getValues());
        }
    }

    /**
     * Update option values
     * @param array $newValues
     */
    private function update($newValues, $oldValues)
    {
        $filteredValues = $this->beforeUpdate($newValues, $oldValues);

        foreach ($filteredValues as $key => $value) {
            $this->option->setValue($key, $value);
        }

        $this->option->update();
    }

    /**
     * Before updating submitted values
     * @param array $newValues
     * @param array $oldValues
     */
    protected function beforeUpdate($newValues, $oldValues)
    {
        $values = $oldValues;

        foreach ($newValues as $key => $value) {
            $values[$key] = filter_var($value, FILTER_SANITIZE_STRING);
        }

        return $values;
    }

}

/*?>*/
