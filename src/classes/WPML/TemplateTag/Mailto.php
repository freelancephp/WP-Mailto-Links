<?php
/**
 * Class WPML_TemplateTag_Mailto
 *
 * @package  WPML
 * @category WordPress Plugins
 * @author   Victor Villaverde Laan
 * @link     http://www.freelancephp.net/
 * @link     https://github.com/freelancephp/WP-Mailto-Links
 * @link     https://wordpress.org/plugins/wp-mailto-links/
 * @license  MIT license
 */
final class WPML_TemplateTag_Mailto extends WPLim_TemplateTag_Abstract_0x4x0
{

    /**
     * @var string
     */
    protected $tagName = 'wpml_mailto';

    /**
     * @param string $content
     * @return string
     */
    protected function func($email, $display = null, $attrs = array())
    {
        if (is_array($display)) {
            // backwards compatibility (old params: $display, $attrs = array())
            $attrs   = $display;
            $display = $email;
        } else {
            $attrs['href'] = 'mailto:'.$email;
        }

        return WPML_Plugin::plugin()->getSite()->protectedMailto($display, $attrs);
    }

}

/*?>*/
