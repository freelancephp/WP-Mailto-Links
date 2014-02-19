/* WP Mailto Links Plugin */
/*global window, jQuery*/
(function (window) {
    'use strict';

    var document = window.document;

    // add event handler
    function addEvt(el, evt, fn) {
        if (el.attachEvent) {
            // IE method
            el.attachEvent('on' + evt, fn);
        } else if (el.addEventListener) {
            // Standard JS method
            el.addEventListener(evt, fn, false);
        }
    }

    // encoding method
    function rot13(s) {
        // source: http://jsfromhell.com/string/rot13
        return s.replace(/[a-zA-Z]/g, function (c) {
            return String.fromCharCode((c <= 'Z' ? 90 : 122) >= (c = c.charCodeAt(0) + 13) ? c : c - 26);
        });
    }

    // open mailto link
    function mailto(el) {
        var email = el.getAttribute('data-enc-email');

        if (!email) {
            return;
        }

        email = email.replace('[at]', '@');
        email = 'mailto:' + rot13(email.replace(/\[a\]/g, '@'));

        window.location.href = email;
    }

    // on DOM ready...
    if (window.jQuery) {
    // jQuery DOMready method
        jQuery(function ($) {
            $('body').delegate('a[data-enc-email]', 'click', function () {
                mailto(this);
            });
        });
    } else {
    // use onload when jQuery not available
        addEvt(window, 'load', function () {
            var links = document.getElementsByTagName('a');
            var addClick = function (a) {
                addEvt(a, 'click', function () {
                    mailto(a);
                });
            };
            var a, i;

            // check each <a> element
            for (i = 0; i < links.length; i + 1) {
                a = links[i];

                // click event for opening in a new window
                if (a.getAttribute('data-enc-email')) {
                    addClick(a);
                }
            }
        });
    }

})(window);
