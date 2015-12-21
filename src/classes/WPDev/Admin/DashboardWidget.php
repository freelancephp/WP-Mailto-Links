<?php
/**
 * Class WPDev_Admin_DashboardWidget
 *
 * Creating an admin dashboard widget
 *
 * @package  WPDev
 * @category WordPress Library
 * @version  0.4.0
 * @author   Victor Villaverde Laan
 * @link     http://www.freelancephp.net/
 * @link     https://github.com/freelancephp/WPDev
 * @license  MIT license
 */
class WPDev_Admin_DashboardWidget_04
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
        'option'          => '',    // instanceof WPDev_Option
        'templatesPath'   => '',
        'templateVars'    => array(),
        'templateFileExt' => '.php',
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
            $this->settings['callback'] = array($this, 'showWidget');
        }

        // default control callback function
        if (empty($this->settings['callbackControl'])) {
            $this->settings['callbackControl'] = array($this, 'showForm');
        }

        // default update callback function
        if (empty($this->settings['callbackUpdate'])) {
            $this->settings['callbackUpdate'] = array($this, 'update');
        }

        add_action('wp_dashboard_setup', array($this, 'setup'));
    }

    /**
     * Add dashboard widget
     */
    public function setup()
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
    public function showWidget()
    {
        echo $this->renderTemplate('widget');
    }

    /**
     * Show option form
     */
    public function showForm()
    {
        if ($this->settings['option'] instanceof WPDev_Option_04) {
            $optionName = $this->settings['option']->getOptionName();

            if('POST' === $_SERVER['REQUEST_METHOD'] && !empty($_POST[$optionName])) {
                call_user_func($this->settings['callbackUpdate'], $_POST[$optionName], $this->settings['option']);
            }
        }

        echo $this->renderTemplate('form');
    }

    /**
     * Update option values
     * @param array $newValues
     */
    public function update($newValues, $option)
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

        $view = WPDev_View_04::create($templateFile, $this->settings['templateVars']);

        if (!$view->exists()) {
            return false;
        }

        return $view->render();
    }

}

/*?>*/
