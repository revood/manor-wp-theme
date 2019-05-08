<?php
/**
 * The header of the Theme.
 *
 * @package Revood
 */

?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

	<header id="mastheader" class="site-header">
		<div class="container">
			<?php the_custom_logo(); ?>

			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
			<?php if ( get_bloginfo( 'description' ) ) : ?>
				<div class="site-description"><?php bloginfo( 'description' ); ?></div>
			<?php endif; ?>
		</div>
	</header>
	<!-- /#mastheader.site-header -->

	<?php if ( has_nav_menu( 'social' ) || is_customize_preview() ) : ?>
	<nav class="social-nav">
		<?php
		wp_nav_menu(
			array(
				'theme_location' => 'social',
				'menu_class'     => 'social-nav-menu',
				'link_before'    => '<span class="screen-reader-text">',
				'link_after'     => '</span>' . manor_get_link_icon(),
				'depth'          => 1,
				'fallback_cb'    => '',
			)
		);
		?>
	</nav>
	<?php endif; ?>

	<nav id="site-nav" class="site-nav">
		<div class="container">
			<button id="site-nav-toggle" class="site-nav-toggle" aria-controls="site-nav-menu" aria-expanded="false">
				<span class="site-nav-toggle-lines">
					<span class="site-nav-toggle-line top"></span>
					<span class="site-nav-toggle-line bottom"></span>
				</span>
				<span class="site-nav-toggle-text"><?php esc_html_e( 'Menu', 'manor' ); ?></span>
			</button>

			<?php
			wp_nav_menu(
				array(
					'theme_location'  => 'primary',
					'container_id'    => 'site-nav-menu',
					'container_class' => 'site-nav-menu-container',
					'fallback_cb'     => 'manor_menu_fallback',
				)
			);
			?>
		</div>
	</nav>
	<!-- /#site-nav.site-nav -->

	<div id="site-content" class="site-content">
