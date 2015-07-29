<script>
jQuery(function ($) {
    var $wrap = $('.plugin-page');

    // Workaround for saving disabled checkboxes in options db
    // prepare checkboxes before submit
    $wrap.find('form').submit(function () {
        // force value 0 being saved in options
        $('*[type="checkbox"]:not(:checked)')
            .css({ 'visibility': 'hidden' })
            .attr({
                'value': '0',
                'checked': 'checked'
            });
    });

    // enable submit buttons
    $wrap.find('*[type="submit"]')
        .attr('disabled', false)
        .removeClass('submit'); // remove class to fix button background
});
</script>
<div class="wrap plugin-page">
    <div class="icon32" id="icon-options-custom" style="background:url(<?php echo $plugin->getGlobal('pluginUrl') . '/images/icon-wp-mailto-links.png' ?>) no-repeat 50% 50%"><br></div>
    <h2><?php echo get_admin_page_title() ?> - <em><small><?php $plugin->_e('Manage Email Links') ?></small></em></h2>

    <?php if (isset($_GET['settings-updated']) && $_GET['settings-updated'] == 'true' && $values['own_admin_menu']): ?>
    <div class="updated settings-error" id="setting-error-settings_updated">
        <p><strong><?php _e('Settings saved.') ?></strong></p>
    </div>
    <?php endif; ?>

    <form method="post" action="options.php">
        <?php settings_fields($plugin->getGlobal('key')); ?>

        <input type="hidden" name="<?php echo $plugin->getGlobal('key') ?>_nonce" value="<?php echo wp_create_nonce($plugin->getGlobal('key')) ?>" />
        <?php wp_nonce_field('closedpostboxes', 'closedpostboxesnonce', false); ?>
        <?php wp_nonce_field('meta-box-order', 'meta-box-order-nonce', false); ?>

        <div id="poststuff">
            <div id="post-body" class="metabox-holder columns-<?php echo 1 == get_current_screen()->get_columns() ? '1' : '2'; ?>">
                <!--<div id="post-body-content"></div>-->

                <div id="postbox-container-1" class="postbox-container">
                    <?php do_meta_boxes('', 'side', ''); ?>
                </div>

                <div id="postbox-container-2" class="postbox-container">
                    <?php do_meta_boxes('', 'normal', ''); ?>
                    <?php do_meta_boxes('', 'advanced', ''); ?>
                </div>
            </div> <!-- #post-body -->
        </div> <!-- #poststuff -->
    </form>
</div>
