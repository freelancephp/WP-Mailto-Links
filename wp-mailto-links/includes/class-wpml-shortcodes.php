<?php
/**
 * Class WPML_Shortcodes
 *
 * @package  WPML
 * @category WordPress Plugin
 * @version  2.1.5
 * @author   Victor Villaverde Laan
 * @link     http://www.finewebdev.com
 * @link     https://github.com/freelancephp/WP-Mailto-Links
 * @license  Dual licensed under the MIT and GPLv2+ licenses
 */
final class WPML_Shortcodes extends FWP_Shortcode_Base_1x0x0
{

    /**
     * @var WPML_Email_Encoder
     */
    private $email_encoder = null;

    /**
     * Initialize
     * @param WPML_Email_Encoder $email_encoder
     */
    protected function init( WPML_Email_Encoder $email_encoder )
    {
        $this->email_encoder = $email_encoder;
    }

    /**
     * Handle shortcode
     * @param array   $atts
     * @param string  $content
     */
    protected function mailto( $atts, $content = null )
    {
        // set "email" to "href"
        if ( isset( $atts[ 'email' ] ) ) {
            $atts[ 'href' ] = 'mailto:' . $atts[ 'email' ];
            unset( $atts[ 'email' ] );
        }

        $content = $this->email_encoder->protectedMailto( $content, $atts );

        return $content;
    }

}

/*?>*/
