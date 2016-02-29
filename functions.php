<?php

require_once get_stylesheet_directory() . '/inc/custom-header.php';

require_once get_template_directory() . '/inc/colorcase.php';

/**
 * Enqueues child theme stylesheet, loading first the parent theme stylesheet.
 */
function anchor_enqueue_child_theme_styles() {

	wp_enqueue_style( 'parent-theme-css', get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'praise-fonts', anchor_fonts_url() );
	wp_dequeue_style( 'rock' );

}

add_action( 'wp_enqueue_scripts', 'anchor_enqueue_child_theme_styles', 5 );

/**
 * Returns the Google font stylesheet URL, if available.
 *
 * The use of Open Sans and Source Serif Pro by default is localized. For languages
 * that use characters not supported by the font, the font can be disabled.
 *
 * @return string $fonts_url	Font stylesheet or empty string if disabled.
 */
function anchor_fonts_url() {
	$fonts_url = '';

	/* Translators: If there are characters in your language that are not
	 * supported by Open Sans, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$open_sans = _x( 'on', 'Open Sans font: on or off', 'rock' );

	/* Translators: If there are characters in your language that are not
	 * supported by Source Serif Pro, translate this to 'off'. Do not translate into your
	 * own language.
	 */
	$source_serif_pro = _x( 'on', 'Source Serif Pro font: on or off', 'rock' );

	if ( 'off' !== $open_sans || 'off' !== $source_serif_pro ) {
		$font_families = array();

		if ( 'off' !== $open_sans )
			$font_families[] = 'Open Sans:400,500,700,800';

		if ( 'off' !== $source_serif_pro )
			$font_families[] = 'Source Serif Pro:400,700';

		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);
		$fonts_url = add_query_arg( $query_args, "//fonts.googleapis.com/css" );
	}

	return $fonts_url;
}
