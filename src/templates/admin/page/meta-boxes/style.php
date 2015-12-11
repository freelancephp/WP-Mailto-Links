<fieldset class="options">
    <table class="form-table">
        <tr>
            <th scope="row">
                <?php _e('Additional Classes', 'wp-mailto-links'); ?>
            </th>
            <td colspan="3">
                <label>
                    <input type="text"
                           id="class_name"
                           name="<?php echo $option->getFieldName('class_name'); ?>"
                           class="regular-text"
                           value="<?php echo $option->getValue('class_name'); ?>">
                    <p class="description"><?php _e('Add extra classes to mailto links (or leave blank).', 'wp-mailto-links') ?></p>
                </label>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <?php _e('No-icon Class', 'wp-mailto-links'); ?>
            </th>
            <td colspan="3">
                <label>
                    <input type="text"
                           id="no_icon_class"
                           name="<?php echo $option->getFieldName('no_icon_class'); ?>"
                           class="regular-text"
                           value="<?php echo $option->getValue('no_icon_class'); ?>">
                    <p class="description"><?php _e('Use this class when a mailto link should not show an icon.', 'wp-mailto-links') ?></p>
                </label>
            </td>
        </tr>
    </table>

    <p>
        <input class="button button-primary button-large" type="submit" value="<?php _e('Save Changes') ?>">
    </p>
</fieldset>
