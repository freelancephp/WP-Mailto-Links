<?php $pluginData = get_plugin_data($FILE); ?>

<h3><i class="dashicons-before dashicons-email"></i>  <?php echo get_admin_page_title() ?> - v<?php echo $pluginData['Version']; ?></h3>
<p><?php echo $pluginData['Description']; ?></p>

<h4>Features</h4>
<ul>
    <li>Protect mailto links automatically</li>
    <li>Protect plain email addresses or convert them to mailto links</li>
    <li>Protect RSS feed</li>
    <li>Set mail icon</li>
    <li>Use shortcodes, template functions, action and filter hooks</li>
</ul>
