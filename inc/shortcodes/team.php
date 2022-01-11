<?php
/**
 * Display a selected team & players with their respective social accounts.
 */
function display_team($atts = []) {
    // Set default team.
    $atts = shortcode_atts([
        'team' => 'main'
    ], $atts);

    $args = array(
        'posts_per_page' => -1,
        'post_type'      => 'players',
        'tax_query'      => array(
            array(
                'taxonomy' => 'teams',
                'field'    => 'slug',
                'terms'    => $atts['team'],
            )
        )
    );

    $players = get_posts($args);
    
    $not_front_page = "";
    if(!is_front_page()) {
        $not_front_page = "not_front_page";
    }

    $output = '<div class="players ' . $not_front_page . ' is-center default-width">';

    // Loop through all players and build the html.
    foreach($players as $player) {
        $player_image_url = \get_field('player_image', $player->ID)['sizes']['medium'];

        $output .= '<div class="player">';
        $output .= '<img class="player__img" src="' . $player_image_url . '" alt="' . $player->post_title . '">';
        $output .= '<div class="player__content">';
        $output .= '<p class="player__name">' . $player->post_title . '</p>';

        // Get all social account urls.
        $social_accounts = \get_field('player_social', $player->ID);

        // Check if there is any social accounts linked to player.
        if(array_filter($social_accounts)) {

            $output .= '<div class="socials-container">';

            foreach($social_accounts as $social => $url) {
                // Remove prefix from social identifier.
                $social_no_prefix = str_replace('social_', '', $social);

                // If no url as been set or the icon doesn't exist, skip.
                if(empty($url)) continue;

                $output .= '<div class="social-account">';
                $output .= '<a href="' . $url . '" target="_blank" rel="noopener noreferrer" class="social-link"><i class="social-icon social-icon--' . $social_no_prefix . ' fab fa-' . $social_no_prefix . '"></i></a>';
                $output .= '</div>';
            }

            // .socials-container
            $output .= '</div>';

        }

        // .qinfo
        $output .= '</div>';

        // .player
        $output .= '</div>';
    }

    //.players
    $output .= '</div>';

    return $output;
}

add_shortcode('team', 'display_team');