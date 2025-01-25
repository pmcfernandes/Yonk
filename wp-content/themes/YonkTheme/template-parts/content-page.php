<?php

    if (!defined('ABSPATH')) {
        exit;
    }

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> role="article" itemscope itemtype="http://schema.org/Article">
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <header class="page-header">
                <h1 itemprop="name"><?php the_title(); ?></h1>
            </header>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" itemprop="articleBody">
					<?php the_content(); ?>
				</div>
			</div>
		</div>
	</div>
</article>