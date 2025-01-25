<?php

    if (!defined('ABSPATH')) {
        exit;
    }

?>
<?php if (is_active_sidebar('category')): ?>
	<?php dynamic_sidebar('category'); ?>
<?php else: ?>
	<div class="no-widgets">
		<p><?php _e('This is a widget ready area. Add some and they will appear here.', 'blank'); ?></p>
	</div>
<?php endif; ?>
