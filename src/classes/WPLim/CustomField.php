<?php
/**
 * Class WPLim_CustomField
 *
 * @package  WPLim
 * @category WordPress Library
 * @version  0.4.0
 * @author   Victor Villaverde Laan
 * @link     http://www.freelancephp.net/
 * @link     https://github.com/freelancephp/WPLim
 * @license  MIT license
 */
class WPLim_CustomField_0x4x0
{

    /**
     * @var string
     */
    private $key = null;

    /**
     * @var integer
     */
    private $postId = null;

    /**
     * @var boolean
     */
    private $singleValueField = null;


    /**
     * @param string  $key
     * @param integer $postId
     * @param boolean $singleValueField
     */
    public function __construct($key, $postId, $singleValueField = false)
    {
        $this->key = $key;
        $this->postId = $postId;
        $this->singleValueField = $singleValueField;
    }

    /**
     * @return mixed
     */
    public function get()
    {
        $single = $this->singleValueField;
        return get_post_meta($this->postId, $this->key, $single);
    }

    /**
     * @param mixed   $value
     * @return boolean|integer
     */
    public function add($value)
    {
        $unique = ! $this->singleValueField;
        return add_post_meta($this->postId, $this->key, $value, $unique);
    }

    /**
     * @param mixed $newValue
     * @param mixed $containingValue
     * @return boolean|integer
     */
    public function update($newValue, $containingValue = null)
    {
        return update_post_meta($this->postId, $this->key, $newValue, $containingValue);
    }

    /**
     * @param mixed $containingValue
     * @return boolean
     */
    public function delete($containingValue = null)
    {
        return delete_post_meta($this->postId, $this->key, $containingValue);
    }

}

/*?>*/
