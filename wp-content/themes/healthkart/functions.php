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

// Adds image sizes.
add_image_size( 'sidebar-featured', 75, 75, true );
add_image_size( 'genesis-singular-images', 702, 526, true );

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
    wp_enqueue_style('font-family', 'https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">', array(), '', false);
}
//* this will bring in the Genesis Parent files needed:
include_once( get_template_directory() . '/lib/init.php' );

function enqueue_theme_scripts() { 
    wp_register_script( 'jquery-js', get_stylesheet_directory_uri().'/assets/js/jquery.js' , '', '', true );
    wp_register_script( 'bootstrap-js', get_stylesheet_directory_uri().'/assets/js/bootstrap.min.js' , '', '', true );
    wp_register_script( 'themescripts-js', get_stylesheet_directory_uri().'/assets/js/theme-scripts.js' , '', '', true );
   	
   	wp_enqueue_script('jquery-js');
    wp_enqueue_script('bootstrap-js');
    wp_enqueue_script('themescripts-js');     
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
		'top-menu' => __('Topmenu'),	
		'main-menu' => __('Headermenu')
		)
	);
}




add_action('init', 'register_menus');

add_shortcode( 'banner', function(){?>
	<div class="banner-image">
		
	</div>
<?php });

add_shortcode( 'related-articles', function(){?>
<div class="related-articles">
	<div class="section-title pb-3">Related Articles</div>
		<?php 
			global $post;
			$tags = wp_get_post_tags($post->ID);
			if ($tags) {

			$tag_ids = array();
			foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
			$args=array(
			'tag__in' => $tag_ids,
			'post__not_in' => array($post->ID),
			'posts_per_page'=>4, // Number of related posts that will be shown.
			'ignore_sticky_posts'=>1
			);

			$my_query = new wp_query( $args );
			if( $my_query->have_posts() ) {

				while( $my_query->have_posts() ) {
				$my_query->the_post(); ?>

					<div class="recent-post">
						<div class="row py-4">
							<div class="col-md-4">
								<div class="recent-post-featured-img">
									<a href="<?php the_permalink(); ?>">
										<?php
										// $post_thumbnail_url = get_the_post_thumbnail_url($attachment_id,'post-thumb');
										$post_title = get_the_title();

										?>
										<img src="<?php echo $post_thumbnail_url ?>" alt="<?php echo $post_title;?>" title="<?php echo $post_title;?>">
									</a>
								</div>
							</div>
							<div class="col-md-8">
								<span>
									<span class="category">
									<?php the_category(' , '); ?>
									</span>
									<span class="dot"><i class="fa fa-circle" aria-hidden="true"></i></span>
									<span class="last-read">2 MINS READ</span>
									</span>
								<div class="recent-post-header">
									<h2 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
								</div>
							</div>
						</div>
					</div>
				<?php } ?>
			<?php } ?>
		<?php } ?>	
	</div>
<?php });



add_shortcode( 'form', function(){?>
	<div class="form-wrapper">
		<div class="wrap">
			<h2 class="form-title">Ask A Question</h2>
			<div class="form-group">
				<label for="category">Select Topic</label>
				<select class="form-control" id="category">
					<option>BodyBuilding</option>
					<option>HealthyLiving</option>
					<option>Weightloss</option>
					<option>Celebrity</option>
				</select>
			</div>
			<div class="form-group">
				<label for="comment">What's your question</label>
	  			<textarea class="form-control" rows="5" id="comment" placeholder="Please specify in detail"></textarea>
			</div>
			<button type="submit" class="hk-btn">Submit Question</button>
		</div>
		<hr>
		<div class="wrap">
			<h2 class="form-title">Subscribe to Healthkart Blog</h2>
			<p>We’ll email you the latest developments about the Fitness & nutrition and Muscleblaze’s top health news stories, daily.</p>
			<div class="form-group">
		      	<input type="email" class="form-control" id="email" placeholder="Enter email">
			</div>
			<button type="submit" class="hk-btn">Subscribe Now</button>
		</div>
	</div>
<?php });
