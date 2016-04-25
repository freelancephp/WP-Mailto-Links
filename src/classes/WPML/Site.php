<?php
/**
 * Class WPML_Site
 *
 * @todo Refactor and cleanup
 *
 * @package  WPML
 * @category WordPress Plugins
 * @author   Victor Villaverde Laan
 * @link     http://www.freelancephp.net/
 * @link     https://github.com/freelancephp/WP-Mailto-Links
 * @link     https://wordpress.org/plugins/wp-mailto-links/
 * @license  MIT license
 */
final class WPML_Site extends WPRun_BaseAbstract_0x4x0
{

    protected function init()
    {
        do_action('wpml_ready', $this->getCallback('filterContent'));
    }

    protected function action_wp()
    {
        $filterHooks = array();

        if (is_feed()) {
            if ($this->opt('filter_rss')) {
                $callback = $this->getCallback('filterRss');
                array_push($filterHooks, 'final_output');
            } else {
                return;
            }
        } elseif ($this->opt('filter_head') || $this->opt('filter_body')) {
            $callback = $this->getCallback('filterPage');
            array_push($filterHooks, 'final_output');
        } else {
            $callback = $this->getCallback('filterContent');

            if ($this->opt('filter_posts')) {
                array_push($filterHooks, 'the_title', 'the_content', 'the_excerpt', 'get_the_excerpt');
            }

            if ($this->opt('filter_comments')) {
                array_push($filterHooks, 'comment_text', 'comment_excerpt');
            }

            if ($this->opt('filter_widgets')) {
                array_push($filterHooks, 'widget_output');
            }
        }

        foreach ($filterHooks as $hook) {
            add_filter($hook, $callback, 100);
        }
    }

    protected function action_wp_head()
    {
        $headTemplateFile = WP_MAILTO_LINKS_DIR . '/templates/site/head.php';

        $this->showTemplate($headTemplateFile, array(
            'icon' => $this->opt('image'),
            'className' => $this->opt('class_name'),
            'showBefore' => $this->opt('show_icon_before'),
        ));
    }

    protected function action_wp_enqueue_scripts()
    {
        if ($this->opt('protect')) {
            wp_enqueue_script(
                'wp-mailto-links'
                , plugins_url('/js/wp-mailto-links.js', WP_MAILTO_LINKS_FILE)
                , array('jquery')
            );
        }

        // add css font icons
        if ($this->opt('mail_icon') === 'dashicons') {
            wp_enqueue_style('dashicons');

        } elseif ($this->opt('mail_icon') === 'fontawesome') {
            wp_enqueue_style(
                'font-awesome'
                , 'https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css'
                , array()
                , null // use caching CDN file
            );
        }
    }

    private function opt($key)
    {
        return $this->getArgument(0)->getValue($key);
    }

    
    /**
     * @link http://www.mkyong.com/regular-expressions/how-to-validate-email-address-with-regular-expression/
     * @param boolean $include
     * @return string
     */
    public function getEmailRegExp($include = false)
    {
        $baseEmailRegexp = '([_A-Za-z0-9-]+(\\.[_A-Za-z0-9-]+)*@[A-Za-z0-9-]+(\\.[A-Za-z0-9-]+)*(\\.[A-Za-z]{2,}))';

        if ($include === true) {
            return $baseEmailRegexp;
        }

        return '/' . $baseEmailRegexp . '/i';
    }

    /**
     * @param string $content
     * @return string
     */
    protected function filterPage($content)
    {

        $filterHead = (bool) $this->opt('filter_head');
        $filterBody = (bool) $this->opt('filter_body');

        $htmlSplit = preg_split('/(<body(([^>]*)>))/is', $content, null, PREG_SPLIT_DELIM_CAPTURE);

        if (count($htmlSplit) < 4) {
            return $content;
        }

        if ($filterHead === true) {
            $filteredHead = $this->filterPlainEmails($htmlSplit[0]);
        } else {
            $filteredHead = $htmlSplit[0];
        }

        if ($filterBody === true) {
            $filteredBody = $this->filterContent($htmlSplit[4]);
        } else {
            $filteredBody = $htmlSplit[4];
        }
        
        $filteredContent = $filteredHead . $htmlSplit[1] . $filteredBody;
        return $filteredContent;
    }

