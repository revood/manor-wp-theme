<?php
/**
 * Template part for displaying page content
 *
 * @package Revood
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header>

	<div class="entry-content">
		<div class="clearfix">
			<?php the_content(); ?>
		</div>
		<?php wp_link_pages(); ?>
	</div>

</article>
<!-- /#post-## -->
