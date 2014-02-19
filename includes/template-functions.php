<?php defined('ABSPATH') OR die('No direct access.');

/**
 * Template Functions
 *
 * @package WP_Mailto_Links
 * @category WordPress Plugins
 */
if (!is_admin()):

    /**
     * Template function for creating protected mailto link
     * @global WPML_Site $WPML_Site
     * @param string $email
     * @param string $display  Optional
     * @param array $attrs  Optional
     * @return string
     */
    if (!function_exists('wpml_mailto')):
        function wpml_mailto($email, $display = null, $attrs = array()) {
            global $WPML_Site;

            if (is_array($display)) {
            // backwards compatibility (old params: $display, $attrs = array())
                $attrs = $display;
                $display = $email;
            } else {
                $attrs['href'] = 'mailto:' . $email;
            }

            return $WPML_Site->protected_mailto($display, $attrs);
        }
    endif;

    /**
     * Template function for protecting mailto links in given content
     * @global WPML_Site $WPML_Site
     * @param string $content
     * @return string
     */
    if (!function_exists('wpml_filter')):
        function wpml_filter($content) {
            global $WPML_Site;
            return $WPML_Site->callback_filter_content($content);
        }
    endif;

endif;

/*?> // ommit closing tag, to prevent unwanted whitespace at the end of the parts generated by the included files */