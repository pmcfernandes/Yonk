<?php /* Template Name: One Page Layout */ ?>
<?php 

    if (!defined('ABSPATH')) {
        exit;
    }

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
				$slug 	= $pageObj->post_name;
				$title 	= $pageObj->post_title;		
		?>
		<?php do_action('Yonk_page_before', $slug); ?>
			<section id="page-<?php echo $slug; ?>" <?php post_class(); ?> role="region" aria-labelledby="page-<?php echo $slug; ?>" aria-label="<?php echo $title; ?>"> 
				<?php get_template_part('page', $slug); ?>
			</section>
		<?php do_action('Yonk_page_after', $slug); ?>
		<?php
			endwhile;
		endif;
		wp_reset_query();
	get_footer(); 

?>
