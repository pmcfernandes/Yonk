<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Register the Farmacias widget.
 *
 * @param \Elementor\Widgets_Manager $widgets_manager The Widgets Manager instance.
 */
function register_farmacias_widget($widgets_manager)
{
    require_once(__DIR__ . '/widgets/farmacias-widget.php');
    $widgets_manager->register(new \Elementor_Farmacias_Widget());
}

add_action('elementor/widgets/register', 'register_farmacias_widget');
