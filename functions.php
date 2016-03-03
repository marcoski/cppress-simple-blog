<?php
/**
 * CpPress Sipmle Blog Theme functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package CpPress_Sipmle_Blog_Theme
 */

use CpPress\CpPress;
use CpPressSimpleBlog\Filter\LayoutFilter;
use CpPressSimpleBlog\Filter\WidgetsFilter;

require_once 'vendor/autoload.php';

include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if(is_plugin_active('cp-press'.DIRECTORY_SEPARATOR.'cp-press.php') && !is_admin()){
	require_once WP_PLUGIN_DIR.DIRECTORY_SEPARATOR.'cp-press'.DIRECTORY_SEPARATOR.'cp-press.php';
	LayoutFilter::add();
	WidgetsFilter::add();
}


if ( ! function_exists( 'cppress_simple_blog_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function cppress_simple_blog_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on CpPress Sipmle Blog Theme, use a find and replace
	 * to change 'cppress_simple_blog' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'cppress_simple_blog', get_template_directory() . '/languages' );

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

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'cppress_simple_blog' ),
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
}
endif;
add_action( 'after_setup_theme', 'cppress_simple_blog_setup' );


/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function cppress_simple_blog_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'cppress_simple_blog' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'cppress_simple_blog_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function cppress_simple_blog_scripts() {
	wp_enqueue_style( 'cppress_simple_blog-style', get_stylesheet_uri() );
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css' );
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.css' );
	wp_enqueue_style( 'magnific-popup', get_template_directory_uri() . '/css/magnific-popup.css' );
	wp_enqueue_style( 'responsive', get_template_directory_uri() . '/css/responsive.min.css' );
	wp_enqueue_style( 'style', get_template_directory_uri() . '/css/style.min.css' );
	if(defined("CP_ENV") && CP_ENV == 'development'){
		wp_enqueue_style( 'stamp', get_stylesheet_directory_uri() . '/css/simpleblog.less', array(), '1.0.0' );
	}else if(defined("CP_ENV") && CP_ENV == 'presentation'){
		wp_enqueue_style( 'stamp', get_stylesheet_directory_uri() . '/css/simpleblog.css', array(), '1.0.0' );
	}
	if(defined("CP_ENV") && CP_ENV == 'development'){
		wp_enqueue_script( 'less', get_stylesheet_directory_uri() . '/js/less/less.min.js');
	}
	wp_enqueue_style( 'simpleblog', get_template_directory_uri() . '/css/simpleblog.css' );

	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '1.0.0', true );
	wp_enqueue_script( 'gmap3', get_template_directory_uri() . '/js/gmap3.min.js', array('jquery'), '1.0.0', true );
	wp_enqueue_script( 'imageloaded', get_template_directory_uri() . '/js/imageloaded.pkgd.min.js', array('jquery'), '1.0.0', true );
	wp_enqueue_script( 'jquery.easing', get_template_directory_uri() . '/js/jquery.easing.js', array('jquery'), '1.0.0', true );
	wp_enqueue_script( 'magnific-popup', get_template_directory_uri() . '/js/magnificpopup.min.js', array('jquery'), '1.0.0', true );
	wp_enqueue_script( 'masonry', get_template_directory_uri() . '/js/masonry.pkgd.min.js', array('jquery'), '1.0.0', true );
	wp_enqueue_script( 'simpleblog', get_template_directory_uri() . '/js/simpleblog.js', array('jquery'), '1.0.0', true );
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'cppress_simple_blog_scripts' );

if(defined("CP_ENV") && CP_ENV == 'development'){
	add_filter('style_loader_tag', function($tag, $handle){
		global $wp_styles;
		$match_pattern = '/\.less$/U';
		if ( preg_match( $match_pattern, $wp_styles->registered[$handle]->src ) ) {
			$handle = $wp_styles->registered[$handle]->handle;
			$media = $wp_styles->registered[$handle]->args;
			$href = $wp_styles->registered[$handle]->src . '?ver=' . $wp_styles->registered[$handle]->ver;
			$rel = isset($wp_styles->registered[$handle]->extra['alt']) && $wp_styles->registered[$handle]->extra['alt'] ? 'alternate stylesheet' : 'stylesheet';
			$title = isset($wp_styles->registered[$handle]->extra['title']) ? "title='" . esc_attr( $wp_styles->registered[$handle]->extra['title'] ) . "'" : '';
			$tag = "<link rel='stylesheet/less' id='$handle' $title href='$href' type='text/css' media='$media' />\r\n";
		}
		return $tag;
	}, 5, 2);
}