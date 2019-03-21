<?php
/**
 * Main template file.
 *
 * @package Revood
 */

get_header();
?>

<?php if ( is_archive() ) : ?>
	<header class="page-header">
		<?php the_archive_title( '<h1 class="page-title">', '</h1>' ); ?>
		<?php the_archive_description( '<div class="page-description">', '</div>' ); ?>
	</header>
<?php elseif ( is_search() ) : ?>
	<?php if ( have_posts() ) : ?>
		<header class="page-header">
			<h1 class="page-title">
				<?php
				/* translators: %s: search query */
				printf( esc_html__( 'Search results for: %s', 'manor' ), '<span class="search-query">' . esc_attr( get_search_query() ) . '</span>' );
				?>
			</h1>
		</header>
	<?php endif; ?>
<?php endif; ?>

<div class="container">
	<main id="primary" class="entries site-main" role="main">
	<?php
	if ( have_posts() ) {
		while ( have_posts() ) {
			the_post();
			get_template_part( 'template-parts/loop/content', get_post_format() );
		}

		the_posts_pagination(
			array(
				'before_page_number' => '<span class="screen-reader-text">' . __( 'Page', 'manor' ) . '</span>',
			)
		);
	} else {
		get_template_part( 'template-parts/loop/content', 'none' );
	}
	?>
	</main>
</div>

<?php
get_footer();
