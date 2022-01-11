<?php 
/**
 * Template for displaying static front page.
 * 
 * @package Madsport
 * @version 1.1
 */

    get_header(); 

    if(have_posts()) {
        while(have_posts()) {
            the_post();
            the_content();
        }
    }

    get_footer();
?>