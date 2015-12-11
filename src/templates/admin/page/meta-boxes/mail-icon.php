<fieldset class="options">
    <p>
        <label>
            <input type="radio"
                   name="<?php echo $option->getFieldName('mail_icon'); ?>"
                   value=""
                   <?php checked('image', $option->getValue('mail_icon')); ?>>
            <span><?php _e('No icon', 'wp-mailto-links') ?></span>
        </label>
    </p>
    <p>
        <label>
            <input type="radio"
                   name="<?php echo $option->getFieldName('mail_icon'); ?>"
                   value="image"
                   <?php checked('image', $option->getValue('mail_icon')); ?>>
            <span><?php _e('Image', 'wp-mailto-links') ?></span>
        </label>
    </p>
    <p>
        <label>
            <input type="radio"
                   name="<?php echo $option->getFieldName('mail_icon'); ?>"
                   value="dashicons"
                   <?php checked('dashicons', $option->getValue('mail_icon')); ?>>
            <span><?php _e('DashIcons', 'wp-mailto-links') ?></span>
        </label>
        <select style="font-family: 'dashicons'; font-size:1em; padding:0.5em;">
            <option>&#xf103</option>
            <option>&#xf233</option>
            <option>&#xf319</option>
            <option>&#xf233</option>
            <option>&#xf319</option>
            <option>&#xf103</option>
            <option>&#xf233</option>
            <option>&#xf319</option>
        </select>
    </p>
    <p>
        <label>
            <input type="radio"
                   name="<?php echo $option->getFieldName('mail_icon'); ?>"
                   value="fontawesome"
                   <?php checked('fontawesome', $option->getValue('mail_icon')); ?>>
            <span><?php _e('FontAwesome', 'wp-mailto-links') ?></span>
        </label>
        <select style="font-family: 'FontAwesome'; font-size:1.5em; padding:0.5em;">
            <option>&#xf286</option>
            <option>&#xf289</option>
            <option>&#xf1b9</option>
            <option>&#xf289</option>
            <option>&#xf1b9</option>
            <option>&#xf286</option>
            <option>&#xf289</option>
            <option>&#xf1b9</option>
        </select>
    </p>

    <p>
        <input class="button button-primary button-large" type="submit" value="<?php _e('Save Changes') ?>">
    </p>
</fieldset>
