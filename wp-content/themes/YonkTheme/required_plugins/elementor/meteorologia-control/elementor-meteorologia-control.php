<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Register the Farmacias widget.
 *
 * @param \Elementor\Widgets_Manager $widgets_manager The Widgets Manager instance.
 */
function register_meteorologia_widget($widgets_manager)
{
    require_once(__DIR__ . '/widgets/meteorologia-widget.php');
    $widgets_manager->register(new \Elementor_Meteorologia_Widget());
}

add_action('elementor/widgets/register', 'register_meteorologia_widget');
