<?php /* Template Name: Full Page */ ?>
<?php

    if (!defined('ABSPATH')) {
        exit;
    }

    get_header(); 
        if (have_posts()):
            while (have_posts()): the_post();
                get_template_part('template-parts/content', 'page');
            endwhile;
        else:
            get_template_part('template-parts/content', 'none');
        endif;
    get_footer(); 
    
?>