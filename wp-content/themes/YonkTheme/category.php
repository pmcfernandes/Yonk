<?php

    if (!defined('ABSPATH')) {
        exit;
    }

    get_header();
    
?>
<div class="row">
	<div class="col-xs-12 col-sm-8 col-md-8 col-lg-9 content">
        <header class="page-header">
            <h1><?php single_cat_title(); ?></h1>
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
	</div>
	<div class="col-xs-12 col-sm-4 col-md-4 col-lg-3 sidebar">
		<section id="sidebar">
			<?php get_sidebar(); ?>
		</section>
	</div>
</div>
<?php
    get_footer();
?>
