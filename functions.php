<?php
/**
 * Theme functions & definitions.
 *
 * @package Revood
 */

if ( ! function_exists( 'manor_setup' ) ) :
	/**
	 * Setup theme defaults & registers supports for various WordPress features.
	 */
	function manor_setup() {
		// Load translations for the theme.
		load_theme_textdomain( 'manor' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		// Let WordPress manage the document title.
		add_theme_support( 'title-tag' );

		// Enable support for post thumbnails.
		add_theme_support( 'post-thumbnails' );
		add_image_size( 'blog-thumb', 720, 720, true );

		// Switch core default markup to ouput valid HTML5.
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);

		// Setup custom logo support
		add_theme_support(
			'custom-logo',
			array(
				'flex-width'  => true,
				'flex-height' => true,
				'header-text' => array( 'site-title', 'site-description' ),
			)
		);

		// Register support for post formats.
		add_theme_support(
			'post-formats',
			array(
				'aside',
				'gallery',
				'video',
			)
		);

		// Add support for selective refresh.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Register navigation menus.
		register_nav_menus(
			array(
				'primary' => __( 'Primary', 'manor' ),
				'footer'  => __( 'Footer Menu', 'manor' ),
				'social'  => __( 'Social Links Menu', 'manor' ),
			)
		);

		// Add support for Block Styles.
		add_theme_support( 'wp-block-styles' );

		// Add support for full and wide align images.
		add_theme_support( 'align-wide' );

		// Add support for editor styles.
		add_theme_support( 'editor-styles' );

		// Add support for editor stylesheet.
		add_editor_style( 'style-editor.css' );

		// Add support for responsive embeds content.
		add_theme_support( 'responsive-embeds' );

		// Editor color palette.
		add_theme_support(
			'editor-color-palette',
			array(
				array(
					'name' => __( 'Primary color', 'manor' ),
					'slug' => 'primary',
					'color' => get_theme_mod( 'primary_color' ) ? get_theme_mod( 'primary_color' ) : '#DF6296',
				),
				array(
					'name' => __( 'Black', 'manor' ),
					'slug' => 'black',
					'color' => '#363636',
				),
				array(
					'name' => __( 'White', 'manor' ),
					'slug' => 'white',
					'color' => '#fff',
				),
			)
		);

		// Add starter content.
		add_theme_support(
			'starter-content',
			array(
				'widgets' => array(
					'sidebar-1' => array(
						'search',
						'text_about',
						'recent-comments',
					),
				),
				'nav_menus' => array(
					'social' => array(
						'name' => __( 'Social Links Menu', 'manor' ),
						'items' => array(
							'link_facebook',
							'link_twitter',
							'link_instagram',
						),
					),
				),
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'manor_setup' );

/**
 * Set the content width in pixels, based on the Theme's design and stylesheet.
 *
 * @global int $content_width
 */
function manor_content_width() {
	/**
	 * Filters the content width of the theme.
	 *
	 * @param int $manor_content_width
	 */
	$manor_content_width = apply_filters( 'manor_content_width', 800 );

	$GLOBALS['content_width'] = $manor_content_width;
}
add_action( 'after_setup_theme', 'manor_content_width', 0 );

/**
 * Register widget areas.
 */
function manor_widgets_init() {
	register_sidebar(
		array(
			'id'            => 'sidebar-1',
			'name'          => __( 'Footer Widget Area', 'manor' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
			'after_widget'  => '</section>',
		)
	);
}
add_action( 'widgets_init', 'manor_widgets_init' );

/**
 * Enqueue scripts & styleshseets.
 */
function manor_enqueue_scripts() {
	// Scripts.
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	if ( has_nav_menu( 'primary' ) ) {
		wp_enqueue_script( 'manor-navigation', get_parent_theme_file_uri( 'js/navigation.js' ), array(), '0.1.0', true );
		wp_localize_script(
			'manor-navigation',
			'_btl10n',
			array(
				'expand'   => __( 'Expand child menu', 'manor' ),
				'collapse' => __( 'Collapse child menu', 'manor' ),
			)
		);
	}

	// Stylesheets.
	wp_enqueue_style( 'open-sans' );
	wp_enqueue_style( 'manor-main', get_parent_theme_file_uri( 'style.css' ), array( 'open-sans' ), '0.1.0' );
	if ( is_child_theme() ) {
		wp_enqueue_style( 'manor-child-theme', get_stylesheet_uri() );
	}
}
add_action( 'wp_enqueue_scripts', 'manor_enqueue_scripts' );

/**
 * Output colorscheme css.
 */
function manor_output_color_scheme_css() {
	$primary_color = strtoupper( get_theme_mod( 'primary_color' ) );

	// Don't output if primary color isn't changed.
	if ( ! $primary_color || '#DF6296' === $primary_color ) {
		return;
	}

	echo '<style id="manor-color-scheme-css" type="text/css">' . manor_get_color_scheme_css( $primary_color, manor_darken_color( $primary_color, 15 ) ) . '</style>';
}
add_action( 'wp_head', 'manor_output_color_scheme_css', 100 );

/**
 * Add colorscheme css to block editor.
 *
 * @param array $editor_settings
 * @return array
 */
function manor_block_editor_settings( $editor_settings ) {
	$primary_color = strtoupper( get_theme_mod( 'primary_color' ) );

	if ( $primary_color && '#DF6296' !== $primary_color ) {
		$editor_settings['styles'][] = array(
			'css' => manor_get_editor_color_scheme_css( $primary_color, manor_darken_color( $primary_color, 15 ) ),
		);
	}

	return $editor_settings;
}
add_filter( 'block_editor_settings', 'manor_block_editor_settings' );

/**
 * Enqueue editor styleshseet.
 */
function manor_enqueue_block_editor_assets() {
	wp_enqueue_style( 'open-sans' );
}
add_action( 'enqueue_block_editor_assets', 'manor_enqueue_block_editor_assets' );

/**
 * Excerpt more
 *
 * @param string $more_text
 * @return string
 */
function manor_excerpt_more( $more_text ) {
	if ( is_admin() ) {
		return $more_text;
	}

	return '&hellip;';
}
add_action( 'excerpt_more', 'manor_excerpt_more' );

/**
 * Share links scripts.
 */
function manor_footer_share_link_scripts() {
	?>
	<script>( function() {
		var shareLinks = Array.prototype.slice.call( document.querySelectorAll( '.entry-share-links .share' ) );
		shareLinks.forEach( function( link ) {
			link.addEventListener( 'click', function( event ) {
				event.preventDefault();
				window.open( link.href, 'sharer', 'width=640,height=480' );
			});
		});
	})();</script>
	<?php
}
add_action( 'wp_footer', 'manor_footer_share_link_scripts' );

/**
 * Fallback menu for `primary` menu location
 */
function manor_menu_fallback() {
	wp_page_menu(
		array(
			'menu_id' => 'site-nav-menu',
			'menu_class' => 'site-nav-menu-container',
			'show_home' => true,
			'number' => 3,
			'before' => '<ul class="menu">',
		)
	);
}

// Custom template tags.
require get_parent_theme_file_path( 'inc/template-tags.php' );

// Customizer additions.
require get_parent_theme_file_path( 'inc/customizer.php' );

// Icon functions.
require get_parent_theme_file_path( 'inc/icon-functions.php' );

// Color functions.
require get_parent_theme_file_path( 'inc/color-functions.php' );
