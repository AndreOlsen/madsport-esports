<?php 
/**
 * Displays a single post 
 * 
 * @package Madsport
 * @version 1.1
 */

get_header(); 

$banner_url = has_post_thumbnail(get_the_id()) ? get_the_post_thumbnail_url(get_the_id(), 'full') : '';
?>

<main class="main-wrap">

    <div class="wp-block-cover has-background-dim has-parallax" style="background-image:url(<?php echo $banner_url ?>); min-height:400px;">
        <div class="wp-block-cover__inner-container">
            <p class="has-text-align-center has-large-font-size banner-heading banner-heading-smaller"><?php the_title(); ?></p>
        </div>
    </div>

    <div class="wp-block-spacer custom-spacer-100"></div>

    <?php
        if(have_posts()) : while(have_posts()) : the_post();
            get_template_part('template-parts/post/content-single');
        endwhile; else:
            esc_html_e('Ingen nyheder fundet.', 'madsport');
        endif;
    ?>

</main>

<?php
    get_footer();
?>