<script>
jQuery(function ($) {
    $('input#filter_body')
        .change(function () {
            var $i = $('input#filter_posts, input#filter_comments, input#filter_widgets');

            if ($(this).attr('checked')) {
                $i.attr('disabled', true)
                    .attr('checked', true);
            } else {
                $i.attr('disabled', false);
            }
        })
        .change();
});
</script>
<fieldset class="options">
    <table class="form-table">
    <tr>
        <th><?php $plugin->_e('Protect mailto links') ?></th>
        <td><label><input type="checkbox" id="<?php echo $optionName ?>[protect]" name="<?php echo $optionName ?>[protect]" value="1" <?php checked('1', (int) $values['protect']); ?> />
            <span><?php $plugin->_e('Protect mailto links against spambots') ?></span></label>
        </td>
    </tr>
    <tr>
        <th><?php $plugin->_e('Protect plain emails') ?></th>
        <td><label><input type="radio" id="<?php echo $optionName ?>[convert_emails]" name="<?php echo $optionName ?>[convert_emails]" value="0" <?php checked('0', (int) $values['convert_emails']); ?> />
            <span><?php $plugin->_e('No, keep plain emails as they are') ?></span></label>
            <br/><label><input type="radio" id="<?php echo $optionName ?>[convert_emails]" name="<?php echo $optionName ?>[convert_emails]" value="1" <?php checked('1', (int) $values['convert_emails']); ?> />
            <span><?php $plugin->_e('Yes, protect plain emails with protection text *') ?></span> <span class="description"><?php $plugin->_e('(Recommended)') ?></span></label>
            <br/><label><input type="radio" id="<?php echo $optionName ?>[convert_emails]" name="<?php echo $optionName ?>[convert_emails]" value="2" <?php checked('2', (int) $values['convert_emails']); ?> />
            <span><?php $plugin->_e('Yes, convert plain emails to mailto links') ?></span></label>
        </td>
    </tr>
    <tr>
        <th><?php $plugin->_e('Options have effect on') ?></th>
        <td>
            <label><input type="checkbox" name="<?php echo $optionName ?>[filter_body]" id="filter_body" value="1" <?php checked('1', (int) $values['filter_body']); ?> />
            <span><?php $plugin->_e('All contents') ?></span> <span class="description"><?php $plugin->_e('(the whole <code>&lt;body&gt;</code>)') ?></span></label>
            <br/>&nbsp;&nbsp;<label><input type="checkbox" name="<?php echo $optionName ?>[filter_posts]" id="filter_posts" value="1" <?php checked('1', (int) $values['filter_posts']); ?> />
                    <span><?php $plugin->_e('Post contents') ?></span></label>
            <br/>&nbsp;&nbsp;<label><input type="checkbox" name="<?php echo $optionName ?>[filter_comments]" id="filter_comments" value="1" <?php checked('1', (int) $values['filter_comments']); ?> />
                    <span><?php $plugin->_e('Comments') ?></span></label>
            <br/>&nbsp;&nbsp;<label><input type="checkbox" name="<?php echo $optionName ?>[filter_widgets]" id="filter_widgets" value="1" <?php checked('1', (int) $values['filter_widgets']); ?> />
                    <span><?php $plugin->_e('All widgets'); ?></span></label>
        </td>
    </tr>
    <tr>
        <th><?php $plugin->_e('Also protect...') ?></th>
        <td><label><input type="checkbox" name="<?php echo $optionName ?>[filter_head]" value="1" <?php checked('1', (int) $values['filter_head']); ?> />
                <span><?php $plugin->_e('<code>&lt;head&gt;</code>-section by replacing emails with protection text *') ?></span></label>
            <br/><label><input type="checkbox" name="<?php echo $optionName ?>[filter_rss]" value="1" <?php checked('1', (int) $values['filter_rss']); ?> />
                <span><?php $plugin->_e('RSS feed by replacing emails with protection text *') ?></span></label>
            <br/><label><input type="checkbox" name="<?php echo $optionName ?>[input_strong_protection]" value="1" <?php checked('1', (int) $values['input_strong_protection']); ?> />
                <span><?php $plugin->_e('Strong protection for input form fields') ?></span> <span class="description"><?php $plugin->_e('(Warning: this option could conflict with certain form plugins. Test it first.)') ?></span></label>
        </td>
    </tr>
    <tr>
        <th><?php $plugin->_e('Set protection text *') ?></th>
        <td><label><input type="text" id="protection_text" class="regular-text" name="<?php echo $optionName ?>[protection_text]" value="<?php echo $values['protection_text']; ?>" />
                <br/><span class="description"><?php $plugin->_e('This text will be shown for protected emailaddresses.') ?></span>
            </label>
        </td>
    </tr>
    </table>
</fieldset>
<p class="submit">
    <input class="button-primary" type="submit" disabled="disabled" value="<?php _e('Save Changes' ) ?>" />
</p>
<br class="clear" />