    /**
     * Filter content
     * @param string $content
     * @return string
     */
    protected function filterContent($content)
    {
        $filtered = $content;

        $filtered = $this->filterInputFields($filtered);
        $filtered = $this->filterMailtoLinks($filtered);

        // plain emails
        $convertPlainEmails = $this->opt('convert_emails');

        if ($convertPlainEmails == 1) {
            $filtered = $this->filterPlainEmails($filtered);

        } elseif ($convertPlainEmails == 2) {
            $filtered = $this->filterPlainEmails($filtered, function ($match) {
                return $this->protectedMailto($match[0], array('href' => 'mailto:' . $match[0]));
            });
        }
 
        return $filtered;
    }

    /**
     * @param string $content
     * @return string
     */
    private function filterMailtoLinks($content)
    {
        $self = $this;

        $callbackEncodeMailtoLinks = function ($match) use ($self) {
            $attrs = shortcode_parse_atts($match[1]);
            return $self->protectedMailto($match[4], $attrs);
        };

        $regexpMailtoLink = '/<a[\s+]*(([^>]*)href=["\']mailto\:([^>]*)["\'])>(.*?)<\/a[\s+]*>/is';

        return preg_replace_callback($regexpMailtoLink, $callbackEncodeMailtoLinks, $content);
    }

    /**
     * @param string $content
     * @return string
     */
    private function filterInputFields($content)
    {
        $self = $this;

        $callbackEncodeInputFields = function ($match) use ($self) {
            $input = $match[0];
            $email = $match[2];
            $strongEncoding = (bool) $this->opt('input_strong_protection');

            return $self->encodeInputField($input, $email, $strongEncoding);
        };
        
        $regexpInputField = '/<input([^>]*)value=["\'][\s+]*' . $this->getEmailRegExp(true) . '[\s+]*["\']([^>]*)>/is';

        return preg_replace_callback($regexpInputField, $callbackEncodeInputFields, $content);
    }

    /**
     * @return string
     */
    private function getProtectionText()
    {
        return __($this->opt('protection_text'), 'wp-mailto-links');
    }

    /**
     * Emails will be replaced by '*protected email*'
     * @param string           $content
     * @param string|callable  $replaceBy  Optional
     * @return string
     */
    private function filterPlainEmails($content, $replaceBy = null)
    {
        if ($replaceBy === null) {
            $replaceBy = $this->getProtectionText();
        }

        if (is_callable($replaceBy)) {
            return preg_replace_callback($this->getEmailRegExp(), $replaceBy, $content);
        }
        
        return preg_replace($this->getEmailRegExp(), $replaceBy, $content);
    }

    /**
     * Encode email in input field
     * @param string $input
     * @param string $email
     * @return string
     */
    private function encodeInputField($input, $email, $strongEncoding = true)
    {
        if ($strongEncoding === false) {
            // encode email with entities (default wp method)
            return str_replace($email, antispambot($email), $input);
        }

        // add data-enc-email after "<input"
        $inputWithDataAttr = substr($input, 0, 6);
        $inputWithDataAttr .= ' data-enc-email="' . $this->getEncEmail($email) . '"';
        $inputWithDataAttr .= substr($input, 6);

        // remove email from value attribute
        $encInput = str_replace($email, '', $inputWithDataAttr);

        return $encInput;
    }

    /**
     * Emails will be replaced by '*protected email*'
     * @param string $content
     * @return string
     */
    protected function filterRss($content)
    {
        $regexpHrefMailto = '/mailto\:[\s+]*' . $this->getEmailRegExp(true) . '/i';
        
        $filtered = $this->filterPlainEmails($content);
        // @todo Check removing explicit mailto check
        $filtered = preg_replace($regexpHrefMailto, 'mailto:' . $this->getProtectionText(), $filtered);
        return $filtered;
    }

