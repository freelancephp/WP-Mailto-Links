<?php
/**
 * Class WPDev_Plugin_OptionValues
 *
 * Managing options
 *
 * @package  WPDev
 * @category WordPress Library
 * @version  1.0.0
 * @author   Victor Villaverde Laan
 * @link     http://www.freelancephp.net/
 * @link     https://github.com/freelancephp/WPDev
 * @license  MIT license
 */
class WPDev_Plugin_OptionValues
{

    /**
     * @var array
     */
    protected $values = array();

    /**
     * @var string
     */
    protected $optionGroup = null;

    /**
     * @var string
     */
    protected $optionName = null;

    /**
     * @param string $optionGroup
     * @param string $optionName
     * @param array $defaultValues  Optional
     */
    public function __construct($optionGroup, $optionName, array $defaultValues = array())
    {
        $this->optionGroup = $optionGroup;
        $this->optionName = $optionName;

        // first set all defaults
        $this->values = $defaultValues;

        $this->setSavedValues($defaultValues);

        // add actions
        add_action('admin_init', array($this, 'register'), 1);
    }

    /**
     * Set saved option values
     */
    protected function setSavedValues()
    {
        // get saved option values
        $savedValues = get_option($this->optionName);

        // overwrite defaults with saved values (if exists)
        if ($savedValues) {
            foreach ($savedValues as $key => $value) {
                $this->values[$key] = $value;
            }
        }
    }

    /**
     * Get value
     * @param string|null $key
     * @return mixed|null
     */
    public function get($key = null)
    {
        if ($key === null) {
            return $this->values;
        }

        if (key_exists($key, $this->values)) {
            return $this->values[$key];
        }

        return null;
    }

    /**
     * Change value
     * @param string $key
     * @param mixed $value
     */
    public function set($key, $value)
    {
        if (key_exists($key, $this->values)) {
            $this->values[$key] = $value;
        }
    }

    /**
     * Save values
     */
    public function save()
    {
        return update_option($this->optionName, $this->values);
    }

    /**
     * Register setting
     */
    public function register()
    {
        register_setting($this->optionGroup, $this->optionName);
    }

    /**
     * Delete all values from DB and unregister
     * Could be used for plugin uninstall or deactivate proces
     * Cannot immediatly be attached to register_uninstall_hook, because needs to be static method
     */
    public function deleteAll()
    {
        delete_option($this->optionName);
        unregister_setting($this->optionGroup, $this->optionName);
    }

}
