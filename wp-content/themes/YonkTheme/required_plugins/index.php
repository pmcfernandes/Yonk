<?php defined('ABSPATH') or die('No script kiddies please!'); ?>
<?php
    require_once 'class-tgm-plugin-activation.php';    
    require_once 'acf.php';
    require_once 'vendor/autoload.php';
    require_once 'libs/navmenu.php';
    require_once 'libs/pagenavi.php';
    require_once 'libs/optimizations.php';
    require_once 'libs/admin.php';
    require_once 'libs/functions.php';
    require_once 'libs/customizer.php';
    require_once 'libs/tinymce_editor.php';

    function Yonk_register_required_plugins() {
        /*
        * Array of plugin arrays. Required keys are name and slug.
        * If the source is NOT from the .org repo, then source is also required.
        */
        $plugins = array(

            // This is an example of how to include a plugin bundled with a theme.
            array(
                'name'               => 'Elementor',
                'slug'               => 'elementor',
                'source'             => 'https://downloads.wordpress.org/plugin/elementor.3.9.2.zip',
                'required'           => true,
                'version'            => '3.9.2',
                'force_activation'   => false,
                'force_deactivation' => false,
                'external_url'       => 'https://pt.wordpress.org/plugins/elementor/',
                'is_callable'        => '',
            ),

            array(
                'name'               => 'Classic Widgets',
                'slug'               => 'classic-widgets',
                'source'             => 'https://downloads.wordpress.org/plugin/classic-widgets.0.3.zip',
                'required'           => true,
                'version'            => '0.3',
                'force_activation'   => false,
                'force_deactivation' => false,
                'external_url'       => 'https://pt.wordpress.org/plugins/classic-widgets/',
                'is_callable'        => '',
            ),

            array(
                'name'               => 'Classic Editor',
                'slug'               => 'classic-editor',
                'source'             => 'https://downloads.wordpress.org/plugin/classic-editor.1.6.2.zip',
                'required'           => true,
                'version'            => '1.6.2',
                'force_activation'   => false,
                'force_deactivation' => false,
                'external_url'       => 'https://pt.wordpress.org/plugins/classic-editor/',
                'is_callable'        => '',
            ),

        );

        $config = array(
            'id'           => 'blank',                 // Unique ID for hashing notices for multiple instances of TGMPA.
            'default_path' => '',                      // Default absolute path to bundled plugins.
            'menu'         => 'tgmpa-install-plugins', // Menu slug.
            'parent_slug'  => 'themes.php',            // Parent menu slug.
            'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
            'has_notices'  => true,                    // Show admin notices or not.
            'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
            'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
            'is_automatic' => false,                   // Automatically activate plugins after installation or not.
            'message'      => '',                      // Message to output right before the plugins table.
        );

        tgmpa( $plugins, $config );
    }

    add_action( 'tgmpa_register', 'Yonk_register_required_plugins' );