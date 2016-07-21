/**
 * WP Mailto Links Plugin
 * Admin
 */
/*global jQuery, window*/
jQuery(function ($) {
    'use strict';

    var $wrapper = $('.wpml-settings-page');

    /**
     * Apply Sections Settings
     */
    $wrapper.on('change', '.js-wpml-apply input', function () {
        var apply_all = $(this).is(':checked');
        var $items = $wrapper.find('.js-wpml-apply-child');

        if (apply_all) {
            $items.hide();
        } else {
            $items.show();
        }
    });

    // trigger immediatly
    $wrapper.find('.js-wpml-apply input').change();


    /**
     * Link Settings
     */
    $wrapper.on('change', '.js-icon-type select', function () {
        var iconType = $(this).val();
        var $itemsChild = $wrapper.find('.js-icon-type-child');
        var $itemsDepend = $wrapper.find('.js-icon-type-depend');

        $itemsChild.hide();

        if (iconType === 'image') {
            $itemsDepend.show();
            $itemsChild.filter('.js-icon-type-image').show();
        } else if (iconType === 'dashicon') {
            $itemsDepend.show();
            $itemsChild.filter('.js-icon-type-dashicon').show();
        } else if (iconType === 'fontawesome') {
            $itemsDepend.show();
            $itemsChild.filter('.js-icon-type-fontawesome').show();
        } else {
            $itemsDepend.hide();
        }
    });

    $wrapper.on('change', '.js-apply-settings input', function () {
        var $items = $wrapper.find('.form-table tr').not('.js-apply-settings');

        if ($(this).prop('checked')) {
            $items.show();
            $wrapper.find('.js-icon-type select').change();
        } else {
            $items.hide();
        }
    });

    // trigger immediatly
    $wrapper.find('.js-apply-settings input').change();


    /**
     * Support
     */
    $wrapper.on('click', '.js-wpml-copy', function (e) {
        e.preventDefault();

        var node = $wrapper.find('.js-wpml-copy-target').get(0);
        node.select();

        var range = document.createRange();
        range.selectNode(node);
        window.getSelection().addRange(range);

        try {
            document.execCommand('copy');
        } catch(err) {
            console.log('Unable to copy');
        }
    });

    /**
     * Help documentation links/buttons
     */
    $wrapper.on('click', '[data-wpml-help]', function () {
        var helpKey = $(this).data('wpml-help');

        if (helpKey) {
            // activate given tab
            $('#tab-link-'+ helpKey +' a').click();
        } else {
            // activate first tab
            $('.contextual-help-tabs li a').first().click();
        }

        $('#contextual-help-link[aria-expanded="false"]').click();
    });


});
