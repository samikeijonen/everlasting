<?php
/**
 * Everlasting functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Everlasting
 */

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function everlasting_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Everlasting, use a find and replace
	 * to change 'everlasting' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'everlasting', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// Default image size.
	set_post_thumbnail_size( 1110, 750, true );

	// Add custom image sizes.
	add_image_size( 'everlasting-bigger', 1140, 680, true );
	add_image_size( 'everlasting-small', 400, 400, true );

	// Register menus.
	register_nav_menus( array(
		'primary'  => esc_html__( 'Primary', 'everlasting' ),
		'featured' => esc_html__( 'Featured', 'everlasting' ),
		'footer'   => esc_html__( 'Bottom', 'everlasting' ),
		'social'   => esc_html__( 'Social links in the footer', 'everlasting' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	// Add them support for editor.
	add_theme_support( 'gutenberg', array(
		'wide-images' => true,
		'colors' => array(
			'#0073aa',
			'#229fd8',
			'#eee',
			'#444',
		),
	) );

	// Add theme support for breadcrumb trail.
	add_theme_support( 'breadcrumb-trail' );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style( array( 'assets/css/editor-style.css', everlasting_fonts_url() ) );
}
add_action( 'after_setup_theme', 'everlasting_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function everlasting_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'everlasting_content_width', 770 );
}
add_action( 'after_setup_theme', 'everlasting_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function everlasting_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'everlasting' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'everlasting' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'everlasting_widgets_init' );

/**
 * Handles JavaScript detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since 1.0.0
 */
function everlasting_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'everlasting_javascript_detection', 0 );

/**
 * Register Google fonts.
 *
 * @since 1.0.0
 *
 * @return string Google fonts URL for the theme.
 */
function everlasting_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin';

	/* translators: If there are characters in your language that are not supported by Poppins, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== esc_attr_x( 'on', 'Barlow font: on or off', 'everlasting' ) ) {
		$fonts[] = 'Barlow:400,500,600,700';
	}

	// Set fonts if there are any.
	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), 'https://fonts.googleapis.com/css' );
	}

	// Return font url.
	return esc_url_raw( $fonts_url );
}

/**
 * Add preconnect for Google Fonts.
 *
 * @param array  $urls           URLs to print for resource hints.
 * @param string $relation_type  The relation type the URLs are printed.
 * @return array $urls           URLs to print for resource hints.
 */
function everlasting_resource_hints( $urls, $relation_type ) {
	if ( wp_style_is( 'everlasting-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href' => 'https://fonts.gstatic.com',
			'crossorigin',
		);
	}

	return $urls;
}
add_filter( 'wp_resource_hints', 'everlasting_resource_hints', 10, 2 );

/**
 * Enqueue scripts and styles.
 */
function everlasting_scripts() {
	// Get '.min' suffix.
	$suffix = everlasting_get_min_suffix();

	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'everlasting-fonts', everlasting_fonts_url(), array(), null );

	// Add main styles.
	wp_enqueue_style( 'everlasting-style', get_stylesheet_directory_uri() . '/style' . $suffix . '.css', array(), '20170815' );

	// Add navigation JS.
	wp_enqueue_script( 'everlasting-navigation', get_template_directory_uri() . '/assets/scripts/navigation' . $suffix . '.js', array(), '20170213', true );

	// Add flickity JS.
	wp_enqueue_script( 'everlasting-flickity', get_template_directory_uri() . '/assets/scripts/third-party/flickity' . $suffix . '.js', array(), '20170215', true );

	// Add skip link focus fix JS.
	wp_enqueue_script( 'everlasting-skip-link-focus-fix', get_template_directory_uri() . '/assets/scripts/skip-link-focus-fix' . $suffix . '.js', array(), '20170215', true );

	// Add comment reply JS.
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'everlasting_scripts' );

/**
 * Enqueue styles for editor.
 */
function everlasting_scripts_editor() {
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'everlasting-fonts', everlasting_fonts_url(), array(), null );

	// Add main styles.
	wp_enqueue_style( 'everlasting-style', get_stylesheet_directory_uri() . '/style' . $suffix . '.css', array( 'wp-blocks' ), '20170815' );
}
//add_action( 'enqueue_block_editor_assets', 'everlasting_scripts_editor' );

/**
 * Helper function for getting the script/style `.min` suffix for minified files.
 *
 * @since  1.0.0
 * @return string
 */
function everlasting_get_min_suffix() {
	return defined( 'SCRIPT_DEBUG' ) && true === SCRIPT_DEBUG ? '' : '.min';
}

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * SVG icons.
 */
require get_template_directory() . '/inc/function-icons.php';

/**
 * Filters used in the theme.
 */
require get_template_directory() . '/inc/filters.php';

/**
 * Responsive videos.
 */
require get_template_directory() . '/inc/responsive-videos.php';

/**
 * Polylang strings.
 */
require get_template_directory() . '/inc/polylang.php';
