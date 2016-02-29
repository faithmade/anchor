<?php
/**
 * Sample implementation of the Custom Header feature
 * http://codex.wordpress.org/Custom_Headers
 *
 * @package anchor
 */

/**
 * Setup the WordPress core custom header feature.
 *
 * @uses anchor_header_style()
 * @uses anchor_admin_header_style()
 * @uses anchor_admin_header_image()
 */
function anchor_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'anchor_custom_header_args', array(
		'default-image'        => get_stylesheet_directory_uri() . '/assets/images/header.jpg',
		'default-text-color'   => 'ffffff',
		'width'                => 2400,
		'height'               => 80,
		'flex-height'          => true,
		'wp-head-callback'     => 'anchor_header_style'
	) ) );
}
add_action( 'after_setup_theme', 'anchor_custom_header_setup' );

if ( ! function_exists( 'anchor_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see anchor_custom_header_setup().
 */
function anchor_header_style() {

	?>
	<style type="text/css" id="anchor-header-image">
	.site-header{
		background-image: url("<?php header_image(); ?>");
	}

	<?php if( get_header_image() ){ ?>
		.site-header{
			background-size: cover;
			background-position: bottom center;
		}
	<?php } ?>
	</style>
	<?php

	// If the header text option is untouched, let's bail.
	if ( display_header_text() ) {
		return;
	// If the header text has been hidden.
	} else {
	?>
		<style type="text/css" id="anchor-header-css">
			.site-title,
			.site-description {
				clip: rect(1px, 1px, 1px, 1px);
				position: absolute;
			}
		</style>
	<?php
	}
}
endif; // anchor_header_style
