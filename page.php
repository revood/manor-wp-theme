<?php
/**
 * The template for displaying pages.
 *
 * @package Revood
 */

get_header();
?>

<main id="primary" class="site-main" role="main">
	<?php
	while ( have_posts() ) {
		the_post();
		get_template_part( 'template-parts/content', 'page' );

		if ( comments_open() || get_comments_number() ) {
			comments_template();
		}
	}
	?>
</main>

<?php
get_footer();
