<?php

    if (!defined('ABSPATH')) {
        exit;
    }

    define('MY_ACF_PATH', trailingslashit(get_template_directory()) . 'required_plugins/acf/');
    define('MY_ACF_URL', (get_template_directory_uri()) . '/required_plugins/acf/');

    /**
     * Required: include ACF.
     */
    include_once(MY_ACF_PATH . 'acf.php');

    /**
     * Customize the url setting to fix incorrect asset URLs.
     *
     * @return void
     */
    function my_acf_settings_url($url)
    {
        return MY_ACF_URL;
    }

    add_filter('acf/settings/url', 'my_acf_settings_url');

    /**
     * Show acf in wordpress admin menu
     *
     * @return void
     */
    function my_acf_show_admin_menus()
    {
        if (!current_user_can('administrator')) {
            add_filter('acf/settings/show_admin', '__return_false');
        }

        add_filter('acf/settings/show_updates', '__return_false', 100);
    }

    add_action('init', 'my_acf_show_admin_menus');

    /**
     * Update Google Maps API key for ACF
     *
     * @return void
     */
    function my_acf_init() {
        $key = ot_get_option('google_api_key', GOOGLE_MAPS_API_KEY);

        if (!empty($key)) {
            acf_update_setting('google_api_key', $key);
        }
    }

    add_action('acf/init', 'my_acf_init');


