<?php
/**
 * The template for displaying comments.
 *
 * @package Revood
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}

?>

<section id="comments" class="comments">

	<?php if ( have_comments() ) : ?>
		<h3 class="comments-title">
			<?php
			$manor_comments_number = get_comments_number();
			echo esc_html(
				sprintf(
					/* translators: 1: number of comments, 2: post title */
					_nx( '%1$s Reply to &ldquo;%2$s&ldquo;', '%1$s Replies to &ldquo;%2$s&ldquo;', $manor_comments_number, 'comments title', 'manor' ),
					number_format_i18n( $manor_comments_number ),
					get_the_title()
				)
			);
			?>
		</h3>

		<ol class="comment-list">
			<?php
			wp_list_comments(
				array(
					'avatar_size' => 64,
					'style'       => 'ol',
					'short_ping'  => true,
					'reply_text'  => __( 'Reply', 'manor' ),
				)
			);
			?>
		</ol>

		<?php
		the_comments_pagination(
			array(
				'prev_text' => __( 'Previous', 'manor' ),
				'next_text' => __( 'Next', 'manor' ),
			)
		);
		?>

	<?php endif; // have_comments() ?>

	<?php if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
		<p class="comments-close"><?php esc_html_e( 'Comments are closed.', 'manor' ); ?></p>
	<?php endif; ?>

	<?php comment_form(); ?>

</section>
<!-- /#comments.comments -->
