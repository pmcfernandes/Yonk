<?php defined('ABSPATH') or die('No script kiddies please!');?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> role="article" itemscope itemtype="http://schema.org/Article">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <header class="page-header">
                <h1 itemprop="name"><?php the_title(); ?></h1>
            </header>
            <div class="meta">
                <p class="date" itemprop="datePublished"><?php the_date(); ?></p>
                <div class="category_name" itemprop="genre"><?php the_category(', '); ?></div>
            </div>
        </div>
    </div>
    <?php get_template_part('post-formats/format', get_post_format()); ?>
</article>
<?php echo get_template_part('author'); ?>