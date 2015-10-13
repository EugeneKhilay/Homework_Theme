<?php
/**
 * _tk functions and definitions
 *
 * @package _tk
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 750; /* pixels */

if ( ! function_exists( '_tk_setup' ) ) :
/**
 * Set up theme defaults and register support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
function _tk_setup() {
	global $cap, $content_width;

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
	add_theme_support( 'post-thumbnails', array( 'post', 'page', 'approach' ) );

	/**
	 * Enable support for Post Formats
	*/
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

	/**
	 * Setup the WordPress core custom background feature.
	*/
	add_theme_support( 'custom-background', apply_filters( '_tk_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
	
	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on _tk, use a find and replace
	 * to change '_tk' to the name of your theme in all the template files
	*/
	load_theme_textdomain( '_tk', get_template_directory() . '/languages' );

	/**
	 * This theme uses wp_nav_menu() in one location.
	*/
	register_nav_menus( array(
		'primary'  => __( 'Header bottom menu', '_tk' ),
	) );

}
endif; // _tk_setup
add_action( 'after_setup_theme', '_tk_setup' );

/**
 * Register widgetized area and update sidebar with default widgets
 */
function _tk_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', '_tk' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', '_tk_widgets_init' );

// ====================== Footer Menu ==========================

function register_footer_menu() {
  register_nav_menu('footer-menu',__( 'Footer Menu' ));
}
add_action( 'init', 'register_footer_menu' );
// ====================== Footer Menu ==========================

// ====================== Widget Zone ==========================
/**
 * Register our sidebars and widgetized areas.
 *
 */
function left_widgets_init() {

	register_sidebar( array(
		'name'          => 'Home left sidebar',
		'id'            => 'home_left_1',
		'before_widget' => '<div>',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="rounded">',
		'after_title'   => '</h2>',
	) );

}
add_action( 'widgets_init', 'left_widgets_init' );

function central_widgets_init() {

	register_sidebar( array(
		'name'          => 'Home central sidebar',
		'id'            => 'home_central_1',
		'before_widget' => '<div>',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="rounded">',
		'after_title'   => '</h2>',
	) );

}
add_action( 'widgets_init', 'central_widgets_init' );


// ====================== Widget Zone ==========================

// ====================== Custom Post Type =====================

add_action( 'init', 'approach_custom_post_type' );
function approach_custom_post_type() {
  register_post_type( 'approach',
    array(
      'labels' => array(
        'name' => __( 'Aproach' ),
        'singular_name' => __( 'Aproach' )
      ),
      'public' => true,
      'has_archive' => true,
      'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),

    )
  );
}
// ====================== Custom Post Type =====================

// ====================== Customize Register ===================

function socials_customize_register( $wp_customize ) {
   //All our sections, settings, and controls will be added here
	
	$wp_customize->add_section( 'socials' , array(
	    'title'      => __( 'Socials', '_tk' ),
	    'priority'   => 30,
	) );

	$wp_customize->add_setting( 'twitter_setting' , array(
	    'transport'   => 'refresh',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'socials_twi', array(
		'label'      => __( 'Twitter link', '_tk' ),
		'section'    => 'socials',
		'settings'   => 'twitter_setting',
	) ) );

	$wp_customize->add_setting( 'facebook_setting' , array(
	    'transport'   => 'refresh',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'socials_fb', array(
		'label'      => __( 'Facebook link', '_tk' ),
		'section'    => 'socials',
		'settings'   => 'facebook_setting',
	) ) );

}
add_action( 'customize_register', 'contacts_customize_register' );

function contacts_customize_register( $wp_customize ) {
   //All our sections, settings, and controls will be added here
	
	$wp_customize->add_section( 'contacts' , array(
	    'title'      => __( 'Contacts', '_tk' ),
	    'priority'   => 30,
	) );

	$wp_customize->add_setting( 'mail_setting' , array(
	    'transport'   => 'refresh',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'contacts_ml', array(
		'label'      => __( 'Mail link', '_tk' ),
		'section'    => 'contacts',
		'settings'   => 'mail_setting',
	) ) );

	$wp_customize->add_setting( 'skype_setting' , array(
	    'transport'   => 'refresh',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'contacts_sk', array(
		'label'      => __( 'Skype link', '_tk' ),
		'section'    => 'contacts',
		'settings'   => 'skype_setting',
	) ) );

}
add_action( 'customize_register', 'contacts_customize_register' );

// ====================== Customize Register ===================

/**
 * Enqueue scripts and styles
 */
function _tk_scripts() {

	// Import the necessary TK Bootstrap WP CSS additions
	wp_enqueue_style( '_tk-bootstrap-wp', get_template_directory_uri() . '/includes/css/bootstrap-wp.css' );

	// load bootstrap css
	wp_enqueue_style( '_tk-bootstrap', get_template_directory_uri() . '/includes/resources/bootstrap/css/bootstrap.min.css' );

	// load Font Awesome css
	wp_enqueue_style( '_tk-font-awesome', get_template_directory_uri() . '/includes/css/font-awesome.min.css', false, '4.1.0' );

	// load _tk styles
	wp_enqueue_style( '_tk-style', get_stylesheet_uri() );

	// load bootstrap js
	wp_enqueue_script('_tk-bootstrapjs', get_template_directory_uri().'/includes/resources/bootstrap/js/bootstrap.min.js', array('jquery') );

	// load bootstrap wp js
	wp_enqueue_script( '_tk-bootstrapwp', get_template_directory_uri() . '/includes/js/bootstrap-wp.js', array('jquery') );

	wp_enqueue_script( '_tk-skip-link-focus-fix', get_template_directory_uri() . '/includes/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( '_tk-keyboard-image-navigation', get_template_directory_uri() . '/includes/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	}

}
add_action( 'wp_enqueue_scripts', '_tk_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/includes/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/includes/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/includes/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/includes/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/includes/jetpack.php';

/**
 * Load custom WordPress nav walker.
 */
require get_template_directory() . '/includes/bootstrap-wp-navwalker.php';
