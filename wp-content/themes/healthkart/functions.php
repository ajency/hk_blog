<?php
/**
 * Genesis Sample.
 *
 * This file adds functions to the Genesis Sample Theme.
 *
 * @package Genesis Sample
 * @author  StudioPress
 * @license GPL-2.0-or-later
 * @link    https://www.studiopress.com/
 */
require_once get_stylesheet_directory() . "/incs/init.php";
// Starts the engine.
require_once get_template_directory() . '/lib/init.php';

// Sets up the Theme.
require_once get_stylesheet_directory() . '/lib/theme-defaults.php';

add_action( 'after_setup_theme', 'genesis_sample_localization_setup' );
/**
 * Sets localization (do not remove).
 *
 * @since 1.0.0
 */
function genesis_sample_localization_setup() {

	load_child_theme_textdomain( genesis_get_theme_handle(), get_stylesheet_directory() . '/languages' );

}

// Adds helper functions.
require_once get_stylesheet_directory() . '/lib/helper-functions.php';

// Adds image upload and color select to Customizer.
require_once get_stylesheet_directory() . '/lib/customize.php';

// Includes Customizer CSS.
require_once get_stylesheet_directory() . '/lib/output.php';

// Adds WooCommerce support.
require_once get_stylesheet_directory() . '/lib/woocommerce/woocommerce-setup.php';

// Adds the required WooCommerce styles and Customizer CSS.
require_once get_stylesheet_directory() . '/lib/woocommerce/woocommerce-output.php';

// Adds the Genesis Connect WooCommerce notice.
require_once get_stylesheet_directory() . '/lib/woocommerce/woocommerce-notice.php';

add_action( 'after_setup_theme', 'genesis_child_gutenberg_support' );
/**
 * Adds Gutenberg opt-in features and styling.
 *
 * @since 2.7.0
 */
function genesis_child_gutenberg_support() { // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedFunctionFound -- using same in all child themes to allow action to be unhooked.
	require_once get_stylesheet_directory() . '/lib/gutenberg/init.php';
}

// Registers the responsive menus.
if ( function_exists( 'genesis_register_responsive_menus' ) ) {
	genesis_register_responsive_menus( genesis_get_config( 'responsive-menus' ) );
}

add_action( 'wp_enqueue_scripts', 'genesis_sample_enqueue_scripts_styles' );
/**
 * Enqueues scripts and styles.
 *
 * @since 1.0.0
 */
function genesis_sample_enqueue_scripts_styles() {

	$appearance = genesis_get_config( 'appearance' );

	wp_enqueue_style(
		genesis_get_theme_handle() . '-fonts',
		$appearance['fonts-url'],
		[],
		genesis_get_theme_version()
	);

	wp_enqueue_style( 'dashicons' );

	if ( genesis_is_amp() ) {
		wp_enqueue_style(
			genesis_get_theme_handle() . '-amp',
			get_stylesheet_directory_uri() . '/lib/amp/amp.css',
			[ genesis_get_theme_handle() ],
			genesis_get_theme_version()
		);
	}

}

add_action( 'after_setup_theme', 'genesis_sample_theme_support', 9 );
/**
 * Add desired theme supports.
 *
 * See config file at `config/theme-supports.php`.
 *
 * @since 3.0.0
 */
function genesis_sample_theme_support() {

	$theme_supports = genesis_get_config( 'theme-supports' );

	foreach ( $theme_supports as $feature => $args ) {
		add_theme_support( $feature, $args );
	}

}

add_action( 'after_setup_theme', 'genesis_sample_post_type_support', 9 );
/**
 * Add desired post type supports.
 *
 * See config file at `config/post-type-supports.php`.
 *
 * @since 3.0.0
 */
function genesis_sample_post_type_support() {

	$post_type_supports = genesis_get_config( 'post-type-supports' );

	foreach ( $post_type_supports as $post_type => $args ) {
		add_post_type_support( $post_type, $args );
	}

}

// Remove image sizes.
remove_image_size('1536x1536');
remove_image_size('2048x2048');

// Removes header right widget area.
unregister_sidebar( 'header-right' );

// Removes secondary sidebar.
unregister_sidebar( 'sidebar-alt' );

// Removes site layouts.
genesis_unregister_layout( 'content-sidebar-sidebar' );
genesis_unregister_layout( 'sidebar-content-sidebar' );
genesis_unregister_layout( 'sidebar-sidebar-content' );

// Repositions primary navigation menu.
remove_action( 'genesis_after_header', 'genesis_do_nav' );
add_action( 'genesis_header', 'genesis_do_nav', 12 );

