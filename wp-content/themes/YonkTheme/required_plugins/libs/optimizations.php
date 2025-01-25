<?php

    if (!defined('ABSPATH')) {
        exit;
    }

    /**
     * Optimize and remove some head actions
     * 
     * @return void
     */
    function Yonk_head_cleanup() {
        remove_action('wp_head', 'rsd_link');
        remove_action('wp_head', 'wlwmanifest_link');
        remove_action('wp_head', 'index_rel_link');
        remove_action('wp_head', 'parent_post_rel_link', 10, 0);
        remove_action('wp_head', 'start_post_rel_link', 10, 0);
        remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
        remove_action('wp_head', 'wp_generator');

        add_filter('xmlrpc_enabled', '__return_false');
        add_filter('the_generator', '__return_false');

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
     * 
     * @return void
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
     * 
     * @return void
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
     * 
     * @return void
     */
    add_filter('the_generator', '__return_false');

    /**
     *
     * Don't return the default description in the RSS feed if it hasn't been changed
     */
    function Yonk_remove_default_bloginfo($bloginfo) {
        $defaultTagline = 'Just another WordPress site';
        return ($bloginfo === $defaultTagline) ? '' : $bloginfo;
    }

    add_filter('get_bloginfo_rss', 'Yonk_remove_default_bloginfo');

    /**
     * Change language based on lang query string
     * 
     * @param string $local language
     * @return string
     */
    function Yonk_theme_localized($locale) {
        if (isset($_GET['lang'])) {
            return sanitize_key($_GET['lang']);
        }

        return $locale;
    }

    add_filter('locale', 'Yonk_theme_localized');

    /**
     * Disable Heartbeat
     *
     * @return void
     */
    function Yonk_stop_heartbeat() {
        if (get_option('disable_heartbeat') !== null) {
            if (get_option('disable_heartbeat') == 'true') {
                wp_deregister_script('heartbeat');
            }
        }
    }

    add_action('init', 'Yonk_stop_heartbeat', 1);


    /**
     * Disbale post by email configuration 
     * because writing menu is disabled by default in admin settings
     * 
     * @return boolean false
     */
    add_filter('enable_post_by_email_configuration', '__return_false');
