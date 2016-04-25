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
final class WPML_TemplateTag_Mailto extends WPRun_BaseAbstract_0x4x0
{

    /**
     * Create template tag "wpml_mailto()"
     */
    protected function init()
    {
        $this->createTemplateTag('wpml_mailto', $this->getCallback('mailto'));
    }

    /**
     * Handle template tag
     * @param string $email
     * @param string $display
     * @param array  $atts
     * @return string
     */
    protected function mailto($email, $display = null, $atts = array())
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