// Repositions the secondary navigation menu.
remove_action( 'genesis_after_header', 'genesis_do_subnav' );
add_action( 'genesis_footer', 'genesis_do_subnav', 10 );

add_filter( 'wp_nav_menu_args', 'genesis_sample_secondary_menu_args' );
/**
 * Reduces secondary navigation menu to one level depth.
 *
 * @since 2.2.3
 *
 * @param array $args Original menu options.
 * @return array Menu options with depth set to 1.
 */
function genesis_sample_secondary_menu_args( $args ) {

	if ( 'secondary' === $args['theme_location'] ) {
		$args['depth'] = 1;
	}

	return $args;

}

add_filter( 'genesis_author_box_gravatar_size', 'genesis_sample_author_box_gravatar' );
/**
 * Modifies size of the Gravatar in the author box.
 *
 * @since 2.2.3
 *
 * @param int $size Original icon size.
 * @return int Modified icon size.
 */
function genesis_sample_author_box_gravatar( $size ) {

	return 90;

}

add_filter( 'genesis_comment_list_args', 'genesis_sample_comments_gravatar' );
/**
 * Modifies size of the Gravatar in the entry comments.
 *
 * @since 2.2.3
 *
 * @param array $args Gravatar settings.
 * @return array Gravatar settings with modified size.
 */
function genesis_sample_comments_gravatar( $args ) {

	$args['avatar_size'] = 60;
	return $args;

}
add_action( 'wp_enqueue_scripts', 'my_child_theme_scripts' );

function my_child_theme_scripts() {
    wp_enqueue_style( 'parent-theme-css', get_stylesheet_directory_uri() . '/style.css' );
 	wp_enqueue_style('theme-styles', get_stylesheet_directory_uri() . '/assets/css/theme-styles.css', array(), '', false);
 	wp_enqueue_style('fontawesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css?ver=5.4.2', array(), '', false);
    wp_enqueue_style('font-family', 'https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">', array(), '', false);
    wp_enqueue_style('slick', get_stylesheet_directory_uri() . '/assets/css/slick.css', array(), '', false);
 	wp_enqueue_style('animate', get_stylesheet_directory_uri() . '/assets/css/animate.min.css', array(), '', false);
 	wp_enqueue_style('normalize', get_stylesheet_directory_uri() . '/assets/css/normalize.min.css', array(), '', false);
}
//* this will bring in the Genesis Parent files needed:
include_once( get_template_directory() . '/lib/init.php' );

function enqueue_theme_scripts() { 
	global $wp_query;
	wp_deregister_script( 'jquery' );
    wp_register_script( 'jquery', get_stylesheet_directory_uri().'/assets/js/jquery.js' , '', '', true );
    wp_register_script( 'bootstrap', get_stylesheet_directory_uri().'/assets/js/bootstrap.min.js' , '', '', true );
    wp_register_script( 'themescripts', get_stylesheet_directory_uri().'/assets/js/theme-scripts.js' , '', '', true );
    wp_register_script( 'slick', get_stylesheet_directory_uri().'/assets/js/slick.min.js' , '', '', true );
    wp_register_script( 'slickanimation', get_stylesheet_directory_uri().'/assets/js/slick-animation.min.js' , '', '', true );

    wp_localize_script( 'themescripts', 'ajax_params', array(
		'url' => site_url() . '/wp-admin/admin-ajax.php', 
	) );
   	wp_enqueue_script('jquerys');
    wp_enqueue_script('bootstrap');
    wp_enqueue_script('themescripts');     
    wp_enqueue_script('slick');     
    wp_enqueue_script('slickanimation');     
}
add_action("wp_enqueue_scripts", "enqueue_theme_scripts");


/*
=============================================================
Register Menus
=============================================================
*/

function register_menus() {
	register_nav_menus(
		array(
		'top-menu' => __('Top Menu'),	
		'main-menu' => __('Header Menu'),
		'secondary-menu' => __('Secondary Menu')
		)
	);
}


add_action('init', 'register_menus');

function register_home_banner_space_sidebar() {
    register_sidebar( array(
        'name'          => 'Home Banner Space',
        'id'            => 'sidebar-home-banner-space',
        'description'   => 'Widgets in this section will be shown as banner space on the home page in More articles section.',
        'before_widget' => '<div class="home-banner-space widget_media_image">',
        'after_widget'  => '</div>',
    ) );
}
add_action( 'widgets_init', 'register_home_banner_space_sidebar' );