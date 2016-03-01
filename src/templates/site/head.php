<style type="text/css" media="all">
/* WP Mailto Links Plugin */
.wpml-nodis { display:none; }
.wpml-rtl { unicode-bidi:bidi-override; direction:rtl; }
.wpml-encoded { position:absolute; margin-top:-0.3em; z-index:1000; color:green; }

// add nowrap style
<?php if ($className): ?>
    .<?php echo $className; ?> { white-space:nowrap; }
<?php endif; ?>

// add icon styling
<?php if ($icon): ?>
    .mail-icon-<?php echo $icon; ?> {
    background:url(<?php echo WPML_Plugin::plugin()->getUrl('/images/mail-icon-' . $icon . '.png'); ?>) no-repeat
    <?php if ($showBefore): ?>
        0% 50%; padding-left:18px;
    <?php else: ?>
        100% 50%; padding-right:18px;
    <?php endif; ?>
    }
<?php endif; ?>
</style>
