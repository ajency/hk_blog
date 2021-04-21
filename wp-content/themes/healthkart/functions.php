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
 	wp_enqueue_style('theme-styles', get_stylesheet_directory_uri() . '/assets/css/theme-styles.css', array(), '2.8', false);
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
    wp_register_script( 'themescripts', get_stylesheet_directory_uri().'/assets/js/theme-scripts.js' , '', '2.2', true );
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

add_filter( 'wpseo_json_ld_output', '__return_false' );


/*********
remove tags for blog post (change request)
********
// Disable Tags Dashboard WP
add_action('admin_menu', 'my_remove_sub_menus');

function my_remove_sub_menus() {
    remove_submenu_page('edit.php', 'edit-tags.php?taxonomy=post_tag');
    remove_submenu_page('edit.php', 'edit-tags.php?taxonomy=secondary_tag');
}
// Remove secondary tags support from posts
function myprefix_unregister_tags() {
    unregister_taxonomy_for_object_type('post_tag', 'infographic');
    unregister_taxonomy_for_object_type('post_tag', 'transformation');
    unregister_taxonomy_for_object_type('post_tag', 'video');
    unregister_taxonomy_for_object_type('post_tag', 'post');
    unregister_taxonomy_for_object_type('secondary_tag', 'post');

}
add_action('init', 'myprefix_unregister_tags');



/*********/


/********Tansformaion for AMP **********/

add_action('ampforwp_inside_post_content_before','amp_custom_image_before_content');
function amp_custom_image_before_content() {

	$post_type = get_post_type(); 
	if($post_type == "transformation"){
		$before_image_id = get_post_meta(get_the_id(), 'hk_image_before_diet_id', true);
		$before_image_url = wp_get_attachment_image_src($before_image_id, 'medium')[0];
		$after_image_id = get_post_meta(get_the_id(), 'hk_image_after_diet_id', true);
		$after_image_url = wp_get_attachment_image_src($after_image_id, 'medium')[0];

		$before_weight = get_post_meta(get_the_id(), 'hk_weight_before_diet', true);
		$after_weight = get_post_meta(get_the_id(), 'hk_weight_after_diet', true);
		$before_age = get_post_meta(get_the_id(), 'hk_age_before_diet', true);
		$after_age = get_post_meta(get_the_id(), 'hk_age_after_diet', true);
		$before_fat = get_post_meta(get_the_id(), 'hk_body_fat_before_diet', true);
		$after_fat = get_post_meta(get_the_id(), 'hk_body_fat_after_diet', true);
		 ?>
		 <div class="amp-content-fields p-3">
				<div class="content-fields-titles row">
					<div class="age-content border-r">
						<label class="content-fields-titles-single col-md-2 pr-2">Age</label>
					</div>
					<div class="fat-content border-r">
						<label class="content-fields-titles-single col-md-3 px-2">Then</label>
						<label class="content-fields-titles-single col-md-2 px-2 transformation-border-right">Now</label>
					</div>
					<div class="fat-content">
						<label class="content-fields-titles-single col-md-3 px-2">Bodyfat then</label>
						<label class="content-fields-titles-single col-md-2 px-2">Now</label>
					</div>
				</div>
				<div class="content-fields-values row">
					<div class="age-content border-r">
						<span class="content-fields-values-single col-md-2 pr-2"><?php echo $before_age.'/'.$after_age; ?></span>
					</div>
					<div class="fat-content border-r">
						<span class="content-fields-value-single transformation-before col-md-2 px-2"><?php echo $before_weight; ?>kg</span>
						<span class="content-fields-value-single transformation-seperator col-md-1 px-2">></span>
						<span class="content-fields-values-single transformation-after transformation-border-right col-md-2 px-2"><?php echo $after_weight; ?>kg</span>
					</div>
					<div class="fat-content">
						<span class="content-fields-values-single transformation-before col-md-2 px-2"><?php echo is_numeric($before_fat) ? $before_fat.'%' : $before_fat; ?></span>
						<span class="content-fields-values-single transformation-seperator col-md-1 px-2">></span>
						<span class="content-fields-values-single transformation-after col-md-2 px-2"><?php echo is_numeric($after_fat) ? $after_fat.'%' : $after_fat; ?></span>
					</div>
				</div>
			</div>
			
			<div class="blog_featured_img my-4 content-mobile">
				<a class="row amp-img-container" href="<?php the_permalink(); ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>">
				<div class="position-relative col-md-6 pl-3 pr-1 transform">
					<img src="<?php echo $before_image_url; ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />
					<div class="img-tag px-3 py-1">Before</div>
				</div>
				<div class="position-relative col-md-6 pl-1 pr-3 transform">
					<img src="<?php echo $after_image_url; ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />
					<div class="img-tag px-3 py-1">After</div>
				</div>
				</a>
			</div>


		<?php 
	}
	
}


