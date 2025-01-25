<?php

    if (!defined('ABSPATH')) {
        exit;
    }

    if (is_active_sidebar('search')):
        dynamic_sidebar('search');
    else:
?>
	<div class="no-widgets">
		<p><?php _e('This is a widget ready area. Add some and they will appear here.', 'blank'); ?></p>
	</div>
<?php 
	endif; 
?>
