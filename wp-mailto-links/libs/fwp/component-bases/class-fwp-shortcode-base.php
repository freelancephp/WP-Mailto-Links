<?php
/**
 * Class FWP_Shortcode_Base_1x0x0
 *
 * Public methods implemented in concrete subclasses will be automatically
 * created as shortcodes.
 *
 * @package  FWP
 * @category WordPress Library
 * @version  1.0.0
 * @author   Victor Villaverde Laan
 * @link     http://www.finewebdev.com
 * @link     https://github.com/freelancephp/WPRun-WordPress-Development
 * @license  Dual licensed under the MIT and GPLv2+ licenses
 */
abstract class FWP_Shortcode_Base_1x0x0 extends WPRun_Base_1x0x0
{

    /**
     * Action for "wp"
     * Create template tags
     */
    protected function action_wp()
    {
        // get public methods of parent class
        $parent_class = get_parent_class( $this );
        $reflection_parent_class = new ReflectionClass( $parent_class );
        $parent_methods = $reflection_parent_class->getMethods( ReflectionMethod::IS_PUBLIC  );

        // get public methods of current class
        $reflection_class = new ReflectionClass( get_called_class() );
        $class_methods = $reflection_class->getMethods( ReflectionMethod::IS_PUBLIC );

        // get only the public methods implemented in concrete class
        // these are the shortcodes
        $shortcode_refl_methods = array_diff( $class_methods, $parent_methods );

        foreach ( $shortcode_refl_methods as $refl_method ) {
            $this->create_shortcode( $refl_method->name );
        }
    }

    /**
     * Create shortcode
     * @return void
     */
    protected function create_shortcode( $shortcode )
    {
        add_shortcode( $shortcode, $this->get_callback( $shortcode ) );
    }

}

/*?>*/
