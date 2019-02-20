<?php
/**
 * Template part for displaying post content.
 *
 * @package Revood
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header>

	<div class="entry-content">
		<?php
		the_content();
		wp_link_pages();
		?>
	</div>

	<?php manor_entry_footer(); ?>

	<div class="entry-share">
		<div class="entry-author">
			<div class="author vcard">
				<?php echo get_avatar( get_the_author_meta( 'ID' ), 164 ); ?>
				<div>
					<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" class="url fn n"><?php the_author(); ?></a>
					<?php echo wpautop( get_the_author_meta( 'description' ) ); ?>
				</div>
			</div><!-- /.vcard -->
		</div><!-- /.entry-author -->

		<div class="entry-share-links">
			<span class="heading"><?php _e( 'Share', 'manor' ); ?></span>
			<?php manor_share_post_links(); ?>
		</div><!-- /.entry-share-links -->
	</div>

	<?php manor_edit_link(); ?>

</article>
<!-- /#post-## -->
