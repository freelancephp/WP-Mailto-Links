<?php $pluginData = get_plugin_data($FILE); ?>
<h3><i class="dashicons-before dashicons-email"></i>  <?php echo get_admin_page_title() ?> - v<?php echo $pluginData['Version']; ?></h3>
<p>
    <?php echo str_replace('<cite>', '<br><br><cite>', $pluginData['Description']); ?>
    <i class="dashicons-before dashicons-universal-access"></i>
</p>
<hr>
<h4><?php _e('Cheat Sheet', 'wp-mailto-links'); ?> <i class="dashicons-before dashicons-smiley"></i></h4>
<table>
    <tr>
        <td><?php _e('Shortcode:', 'wp-mailto-links'); ?></td>
        <td><code><b>[wpml_mailto</b> email="..."<b>]</b>...<b>[/wpml_mailto]</b></code></td>
    </tr>
    <tr>
        <td><?php _e('Template tags:', 'wp-mailto-links'); ?></td>
        <td><code><b>wpml_mailto(</b> $email [, $display] [, $attrs] <b>)</b>;</code></td>
    </tr>
    <tr>
        <td></td>
        <td><code><b>wpml_filter(</b> $content <b>)</b>;</code></td>
    </tr>
    <tr>
        <td><?php _e('Filter hook:', 'wp-mailto-links'); ?></td>
        <td><code>add_filter('<b>wpml_mailto</b>', 'func', 10, 4);</code></td>
    </tr>
    <tr>
        <td><?php _e('Action hook:', 'wp-mailto-links'); ?></td>
        <td><code>add_action('<b>wpml_ready</b>', 'func');</code></td>
    </tr>
</table>
