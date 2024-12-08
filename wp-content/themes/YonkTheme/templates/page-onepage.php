<?php /* Template Name: One Page Layout */ ?>
<?php defined('ABSPATH') or die('No script kiddies please!');
get_header(); 
	global $post;

	$args = array(
		'post_type'      => 'page',
		'post_status'	 => 'publish',
    	'posts_per_page' => -1,
    	'post_parent'    => $post->ID,
    	'orderby'        => 'menu_order',
		'order'          => 'ASC'
	);

	$query = new WP_Query($args);

	if ($query->have_posts()):
		while($query->have_posts()): $query->the_post();
			$pageObj = get_post(get_the_ID());
			$slug = $pageObj->post_name; ?>
	<?php do_action('Yonk_page_before', $slug); ?>
        <section id="page-<?php echo $slug; ?>" <?php post_class(); ?> role="section">
            <?php get_template_part('page', $slug); ?>
        </section>
	<?php do_action('Yonk_page_after', $slug); ?>
    <?php
		endwhile;
	endif;
	wp_reset_query();
get_footer(); ?>
