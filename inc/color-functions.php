<?php
/**
 * Color functions.
 *
 * @package Revood
 */

/**
 * Returns color scheme css.
 *
 * @param string $primary_color
 * @param string $primary_color_dark
 * @return string
 */
function manor_get_color_scheme_css( $primary_color, $primary_color_dark ) {
	return <<<CSS
blockquote,
a,
.site-nav .current-menu-item > a,
.site-nav .current_page_item > a,
.social-nav a:hover,
.widget a:hover,
.site-footer a:hover,
.comments-pagination a:hover,
.pagination a:hover,
.comments-pagination .page-numbers.current,
.pagination .page-numbers.current,
.entries .entry-title a:hover,
.entry-meta a:hover,
.has-primary-color,
.wp-block-button.is-style-outline .wp-block-button__link:not(.has-text-color) {
	color: $primary_color;
}

.button,
button,
input[type="button"],
input[type="submit"],
input[type="reset"],
.entry-meta:after,
.has-primary-background-color,
.wp-block-button .wp-block-button__link:not(.has-background),
.wp-block-file .wp-block-file__button {
	background-color: $primary_color;
}

.comments-pagination .page-numbers.current,
.pagination .page-numbers.current,
.wp-block-button.is-style-outline .wp-block-button__link {
	border-color: $primary_color;
}

a:hover {
	color: $primary_color_dark;
}

.button:hover,
.button:focus,
button:hover,
button:focus,
input[type="button"]:hover,
input[type="button"]:focus,
input[type="submit"]:hover,
input[type="submit"]:focus,
input[type="reset"]:hover,
input[type="reset"]:focus,
.wp-block-button .wp-block-button__link:not(.has-background):hover,
.wp-block-file .wp-block-file__button:hover {
	background-color: $primary_color_dark;
}
CSS;
}

/**
 * Get editor color scheme css.
 *
 * @param string $primary_color
 * @param string $primary_color_dark
 * @return string
 */
function manor_get_editor_color_scheme_css( $primary_color, $primary_color_dark ) {
	return <<<CSS
a,
blockquote,
.wp-block-button.is-style-outline .wp-block-button__link:not(.has-text-color) {
	color: $primary_color;
}

a:hover {
	color: $primary_color_dark;
}

.wp-block-button .wp-block-button__link:not(.has-background),
.wp-block-file .wp-block-file__button {
	background-color: $primary_color;
}

.wp-block-button .wp-block-button__link:not(.has-background):hover,
.wp-block-file .wp-block-file__button:hover {
	background-color: $primary_color_dark;
}

.wp-block-button.is-style-outline .wp-block-button__link {
	background: transparent;
	border-color: $primary_color;
}
CSS;
}

/**
 * Darken hex color.
 *
 * @param string $hex
 * @param int $percentage
 * @return string
 */
function manor_darken_color( $hex, $percentage ) {
	if ( strlen( $hex ) < 6 ) {
		preg_match( '/^#?([0-9a-f])([0-9a-f])([0-9a-f])$/i', $hex, $rgb );
		$rgb[1] .= $rgb[1];
		$rgb[2] .= $rgb[2];
		$rgb[3] .= $rgb[3];
	} else {
		preg_match( '/^#?([0-9a-f]{2})([0-9a-f]{2})([0-9a-f]{2})$/i', $hex, $rgb );
	}

	$new_hex = '#';

	for ( $i = 1; $i <= 3; $i++ ) {
		$rgb[ $i ] = hexdec( $rgb[ $i ] );
		$rgb[ $i ] = round( $rgb[ $i ] * ( 100 - ( $percentage / 2 ) ) / 100 );
		$new_hex .= str_pad( dechex( $rgb[ $i ] ), 2, '0', STR_PAD_LEFT );
	}

	return $new_hex;
}
