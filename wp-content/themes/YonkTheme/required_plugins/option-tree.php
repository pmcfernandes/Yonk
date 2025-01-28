<?php

    if (!defined('ABSPATH')) {
        exit;
    }

    /**
     * Required: include OptionTree.
     */
    require(trailingslashit(__DIR__) . 'option-tree/ot-loader.php');

    /**
     * Required: set 'ot_theme_mode' filter to true.
     */
    add_filter('ot_theme_mode', '__return_true');


