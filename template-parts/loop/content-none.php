<?php
/**
 * Template for displaying a message that posts cannot be found.
 *
 * @package Revood
 */

?>

<article id="post-0" class="not-found">
	<header class="entry-header">
		<h3 class="entry-title"><?php _e( 'Nothing found', 'manor' ); ?></h3>
	</header>

	<div class="entry-content">
		<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'manor' ); ?>
		<?php get_search_form(); ?>
	</div>
</article>
<!-- #post-0 -->
