<div class="slider-container">
    <div class="slider">
        <?php
            // Loop through twice to make two sliders
            for($i = 0; 2 > $i; $i++) {
                echo '<div class="sliding-section">';

                foreach($args['sponsor_ids'] as $id) {
                    $link = \get_field('sponsor_link', $id) ? \get_field('sponsor_link', $id) : '';
                    $logo = \get_field('sponsor_logo', $id) ? \get_field('sponsor_logo', $id)['url'] : '';

                    echo'<div class="sliding-section__item"><a class="sponsor__url" href="'.$link.'" target="_blank" rel="noopener noreferrer"><img class="sponsor__logo" src="' . $logo . '" alt="' . get_the_title($id) . '"/></a></div>';
                }

                echo '</div>'; // .sliding-section__item
            }
        ?>
    </div> <!-- .slider -->
</div> <!-- .slider-container -->

<div class="sponsors-static default-width">
    <?php
        foreach($args['sponsor_ids'] as $id) {
            $link = \get_field('sponsor_link', $id) ? \get_field('sponsor_link', $id) : '';
            $logo = \get_field('sponsor_logo', $id) ? \get_field('sponsor_logo', $id)['url'] : '';

            echo'<div class="sponsor-static__item"><a class="sponsor-static__url" href="' . $link . '" target="_blank" rel="noopener noreferrer"><img class="sponsor-static__logo" src="' . $logo . '" alt="' . get_the_title($id) . '"/></a></div>';
        }
    ?>
</div> <!-- sponsors-static -->