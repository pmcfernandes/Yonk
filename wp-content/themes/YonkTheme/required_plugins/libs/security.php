<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

class WP_Security_Boost {
    public function __construct() {
        // Hook into WordPress
        add_action('init', array($this, 'init_security_measures'));
        add_filter('authenticate', array($this, 'check_failed_login'), 30, 3);
        add_action('wp_login_failed', array($this, 'log_failed_login'));
        add_filter('wp_headers', array($this, 'add_security_headers'));
        add_action('admin_init', array($this, 'force_strong_passwords'));
    }

    public function init_security_measures() {
        // Disable user enumeration
        if (!is_admin() && isset($_GET['author'])) {
            wp_redirect(home_url(), 301);
            exit;
        }

        // Disable file editing in the WordPress dashboard
        if (!defined('DISALLOW_FILE_EDIT')) {
            define('DISALLOW_FILE_EDIT', true);
        }
    }

    public function check_failed_login($user, $username, $password) {
        $failed_login_limit = 5; // Number of allowed failed logins
        $lockout_duration = 15 * MINUTE_IN_SECONDS; // 15 minutes lockout

        $failed_login_count = get_transient('failed_login_count_' . $username);

        if ($failed_login_count && $failed_login_count >= $failed_login_limit) {
            $lockout_time = get_transient('login_lockout_' . $username);
            if ($lockout_time) {
                return new WP_Error('too_many_failed_logins', sprintf(__('Too many failed login attempts. Please try again in %d minutes.'), ceil(($lockout_time - time()) / 60)));
            }
        }

        return $user;
    }

    public function log_failed_login($username) {
        $failed_login_limit = 5;
        $lockout_duration = 15 * MINUTE_IN_SECONDS;

        $failed_login_count = get_transient('failed_login_count_' . $username);
        $failed_login_count = $failed_login_count ? $failed_login_count + 1 : 1;

        if ($failed_login_count >= $failed_login_limit) {
            set_transient('login_lockout_' . $username, time() + $lockout_duration, $lockout_duration);
            set_transient('failed_login_count_' . $username, $failed_login_count, $lockout_duration);
        } else {
            set_transient('failed_login_count_' . $username, $failed_login_count, 12 * HOUR_IN_SECONDS);
        }
    }

    public function add_security_headers($headers) {
        $headers['X-Frame-Options'] = 'SAMEORIGIN';
        $headers['X-XSS-Protection'] = '1; mode=block';
        $headers['X-Content-Type-Options'] = 'nosniff';
        $headers['Referrer-Policy'] = 'strict-origin-when-cross-origin';
        $headers['Strict-Transport-Security'] = 'max-age=31536000; includeSubDomains; preload';

        return $headers;
    }

    public function force_strong_passwords() {
        if (isset($_POST['action']) && $_POST['action'] === 'resetpass') {
            $password = isset($_POST['pass1']) ? $_POST['pass1'] : '';
            if (!$this->is_password_strong($password)) {
                wp_die('Please choose a stronger password. It should be at least 12 characters long and include uppercase and lowercase letters, numbers, and special characters.');
            }
        }
    }

    private function is_password_strong($password) {
        if (strlen($password) < 12) {
            return false;
        }
        if (!preg_match('/[A-Z]/', $password) || !preg_match('/[a-z]/', $password) || !preg_match('/[0-9]/', $password) || !preg_match('/[^A-Za-z0-9]/', $password)) {
            return false;
        }
        return true;
    }
}

// Initialize the plugin
new WP_Security_Boost();
