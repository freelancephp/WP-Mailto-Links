<h3><?php _e('Action Hook', 'wp-mailto-links'); ?></h3>

<h4><code>add_action('wpml_ready', 'func');</code></h4>
<p><?php _e('Add extra code after plugin is ready on the site, f.e. to add extra filters:', 'wp-mailto-links'); ?></p>
<pre><code><&#63;php
add_action('wpml_ready', 'extra_filters');

function extra_filters($filter_callback, $object) {
    add_filter('some_filter', $filter_callback);
}
&#63;></code></pre>
