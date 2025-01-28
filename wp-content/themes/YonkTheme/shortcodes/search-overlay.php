<?php

if (!defined('ABSPATH')) {
    exit;
}


function search_overlay_func($atts)
{
    ob_start();
?>

    <div class="search-icon-container">
        <a class="search-icon" data-bs-toggle="offcanvas" href="#searhOffcanvas" role="button" aria-controls="searhOffcanvas">
            <i class="fa fa-search"></i>
        </a>

        <div class="search-overlay offcanvas offcanvas-start" tabindex="-1" id="searhOffcanvas" aria-labelledby="searhOffcanvasLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="searhOffcanvasLabel"><?php echo esc_attr_x('Search', 'submit button', 'blank'); ?></h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="search-overlay-content offcanvas-body">
                <?php get_search_form(); ?>
            </div>
        </div>
    </div>


<?php

    $content = ob_get_clean();
    return $content;
}

add_shortcode('search_overlay', 'search_overlay_func');
