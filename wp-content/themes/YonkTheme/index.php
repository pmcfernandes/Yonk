<?php

if (!defined('ABSPATH')) {
    exit;
}

/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage YonkTheme
 * @since 1.0
*/
?>
<?php get_header(); ?>
<!-- Customize this page like you want -->
<div class="row">
    <div class="col-xs-12 col-sm-8 col-md-8 col-lg-9 content">
        <div id="category-results">
		    <?php
		    if (have_posts()):
			    while (have_posts()): the_post();
                    get_template_part('template-parts/content', 'category');
			    endwhile;

                get_template_part('template-parts/pagination');
		    else:
			    get_template_part('template-parts/content', 'none');
		    endif;
		    ?>
        </div>
    </div>
    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-3 sidebar">
        <section id="sidebar">
            <?php get_sidebar('template-parts/sidebar-home'); ?>
        </section>
    </div>
</div>
<?php get_footer(); ?>
