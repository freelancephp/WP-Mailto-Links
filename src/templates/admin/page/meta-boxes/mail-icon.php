<fieldset class="options">
    <table class="form-table">
        <tr>
            <th scope="row">
                <?php _e('Choose Mail Icon', 'wp-mailto-links'); ?>
            </th>
            <td colspan="3">
                    <label>
                        <input type="radio"
                               name="<?php echo $option->getFieldName('mail_icon'); ?>"
                               value=""
                               <?php checked('image', $option->getValue('mail_icon')); ?>>
                        <span><?php _e('No icon', 'wp-mailto-links') ?></span>
                    </label>
                <br>
                    <label>
                        <input type="radio"
                               name="<?php echo $option->getFieldName('mail_icon'); ?>"
                               value="image"
                               <?php checked('image', $option->getValue('mail_icon')); ?>>
                        <span><?php _e('Image', 'wp-mailto-links') ?></span>
                        <span class="description"><?php _e('(deprecated)', 'wp-mailto-links') ?></span>
                    </label>

                <br class="clear">
                    <div style="width:12%;float:left">
                    <?php for ($x = 1; $x <= 25; $x++): ?>
                        <label>
                            <input type="radio"
                                   name="<?php echo $option->getFieldName('icon'); ?>"
                                   value="<?php echo $x ?>"
                                   <?php checked((string) $x, $option->getValue('icon')); ?>>
                            <img src="<?php echo WPML::glob('URL') . '/images/mail-icon-'. $x .'.png' ?>">
                        </label>
                        <br>
                        <?php if ($x % 5 == 0): ?>
                    </div>
                    <div style="width:12%;float:left">
                        <?php endif; ?>
                    <?php endfor; ?>
                    </div>
                <br class="clear">
                <br>
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
                <br>
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
            </td>
        </tr>
        <tr>
            <th scope="row">
                <?php _e('Skip icon containing <code>&lt;img&gt;</code>', 'wp-mailto-links'); ?>
            </th>
            <td colspan="3">
                <label>
                    <input type="checkbox"
                           id="image_no_icon"
                           name="<?php echo $option->getFieldName('image_no_icon'); ?>"
                           value="1"
                           <?php checked('1', $option->getValue('image_no_icon')); ?>>
                    <span><?php _e('No icon for links already containing an <code>&lt;img&gt;</code>-tag', 'wp-mailto-links') ?></span>
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
