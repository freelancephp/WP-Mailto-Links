<?php
/**
 * Class WPML_Network_Page
 *
 * @package  WPML
 * @category WordPress Plugin
 * @version  2.1.5
 * @author   Victor Villaverde Laan
 * @link     http://www.finewebdev.com
 * @link     https://github.com/freelancephp/WP-Mailto-Links
 * @license  Dual licensed under the MIT and GPLv2+ licenses
 */
final class WPML_Network_Page extends WPRun_Base_1x0x0
{

    /**
     * @var string
     */
    private $menu_slug = 'wpml-network-settings-page';

    /**
     * @var string
     */
    private $current_tab = null;

    /**
     * @var array
     */
    private $tabs = array();

    /**
     * Initialize
     */
    protected function init( array $fields_objects )
    {
        $this->tabs = array(
            'network-settings' => array(
                'title'     => __( 'Multi Site Settings', 'wp-mailto-links' ),
                'icon'      => '<i class="fa fa-sitemap" aria-hidden="true"></i>',
                'fields'    => $fields_objects[ 'network-settings' ],
            ),
            'network-admin-settings' => array(
                'title'     => __( 'Admin Settings', 'wp-mailto-links' ),
                'icon'      => '<i class="fa fa-cogs" aria-hidden="true"></i>',
                'fields'    => $fields_objects[ 'network-admin-settings' ],
            ),
            'support' => array(
                'title'     => __( 'Support', 'wp-mailto-links' ),
                'icon'      => '<i class="fa fa-question" aria-hidden="true"></i>',
            ),
        );

        // get current tab
        $this->current_tab = filter_input( INPUT_GET, 'tab', FILTER_SANITIZE_STRING );

        // set default tab
        if ( ! key_exists( $this->current_tab, $this->tabs ) ) {
            reset( $this->tabs );
            $this->current_tab = key( $this->tabs );
        }
    }

    /**
     * Get option value
     * @param string $key
     * @param string $type
     * @return string
     * @triggers E_USER_NOTICE Option value cannot be found
     */
    public function get_option_value( $key, $type = null )
    {
        if ( null === $type ) {
            foreach ( $this->tabs as $tab_key => $values ) {
                if ( ! isset( $values[ 'fields' ] ) ) {
                    continue;
                }

                $option_values = $values[ 'fields' ]->get_option_values();

                if ( ! isset( $option_values[ $key ] ) ) {
                    continue;
                }

                return $option_values[ $key ];
            }
        } else if ( isset( $this->tabs[ $type ][ 'fields' ] ) ) {
            $option_values = $this->tabs[ $type ][ 'fields' ]->get_option_values();

            if ( isset( $option_values[ $key ] ) ) {
                return $option_values[ $key ];
            }
        }

        trigger_error( 'Option value "'. $key .'" cannot be found.' );
    }

    /**
     * Action for "network_admin_menu"
     */
    protected function action_network_admin_menu()
    {
        $own_admin_menu = $this->get_option_value( 'own_admin_menu' );

        if ( '1' === $own_admin_menu ) {
            $this->page_hook = add_menu_page(
                __( 'WP External Links' , 'wp-mailto-links' )       // page title
                , __( 'External Links' , 'wp-mailto-links' )        // menu title
                , 'manage_network'                                  // capability
                , $this->menu_slug                                  // menu slug
                , $this->get_callback( 'show_network_page' )        // callback
                , 'none'                                            // icon
                , null                                              // position
            );
        } else {
            $this->page_hook = add_submenu_page(
                'settings.php'                                      // parent slug
                , __( 'WP External Links' , 'wp-mailto-links' )     // page title
                , __( 'External Links' , 'wp-mailto-links' )        // menu title
                , 'manage_options'                                  // capability
                , $this->menu_slug                                  // menu slug
                , $this->get_callback( 'show_network_page' )        // callback
            );
        }

        add_action( 'load-'. $this->page_hook, $this->get_callback( 'add_help_tabs' ) );
    }

    /**
     * Action for "admin_enqueue_scripts"
     */
    protected function action_admin_enqueue_scripts()
    {
        wp_enqueue_style( 'font-awesome' );
        wp_enqueue_style( 'wpml-admin-style' );
        wp_enqueue_script( 'wpml-admin-script' );
    }

    /**
     * Show Admin Page
     */
    protected function show_network_page()
    {
        $page = $this->get_option_value( 'own_admin_menu' ) ? 'admin.php' : 'settings.php';
        $page_url = network_admin_url() . $page .'?page='. $this->menu_slug;

        $template_file = WPML_Plugin::get_plugin_dir( '/templates/network-page/main.php' );
        $this->show_template( $template_file, array(
            'tabs'              => $this->tabs,
            'current_tab'       => $this->current_tab,
            'page_url'          => $page_url,
            'menu_slug'         => $this->menu_slug,
            'own_admin_menu'    => $this->get_option_value( 'own_admin_menu' ),
        ) );
    }

    /**
     * Add help tabs
     */
    protected function add_help_tabs()
    {
        $screen = get_current_screen();

        $screen->add_help_tab( array(
            'id'        => 'under-construction',
            'title'     => __( 'Under Construction', 'wp-mailto-links' ),
            'callback'  => $this->get_callback( 'show_help_tab' ),
        ) );
    }

    /**
     * @param WP_Screen $screen
     * @param array     $args
     */
    protected function show_help_tab( WP_Screen $screen, array $args )
    {
        $template_file = WPML_Plugin::get_plugin_dir( '/templates/network-page/help-tabs/'. $args[ 'id' ] .'.php' );
        $this->show_template( $template_file );
    }

}

/*?>*/
