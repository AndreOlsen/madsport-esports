<?php

    /**
     * Add WordPress functions support to theme.
     */
    function madsport_theme_setup() {
        // Let WordPress manage site title.
        add_theme_support('title-tag');

        // Add custom logo support.
        add_theme_support('custom-logo', array(
            'height'      => 120,
            'width'       => 90,
            'flex-height' => true,
            'flex-width'  => true, 
        ));
    
        // Enable thumbnail support for posts and pages.
        add_theme_support('post-thumbnails');

        // Make theme translatable.
        load_theme_textdomain('madsport');

        // Add support for full and wide align images.
	    add_theme_support('align-wide');

        // Add support for responsive embeds.
        add_theme_support('responsive-embeds');

        add_theme_support('wp-block-styles');

        add_editor_style('style-editor.css');

        add_theme_support('editor-styles');

        add_theme_support('dark-editor-style');
    }

    add_action('after_setup_theme', 'madsport_theme_setup');

    /**
     * Enqueue theme styles.
     */
    function madsport_enqueue_styles() {
        wp_enqueue_style('madsport-style', get_stylesheet_uri(), array(), '3.0.8', 'all');
    }

    add_action('wp_enqueue_scripts', 'madsport_enqueue_styles');

    /**
     * Enqueue theme scripts.
     */
    function madsport_enqueue_scripts() {
        wp_enqueue_script('fade-heading', get_template_directory_uri() . '/assets/js/banner-header-fading.js', array( 'jquery' ), '1.0.0', true);
        wp_enqueue_script('header-menus', get_template_directory_uri() . '/assets/js/header-menus.js', array( 'jquery' ), '1.0.0', true);
        //wp_enqueue_script('https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
        //wp_enqueue_script('show-more', get_template_directory_uri() . '/assets/js/show-more.js', array( 'jquery' ), '1.0.0', true);
    }

    add_action('wp_enqueue_scripts', 'madsport_enqueue_scripts');

    /**
     * Send security headers
     */
    add_action('send_headers', function(){
        // Enforce the use of HTTPS
        header("Strict-Transport-Security: max-age=31536000; includeSubDomains");
        // Prevent Clickjacking
        header("X-Frame-Options: SAMEORIGIN");
        // Block Access If XSS Attack Is Suspected
        header("X-XSS-Protection: 1; mode=block");
        // Prevent MIME-Type Sniffing
        header("X-Content-Type-Options: nosniff");
        // Referrer Policy
        header("Referrer-Policy: no-referrer-when-downgrade");
    }, 1);

    /**
     * Get template in output buffer.
     * 
     * @param  string $template_name Template name.
     * @param  string $part_name Part name.
     * @param  array  $args Array of variable being passed to the template.
     * @return string Returns the template html.
     */
    function load_template_part($template_name, $part_name = NULL, $args = array()) {
        ob_start();
        get_template_part($template_name, $part_name, $args);
        $html = ob_get_contents();
        ob_end_clean();

        return $html;
    }

    add_filter( 'oembed_response_data', 'disable_embeds_filter_oembed_response_data_' );

    // Include sponsor carousel shortcode.
    include get_stylesheet_directory() . '/inc/shortcodes/sponsor_carousel.php';
    // Include team shortcode.
    include get_stylesheet_directory() . '/inc/shortcodes/team.php';
    // Include management team shortcode.
    include get_stylesheet_directory() . '/inc/shortcodes/management.php';

    // Include widget class.
    include get_stylesheet_directory() . '/inc/widgets/socials-widget.php';

    // Change wp excerpt length
    add_filter( 'excerpt_length', function($length) {
        return 225;
    } );

    /**
     * Removes author from embeds.
     * 
     * @param array $data Array containing the embed data.
     */
    function disable_embeds_filter_oembed_response_data_( $data ) {
        unset($data['author_url']);
        unset($data['author_name']);
        return $data;
    }

    /**
     * Register sidebars and widgetizing areas.
     */
    function socials_widgets_init() {
        register_sidebar(
            array(
                'name'          => 'Footer left sidebar',
                'id'            => 'footer-left',
                'description'   => __('Widgets in this area will be displayed in the first column in the footer.', 'madsport'),
                'before_widget' => '<div>',
                'after_widget'  => '</div>',
                'before_title'  => '<h2 class="rounded">',
                'after_title'   => '</h2>',
            )
        );
    }

    add_action('widgets_init', 'socials_widgets_init');

    /**
     * Register menu areas.
     */
    function register_my_menus() {
        register_nav_menus(
            array(
                'main-menu-left'  => __('Main Menu Left'),
                'main-menu-right' => __('Main Menu Right'),
                'mobile-menu'     => __('Mobile Menu'),
            )
        );
    }

    add_action('init', 'register_my_menus');
    
    /**
     * Register custom post types.
     */
    function cpt_init() {

        // Sponsors.
        $args = array(
            'labels' => array(
                'name'          => __('Sponsors','madsport'),
                'singular_name' => __('Sponsor', 'madsport'),
            ),
            'public'              => true,
            'has_archive'         => true,
            'menu_icon'           => 'dashicons-businessman',
            'publicly_queryable'  => false,
        );

        register_post_type('sponsors', $args);

        // Players.
        $args = array(
            'labels' => array(
                'name'          => __('Players','madsport'),
                'singular_name' => __('Player', 'madsport'),
            ),
            'public'              => true,
            'has_archive'         => true,
            'menu_icon'           => 'dashicons-groups',
            'publicly_queryable'  => false,
        );

        register_post_type('players', $args);

        // Teams taxonomy for Players cpt.
        register_taxonomy(
            'teams',
            'players',
            array(
                'labels' => array(
                    'name'          => __('Teams', 'madsport'),
                    'singular_name' => __('Team','madsport'),
                    'add_new_item'  => 'New team',
                    'new_item_name' => 'New team',
                ),
                'show_ui'       => true,
                'show_tagcloud' => false,
                'hierarchical'  => true
            ),
        );

        // Management.
        $args = array(
            'labels' => array(
                'name'          => __('Management', 'madsport'),
                'singular_name' => __('Management', 'madsport'),
            ),
            'public'              => true,
            'has_archive'         => true,
            'menu_icon'           => 'dashicons-businessperson',
            'publicly_queryable'  => false,
        );

        register_post_type('management', $args);
    }

    add_action('init', 'cpt_init');
    
    /**
     * Flush rewrite rules.
     */
    function rewrite_flush() {
        cpt_init();
        flush_rewrite_rules();
    
    }

    add_action('after_switch_theme', 'rewrite_flush');

    /**
     * Add custom players columns to the players post type.
     * 
     * @param  array $columns Contains the columns of the admin tables.
     * @return array Array with the new custom columns.
     */
    function set_custom_players_columns($columns) {
        $new = array();
    
        foreach($columns as $key => $value) {
            // Place every custom column before date column.
            if($key == 'date') {
                $new['team'] = __('Team', 'madsport');
                $new['profile_pic'] = __('Image', 'madsport');
            }

            $new[$key] = $value;
        }  
    
        return $new;
    }

    add_filter('manage_players_posts_columns', 'set_custom_players_columns');

    /**
     * Add custom players columns to the Sponsors post type.
     * 
     * @param  array $columns Contains the columns of the admin tables.
     * @return array Array with the new custom columns.
     */
    function set_custom_sponsors_columns($columns) {
        $new = array();

        foreach($columns as $key => $value) {
            // Place every custom column before date column.
            if($key == 'date') {
                $new['image'] = __('Image', 'madsport');
            }

            $new[$key] = $value;
        }

        return $new;
    }

    add_filter('manage_sponsors_posts_columns', 'set_custom_sponsors_columns');

    /**
     * Add custom players columns to the Management post type.
     * 
     * @param  array $columns Contains the columns of the admin tables.
     * @return array Array with the new custom columns.
     */
    function set_custom_management_columns($columns) {
        $new = array();

        foreach($columns as $key => $value) {
            // Place every custom column before date column.
            if($key == 'date') {
                $new['image'] = __('Image', 'madsport');
            }

            $new[$key] = $value;
        }

        return $new;
    }

    add_filter('manage_management_posts_columns', 'set_custom_management_columns');

    /**
     * Make custom players columns sortable.
     * 
     * @param  array $columns Contains the columns of the admin tables.
     * @return array New sortable admin table column.
     */
    function set_sortable_players_columns($columns) {
        $columns['team'] = 'team';

        return $columns;
    }

    add_filter('manage_edit-players_sortable_columns', 'set_sortable_players_columns');

    /**
     * Add the data to the custom columns for the players post type.
     * 
     * @param string $column  Loops through admin table columns.
     * @param int    $post_id Post id. Self-explanatory.
     */
    function custom_players_column($column, $post_id) {
        switch ($column) {
            case 'team':
                echo get_the_terms($post_id, 'teams')[0]->name;
            break;
            case 'profile_pic':
                echo '<img src="' . \get_field('player_image', $post_id)['url'] . '" width="50">';
            break;
        }
    }

    add_action('manage_players_posts_custom_column', 'custom_players_column', 10, 2);

    /**
     * Add the data to the custom columns for the Sponsors post type.
     * 
     * @param string $column  Loops through admin table columns.
     * @param int    $post_id Post id. Self-explanatory.
     */
    function custom_sponsors_column($column, $post_id) {
        switch ($column) {
            case 'image':
                echo '<img src="' . \get_field('sponsor_logo', $post_id)['url'] . '" width="50">';
            break;
        }
    }

    add_action('manage_sponsors_posts_custom_column', 'custom_sponsors_column', 10, 2);

    /**
     * Add the data to the custom columns for the Management post type.
     * 
     * @param string $column  Loops through admin table columns.
     * @param int    $post_id Post id. Self-explanatory.
     */
    function custom_management_column($column, $post_id) {
        switch ($column) {
            case 'image':
                echo '<img src="' . \get_field('manager_image', $post_id) . '" width="50">';
            break;
        }
    }

    add_action('manage_management_posts_custom_column', 'custom_management_column', 10, 2);

    /**
     * Gets the authors social media links from Yoast.
     * 
     * @param int $author_id Author id.
     */
    function get_author_socials_tagline($author_id) {
        // Compile array of social media links.
        $socials = array (
            'Facebook'  => get_user_meta($author_id, 'facebook', true),
            'Twitter'   => get_user_meta($author_id, 'twitter', true),
            'Instagram' => get_user_meta($author_id, 'instagram', true),
            'Youtube'   => get_user_meta($author_id, 'youtube', true),
        );

        $tagline = "";

        foreach($socials as $social => $social_url) {
            if (empty($social_url)) continue;
            
            $tagline .= '<a href="' . $social_url . '" title="' . $social . '"> ' . $social . ' </a> |';
        }

        //Shave off last separator and echo.
        echo substr($tagline, 0, -1);
    }

    /**
     * Check if author has author role. Used to prevent administrator to show up as author of articles.
     * 
     * @param int @author_id Author id.
     */
    function has_author_role($author_id) {
        // Get the user object.
        $author = get_userdata( $author_id );

        // Get all the user roles as an array.
        $author_roles = $author->roles;

        // Check if the role you're interested in, is present in the array.
        if ( in_array( 'author', $author_roles, true ) ) {
            return true;
        } else  {
            return false;
        }
    }
?>