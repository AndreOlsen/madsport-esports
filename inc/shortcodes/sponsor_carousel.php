<?php

/**
 * Shortcode for displaying a endless sponsor logo carousel.
 * 
 * Uses the image, url and post id from the custom post type
 * "sponsors".
 * 
 * @return string Returns the html for the carousel.
 */
function display_sponsor_loop() {
    $args = array(
        'post_type'   => 'sponsors', 
        'fields'      => 'ids',
        'numberposts' => -1, 
    );

    $sponsor_ids = get_posts($args);

    return load_template_part('template-parts/shortcodes/shortcode', 'carousel', array('sponsor_ids' => $sponsor_ids));

}

add_shortcode('sponsor_carousel', 'display_sponsor_loop');