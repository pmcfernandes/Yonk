<?php defined('ABSPATH') or die('No script kiddies please!'); ?>
<?php
    define('DISALLOW_FILE_EDIT', true);
    
    require_once dirname(__FILE__) . '/required_plugins/index.php';
    require_once dirname(__FILE__) . '/vendor/autoload.php';
    require_once dirname(__FILE__) . '/shortcodes/qrcode.php';

    /**
     * Register custom scripts in frontend
     * Hook into the 'wp_enqueue_scripts' action
     * 
     * @return void
     */
    function Yonk_register_scripts() {
        wp_register_script('bootstrap', get_template_directory_uri() . '/assets/js/all.min.js', array('jquery'), '1.2.0', true);
        wp_enqueue_script('bootstrap');

        if (is_singular()) {
            wp_enqueue_script('comment-reply');
        }
    }

    add_action('wp_enqueue_scripts', 'Yonk_register_scripts');

    /**
     * Register custom styles in frontend
     * Hook into the 'wp_enqueue_scripts' action
     * 
     * @return void
     */
    function Yonk_register_styles() {
        wp_register_style('bootstrap', get_template_directory_uri() . '/assets/css/all.min.css', array(), '1.2.0');
        wp_register_style('style', get_template_directory_uri() . '/style.css', array(), '1.2.0');
        wp_register_style('style_Yonk', get_template_directory_uri() . '/assets/css/site.css', array(), '1.2.0');

        wp_enqueue_style('bootstrap');
        wp_enqueue_style('style');
        wp_enqueue_style('style_Yonk');
    }

    add_action('wp_enqueue_scripts', 'Yonk_register_styles', 0);

    /**
     * Register two navigation menus, cam register more, just put that on array.
     * Hook into the 'init' action
     * 
     * @return void
     */
    function Yonk_nav_menus() {
        register_nav_menus(array(
            'primary' 	=> __('Navigation menu', 'blank'),
            'secondary' => __('Footer menu', 'blank'),
        ));
    }

    add_action('init', 'Yonk_nav_menus');
    
    /**
     * Register sidebars for home, pages and posts
     * Hook into the 'widgets_init' action
     * 
     * @return void
     */
    function Yonk_register_siderbar() {
        register_sidebar(array(
            'name' => __('Home Sidebar', 'blank'),
            'id' => 'home',
            'before_widget' => '<aside id="%1$s" class="panel widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h5>',
            'after_title'   => '</h5>',
        ));

        register_sidebar(array(
            'name' => __('Single Sidebar', 'blank'),
            'id' => 'single',
            'before_widget' => '<aside id="%1$s" class="panel widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h5>',
            'after_title'   => '</h5>',
        ));

        register_sidebar(array(
            'name' => __('Page Sidebar', 'blank'),
            'id' => 'page',
            'before_widget' => '<aside id="%1$s" class="panel widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h5>',
            'after_title'   => '</h5>',
        ));

        register_sidebar(array(
            'name' => __('Search Sidebar', 'blank'),
            'id' => 'search',
            'before_widget' => '<aside id="%1$s" class="panel widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h5>',
            'after_title'   => '</h5>',
        ));

        register_sidebar(array(
            'name' => __('Category Sidebar', 'blank'),
            'id' => 'category',
            'before_widget' => '<aside id="%1$s" class="panel widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h5>',
            'after_title'   => '</h5>',
        ));
    }

    add_action('widgets_init', 'Yonk_register_siderbar');

    
    /**
     * Call template for category specified single
     * Hook into the 'single_template' action
     *
     * @param [type] $t
     * @return void
     */
    function Yonk_single_category_template($t) {
        foreach ((array) get_the_category() as $cat) {
            if ($cat->category_parent == 0) {
                $cat_id = $cat->cat_ID;
            } else {
                $cat_id = $cat->category_parent;
            }

            if (file_exists(get_template_directory() . "/single-cat-{$cat_id}.php"))  {
                return get_template_directory() . "/single-cat-{$cat_id}.php";
            }
        }

        return $t;
    }

    add_filter('single_template', 'Yonk_single_category_template');

    /**
     * Load languages from child theme instead of the default
     * 
     * @return void
     */
    function Yonk_load_theme_textdomain() {
        
        load_theme_textdomain('blank', get_template_directory() . '/languages');
        load_child_theme_textdomain('YonkTheme', get_stylesheet_directory() . '/languages');

    }
    
    add_action('after_setup_theme', 'Yonk_load_theme_textdomain');