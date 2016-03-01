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
final class WPML_Shortcode_Mailto extends WPLim_Shortcode_Abstract_0x4x0
{

    /**
     * @var string
     */
    protected $shortcodeName = 'wpml_mailto';

    /**
     * @param array  $atts
     * @param string $content
     * @return string
     */
    protected function func($atts, $content)
    {
        $plugin = WPML_Plugin::plugin();
        $site = $plugin->getSite();

        if ($plugin->getOption()->getValue('protect') && preg_match($site->regexps['emailPlain'], $content) > 0) {
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
