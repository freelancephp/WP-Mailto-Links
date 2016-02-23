<fieldset>
    <p>
        <?php $fields->textField('class_name', ''); ?>
        <p class="description"><?php _e('Add extra classes to mailto links (or leave blank).', 'wp-mailto-links') ?></p>
    </p>

    <p>
        <?php echo $fields->submitButton(); ?>
    </p>
</fieldset>
