<?php
/**
 * Class WPML_Shortcode_Mailto
 *
 * @package  WPML
 * @category WordPress Plugins
 * @author   Victor Villaverde Laan
 * @link     http://www.freelancephp.net/
 * @link     https://github.com/freelancephp/WP-Mailto-Links
 * @link     https://wordpress.org/plugins/wp-mailto-links/
 * @license  MIT license
 */
final class WPML_Shortcode_Mailto extends WPRun_BaseAbstract_0x4x0
{

    /**
     * Add shortcode "[wpml_mailto]"
     */
    protected function init()
    {
        add_shortcode('wpml_mailto', $this->getCallback('mailto'));
    }

    /**
     * Handle shortcode
     * @param array   $atts
     * @param string  $content
     */
    protected function mailto($atts, $content = null)
    {
        $site = $this->getArgument(0);
        $option = $this->getArgument(1);

        if ($option->getValue('protect') && preg_match($site->getEmailRegExp(), $content) > 0) {
            $content = $site->getProtectedDisplay($content);
        }

        // set "email" to "href"
        if (isset($atts['email'])) {
            $atts['href'] = 'mailto:' . $atts['email'];
            unset($atts['email']);
        }

        $content = $site->protectedMailto($content, $atts);

        return $content;
    }

}

/*?>*/
