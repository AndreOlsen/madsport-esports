<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package madsport
 * @since 1.1
 */

get_header();
?>

    <main class="main-wrap error-404">
        <div class="custom-spacer-100"></div>
        <h1><?php _e('404', 'madsport'); ?></h1>
        <p><?php _e('Page not found', 'madsport'); ?></p>
        <p><?php _e("Either an error occurred or the page you're looking for doesn't exist anymore.", 'madsport'); ?></p>
        <div class="custom-spacer-100"></div>
    </main>

<?php
get_footer();
