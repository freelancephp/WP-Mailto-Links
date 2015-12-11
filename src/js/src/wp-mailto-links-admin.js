/* WP Mailto Links Admin */
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

    // get dashicons and fontawesome
    $.get(userSettings.url + 'wp-content/plugins/wp-mailto-links/data/json/font-awesome.json', null, function (data) {
        var $select = $('.select-fontawesome');
        fillSelect($select, data['icons'], 'unicode', 'className');
    });

    $.get(userSettings.url + 'wp-content/plugins/wp-mailto-links/data/json/dash-icons.json', null, function (data) {
        var $select = $('.select-dashicons');
        fillSelect($select, data['icons'], 'unicode', 'className');
    });

    function fillSelect($select, list, keyText, keyValue)
    {
        $.each(list, function (index, item) {
            var value = item[keyValue];
            var text = item[keyText].replace('\\u', '&#x');

            $select.append('<option value="'+ value +'">'+ text +'</option>');
        });
    }


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
