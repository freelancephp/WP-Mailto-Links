<?php
/**
 * Class WPML_Template_Tags
 *
 * @package  WPML
 * @category WordPress Plugin
 * @version  2.1.5
 * @author   Victor Villaverde Laan
 * @link     http://www.finewebdev.com
 * @link     https://github.com/freelancephp/WP-Mailto-Links
 * @license  Dual licensed under the MIT and GPLv2+ licenses
 */
final class WPML_Template_Tags extends FWP_Template_Tag_Base_1x0x0
{

    /**
     * @var WPML_Front
     */
    private $front = null;

    /**
     * Initialize
     * @param WPML_Front $front
     */
    protected function init( WPML_Front $front )
    {
        $this->front = $front;
    }

    /**
     * Template tag funtion
     * @param string $content
     * @return string
     */
    public function wpel_filter( $content )
    {
        return $this->front->scan( $content );
    }

}

/*?>*/
