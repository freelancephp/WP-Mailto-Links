<?php
/**
 * Class WPLim_Widget_Abstract
 *
 * Parent for creating a widget
 *
 * @package  WPLim
 * @category WordPress Library
 * @version  0.4.0
 * @author   Victor Villaverde Laan
 * @link     http://www.freelancephp.net/
 * @link     https://github.com/freelancephp/WPLim
 * @license  MIT license
 */
abstract class WPLim_Widget_Abstract_0x4x0 extends WP_Widget
{

    /**
     * @var array
     */
    private $settings = array(
        'id'              => '',
        'name'            => '',
        'templatesPath'   => '',
        'templateFileExt' => '.php',
        'widgetOptions'   => array(),
        'controlOptions'  => array(),
    );

    /**
     * @var array
     */
    private $values = array();

    /**
     * @var array
     */
    private $defaultValues = array();


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->init();

        parent::__construct(
            $this->settings['id']
            , $this->settings['name']
            , $this->settings['widgetOptions']
            , $this->settings['controlOptions']
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
     * Set settings
     * @param array $settings
     */
    protected function setSettings(array $settings)
    {
        $this->settings = array_merge($this->settings, $settings);
    }

    /**
     * Set default values
     * @param array $defaultValues
     */
    protected function setDefaultValues(array $defaultValues)
    {
        $this->defaultValues = array_merge($this->defaultValues, $defaultValues);
    }

    /**
     * Widget output
     * @param array $args
     * @param array $instance
     */
    public function widget($args, $instance)
    {
        $this->setValues($instance);

        echo $this->renderTemplate('widget', array(
            'args'   => $args,
            'widget' => $this,
        ));
    }

    /**
     * Widget Admin Form
     * @param array $instance
     */
    public function form($instance)
    {
        $this->setValues($instance);

        echo $this->renderTemplate('form', array(
            'widget'   => $this,
        ));
    }

    /**
     * On DB update
     * @param array $newInstance
     * @param array $oldInstance
     * @return array
     */
    public function update($newInstance, $oldInstance)
    {
        $values = $oldInstance;

        foreach ($newInstance as $key => $value) {
            $values[$key] = filter_var($value, FILTER_SANITIZE_STRING);
        }

        return $values;
    }

    /**
     * Get value
     * @param string $key
     * @return mixed
     * @throws Exception
     */
    public function getValue($key)
    {
        if (!key_exists($key, $this->values)) {
            throw new Exception('Key "' . $key . '" does not exist.');
        }

        return $this->values[$key];
    }

    /**
     * Get values
     * @param array $instance
     * @return array
     */
    protected function setValues($instance)
    {
        $this->values = array_merge($this->defaultValues, $instance);
    }

    /**
     * Render a template
     * @param string $file
     * @param array  $templateVars  Optional
     * @return string
     */
    protected function renderTemplate($key, array $templateVars = array()) {
        $templateFile = $this->settings['templatesPath'] . '/' . $key . $this->settings['templateFileExt'];

        // tight coupling
        $renderer = new WPLim_Template_Render_0x4x0();
        return $renderer->render($templateFile, $templateVars);
    }

    /**
     * Register this widget
     */
    public static function register()
    {
        $className = get_called_class();

        add_action('widgets_init', function () use ($className) {
            register_widget($className);
        });
    }

}

/*?>*/
