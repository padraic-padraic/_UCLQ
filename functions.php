<?php
/**
 * _UCLQ functions and definitions
 *
 * @package _UCLQ
 */
 
 /**
  * Store the theme's directory path and uri in constants
  */
 define('THEME_DIR_PATH', get_template_directory());
 define('THEME_DIR_URI', get_template_directory_uri());

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 750; /* pixels */

if ( ! function_exists( '_UCLQ_setup' ) ) :
/**
 * Set up theme defaults and register support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
function _UCLQ_setup() {
	global $cap, $content_width;

	// Add html5 behavior for some theme elements
	add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );

    // This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	/**
	 * Add default posts and comments RSS feed links to head
	*/
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Enable support for Post Thumbnails on posts and pages
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	*/
	add_theme_support( 'post-thumbnails' );

	/**
	 * Enable support for Post Formats
	*/
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

	/**
	 * Setup the WordPress core custom background feature.
	*/
	add_theme_support( 'custom-background', apply_filters( '_UCLQ_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
		) ) );
	
	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on _UCLQ, use a find and replace
	 * to change '_UCLQ' to the name of your theme in all the template files
	*/
	load_theme_textdomain( '_UCLQ', THEME_DIR_PATH . '/languages' );

	/**
	 * This theme uses wp_nav_menu() in one location.
	*/
	register_nav_menus( array(
		'primary'  => __( 'Header bottom menu', '_UCLQ' ),
		) );

}
endif; // _UCLQ_setup
add_action( 'after_setup_theme', '_UCLQ_setup' );

/**
 * Register widgetized area and update sidebar with default widgets
 */
function _UCLQ_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', '_UCLQ' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<div id="%1$s" class="panel panel-default widget %2$s">',
		'after_widget'  => '</div></div>',
		'before_title'  => '<div class="panel-heading"><h3 class="widget-title">',
		'after_title'   => '</h3></div><div class="panel-body">',
		) );
}
add_action( 'widgets_init', '_UCLQ_widgets_init' );

/**
 * Enqueue scripts and styles
 */
function _UCLQ_scripts() {

	// Import the necessary TK Bootstrap WP CSS additions
	wp_enqueue_style( '_UCLQ-bootstrap-wp', THEME_DIR_URI . '/includes/css/bootstrap-wp.css' );

	// load bootstrap css
	wp_enqueue_style( '_UCLQ-bootstrap', THEME_DIR_URI . '/includes/resources/bootstrap/css/bootstrap.min.css' );

	// load Font Awesome css
	wp_enqueue_style( '_UCLQ-font-awesome', THEME_DIR_URI . '/includes/css/font-awesome.min.css', false, '4.1.0' );

	// load _UCLQ styles
	wp_enqueue_style( '_UCLQ-style', get_stylesheet_uri() );

	// load bootstrap js
	wp_enqueue_script('_UCLQ-bootstrapjs', THEME_DIR_URI . '/includes/resources/bootstrap/js/bootstrap.min.js', array('jquery') );

	// load bootstrap wp js
	wp_enqueue_script( '_UCLQ-bootstrapwp', THEME_DIR_URI . '/includes/js/bootstrap-wp.js', array('jquery') );

	wp_enqueue_script( '_UCLQ-skip-link-focus-fix', THEME_DIR_URI . '/includes/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( '_UCLQ-keyboard-image-navigation', THEME_DIR_URI . '/includes/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	}

}
add_action( 'wp_enqueue_scripts', '_UCLQ_scripts' );

/**
 * Move the featured image meta box to be high priority. Keep it on the side if it's a post, 
 or put it in the main area if it's a student/staff.
 */
 function cleanup_taxonomy_boxes($post_type, $context, $post){
 	if ($post_type==='uclq_student') {
 		remove_meta_box('departmentdiv', 'uclq_student', 'side');
 	}
 	elseif ($post_type==='uclq_staff'){
 		remove_meta_box('departmentdiv', 'uclq_staff', 'side');
 		remove_meta_box('job_titlediv', 'uclq_staff', 'side');
 	}
 	elseif ($post_type==='uclq_facility'){
 		remove_meta_box('departmentdiv', 'uclq_facility', 'side');
 		remove_meta_box('facility_typediv', 'uclq_facility', 'side');
 	}
 }

 function move_featured_image($post_type, $context, $post){
 	if ($post_type==='uclq_student'){
		remove_meta_box( 'postimagediv', 'uclq_student', 'side' );
		add_meta_box('postimagediv', __('Student Photo'), 'post_thumbnail_meta_box', 'uclq_student', 'normal', 'high');
 	}
 	elseif ($post_type==='uclq_staff'){
		remove_meta_box( 'postimagediv', 'uclq_staff', 'side' );
		add_meta_box('postimagediv', __('Student Photo'), 'post_thumbnail_meta_box', 'uclq_staf', 'normal', 'high');
 	}
 }
add_action('do_meta_boxes', 'cleanup_taxonomy_boxes', 10, 3);
// add_action('do_meta_boxes', 'move_featured_image', 10, 3);

/**
 * Implement the Custom Header feature.
 */
require THEME_DIR_PATH . '/includes/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require THEME_DIR_PATH . '/includes/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require THEME_DIR_PATH . '/includes/extras.php';

/**
 * Customizer additions.
 */
require THEME_DIR_PATH . '/includes/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require THEME_DIR_PATH . '/includes/jetpack.php';

/**
 * Load custom WordPress nav walker.
 */
require THEME_DIR_PATH . '/includes/bootstrap-wp-navwalker.php';

/** 
 * Load custom UCLQ Member types and taxonomies
 */

require THEME_DIR_PATH .'/includes/post_types/uclq_students.php';
require THEME_DIR_PATH .'/includes/post_types/uclq_staff.php';
require THEME_DIR_PATH .'/includes/post_types/uclq_facilities.php';
// require THEME_DIR_PATH .'/includes/post_types/uclq_phd_students.php';
require THEME_DIR_PATH .'/includes/post_types/extra_taxonomies.php';
/** 
 * Load custom widgets
 */

require THEME_DIR_PATH . '/includes/uclq_widgets.php';

/**
 * Adds WooCommerce support
 */
add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
	add_theme_support( 'woocommerce' );
}
