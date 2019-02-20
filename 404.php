<?php
/**
 * The template for displaying 404 pages.
 *
 * @package Revood
 */

get_header();
?>

<div class="container">
	<main id="primary" class="site-main" role="main">

		<article class="not-found post-0">
			<header class="entry-header">
				<h1 class="entry-title"><?php _e( 'Oops! That page could&rsquo;t be found.', 'manor' ); ?></h1>
			</header>

			<div class="entry-content">
				<p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'manor' ); ?></p>
				<?php get_search_form(); ?>
			</div>
		</article>

	</main>
</div>

<?php
get_footer();
