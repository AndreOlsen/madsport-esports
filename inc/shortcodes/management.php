<?php
/**
 * Shortcode for displaying management team.
 */
function display_management($atts = []) {
    $args = array(
        'posts_per_page' => -1,
        'post_type'      => 'management',
        'fields'         => 'ids',
    );

    $management_ids = get_posts($args);

    $output = '<div class="management is-center default-width">';

    foreach($management_ids as $id) {
        $pic_url = \get_field('manager_image', $id) ? \get_field('manager_image', $id) : '';
        $position = \get_field('manager_position', $id);

        $output .= '<div class="manager">';

        $output .= '<div class="manager__inner">';

        $output .= '<div class="manager__inner--front">';
        $output .= '<img class="profile-picture" src="' . $pic_url . '" />';
        $output .= '</div>'; // .manager__inner--front

        $output .= '<div class="manager__inner--back">';
        $output .= '<h3 class="title">' . get_the_title($id) . '</h3>';
        $output .= '<p>' . $position . '</p>';
        $output .= '</div>'; // .manager__inner--back

        $output .= '</div>'; // .manager__inner

        $output .= '</div>'; // .manager
    }

    $output .= '</div>'; // .management

    return $output;
}

add_shortcode('management_team', 'display_management');