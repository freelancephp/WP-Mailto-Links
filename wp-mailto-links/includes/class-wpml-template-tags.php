<?php
/**
 * Class WPML_Template_Tags
 *
 * @package  WPML
 * @category WordPress Plugin
 * @version  2.1.5
 * @author   Victor Villaverde Laan
 * @link     http://www.finewebdev.com
 * @link     https://github.com/freelancephp/WP-Mailto-Links
 * @license  Dual licensed under the MIT and GPLv2+ licenses
 */
final class WPML_Template_Tags extends FWP_Template_Tag_Base_1x0x0
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
     * Template tag funtion
     * @param string $content
     * @return string
     */
    public function wpml_filter( $content )
    {
        return $this->email_encoder->contentFilter( $content );
    }

    /**
     * Handle template tag
     * @param string $email
     * @param string $display
     * @param array  $atts
     * @return string
     */
    public function wpml_mailto( $email, $display = null, $atts = array() )
    {
        if ( is_array( $display ) ) {
            // backwards compatibility (old params: $display, $attrs = array())
            $atts = $display;
            $display = $email;
        } else {
            $atts[ 'href' ] = 'mailto:'. $email;
        }

        return $this->email_encoder->protectedMailto( $display, $atts );
    }

}

/*?>*/
