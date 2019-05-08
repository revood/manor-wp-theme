<?php
/**
 * Custom template tags for this theme.
 *
 * @package Revood
 */

if ( ! function_exists( 'manor_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function manor_posted_on() {
		// Get the author name; wrap it in a link.
		$byline = sprintf(
			// translators: %s is author name.
			__( 'by %s', 'manor' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . get_the_author() . '</a></span>'
		);

		$cats = get_the_category();
		if ( ! empty( $cats ) ) {
			printf( '<span class="posted-in"><a href="%s">%s</a></span>', esc_url( get_term_link( $cats[0] ) ), esc_attr( $cats[0]->name ) );
		}
		echo '<span class="posted-on">' . manor_time_link() . '</span><span class="byline"> ' . $byline . '</span>';
	}
endif;

if ( ! function_exists( 'manor_time_link' ) ) :
	/**
	 * Gets a nicely formatted string for the published date.
	 * @return stringk
	 *
	 */
	function manor_time_link() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf(
			$time_string,
			get_the_date( DATE_W3C ),
			get_the_date(),
			get_the_modified_date( DATE_W3C ),
			get_the_modified_date()
		);

		// Wrap the time string in a link, and preface it with 'Posted on'.
		return sprintf(
			/* translators: %s: post date */
			__( '<span class="screen-reader-text">Posted on</span> %s', 'manor' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);
	}
endif;

if ( ! function_exists( 'manor_edit_link' ) ) :
	/**
	 * Returns an accessibility-friendly link to edit a post or page.
	 */
	function manor_edit_link() {
		edit_post_link(
			sprintf(
				/* translators: %s: Name of current post */
				__( 'Edit<span class="screen-reader-text"> "%s"</span>', 'manor' ),
				get_the_title()
			),
			'<div class="edit-link">',
			'</div>'
		);
	}
endif;

if ( ! function_exists( 'manor_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function manor_entry_footer() {

		/* translators: used between list items, there is a space after the comma */
		$separate_meta = __( ', ', 'manor' );

		// Get Categories for posts.
		$categories_list = get_the_category_list( $separate_meta );

		// Get Tags for posts.
		$tags_list = get_the_tag_list( '', $separate_meta );

		if ( ( $categories_list || $tags_list ) || get_edit_post_link() ) {
			echo '<footer class="entry-footer">';

			if ( 'post' === get_post_type() && ( $categories_list || $tags_list ) ) {
				if ( $categories_list ) {
					?>
					<span class="cat-links">
						<svg height="18" viewBox="0 0 24 24" width="18" xmlns="http://www.w3.org/2000/svg">
							<path d="M10 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V8c0-1.1-.9-2-2-2h-8l-2-2z"/>
							<path d="M0 0h24v24H0z" fill="none"/>
						</svg>
						<span class="screen-reader-text"><?php esc_html_e( 'Categories', 'manor' ); ?></span>
						<?php echo $categories_list; ?>
					</span>
					<?php
				}

				if ( $tags_list ) {
					?>
					<span class="tags-links">
						<svg height="18" viewBox="0 0 24 24" width="18" xmlns="http://www.w3.org/2000/svg">
							<path d="M0 0h24v24H0z" fill="none"/>
							<path d="M17.63 5.84C17.27 5.33 16.67 5 16 5L5 5.01C3.9 5.01 3 5.9 3 7v10c0 1.1.9 1.99 2 1.99L16 19c.67 0 1.27-.33 1.63-.84L22 12l-4.37-6.16z"/>
						</svg>
						<span class="screen-reader-text"><?php esc_html_e( 'Tags', 'manor' ); ?></span>
						<?php echo $tags_list; ?>
					</span>
					<?php
				}
			}

			echo '</footer><!-- /.entry-footer -->';
		}
	}
endif;

/**
 * Get first gallery block.
 *
 * @param int|WP_Post $post (optional)
 * @return string
 */
function manor_get_post_gallery_block( $post = null ) {
	$post = get_post( $post );

	if ( ! function_exists( 'has_block' ) || ! has_block( 'gallery', $post->post_content ) ) {
		return '';
	}

	$blocks = parse_blocks( $post->post_content );

	foreach ( $blocks as $block ) {
		if ( 'core/gallery' === $block['blockName'] ) {
			return $block['innerHTML'];
		}
	}

	return '';
}

/**
 * Get the first video/embed block.
 *
 * @param int|WP_Post $post (optional)
 * @return string
 */
function manor_get_post_embed_block( $post = null ) {
	$post = get_post( $post );

	if ( ! function_exists( 'has_block' ) ) {
		return '';
	}

	$blocks = parse_blocks( $post->post_content );
	foreach ( $blocks as $block ) {
		if ( 'core/video' === $block['blockName'] ) {
			return $block['innerHTML'];
		} elseif ( 0 === strpos( $block['blockName'], 'core-embed/' ) ) {
			return $block['innerHTML'];
		}
	}

	return '';
}
