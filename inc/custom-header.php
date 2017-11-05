<?php
/**
 * Sample implementation of the Custom Header feature
 *
 * You can add an optional custom header image to header.php like so ...
 *
	<?php the_header_image_tag(); ?>
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package Everlasting
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses everlasting_header_style()
 */
function everlasting_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'everlasting_custom_header_args', array(
		'default-image'      => get_parent_theme_file_uri( '/assets/images/header.jpg' ),
		'default-text-color' => 'ffffff',
		'width'              => 1600,
		'height'             => 500,
		'flex-height'        => true,
		'wp-head-callback'   => 'everlasting_header_style',
	) ) );

	register_default_headers( array(
		'default-image' => array(
			'url'           => '%s/assets/images/header.jpg',
			'thumbnail_url' => '%s/assets/images/header.jpg',
			'description'   => esc_html__( 'Default Header Image', 'everlasting' ),
		),
	) );
}
add_action( 'after_setup_theme', 'everlasting_custom_header_setup' );

/**
 * Styles the header image and text displayed on the blog.
 *
 * @see everlasting_custom_header_setup().
 */
function everlasting_header_style() {
	$header_text_color = get_header_textcolor();

	// Header image.
	$header_image = esc_url( get_header_image() );

	// Featured image can overwrite header image in singular pages.
	$id = get_queried_object_id();
	if ( is_singular() && has_post_thumbnail( $id ) ) {
		$img_array = wp_get_attachment_image_src( get_post_thumbnail_id( $id ), 'full', true );

		// width and url.
		$width = $img_array[1];
		$url   = $img_array[0];

		// Set new header image if it's at least 1600px wide.
		if ( 1599 < $width ) {
			$header_image = esc_url( $url );
		}
	}

	if ( is_post_type_archive( 'portfolio_project' ) || is_tax( 'portfolio_category' ) ) {
		$header_img = get_theme_mod( 'portfolio_header_img' );
	}

	if ( isset( $header_img ) && $header_img ) {
		$header_image = $header_img;
	}

	// Start header styles.
	$style = '';

	// Header images styles.
	if ( ! empty( $header_image ) ) {
		$style .= ".site-header {
			background-image: linear-gradient( 45deg, rgba(82, 34, 92, 0.8) 0%, rgba(82, 34, 92, 0.70) 50% ),
					url({$header_image});
			}";
	}

	// Echo styles if it's not empty.
	if ( ! empty( $style ) ) {
		echo "\n" . '<style type="text/css" id="site-header-css">' . trim( $style ) . '</style>' . "\n";
	}
}
