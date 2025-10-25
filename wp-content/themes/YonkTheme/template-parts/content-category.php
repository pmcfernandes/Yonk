<?php

    if (!defined('ABSPATH')) {
        exit;
    }

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> role="article" itemscope
    itemtype="http://schema.org/Article">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <h3 itemprop="name"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
            <div class="meta">
                <p class="date" itemprop="datePublished"><?php esc_html_e(get_the_date()); ?></p>
                <div class="category_name" itemprop="genre"><?php the_category(', '); ?></div>
            </div>
        </div>
    </div>
    <div class="row">
        <?php if (has_post_thumbnail()): ?>
            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-3">
                <?php the_post_thumbnail('thumbnail', array('class' => 'img-fluid', 'itemprop' => 'image')); ?>
            </div>
        <?php endif; ?>
        <div
            class="col-xs-12 col-sm-<?php echo (has_post_thumbnail() ? "8" : "12"); ?> col-md-<?php echo (has_post_thumbnail() ? "8" : "12"); ?> col-lg-<?php echo (has_post_thumbnail() ? "9" : "12"); ?>">
            <div itemprop="headline"><?php the_excerpt(); ?></div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <a href="<?php the_permalink(); ?>" class="btn btn-link" itemprop="url">
                <?php esc_html_e('Read more', 'blank'); ?>
            </a>
        </div>
    </div>
</article>
