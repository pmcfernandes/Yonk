<?php

if (!defined('ABSPATH')) {
    exit;
}

// Load all PHP classes in custom-types directory

$dir = get_stylesheet_directory() . DIRECTORY_SEPARATOR . 'custom-types';
if (!is_dir($dir) || !is_readable($dir)) {
    return;
}

$files = scandir($dir);
if ($files === false) {
    return;
}

foreach ($files as $file) {
    if (pathinfo($file, PATHINFO_EXTENSION) === 'php') {
        require_once $dir . DIRECTORY_SEPARATOR  . $file;
    }
}

/**
 * Custom functions that act independently of the theme templates
 * Eventually, some of the functionality here could be replaced by core features
 */

