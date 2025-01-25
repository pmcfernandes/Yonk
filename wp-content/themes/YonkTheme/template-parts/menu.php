<?php

    if (!defined('ABSPATH')) {
        exit;
    }

?>
<?php if (has_nav_menu('primary')): ?>
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
		<div class="container-fluid">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
			</div>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav ms-auto mb-2 mb-lg-0">
					<?php wp_nav_menu(
						array(
							'theme_location' => 'primary',
							'container' => false,
							'items_wrap' => '%3$s',
							'walker' => new Yonk_Nav_Menu()
						));
					?>
				</ul>
			</div>
		</div>
	</nav>
<?php endif; ?>