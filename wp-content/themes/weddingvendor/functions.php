<?php
/**
 * weddingvendor functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package weddingvendor
 */


if ( ! function_exists( 'weddingvendor_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function weddingvendor_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on weddingvendor, use a find and replace
	 * to change 'weddingvendor' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'weddingvendor', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );
	

    add_image_size('weddingvendor_user_profile', 290, 290, true);	
	
	add_image_size('weddingvendor_item_thumb', 440, 290, true);	
	
	add_image_size('weddingvendor_hero_thumb', 1900, 600, true);	
	

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array( 'primary' => esc_html__( 'Primary', 'weddingvendor' ) ) );
    register_nav_menus( array( 'topbar' => esc_html__( 'Topbar', 'weddingvendor' ) ) );
	
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

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
		'gallery',
		'audio'
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'weddingvendor_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

    add_editor_style( '/css/custom-editor-style.css' );	
}
endif;
add_action( 'after_setup_theme', 'weddingvendor_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function weddingvendor_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'weddingvendor_content_width', 640 );
}
add_action( 'after_setup_theme', 'weddingvendor_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function weddingvendor_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'weddingvendor' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here for blog sidebar', 'weddingvendor' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="well-box">',
		'after_widget'  => '</div></div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Page 1', 'weddingvendor' ),
		'id'            => 'page-1',
		'description'   => esc_html__( 'Add widgets here for page template sidebar', 'weddingvendor' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="well-box">',
		'after_widget'  => '</div></div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );	
	register_sidebar( array(
		'name'          => esc_html__( 'Footer 1', 'weddingvendor' ),
		'id'            => 'footer-1',
		'description'   => esc_html__( 'Add widgets here for left footer section', 'weddingvendor' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2>',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer 2', 'weddingvendor' ),
		'id'            => 'footer-2',
		'description'   => esc_html__( 'Add widgets here for center footer section', 'weddingvendor' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2>',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer 3', 'weddingvendor' ),
		'id'            => 'footer-3',
		'description'   => esc_html__( 'Add widgets here for right footer section', 'weddingvendor' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2>',
		'after_title'   => '</h2>',
	) );				
}
add_action( 'widgets_init', 'weddingvendor_widgets_init' );

/**
 * Theme Options init file.
 */
require get_template_directory() . '/framework/init.php';

/**
 * ajax upload.
 */
require get_template_directory() . '/inc/ajax_upload.php';

/**
 * Implement the General Function.
 */
require get_template_directory() . '/inc/general-function.php';

/**
 * Implement the CSS JS.
 */
require get_template_directory() . '/inc/css-js-include.php';

/**
 * Help Link Template info.
 */
require get_template_directory() . '/inc/help-function.php';

/**
 * Implement the General Function.
 */
require get_template_directory() . '/inc/nav-menu-walker.php';

/**
 * TGM Load.
 */
require get_template_directory() . '/inc/plugin/wedding-plugin.php';

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
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load Custom widget.
 */
require get_template_directory() . '/inc/widget/init-widget.php';



?>