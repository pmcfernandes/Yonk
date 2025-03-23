<?php

    if (!defined('ABSPATH')) {
        exit;
    }

    function Yonk_disable_wp_rest_api($access) {
        if (!is_user_logged_in()) {
            http_response_code(404);
            die();
        }

        return $access;
    }

    add_filter('rest_authentication_errors', 'Yonk_disable_wp_rest_api');
