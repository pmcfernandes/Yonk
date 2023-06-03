<?php defined('ABSPATH') or die('No script kiddies please!');?>
<article id="page_not_found" role="article">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <header class="page-header">
                <h1><?php _e('Nothing Found', 'blank'); ?></h1>
            </header>
            <?php if (is_home() && current_user_can('publish_posts')): ?>
                <p><?php printf(__('Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'blank'), admin_url('post-new.php')); ?>p>
            <?php elseif (is_search()): ?>
                <p><?php _e('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'blank'); ?></p>
                <?php get_search_form(); ?>
            <?php else: ?>
                <p><?php _e('It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'blank'); ?></p>
                <?php get_search_form(); ?>
            <?php endif; ?>
        </div>
    </div>
</article>