add_action('ampforwp_after_post_content','amp_custom_content_after_default_content');
function amp_custom_content_after_default_content() {
	$post_type = get_post_type();  
	if($post_type == "transformation"){
		

		 ?>
			<div class="entry-content">
				<?php $transform_reason = get_post_meta(get_the_id(), 'hk_transform_reason', true); 
					if($transform_reason): ?>
					<div class="my-2">
							<h2 class="entry-content-heading">Why you decided to Transform?</h2>
							<div class="entry-content-single"><?php echo $transform_reason; ?></div>
					</div>
				<?php endif; ?>
				<?php $accomplish_goal = get_post_meta(get_the_id(), 'hk_accomplish_goal', true); 
					if($accomplish_goal): ?>
					<div class="my-2">
							<h2 class="entry-content-heading">How did you accomplish your Goal:</h2>
							<div class="entry-content-single"><?php echo $accomplish_goal; ?></div>
					</div>
				<?php endif; ?>
				<?php $training_routine = get_post_meta(get_the_id(), 'hk_training_routine', true); 
					if($training_routine): ?>
					<div class="my-2">
							<h2 class="entry-content-heading">Training routine that helped you achieve your Goals</h2>
							<div class="entry-content-single"><?php echo $training_routine; ?></div>
					</div>
				<?php endif; ?>
				<?php $supplements_that_helped = get_post_meta(get_the_id(), 'hk_supplements_that_helped', true); 
					if($supplements_that_helped): ?>
					<div class="my-2">
							<h2 class="entry-content-heading">Supplements:</h2>
							<div class="entry-content-single"><?php echo $supplements_that_helped; ?></div>
					</div>
				<?php endif; ?>
				<?php $challenges = get_post_meta(get_the_id(), 'hk_challenges', true); 
					if($challenges): ?>
					<div class="my-2">
							<h2 class="entry-content-heading">What challenges did you face?</h2>
							<div class="entry-content-single"><?php echo $challenges; ?></div>
					</div>
				<?php endif; ?>
				<?php $how_did_you_overcome = get_post_meta(get_the_id(), 'hk_how_did_you_overcome', true); 
					if($how_did_you_overcome): ?>
					<div class="my-2">
							<h2 class="entry-content-heading">How did you overcome these challenges?</h2>
							<div class="entry-content-single"><?php echo $how_did_you_overcome; ?></div>
					</div>
				<?php endif; ?>
				<?php $future_suggestion = get_post_meta(get_the_id(), 'hk_future_suggestion', true); 
					if($future_suggestion): ?>
					<div class="my-2">
							<h2 class="entry-content-heading">Suggestion for future transformers</h2>
							<div class="entry-content-single"><?php echo $future_suggestion; ?></div>
					</div>
				<?php endif; ?>
			</div> 

		<?php 
	}
	
}

add_action('amp_post_template_css', 'amp_custom_feild_styling');
function amp_custom_feild_styling() { 
	$post_type = get_post_type();  
	if($post_type == "transformation"){

		?>
		.amp-wp-article-featured-image {
			display: none;
		}
		.amp-custom-banner-after-post {
			text-align: center
		}
		.amp-content-fields {
		    background-color: #212121;
		    color: #fff;
		    border-radius: 10px;
		    font-size: 13px;
		    font-weight: bolder;
			padding: 9px 0;
			margin: 21px 0;
			display: flex;
	    	flex-direction: column;
		}
		.img-tag{
			position: absolute;
			color: #fff;
			background-color: #212121;
			border-radius: 10px;
			border: 1px solid #707070;
			bottom: 22px;
			left: 17px;
			font-size: 18px;
			font-weight: bold;
			padding: 2px 12px;
		}
		.amp-img-container{
			/*justify-content: space-between;*/
			justify-content: center;
		}
		.amp-img-container .transform {
	    	width: 46%;
	    	padding: 0px 5px;
			max-width: 200px;
		}
		.amp-img-container .transform img {
	    	width: 100%;
	    	height: auto;
		}
		/*@media (max-width: 767px){*/
			.amp-wp-article-content .the_content h2 {
	    		font-size: 17px;
				color: #212529;
			}
			.amp-wp-article-content .the_content p {
	    		font-size: 15px;
				line-height: 27px;
				color: #333333;
			}
			.amp-wp-article-header h1.amp-wp-title{
				font-size: 24px;
				color: #000;
				font-weight: 700;
			}
			/**For ordering of black box **/
			.amp-wp-article-content .amp-wp-content.the_content{
				display: grid;
				padding-bottom: 24px;
			}
			.blog_featured_img.content-mobile{
				order: -2;
				margin-top: 8px;
			}
			.amp-content-fields{
				order: -1;
			}
		/*}*/	
		.fat-content {
	    	/* width: 42%; */
			width: 35%;
			padding: 0 10px;
	    	display: flex;
	    	justify-content: space-between;
			margin-left: auto;
	    	margin-right: auto;
		}
		@media (max-width:345px){
			.fat-content {
				padding: 0;
				justify-content: space-around;
			}
		}
		.border-r{
			border-right: 1px solid #707070;
		}
		.age-content {
	    	width: 15%;
			text-align: center;
			margin-left: auto;
	   		margin-right: auto;
		}
		.transformation-before {
	 	   color: #FC5A5A;
		}
		.transformation-seperator {
			color: #707070;
			font-size: 20px;
		}
		.transformation-after {
	    	color: #3DD598;
		}
	<?php 
	}
}
/*****************/
