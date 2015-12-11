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
<div id="post-body-content">
    <div class="stuffbox">
        <h3><?php _e('Security Settings', 'plugin-example'); ?></h3>
        <div class="inside">
            <fieldset>
                <table class="form-table">
                <tr>
                    <th scope="row">
                        <?php _e('Protect mailto links', 'wp-mailto-links'); ?>
                    </th>
                    <td>
                        <label>
                            <input type="checkbox"
                                   id="protect"
                                   name="<?php echo $option->getFieldName('protect'); ?>"
                                   value="1"
                                   <?php checked('1', $option->getValue('protect')); ?>>
                            <span><?php _e('Protect mailto links against spambots') ?></span>
                        </label>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <?php _e('Protect plain emails', 'wp-mailto-links'); ?>
                    </th>
                    <td>
                        <label>
                            <input type="radio"
                                   name="<?php echo $option->getFieldName('convert_emails'); ?>"
                                   value="0"
                                   <?php checked('0', $option->getValue('convert_emails')); ?>>
                            <span><?php _e('No, keep plain emails as they are', 'wp-mailto-links') ?></span>
                        </label>
                        <br>
                        <label>
                            <input type="radio"
                                   name="<?php echo $option->getFieldName('convert_emails'); ?>"
                                   value="1"
                                   <?php checked('1', $option->getValue('convert_emails')); ?>>
                            <span><?php _e('Yes, protect plain emails with protection text *', 'wp-mailto-links') ?></span>
                            <span class="description"><?php _e('(Recommended)', 'wp-mailto-links') ?></span>
                        </label>
                        <br>
                        <label>
                            <input type="radio"
                                   name="<?php echo $option->getFieldName('convert_emails'); ?>"
                                   value="2"
                                   <?php checked('2', $option->getValue('convert_emails')); ?>>
                            <span><?php _e('Yes, convert plain emails to mailto links', 'wp-mailto-links') ?></span>
                        </label>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <?php _e('Set protection text *', 'wp-mailto-links'); ?>
                    </th>
                    <td colspan="3">
                        <label>
                            <input type="text"
                                   id="protection_text"
                                   name="<?php echo $option->getFieldName('protection_text'); ?>"
                                   class="regular-text"
                                   value="<?php echo $option->getValue('protection_text'); ?>">
                            <p class="description"><?php _e('This text will be shown for protected emailaddresses.', 'wp-mailto-links'); ?></p>
                        </label>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <?php _e('Also protect...', 'wp-mailto-links'); ?>
                    </th>
                    <td colspan="3">
                        <label>
                            <input type="checkbox"
                                   id="filter_head"
                                   name="<?php echo $option->getFieldName('filter_head'); ?>"
                                   value="1"
                                   <?php checked('1', $option->getValue('filter_head')); ?> >
                            <span><?php _e('<code>&lt;head&gt;</code>-section by replacing emails with protection text *', 'wp-mailto-links'); ?></span>
                        </label>
                        <br>
                        <label>
                            <input type="checkbox"
                                   id="filter_rss"
                                   name="<?php echo $option->getFieldName('filter_rss'); ?>"
                                   value="1"
                                   <?php checked('1', $option->getValue('filter_rss')); ?> >
                            <span><?php _e('RSS feed by replacing emails with protection text *', 'wp-mailto-links'); ?></span>
                        </label>
                        <br>
                        <label>
                            <input type="checkbox"
                                   id="input_strong_protection"
                                   name="<?php echo $option->getFieldName('input_strong_protection'); ?>"
                                   value="1"
                                   <?php checked('1', $option->getValue('input_strong_protection')); ?> >
                            <span><?php _e('Strong protection for input form fields', 'wp-mailto-links'); ?></span>
                            <span class="description"><?php _e('(Warning: this option could conflict with certain form plugins. Test it first.)', 'wp-mailto-links'); ?></span>
                        </label>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <?php _e('Options have effect on', 'wp-mailto-links'); ?>
                    </th>
                    <td colspan="3">
                        <label>
                            <input type="checkbox"
                                   id="filter_body"
                                   name="<?php echo $option->getFieldName('filter_body'); ?>"
                                   value="1"
                                   <?php checked('1', $option->getValue('filter_body')); ?>>
                            <span><?php _e('All contents', 'wp-mailto-links'); ?></span>
                            <span class="description"><?php _e('(the whole <code>&lt;body&gt;</code>)', 'wp-mailto-links'); ?></span>
                        </label>

                        <br>&nbsp;&nbsp;
                        <label>
                            <input type="checkbox"
                                   id="filter_posts"
                                   name="<?php echo $option->getFieldName('filter_posts'); ?>"
                                   value="1"
                                   <?php checked('1', $option->getValue('filter_posts')); ?>>
                            <span><?php _e('Post contents', 'wp-mailto-links'); ?></span>
                        </label>
                        <br>&nbsp;&nbsp;
                        <label>
                            <input type="checkbox"
                                   id="filter_comments"
                                   name="<?php echo $option->getFieldName('filter_comments'); ?>"
                                   value="1"
                                   <?php checked('1', $option->getValue('filter_comments')); ?>>
                            <span><?php _e('Comments', 'wp-mailto-links'); ?></span>
                        </label>
                        <br>&nbsp;&nbsp;
                        <label>
                            <input type="checkbox"
                                   id="filter_widgets"
                                   name="<?php echo $option->getFieldName('filter_widgets'); ?>"
                                   value="1"
                                   <?php checked('1', $option->getValue('filter_widgets')); ?>>
                            <span><?php _e('All widgets', 'wp-mailto-links'); ?></span>
                        </label>
                    </td>
                </tr>
                </table>
            </fieldset>

            <p>
                <input class="button button-primary button-large" type="submit" value="<?php _e('Save Changes') ?>">
            </p>
        </div>
    </div>
</div>
