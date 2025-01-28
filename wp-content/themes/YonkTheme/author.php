<?php

if (!defined('ABSPATH')) {
    exit;
}

/**
 * The template for displaying the author pages
 *
 * If you'd like to further customize these archive views, you may create a new template file for each specific one.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage YonkTheme
 * @since 1.0
 */

    if (ot_get_option('disable_author', true))
        return;

    do_action('Yonk_author_before');
?>

<section id="authorBox" itemscope itemtype="http://schema.org/Person">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <?php echo get_avatar(get_the_author_meta('email'), 80); ?>
            <div class="meta">
                 <h4 rel="author" itemprop="name"><?php _e('About', 'blank'); ?> <?php the_author(); ?></h4>
                 <p><?php the_author_meta('description'); ?></p>
            </div>
        </div>
    </div>
</section>
<?php
    do_action('Yonk_author_after');
?>
