<?php defined('ABSPATH') or die('No script kiddies please!'); 

/**
 * The Header for our theme.
 * Displays all of the head section and everything up till.
 *
 * @package WordPress
 * @subpackage YonkTheme
 * @since 1.0
 */

    $options = get_option('Yonk_theme_options');

    if ($options) {
        extract($options);
    }        
?>
<!doctype html>
<html class="no-js" <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo('charset'); ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title><?php wp_title('|', true, 'right'); ?></title>

        <!-- Favorites and mobile bookmark icons -->
        <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.ico">
    	<link rel="apple-touch-icon-precomposed" href="<?php echo get_stylesheet_directory_uri(); ?>/apple-touch-icon.png">

        <!-- WP headers --> 
        <?php wp_head(); ?>
	</head>
<body <?php body_class(); ?>>
    <?php do_action('Yonk_body_start'); ?>
    <div id="wrapper" class="container-fluid">
        <div class="<?php echo $container; ?>">
            <?php do_action('Yonk_header_before'); ?>
            <header id="header" role="banner">
                <div class="row">
                    <div class="col-xs-12 col-sm-5 col-md-3 col-lg-3">
                        <a href="<?php echo site_url() ?>">
                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/logo.png" class="logo" alt="<?php wp_title('|', true, 'right'); ?>" />
                        </a>
                    </div>
                    <div class="col-xs-12 col-sm-7 col-md-9 col-lg-9 text-right">
                        <?php get_template_part('template-parts/menu'); ?>
                    </div>
                </div>
            </header>
            <?php do_action('Yonk_header_after'); ?>

            <!-- Main content area -->
            <?php do_action('Yonk_content_before'); ?>
            <div id="content" class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">