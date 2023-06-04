<?php defined('ABSPATH') or die('No script kiddies please!'); 
/**
 * The template for displaying 404 page.
 *
 * Used to display 404 error pages if page or post don't exist.
 * If you'd like to further customize these archive views, you may create a new template file for each specific one.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage YonkTheme
 * @since 1.0
*/
?>
<?php
    http_response_code(404);
    die();
?>