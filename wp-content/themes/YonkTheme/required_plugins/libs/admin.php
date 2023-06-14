<?php defined('ABSPATH') or die('No script kiddies please!'); ?>
<?php

    /**
     * Custom admin scripts.
     * Hook into the 'admin_enqueue_scripts' action
     *
     */
    function Yonk_admin_scripts() {
        wp_enqueue_style('yonk-admin-css', get_stylesheet_directory_uri() . '/assets/css/custom-admin.css');
    }

    add_action('admin_enqueue_scripts', 'Yonk_admin_scripts');

    /**
     * Custom login scripts
     * Hook into the 'login_enqueue_scripts' action
     *
     * @return void
     */
    function Yonk_login_css() {
        wp_enqueue_style('yonk-login-css', get_stylesheet_directory_uri() . '/assets/css/custom-login.css', false);
    }

    add_action('login_enqueue_scripts', 'Yonk_login_css', 10);

    /**
     * Custom login url
     * Hook into the 'login_headerurl' action
     *
     * @return void
     */
    function Yonk_login_url() {
        return home_url();
    }

    add_filter('login_headerurl', 'Yonk_login_url');

    /**
     * Custom login title
     * Hook into the 'Yonk_login_title' action
     *
     * @return void
     */
    function Yonk_login_title() {
        return get_option('blogname');
    }

    add_filter('login_headertext', 'Yonk_login_title');

    /**
     * Remove WordPress logo from admin bar
     * Hook into the 'wp_before_admin_bar_render' action
     * 
     * @return void
     */
    function Yonk_adminbar_remove_logo() {
        global $wp_admin_bar;
        $wp_admin_bar->remove_menu('wp-logo');
    }

    add_action('wp_before_admin_bar_render', 'Yonk_adminbar_remove_logo');

    /**
     * Change copyright of admin footer
     * Hook into the 'admin_footer_text' action
     * 
     * @return void
     */
    function Yonk_change_admin_footer() {
        $theme = wp_get_theme();
        echo 'Fueled by <a href="http://www.wordpress.org" target="_blank">WordPress</a> | Powered by <a href="' . $theme->get('AuthorURI') . '" target="_blank">' . $theme->get('Author') . '</a></p>';
    }

    add_filter('admin_footer_text', 'Yonk_change_admin_footer');

    /**
     * Remove welcome panel from dashboard
     * Hook into the 'welcome_panel' action
     * 
     * @return void
     */
    remove_action('welcome_panel', 'wp_welcome_panel');

    /**
     * Remove dashboard widgets from WordPress Admin Home Panel
     * Hook into the 'admin_init' action
     * 
     * @return void
     */
    function Yonk_remove_dashboard_widgets() {
        remove_meta_box('dashboard_recent_drafts', 'dashboard', 'side');
        remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');
        remove_meta_box('dashboard_incoming_links', 'dashboard', 'normal');
        remove_meta_box('dashboard_primary', 'dashboard', 'normal');
        remove_meta_box('dashboard_secondary', 'dashboard', 'normal');
        remove_meta_box('dashboard_plugins', 'dashboard', 'normal');
        remove_meta_box('dashboard_activity', 'dashboard', 'normal');
        remove_meta_box('yoast_db_widget', 'dashboard', 'normal');
        remove_meta_box('rg_forms_dashboard', 'dashboard', 'normal');
        remove_meta_box('bbp-dashboard-right-now', 'dashboard', 'normal');
        remove_meta_box('e-dashboard-overview', 'dashboard', 'normal');
    }

    add_action('admin_init', 'Yonk_remove_dashboard_widgets');


    /**
     * Add support to new mime types in upload
     * 
     * @param array $mimes
     * @return array
     */
    function Yonk_mime_types($mimes) {
        $mimes['svg']  = 'image/svg+xml';
        $mimes['svgz'] = 'image/svg+xml';
        return $mimes;
    }

    add_filter('upload_mimes', 'Yonk_mime_types');

    /**
     * Remove some unnecessary widgets from widget panel
     * Hook into the 'widgets_init' action
     */
    function Yonk_remove_widget() {
        unregister_widget('WP_Widget_Calendar');
        unregister_widget('WP_Widget_Meta');
        unregister_widget('WP_Widget_Recent_Comments');
        unregister_widget('WP_Widget_RSS');
        unregister_widget('WP_Widget_Tag_Cloud');
    }

    add_action('widgets_init', 'Yonk_remove_widget');

    /**
     * Remove tools menu from admin menu
     */
    function Yonk_remove_tools() {
        remove_menu_page('tools.php');
        remove_submenu_page('options-general.php', 'options-writing.php');
        remove_submenu_page('cptui_main_menu', 'cptui_main_menu');
        remove_submenu_page('cptui_main_menu', 'cptui_support');
    }

    add_action('admin_menu', 'Yonk_remove_tools', 999);

    /* Capable to use shortcodes to Widget Text */
    add_filter('widget_text', 'do_shortcode');