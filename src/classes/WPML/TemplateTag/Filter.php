<?php
/**
 * Class WPML_TemplateTag_Filter
 *
 * @package  WPML
 * @category WordPress Plugins
 * @author   Victor Villaverde Laan
 * @link     http://www.freelancephp.net/
 * @link     https://github.com/freelancephp/WP-Mailto-Links
 * @link     https://wordpress.org/plugins/wp-mailto-links/
 * @license  MIT license
 */
final class WPML_TemplateTag_Filter extends WPLim_TemplateTag_Abstract_0x4x0
{

    /**
     * @var string
     */
    protected $tagName = 'wpml_filter';

    /**
     * @param string $content
     * @return string
     */
    protected function func($content)
    {
        return WPML_Plugin::plugin()->getSite()->filterContent($content);
    }

}

/*?>*/
