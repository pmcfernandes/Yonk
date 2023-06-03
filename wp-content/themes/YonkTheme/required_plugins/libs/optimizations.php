<?php defined('ABSPATH') or die('No script kiddies please!'); ?>
<?php

    /**
     * Optimize and remove some head actions
     */
    function Yonk_head_cleanup() {
        remove_action('wp_head', 'rsd_link');
        remove_action('wp_head', 'wlwmanifest_link');
        remove_action('wp_head', 'index_rel_link');
        remove_action('wp_head', 'parent_post_rel_link', 10, 0);
        remove_action('wp_head', 'start_post_rel_link', 10, 0);
        remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
        remove_action('wp_head', 'wp_generator');
    }

    add_action('init', 'Yonk_head_cleanup');

    /**
     * Customize the title for the home page, if one is not set.
     *
     * @param string $title The original title.
     * @return string The title to use.
     */
    function Yonk_wp_title($title) {
        return $title . get_bloginfo('blog_title');
    }

    add_filter('wp_title', 'Yonk_wp_title');

    /**
     * Remove menu css class items because is not necessary if use Bootstrap
     *
     * @param $var
     * @return array
     */
    function Yonk_css_attributes_filter($var) {
        $c = $var;

        if (in_array('current-menu-item', $var))
            $c[] = 'active';
        if (in_array('menu-item-has-children', $var))
            $c[] = 'has-dropdown';

        unset($c['current-menu-item']);
        unset($c['menu-item']);
        unset($c['menu-item-type-post_type']);
        unset($c['menu-item-object-post']);
        unset($c['menu-item-has-children']);

        return $c;
    }

    add_filter('nav_menu_css_class', 'Yonk_css_attributes_filter', 100, 1);

    /**
     * Register Theme Features
     * Hook into the 'after_setup_theme' action
     */
    function Yonk_theme_features() {
        // Add theme support for HTML5 Semantic Markup
        add_theme_support('automatic-feed-links');
        add_theme_support('title-tag');
        add_theme_support('menus');
        add_theme_support('html5', array('search-form', 'gallery', 'caption', 'comment-list', 'comment-form'));
        add_theme_support('post-formats', array('image', 'video', 'audio', 'quote', 'link', 'gallery'));
        add_theme_support('custom-background',  array(
            'default-image' => '',
            'default-color' => '',
            'wp-head-callback' => '_custom_background_cb',
            'admin-head-callback' => '',
            'admin-preview-callback' => ''
        ));
        add_theme_support('post-thumbnails', array('post'));
        set_post_thumbnail_size(125, 125, true);
        add_editor_style(array('style.css'));
    }

    add_action('after_setup_theme', 'Yonk_theme_features', 10);

    /**
     * Sanitize filename on Upload to remove spaces or acents
     * Hook into the 'sanitize_file_name' filter
     */
    function Yonk_sanitize_filename_on_upload($filename) {
        $array = explode('.', $filename);
        $ext = end($array);
        $sanitized = preg_replace('/[^a-zA-Z0-9-_.]/', '', substr($filename, 0, -(strlen($ext) + 1)));
        $sanitized = str_replace('.', '-', $sanitized);

        return strtolower($sanitized . '.' . $ext);
    }

    add_filter('sanitize_file_name', 'Yonk_sanitize_filename_on_upload', 10);

    /**
     * Remove WordPress from RSS feeds
     */
    add_filter('the_generator', '__return_false');