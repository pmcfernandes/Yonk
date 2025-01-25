<?php

if (!defined('ABSPATH')) {
    exit;
}

/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage YonkTheme
 * @since 1.0
 */

get_header(); ?>
<div class="row">
	<div class="col-xs-12 col-sm-8 col-md-8 col-lg-9 content">
        <?php
            if (have_posts()):
                while (have_posts()): the_post();
                    if (post_password_required()):
                        get_template_part('template-parts/content-password-protected');
                    else:
                        get_template_part('template-parts/content');
                    endif;

                    the_post_navigation(array(
                        'prev_text'			 => __('prev post: %title'),
                        'next_text'			 => __('next post: %title'),
                        'screen_reader_text' => __('Continue Reading'),
                    ));
                    comments_template('', true);
                endwhile;
            else:
                get_template_part('template-parts/content', 'none');
            endif;
        ?>
	</div>
	<div class="col-xs-12 col-sm-4 col-md-4 col-lg-3 sidebar">
		<section id="sidebar">
			<?php get_sidebar(); ?>
		</section>
	</div>
</div>
<?php get_footer(); ?>