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
final class WPML_TemplateTag_Filter extends WPRun_BaseAbstract_0x4x0
{

    /**
     * Create template tag "wpml_filter()"
     */
    protected function init()
    {
        $this->createTemplateTag('wpml_filter', $this->getCallback('filter'));
    }

    /**
     * @param string $content
     * @return string
     */
    protected function filter($content)
    {
        $site = $this->getArgument(0);
        return $site->filterContent($content);
    }

}

/*?>*/