    /**
     * Create a protected mailto link
     * @param string $display
     * @param array $attrs Optional
     * @return string
     */
    public function protectedMailto($display, $attrs = array())
    {
        $email     = '';
        $class_ori = (empty($attrs['class'])) ? '' : $attrs['class'];

        // does not contain no-icon class and no icon when contains <img>
        if ((!$this->opt('no_icon_class') || strpos($class_ori, $this->opt('no_icon_class')) === FALSE)
                    && !($this->opt('image_no_icon') == 1 && $this->hasImageTag($display))) {
            if ($this->opt('mail_icon') === 'image') {
            // image
                if ($this->opt('image') > 0 && strpos($class_ori, 'mail-icon-') === FALSE) {
                    $icon_class = 'mail-icon-' . $this->opt('image');

                    $attrs['class'] = (empty($attrs['class'])) ? $icon_class : $attrs['class'] .' '.$icon_class;
                }
            } elseif ($this->opt('mail_icon') === 'dashicons') {
            // dashicons
                $fontIcon = '<i class="dashicons-before ' . $this->opt('dashicons') . '"></i>';
            } elseif ($this->opt('mail_icon') === 'fontawesome') {
            // fontawesome
                $fontIcon = '<i class="fa ' . $this->opt('fontawesome') . '"></i>';
            }
        }

        // set user-defined class
        if ($this->opt('class_name') && strpos($class_ori, $this->opt('class_name')) === FALSE) {
            $attrs['class'] = (empty($attrs['class'])) ? $this->opt('class_name') : $attrs['class'].' '.$this->opt('class_name');
        }

        // check title for email address
        if (!empty($attrs['title'])) {
            $attrs['title'] = $this->filterPlainEmails($attrs['title'], '{{email}}'); // {{email}} will be replaced in javascript
        }

        // create element code
        $link = '<a ';

        foreach ($attrs AS $key => $value) {
            if (strtolower($key) == 'href' && $this->opt('protect')) {
                // get email from href
                $email = substr($value, 7);

                $encoded_email = $this->getEncEmail($email);

                // set attrs
                $link .= 'href="javascript:;" ';
                $link .= 'data-enc-email="'.$encoded_email.'" ';
            } else {
                $link .= $key.'="'.$value.'" ';
            }
        }

        // remove last space
        $link = substr($link, 0, -1);

        $link .= '>';

        if (!empty($fontIcon) && $this->opt('show_icon_before')) {
            $link .= $fontIcon . ' ';
        }

        $link .= ($this->opt('protect') && preg_match($this->getEmailRegExp(), $display) > 0) ? $this->getProtectedDisplay($display) : $display;

        if (!empty($fontIcon) && !$this->opt('show_icon_before')) {
            $link .= ' ' . $fontIcon;
        }

        $link .= '</a>';

        // filter
        $link = apply_filters('wpml_mailto', $link, $display, $email, $attrs);

        // just in case there are still email addresses f.e. within title-tag
        $link = $this->filterPlainEmails($link);

        // mark link as successfullly encoded (for admin users)
        if (current_user_can('manage_options') && $this->opt('security_check')) {
            $link .= '<i class="wpml-encoded dashicons-before dashicons-lock" title="' . __('Email encoded successfully!', 'wp-mailto-links') . '"></i>';
        }


        return $link;
    }

    /**
     * @param string $content
     * @return string
     */
    private function hasImageTag($content)
    {
        return (bool) preg_match('/<img([^>]*)>/is', $content);
    }

    /**
     * Get encoded email, used for data-attribute (translate by javascript)
     * @param string $email
     * @return string
     */
    private function getEncEmail($email)
    {
        $encEmail = $email;

        // decode entities
        $encEmail = html_entity_decode($encEmail);

        // rot13 encoding
        $encEmail = str_rot13($encEmail);

        // replace @
        $encEmail = str_replace('@', '[at]', $encEmail);

        return $encEmail;
    }

    /**
     * Create protected display combining these 3 methods:
     * - reversing string
     * - adding no-display spans with dummy values
     * - using the wp antispambot function
     *
     * Source:
     * - http://perishablepress.com/press/2010/08/01/best-method-for-email-obfuscation/
     * - http://techblog.tilllate.com/2008/07/20/ten-methods-to-obfuscate-e-mail-addresses-compared/
     *
     * @param string|array $display
     * @return string Protected display
     */
    public function getProtectedDisplay($display)
    {
        // get display outof array (result of preg callback)
        if (is_array($display)) {
            $display = $display[0];
        }

        // first strip html tags
        $stripped_display = strip_tags($display);
        // decode entities
        $stripped_display = html_entity_decode($stripped_display);

        $length = strlen($stripped_display);
        $interval = ceil(min(5, $length / 2));
        $offset = 0;
        $dummy_content = time();
        $protected = '';

        // reverse string ( will be corrected with CSS )
        $rev = strrev($stripped_display);

        while ($offset < $length) {
            // set html entities
            $protected .= antispambot(substr($rev, $offset, $interval));

            // set some dummy value, will be hidden with CSS
            $protected .= '<span class="wpml-nodis">'.$dummy_content.'</span>';
            $offset += $interval;
        }

        $protected = '<span class="wpml-rtl">'.$protected.'</span>';

        return $protected;
    }

}

/*?>*/
