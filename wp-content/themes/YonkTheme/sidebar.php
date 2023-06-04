<?php
defined('ABSPATH') or die('No script kiddies please!');

/**
 * The sidebar containing the main widget area
 *
 * @package WordPress
 * @subpackage YonkTheme
 * @since 1.0
 */
?>
<?php if (is_active_sidebar('single')): ?>
	<?php dynamic_sidebar('single'); ?>
<?php else: ?>
	<div class="no-widgets">
		<p><?php _e('This is a widget ready area. Add some and they will appear here.', 'blank'); ?></p>
	</div>
<?php endif; ?>
