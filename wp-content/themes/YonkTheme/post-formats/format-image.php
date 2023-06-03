<?php defined('ABSPATH') or die('No script kiddies please!');?>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" itemprop="articleBody">
        <div class="content-format-image">
            <div class="post-format-icon"></div>
            <?php
                $thumb = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full');
                $url = $thumb['0'];
            ?>
            <img src="<?php echo $url; ?>" alt="<?php the_title(); ?>" alt="<?php the_title(); ?>" style="width:100%" itemprop="image" />
            <?php the_content(); ?>
        </div>
    </div>
</div>