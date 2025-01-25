<?php /* Template Name: Page with Sidebar (default) */ ?>
<?php

    if (!defined('ABSPATH')) {
        exit;
    }
	
	get_header(); 
?>
<div class="row">
	<div class="col-xs-12 col-sm-8 col-md-8 col-lg-9 content">
		<?php
			if (have_posts()):
				while (have_posts()): the_post();
                    get_template_part('template-parts/content', 'page');
				endwhile;
			else:
				get_template_part('template-parts/content', 'none');
			endif;
		?>
	</div>
	<div class="col-xs-12 col-sm-4 col-md-4 col-lg-3 sidebar">
		<section id="sidebar">
			<?php get_sidebar('template-parts/sidebar-page'); ?>
		</section>
	</div>
</div>

<?php 
	get_footer(); 
?>