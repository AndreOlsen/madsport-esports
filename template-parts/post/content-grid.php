<article class="posts-item">
    <a class="posts-link" href="<?php the_permalink(); ?>">
        <figure class="posts-thumbnail">
            <?php the_post_thumbnail('medium'); ?>
        </figure>
    
        <div class="posts-tagline">
            <h2 class="posts-title"><?php the_title(); ?></h2>
            <time class="posts-date"><?php echo get_the_date(); ?></time>
        </div>
    </a>
</article>