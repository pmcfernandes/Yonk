<?php

    if (!defined('ABSPATH')) {
        exit;
    }

    if (is_active_sidebar('home')):
        dynamic_sidebar('home');
    else:
?>
	<div class="no-widgets">
        <p><?php _e('This is a widget ready area. Add some and they will appear here.', 'blank'); ?></p>
	</div>
<?php 
    endif; 
?>
