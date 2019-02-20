<?php
/**
 * Template part for displaying post in loop.
 *
 * @package Revood
 */

$media = false;

if ( 'post' === get_post_type() ) {
	$format = get_post_format();
	switch ( $format ) {
		case 'gallery':
			$gallery = manor_get_post_gallery_block();

			if ( empty( $gallery ) ) {
				$gallery = get_post_gallery();
			}

			if ( ! empty( $gallery ) ) {
				$media = '<div class="entry-gallery">' . $gallery . '</div>';
			}
			break;

		case 'video':
			$media = manor_get_post_embed_block();

			if ( empty( $media ) ) {
				$content = apply_filters( 'the_content', get_the_content() );
				$embeds = get_media_embedded_in_content( $content, array( 'video', 'embed', 'iframe', 'object' ) );

				if ( ! empty( $embeds ) ) {
					$media = '';
					foreach ( $embeds as  $embed ) {
						$media .= sprintf( '<div class="entry-%s">%s</div>', $format, $embed );
					}
				}
			} else {
				$media = apply_filters( 'the_content', $media );
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

	<?php if ( has_post_thumbnail() && ! $media ) : ?>
	<div class="entry-thumbnail">
		<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'blog-thumb' ); ?></a>
	</div>
	<!-- /.entry-thumbnail -->
	<?php endif; ?>

	<?php if ( $media ) : ?>
		<div class="entry-media">
			<?php echo $media; ?>
		</div>
	<?php elseif ( isset( $format ) && 'aside' === $format ) : ?>
		<div class="entry-content"><?php the_content(); ?></div>
	<?php else : ?>
		<div class="entry-summary">
			<?php the_excerpt(); ?>
			<p><a href="<?php the_permalink(); ?>" class="read-more">
				<?php
				/* translators: %s: Name of the current post */
				printf( __( 'Continue reading<span class="screen-reader-text">%s</span>', 'manor' ), get_the_title() );
				?>
			</a></p>
			<?php wp_link_pages(); ?>
		</div>
	<!-- /.entry-summary -->
	<?php endif; ?>

</article>

<?php return; ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ( has_post_thumbnail() && ! $media ) : ?>
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

	<?php if ( $media ) : ?>
		<?php echo $media; ?>
	<?php elseif ( isset( $format ) && 'aside' === $format ) : ?>
		<div class="entry-content"><?php the_content(); ?></div>
	<?php else : ?>
		<div class="entry-summary">
			<?php the_excerpt(); ?>
			<p><a href="<?php the_permalink(); ?>" class="read-more">
				<?php
				/* translators: %s: Name of the current post */
				printf( __( 'Continue reading<span class="screen-reader-text">%s</span>', 'manor' ), get_the_title() );
				?>
			</a></p>
			<?php wp_link_pages(); ?>
		</div>
	<!-- /.entry-summary -->
	<?php endif; ?>

	<?php if ( has_post_thumbnail() && ! $media ) : ?>
	</div><!--- /.entry-wrap -->
	<?php endif; ?>
</article>
<!-- /#post-## -->
