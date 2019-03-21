<?php
/**
 * Template part for displaying post in loop.
 *
 * @package Revood
 */

$manor_media = false;

if ( 'post' === get_post_type() ) {
	$manor_format = get_post_format();
	switch ( $manor_format ) {
		case 'gallery':
			$manor_gallery = manor_get_post_gallery_block();

			if ( empty( $manor_gallery ) ) {
				$manor_gallery = get_post_gallery();
			}

			if ( ! empty( $manor_gallery ) ) {
				$manor_media = '<div class="entry-gallery">' . $manor_gallery . '</div>';
			}
			break;

		case 'video':
			$manor_media = manor_get_post_embed_block();

			if ( empty( $manor_media ) ) {
				$manor_content = apply_filters( 'the_content', get_the_content() );
				$manor_embeds = get_media_embedded_in_content( $manor_content, array( 'video', 'embed', 'iframe', 'object' ) );

				if ( ! empty( $manor_embeds ) ) {
					$manor_media = '';
					foreach ( $manor_embeds as  $manor_embed ) {
						$manor_media .= sprintf( '<div class="entry-%s">%s</div>', $manor_format, $manor_embed );
					}
				}
			} else {
				$manor_media = apply_filters( 'the_content', $manor_media );
			}
			break;
	}
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">
		<?php if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta"><?php manor_posted_on(); ?></div>
		<!-- /.entry-meta -->
		<?php endif; ?>

		<?php the_title( '<h3 class="entry-title"><a rel="bookmark" href="' . esc_url( get_permalink() ) . '">', '</a></h1>' ); ?>
	</header>
	<!-- /.entry-header -->

	<?php if ( has_post_thumbnail() && ! $manor_media ) : ?>
	<div class="entry-thumbnail">
		<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'blog-thumb' ); ?></a>
	</div>
	<!-- /.entry-thumbnail -->
	<?php endif; ?>

	<?php if ( $manor_media ) : ?>
		<div class="entry-media">
			<?php echo $manor_media; ?>
		</div>
	<?php elseif ( isset( $manor_format ) && 'aside' === $manor_format ) : ?>
		<div class="entry-content"><?php the_content(); ?></div>
	<?php else : ?>
		<div class="entry-summary">
			<?php the_excerpt(); ?>
			<p><a href="<?php the_permalink(); ?>" class="read-more">
				<?php
				/* translators: %s: Name of the current post */
				printf( __( 'Continue reading<span class="screen-reader-text">%s</span>', 'manor' ), esc_html( get_the_title() ) );
				?>
			</a></p>
			<?php wp_link_pages(); ?>
		</div>
	<!-- /.entry-summary -->
	<?php endif; ?>

</article>

<?php return; ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ( has_post_thumbnail() && ! $manor_media ) : ?>
	<div class="entry-thumbnail">
		<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'blog-thumb' ); ?></a>
	</div>
	<div class="entry-wrap">
	<?php endif; ?>

	<header class="entry-header">
		<?php if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta"><?php manor_posted_on(); ?></div>
		<!-- /.entry-meta -->
		<?php endif; ?>

		<?php the_title( '<h3 class="entry-title"><a rel="bookmark" href="' . esc_url( get_permalink() ) . '">', '</a></h1>' ); ?>
	</header>
	<!-- /.entry-header -->

	<?php if ( $manor_media ) : ?>
		<?php echo $manor_media; ?>
	<?php elseif ( isset( $manor_format ) && 'aside' === $manor_format ) : ?>
		<div class="entry-content"><?php the_content(); ?></div>
	<?php else : ?>
		<div class="entry-summary">
			<?php the_excerpt(); ?>
			<p><a href="<?php the_permalink(); ?>" class="read-more">
				<?php
				/* translators: %s: Name of the current post */
				printf( __( 'Continue reading<span class="screen-reader-text">%s</span>', 'manor' ), esc_html( get_the_title() ) );
				?>
			</a></p>
			<?php wp_link_pages(); ?>
		</div>
	<!-- /.entry-summary -->
	<?php endif; ?>

	<?php if ( has_post_thumbnail() && ! $manor_media ) : ?>
	</div><!--- /.entry-wrap -->
	<?php endif; ?>
</article>
<!-- /#post-## -->
