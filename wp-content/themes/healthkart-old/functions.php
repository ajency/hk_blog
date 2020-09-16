<?php 

add_action( 'wp_enqueue_scripts', 'my_child_theme_scripts' );

function my_child_theme_scripts() {
    wp_enqueue_style( 'parent-theme-css', get_template_directory_uri() . '/style.css' );
 	wp_enqueue_style('theme-styles', get_template_directory_uri() . '/assets/css/theme-styles.css', array(), '', false);
 	wp_enqueue_style('fontawesome', 'https://use.fontawesome.com/releases/v5.8.1/css/all.css', array(), '', false);
    wp_enqueue_style('font-family', 'https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">', array(), '', false);
}
//* this will bring in the Genesis Parent files needed:
include_once( get_template_directory() . '/lib/init.php' );

function enqueue_theme_scripts() { 
    wp_register_script( 'jquery-js', get_template_directory_uri().'/assets/js/jquery.js' , '', '', true );
    wp_register_script( 'bootstrap-js', get_template_directory_uri().'/assets/js/bootstrap.min.js' , '', '', true );
    wp_register_script( 'themescripts-js', get_template_directory_uri().'/assets/js/theme-scripts.js' , '', '', true );
   	
   	wp_enqueue_script('jquery-js');
    wp_enqueue_script('bootstrap-js');
    wp_enqueue_script('themescripts-js');     
}
add_action("wp_enqueue_scripts", "enqueue_theme_scripts");


//* We tell the name of our child theme
define( 'Child_Theme_Name', __( 'Genesis Child', 'genesischild' ) );
//* We tell the web address of our child theme (More info & demo)
define( 'Child_Theme_Url', 'http://gsquaredstudios.com' );
//* We tell the version of our child theme
define( 'Child_Theme_Version', '1.0' );

//* Add HTML5 markup structure from Genesis
add_theme_support( 'html5' );

//* Add HTML5 responsive recognition
add_theme_support( 'genesis-responsive-viewport' );


/*
=============================================================
Register Menus
=============================================================
*/

function register_menus() {
	register_nav_menus(
		array(
		'top-menu' => __('Topmenu'),	
		'main-menu' => __('Headermenu')
		)
	);
}
	
add_action('init', 'register_menus');

/*
=============================================================
Logo
=============================================================
*/

function themename_custom_logo_setup() {
 $defaults = array(
 'height'      => 100,
 'width'       => 400,
 'flex-height' => true,
 'flex-width'  => true,
 'header-text' => array( 'site-title', 'site-description' ),
 );
 add_theme_support( 'custom-logo', $defaults );
}
add_action( 'after_setup_theme', 'themename_custom_logo_setup' );
function theme_prefix_the_custom_logo() {
	
	if ( function_exists( 'the_custom_logo' ) ) {
		the_custom_logo();
	}
}
/*
=============================================================
Site title
=============================================================
*/
add_filter( 'wp_title', 'wpdocs_hack_wp_title_for_home' );
 
/**
 * Customize the title for the home page, if one is not set.
 *
 * @param string $title The original title.
 * @return string The title to use.
 */
function wpdocs_hack_wp_title_for_home( $title )
{
  if ( empty( $title ) && ( is_home() || is_front_page() ) ) {
     $title .= get_bloginfo( 'name', 'display' ) . ' | ' . get_bloginfo( 'description' );
  }
  return $title;
}

/*
=============================================================
Footer Widgets
=============================================================
*/
function footer_widgets_init() {
	register_sidebar( array(
		'name' => 'Footer Sidebar 1',
		'id' => 'footer-sidebar-1',
		'description' => 'Appears in the footer area',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => 'Footer Sidebar 2',
		'id' => 'footer-sidebar-2',
		'description' => 'Appears in the footer area',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => 'Footer Sidebar 3',
		'id' => 'footer-sidebar-3',
		'description' => 'Appears in the footer area',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
}
add_action('widgets_init','footer_widgets_init');
add_action('widgets_init','footer_widgets_init');
include "incs/init.php";
