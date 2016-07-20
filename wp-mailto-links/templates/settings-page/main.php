<?php
/**
 * Admin Settings
 *
 * @package  WPML
 * @category WordPress Plugin
 * @version  2.1.5
 * @author   Victor Villaverde Laan
 * @link     http://www.finewebdev.com
 * @link     https://github.com/freelancephp/WP-Mailto-Links
 * @license  Dual licensed under the MIT and GPLv2+ licenses
 *
 * @var array $vars
 *      @option array  "tabs"
 *      @option string "current_tab"
 *      @option string "page_url"
 *      @option string "menu_url"
 *      @option string "own_admin_menu"
 */
?>
<div class="wrap wpml-settings-page wpml-settings-page-<?php echo $vars[ 'current_tab' ]; ?>">
    <h1><?php echo get_admin_page_title(); ?></h1>
    <?php
        if ( $vars[ 'own_admin_menu' ] ):
            settings_errors();
        endif;

        // nav tabs
        $nav_tabs_template = WPML_Plugin::get_plugin_dir( '/templates/partials/nav-tabs.php' );
        WPML_Plugin::show_template( $nav_tabs_template, $vars );
    ?>

    <form method="post" action="options.php">
        <?php
            $content_tab_template = __DIR__ .'/tab-contents/'. $vars[ 'current_tab' ] .'.php';
            $default_tab_template = WPML_Plugin::get_plugin_dir( '/templates/partials/tab-contents/'. $vars[ 'current_tab' ] .'.php' );

            if ( is_readable( $content_tab_template ) ):
                WPML_Plugin::show_template( $content_tab_template, $vars );
            elseif ( is_readable( $default_tab_template ) ):
                WPML_Plugin::show_template( $default_tab_template, $vars );
            else:
                $content_tab_template = WPML_Plugin::get_plugin_dir( '/templates/partials/tab-contents/fields-default.php' );

                if ( is_readable( $content_tab_template ) ):
                    WPML_Plugin::show_template( $content_tab_template, $vars );
                endif;
            endif;
        ?>
    </form>
</div>
