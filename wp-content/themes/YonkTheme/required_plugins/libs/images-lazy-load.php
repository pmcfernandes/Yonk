<?php

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

class Simple_Lazy_Load_Images {

    public function __construct() {
        // Hook into WordPress
        add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));
        add_filter('the_content', array($this, 'modify_image_markup'));
        add_filter('post_thumbnail_html', array($this, 'modify_image_markup'));
    }

    public function enqueue_scripts() {
        // Enqueue the lazy load script
        wp_enqueue_script('simple-lazy-load', get_template_directory_uri() . '/assets/js/lazy-load.js', array(), '1.0', true);
    }

    public function modify_image_markup($content) {
        // Don't lazy load if it's an admin page or feed
        if (is_admin() || is_feed()) {
            return $content;
        }

        // Use preg_replace_callback to modify each image tag
        $content = preg_replace_callback('/<img([^>]+)>/i', function($matches) {
            $old_attributes = $matches[1];

            // Don't lazy load images that already have loading="lazy"
            if (strpos($old_attributes, 'loading="lazy"') !== false) {
                return $matches[0];
            }

            // Extract src and srcset
            $src = '';
            $srcset = '';
            if (preg_match('/src=["\'](.*?)["\']/i', $old_attributes, $src_match)) {
                $src = $src_match[1];
                $old_attributes = preg_replace('/src=["\'](.*?)["\']/i', '', $old_attributes);
            }
            if (preg_match('/srcset=["\'](.*?)["\']/i', $old_attributes, $srcset_match)) {
                $srcset = $srcset_match[1];
                $old_attributes = preg_replace('/srcset=["\'](.*?)["\']/i', '', $old_attributes);
            }

            // Build the new image tag
            $new_tag = '<img' . $old_attributes;
            $new_tag .= ' loading="lazy"';
            $new_tag .= ' data-src="' . esc_attr($src) . '"';
            if ($srcset) {
                $new_tag .= ' data-srcset="' . esc_attr($srcset) . '"';
            }
            $new_tag .= ' src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"'; // 1x1 transparent gif
            $new_tag .= '>';

            return $new_tag;
        }, $content);

        return $content;
    }
}

add_action('init', function () {
    
    if (ot_get_option('enable_lazy_load_images', false) == true) {
        new Simple_Lazy_Load_Images();
    }
    
});


