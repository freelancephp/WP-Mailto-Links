<?php
/**
 * Class WPDev_Widget
 *
 * Creating a widget
 *
 * @package  WPDev
 * @category WordPress Library
 * @version  0.4.0
 * @author   Victor Villaverde Laan
 * @link     http://www.freelancephp.net/
 * @link     https://github.com/freelancephp/WPDev
 * @license  MIT license
 */
class WPDev_Widget_0x4x0 extends WP_Widget
{

    /**
     * @var array
     */
    protected $settings = array(
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
    protected $values = array();

    /**
     * @var array
     */
    protected $defaultValues = array();

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
    public function init()
    {
        // to be implemented by child class
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
     * @param array $new_instance
     * @param array $old_instance
     * @return array
     */
    public function update($new_instance, $old_instance)
    {
        return $new_instance;
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

        $view = WPDev_View_0x4x0::create($templateFile, $templateVars);

        if (!$view->exists()) {
            return false;
        }

        return $view->render();
    }

    /**
     * Register this widget
     */
    public static function register()
    {
        add_action('widgets_init', array(get_called_class(), 'registerCallback'));
    }

    /**
     * Register callback (internal use)
     */
    public static function registerCallback()
    {
        register_widget(get_called_class());
    }

}

/*?>*/
