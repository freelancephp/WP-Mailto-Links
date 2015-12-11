    <p>
        <label for="own_admin_menu">
            <input type="checkbox"
                   id="own_admin_menu"
                   name="<?php echo $option->getFieldName('own_admin_menu'); ?>"
                   value="1"
                   <?php checked('1', $option->getValue('own_admin_menu')); ?>>
            <span><?php _e('Show as main menu item', 'wp-mailto-links') ?></span>
            <p class="description"><?php _e('Or else will be shown in "Settings"-menu.', 'wp-mailto-links') ?></p>
        </label>
    </p>
    <p>
        <input class="button button-primary button-large" type="submit" value="<?php _e('Save Changes') ?>">
    </p>
</fieldset>
