<?php if(has_author_role(get_the_author_meta('ID'))) { ?>
    <div class="post-author is-center reading-width">
        <div class="author-image"><?php echo get_avatar(get_the_author_meta('ID')); ?></div>
        <div class="author-deets">
            <div class="author-name"><?php echo get_the_author_meta('first_name') . ' "' . get_the_author_meta('nickname')  . '" ' . get_the_author_meta('last_name'); ?></div>
            <?php get_author_socials_tagline(get_the_author_meta('ID')); ?>
        </div>
    </div>
<?php } ?>

<article class="post-single is-center reading-width">
    <div class="post-tagline">
        <p class="post-subtitle"><?php echo has_excerpt() ? get_the_excerpt() : ''; ?></p>
        <p class="post-date"><?php the_date(); ?></p>
    </div>

    <div class="line-spacer default-width"></div>
    
    <div class="post-content">
        <?php the_content(); ?>
    </div>
</article>