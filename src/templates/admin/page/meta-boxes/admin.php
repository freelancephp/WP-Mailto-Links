<fieldset class="options">
    <table class="form-table">
        <tr>
            <th scope="row">
                <?php _e('Admin menu position', 'wp-mailto-links'); ?>
            </th>
            <td colspan="3">
                <label for="own_admin_menu">
                    <input type="checkbox"
                           id="own_admin_menu"
                           name="<?php echo $option->getFieldName('own_admin_menu'); ?>"
                           value="1"
                           <?php checked('1', $option->getValue('own_admin_menu')); ?>>
                    <span><?php _e('Show as main menu item', 'wp-mailto-links') ?></span>
                    <p class="description"><?php _e('When disabled item will be shown under "General settings".', 'wp-mailto-links') ?></p>
                </label>
            </td>
        </tr>
    </table>

    <p>
        <input class="button button-primary button-large" type="submit" value="<?php _e('Save Changes') ?>">
    </p>
</fieldset>
