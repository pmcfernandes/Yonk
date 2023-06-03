<?php defined('ABSPATH') or die('No script kiddies please!'); ?>
<?php

    /**
     * Load template
     *
     * @param [type] $template_name
     * @param [type] $part_name
     * @return void|string
     */
    function load_template_part($template_name, $part_name = null) {
        ob_start();
        get_template_part($template_name, $part_name);
        $var = ob_get_contents();
        ob_end_clean();
        return $var;
    }

    /**
     * Add search result heading Showinf x - x of y results
     *
     * @return void
     */
    function search_results_heading() {
        global $wp_query;
        $paged = get_query_var('paged') ? get_query_var('paged') : 1;
        $per_page = get_query_var('posts_per_page');
        $start = 1 + $per_page * ($paged - 1);
        $end = $start + $per_page - 1 > $wp_query->found_posts ? $wp_query->found_posts : $start + $per_page - 1;
        $output = 'Showing ' . $start . '-' . $end . ' of ' . $wp_query->found_posts . ' results';
        echo '<div class="search-count">' . $output . '</div>';
    }