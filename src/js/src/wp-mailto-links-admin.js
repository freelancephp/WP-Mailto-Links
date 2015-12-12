/* WP Mailto Links Admin */
/*global jQuery, wpmlSettings*/
jQuery(function ($) {

    'use strict';

    // Workaround for posting disabled checkboxes
    // prepare checkboxes on submit
    $('.wrap form').on('submit', function () {
        // force value 0 being saved in options
        $('*[type="checkbox"]:not(:checked)')
            .css({
                'visibility': 'hidden'
            })
            .attr({
                'value': '0',
                'checked': 'checked'
            });
    });

    // fill dashicons  select options
    $.get(wpmlSettings.pluginUrl + '/data/json/fontawesome.json', null, function (data) {
        var $select = $('.select-fontawesome');
        fillSelect($select, data['icons'], 'unicode', 'className');
        $select.find('option').each(function () {
            if (this.value === wpmlSettings.fontawesomeValue) {
                $(this).attr('selected', true);
            }
        });
    });

    // fill fontawesome select options
    $.get(wpmlSettings.pluginUrl + '/data/json/dashicons.json', null, function (data) {
        var $select = $('.select-dashicons');
        fillSelect($select, data['icons'], 'unicode', 'className');
        $select.val(wpmlSettings.dashiconsValue);
        $select.find('option').each(function () {
            if (this.value === wpmlSettings.dashiconsValue) {
                $(this).attr('selected', true);
            }
        });
    });

    // fill select helper function
    function fillSelect($select, list, keyText, keyValue) {
        $.each(list, function (index, item) {
            var value = item[keyValue];
            var text = item[keyText];

            $select.append('<option value="'+ value +'">&#x'+ text +'</option>');
        });
    }

    // filter body + childs
    $('*[name="wp-mailto-links[filter_body]').on('change', function () {
        var $fields = $('.filter-body-child');

        if ($(this).attr('checked')) {
            $fields.attr('disabled', true);
            $fields.attr('checked', true);
        } else {
            $fields.attr('disabled', false);
        }
    })
    .trigger('change');

    // mail icon
    $('*[name="wp-mailto-links[mail_icon]"').on('change', function () {
        var value = $(this).val();
        var $images = $('.wrap-icon-images');
        var $selectDashicons = $('.wrap-dashicons');
        var $selectFontAwesome = $('.wrap-fontawesome');

        $images.hide();
        $selectDashicons.hide();
        $selectFontAwesome.hide();

        if (value === 'image') {
            $images.show();
        }

        if (value === 'dashicons') {
            $selectDashicons.show();
        }

        if (value === 'fontawesome') {
            $selectFontAwesome.show();
        }
    })
    .filter(':checked').change();

});
