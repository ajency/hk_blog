<?php
function fetch_category_articles(){
	get_template_part( 'page-templates/theme-sections/explore-articles', 'component' );
	die;
}
add_action('wp_ajax_fetch_category_articles', 'fetch_category_articles'); 
add_action('wp_ajax_nopriv_fetch_category_articles', 'fetch_category_articles');

function fetch_category_page_articles(){
	$args = array(
		'posts_per_page' => 6,
		'post_type' => array('post'),
		'post_status' => 'publish',
		'cat' => $_POST['category'],
		'paged' => $_POST['page']
	);
	query_posts( $args ); ?>
	<div class="category-post-row row">
		<?php if( have_posts() ) :
			while( have_posts() ): the_post();
				get_template_part( 'page-templates/theme-sections/category', 'section' );
			endwhile;
		endif; ?>
	</div>
	<div class="my-5 loader category-loader d-none justify-content-center">
		<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/loader.svg">
	</div> 
	<?php die; 
}
add_action('wp_ajax_fetch_category_page_articles', 'fetch_category_page_articles'); 
add_action('wp_ajax_nopriv_fetch_category_page_articles', 'fetch_category_page_articles');