<?php

if (!defined('ABSPATH')) {
    exit;
}

/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query. For example, puts together date-based pages if no date.php file exists.
 * If you'd like to further customize these archive views, you may create a new template file for each specific one.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage YonkTheme
 * @since 1.0
*/

get_header();
?>
<div class="row">
	<div class="col-xs-12 col-sm-8 col-md-8 col-lg-9 content">
		<article id="page-archive" class="archive" role="article">
            <header class="page-header">
                <h1><?php the_archive_title(); ?><small><?php the_archive_description(); ?></small></h1>
            </header>
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
		</article>
	</div>
	<div class="col-xs-12 col-sm-4 col-md-4 col-lg-3 sidebar">
		<section id="sidebar">
			<?php get_sidebar(); ?>
		</section>
	</div>
</div>
<?php get_footer(); ?>
