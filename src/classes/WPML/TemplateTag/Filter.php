<?php
/**
 * Class WPML_TemplateTag_Filter
 *
 * @package  WPML
 * @category WordPress Plugins
 * @version  2.1.0
 * @author   Victor Villaverde Laan
 * @link     http://www.freelancephp.net/
 * @link     https://github.com/freelancephp/WP-Mailto-Links
 * @link     https://wordpress.org/plugins/wp-mailto-links/
 * @license  GPLv2+ license
 */
final class WPML_TemplateTag_Filter extends WPRun_BaseAbstract_0x5x0
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
        $email = $this->getArgument(0);
        return $email->filterContent($content);
    }

}

/*?>*/
