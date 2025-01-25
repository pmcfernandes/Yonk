<?php

if (!defined('ABSPATH')) {
	exit;
}

/**
 * The template for displaying search forms in NARGA
 *
 * @package WordPress
 * @subpackage YonkTheme
 * @since 1.0
 */
?>
<form role="search" method="get" id="searchform" class="searchform" action="<?php echo esc_url(home_url('/')); ?>">
	<div class="input-group mb-3">
		<input type="text" class="form-control" value="<?php echo get_search_query(); ?>" name="s" id="s" placeholder="<?php _e('Search here', 'blank'); ?>" aria-label="<?php _e('Search here', 'blank'); ?>" aria-describedby="searchsubmit" />
		<button type="submit" id="searchsubmit" class="btn btn-primary"><?php echo esc_attr_x('Search', 'submit button', 'blank'); ?></button>
	</div>
</form>
