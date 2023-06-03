<?php defined('ABSPATH') or die('No script kiddies please!');?>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" itemprop="articleBody">
        <div class="content-format-link">
            <div class="post-format-icon"></div>
            <?php 
                if (has_post_format('link')):
                    $content = get_the_content();
                    $linktoend = stristr($content, "http" );
                    $afterlink = stristr($linktoend, ">");
                    if (!strlen($afterlink) == 0):
                        $linkurl = substr($linktoend, 0, - (strlen($afterlink) + 1));
                    else:
                        $linkurl = $linktoend;
                    endif;
            ?>
            <a href="<?php echo $linkurl; ?>">
                <?php the_content(); ?>
            </a>
            <?php endif; ?>
        </div>
    </div>
</div>