<?php
/**
 * Class WPML_Front
 *
 * @package  WPML
 * @category WordPress Plugin
 * @version  2.1.5
 * @author   Victor Villaverde Laan
 * @link     http://www.finewebdev.com
 * @link     https://github.com/freelancephp/WP-Mailto-Links
 * @license  Dual licensed under the MIT and GPLv2+ licenses
 */
final class WPML_Front extends WPRun_Base_1x0x0
{

    private $option = null;
    private $emailEncoder = null;

    /**
     * Initialize
     */
    protected function init($option, $emailEncoder)
    {
        $this->option = $option;
        $this->emailEncoder = $emailEncoder;
    }

    /**
     * Get option value
     * @param string $key
     * @return string
     */
    private function opt($key)
    {
        return $this->option->getValue($key);
    }

    /**
     * Action for "wp"
     */
    protected function action_wp()
    {
        if (is_feed()) {
            if ($this->opt('filter_rss')) {
                add_filter('final_output', $this->getCallback('rssFilter'), 100);
            }

        } else {
            if (!$this->opt('filter_body')) {
                $filterHooks = array();

                if ($this->opt('filter_posts')) {
                    array_push($filterHooks, 'the_title', 'the_content', 'the_excerpt', 'get_the_excerpt');
                }

                if ($this->opt('filter_comments')) {
                    array_push($filterHooks, 'comment_text', 'comment_excerpt');
                }

                if ($this->opt('filter_widgets')) {
                    array_push($filterHooks, 'widget_output');
                }

                foreach ($filterHooks as $hook) {
                   add_filter($hook, $this->getCallback('contentFilter'), 100);
                }
            }

            if ($this->opt('filter_head') || $this->opt('filter_body')) {
                add_filter('final_output', $this->getCallback('pageFilter'), 100);
            }
        }
    }

    /**
     * Action for "wp_head"
     */
    protected function action_wp_head()
    {
        $headTemplateFile = WP_MAILTO_LINKS_DIR . '/templates/site/head.php';

        $this->showTemplate($headTemplateFile, array(
            'icon' => $this->opt('image'),
            'className' => $this->opt('class_name'),
            'showBefore' => $this->opt('show_icon_before'),
        ));
    }

    /**
     * Action for "wp_enqueue_scripts"
     */
    protected function action_wp_enqueue_scripts()
    {
        if ($this->opt('protect')) {
            wp_enqueue_script( 'wp-mailto-links' );
        }

        // add css font icons
        if ($this->opt('mail_icon') === 'dashicons') {
            wp_enqueue_style('dashicons');

        } elseif ($this->opt('mail_icon') === 'fontawesome') {
            wp_enqueue_script( 'font-awesome' );
        }
    }

    /**
     * @param string $content
     * @return string
     */
    protected function pageFilter($content)
    {
        $filterHead = (bool) $this->opt('filter_head');
        $filterBody = (bool) $this->opt('filter_body');

        return $this->emailEncoder->pageFilter($content, $filterHead, $filterBody, $this->opt('convert_emails'));
    }

    /**
     * @param string $content
     * @return string
     */
    protected function contentFilter($content)
    {
        return $this->emailEncoder->contentFilter($content, $this->opt('convert_emails'));
    }

    /**
     * @param string $content
     * @return string
     */
    protected function rssFilter($content)
    {
        return $this->emailEncoder->rssFilter($content, $this->opt('convert_emails'));
    }

}

/*?>*/
