<?php
/**
 * Sidebar template.
 *
 * @package Revood
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}

?>

<aside id="secondary" class="widget-area" role="complementary">
	<div class="container">
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	</div>
</aside>
<!-- /#secondary.widget-area -->
