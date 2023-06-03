<?php
defined('ABSPATH') or die('No script kiddies please!');

/**
 * The template for displaying Comments.
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package WordPress
 * @subpackage YonkTheme
 * @since 1.0
 */

if (post_password_required()) {
	return;
} ?>

<div id="comments" class="comments-area" itemscope itemtype="http://schema.org/Article">
<?php if (have_comments()): ?>
	<h3><span itemprop="commentCount"><?php echo number_format_i18n(get_comments_number()); ?></span> <?php _e('comments', 'blank'); ?>:</h3>
	<?php
		wp_list_comments(array(
			'style'             => 'div',
			'short_ping'        => false,
			'avatar_size'       => 60,
			'type'              => 'all',
			'reply_text'        => __('Reply', 'blank'),
			'page'              => '',
			'per_page'          => '',
			'reverse_top_level' => null,
			'reverse_children'  => ''
		));
	?>
	<?php if (!comments_open()): ?>
		<p class="no-comments">
			<?php _e('Comments are closed.', 'blank'); ?>
		</p>
	<?php endif; ?>
	<?php paginate_comments_links(); ?>
<?php endif; // have_comments() ?>
<?php
	if (comments_open()):
		$args = array(
			'label_submit'	=> __('Send', 'blank'),
			'title_reply'	=> __('Leave here a comment:', 'blank')
		);
		comment_form($args);
	endif;
?>
</div>
