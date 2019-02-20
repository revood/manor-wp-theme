<?php
/**
 * Customizer Additions.
 *
 * @package Revood
 */

/**
 * Register customizer controls & settings.
 *
 * @param WP_Customize_Manager $wp_customize
 */
function manor_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

	$wp_customize->add_setting(
		'twitter_handle',
		array(
			'sanitize_callback' => 'esc_attr',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control(
		'twitter_handle',
		array(
			'type'        => 'text',
			'section'     => 'title_tagline',
			'label'       => __( 'Twitter Handle', 'manor' ),
			'description' => __( 'This handle will be tagged when users share your article.', 'manor' ),
		)
	);

	$wp_customize->selective_refresh->add_partial(
		'blogname',
		array(
			'selector' => '.site-title a',
			'render_callback' => 'manor_customize_partial_blogname',
		)
	);
	$wp_customize->selective_refresh->add_partial(
		'blogdescription',
		array(
			'selector' => '.site-description',
			'render_callback' => 'manor_customize_partial_blogdescription',
		)
	);

	$wp_customize->add_setting(
		'primary_color',
		array(
			'sanitize_callback' => 'sanitize_hex_color',
			'transport' => 'postMessage',
			'default' => '#DF6296',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'primary_color',
			array(
				'description' => __( 'Apply a custom color for buttons, links, etc.', 'manor' ),
				'section' => 'colors',
			)
		)
	);
}
add_action( 'customize_register', 'manor_customize_register' );

/**
 * Bind JS handlers to instantly live-preview changes.
 */
function manor_customize_preview_js() {
	wp_enqueue_script( 'manor-customize-preview', get_parent_theme_file_uri( 'js/customize-preview.js' ), array( 'customize-preview' ), '0.0.1', true );
	wp_script_add_data( 'manor-customize-preview', 'data', 'var _manorColorschemeCSS = ' . json_encode( manor_get_color_scheme_css( '{{ primary_color }}', '{{ primary_color_dark }}' ) ) . ';' );
}
add_action( 'customize_preview_init', 'manor_customize_preview_js' );

/**
 * Render the site title for the selective refresh partial.
 */
function manor_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 */
function manor_customize_partial_blogdescription() {
	bloginfo( 'description' );
}
