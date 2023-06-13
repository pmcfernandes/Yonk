<?php
defined('ABSPATH') or die('No script kiddies please!');

/**
 * The sidebar containing the main widget area
 *
 * @package WordPress
 * @subpackage YonkTheme
 * @since 1.0
 */ 

if (is_front_page() || is_home()):
	$template = 'home';
elseif (is_page()):
	$template = 'page';
elseif (is_single()):
	$template = 'single';
elseif (is_category() || is_archive()):
	$template = 'category';
elseif (is_search()):
	$template = 'search';
endif;

get_template_part('template-parts/sidebar', $template);
