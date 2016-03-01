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
abstract class WPLim_Widget_Abstract_0x4x0 extends WP_Widget implements WPLim_Widget_Interface_0x4x0, WPLim_Fields_Interface_0x4x0
{

    /**
     * @var array
     */
    private $settings = array(
        'id'              => '',
        'name'            => '',
        'templatesPath'   => '',
        'templateFileExt' => '.php',
        'templateVars'  => array(),
        'widgetOptions'   => array(),
        'controlOptions'  => array(),
        'fieldsViewClass' => 'WPLim_Fields_Decorator_View_0x4x0',
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
     * @var WPLim_Render_Template_Interface_0x4x0
     */
    private $renderTemplate = null;


    /**
     * Constructor
     */
    final public function __construct()
    {
        $this->init();

        // set fieldsView template var
        $fieldsViewClass = $this->settings['fieldsViewClass'];
        $fieldsView = new $fieldsViewClass($this);
        $this->settings['templateVars']['fieldsView'] = $fieldsView;

        $this->renderTemplate = new WPLim_RenderTemplate_0x4x0(
            $this->settings['templatesPath']
            , $this->settings['templateFileExt']
            , $this->settings['templateVars']
        );

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
     * Register this widget
     */
    final public function register()
    {
        add_action('widgets_init', function () {
            $className = get_class($this);
            register_widget($className);
        });
    }

    /**
     * Set settings
     * @param array $settings
     */
    final protected function setSettings(array $settings)
    {
        $this->settings = array_merge($this->settings, $settings);
    }

    /**
     * Set default values
     * @param array $defaultValues
     */
    final protected function setDefaultValues(array $defaultValues)
    {
        $this->defaultValues = array_merge($this->defaultValues, $defaultValues);
    }

    /**
     * Widget output
     * @param array $args
     * @param array $instance
     */
    final public function widget($args, $instance)
    {
        $this->setValues($instance);
        $this->showWidget($args);
    }

    /**
     * Show widget
     */
    protected function showWidget($args)
    {
        echo $this->renderTemplate->render('widget', array(
            'args' => $args,
        ));
    }

    /**
     * Widget Settings Form
     * @param array $instance
     */
    final public function form($instance)
    {
        $this->setValues($instance);
        $this->showForm();
    }

    /**
     * Show option form
     */
    protected function showForm()
    {
        echo $this->renderTemplate->render('form');
    }

    /**
     * @param array $newInstance
     * @param array $oldInstance
     * @return array
     */
    final public function update($newInstance, $oldInstance)
    {
        return $this->beforeUpdate($newInstance, $oldInstance);
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

    /**
     * Get value
     * @param string $key
     * @return mixed
     * @throws Exception
     */
    final public function getValue($key)
    {
        if (!key_exists($key, $this->values)) {
            throw new Exception('Key "' . $key . '" does not exist.');
        }

        return $this->values[$key];
    }

    /**
     * @param string $key
     * @return string
     */
    final public function getFieldName($key)
    {
        return $this->get_field_name($key);
    }

    /**
     * @param string $key
     * @return string
     */
    final public function getFieldId($key)
    {
        return $this->get_field_id($key);
    }

    /**
     * Get values
     * @param array $instance
     * @return array
     */
    final protected function setValues($instance)
    {
        $this->values = array_merge($this->defaultValues, $instance);
    }

}

/*?>*/
