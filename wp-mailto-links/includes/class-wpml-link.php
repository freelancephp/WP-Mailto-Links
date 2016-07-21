<?php
/**
 * Class WPML_Link
 *
 * This class extends DOMElement which uses the camelCase naming style.
 * Therefore this class also contains camelCase names.
 *
 * @package  WPML
 * @category WordPress Plugin
 * @version  2.1.5
 * @author   Victor Villaverde Laan
 * @link     http://www.finewebdev.com
 * @link     https://github.com/freelancephp/WP-Mailto-Links
 * @license  Dual licensed under the MIT and GPLv2+ licenses
 */
class WPML_Link extends FWP_HTML_Element_1x0x0
{

    /**
     * Check url is mailto link
     * @return boolean
     */
    public function is_mailto()
    {
        $url = trim( $this->get_attr( 'href' ) );

        if ( substr( $url, 0, 7 ) === 'mailto:' ) {
            return true;
        }

        return false;
    }

}

/*?>*/
