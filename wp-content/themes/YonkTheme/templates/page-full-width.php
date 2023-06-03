<?php /* Template Name: Full Page */ ?>
<?php defined('ABSPATH') or die('No script kiddies please!');
get_header(); 
    if (have_posts()):
        while (have_posts()): the_post();
            get_template_part('content', 'page');
        endwhile;
    else:
        get_template_part('content', 'none');
    endif;
get_footer(); ?>