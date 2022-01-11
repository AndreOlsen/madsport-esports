<?php 
/**
 * Template for displaying posts.
 * 
 * @package Madsport
 * @version 1.1
 */

get_header(); 

$page_for_posts = get_option( 'page_for_posts' );
$banner_url = has_post_thumbnail($page_for_posts) ? get_the_post_thumbnail_url($page_for_posts, 'full') : '';
?>

<main class="main-wrap">

    <div class="wp-block-cover has-background-dim has-parallax" style="background-image:url(<?php echo $banner_url ?>); min-height:500px;">
        <div class="wp-block-cover__inner-container">
            <p class="has-text-align-center has-large-font-size banner-heading"><?php echo get_the_title($page_for_posts); ?></p>
        </div>
    </div>

    <div class="wp-block-spacer custom-spacer-100"></div>

    <section class="posts-items-container is-center reading-width">

        <?php get_template_part('template-parts/post/content', 'full-width'); ?>

        <div class="posts-grid">
            <?php
                if(have_posts()) : while(have_posts()) : the_post();
                    if($GLOBALS['wp_query']->current_post !== (int) 0 && $GLOBALS['page'] === (int) 1 ? true : false) :
                        get_template_part('template-parts/post/content', 'grid');
                    endif;
                endwhile; else:
                    esc_html_e('Ingen nyheder fundet.', 'madsport');
                endif;
            ?>
        </div>
       
    <section>

    <div class="wp-block-spacer custom-spacer-100"></div>

</main>

<?php get_footer(); ?>