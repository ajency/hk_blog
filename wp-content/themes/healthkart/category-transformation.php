<?php

get_header(); 
$post_ids = get_query_var('post_ids');
$args = array(
	'posts_per_page' => 6,
	'post_type' => array('transformation'),
	'post_status' => 'publish',
	'post__not_in' => $post_ids,
	'meta_key' => 'hk_featured_post',
	'meta_query'     => [
        [
            'key'      => 'hk_featured_post',
            'value'    => 'on',
        ]
    ],
);
if(isset($_GET['page'])){
	$args['paged'] = $_GET['page'];
}
query_posts( $args );
?>	
	<div class="header_image position-relative">
		<div class="header">
			<div class="container">
				<div class="breadcrumbs-wrapper position-relative">
      				<div class="breadcrumbs-inside">
  						<?php echo yoast_breadcrumb(); ?>
  					</div>
  				</div>
			</div>
		</div>
	</div>
	<div class="container p-0">
		<h2 class="category-name pl-15">
			<?php echo $category->name;  ?>
		</h2>
		<p class="text-black pl-15 f-14 article-count">
			<?php echo $category->count . ' Articles '; ?>
		</p>
		<div class="latest-reads category-list-view" data-category="<?php echo $category->term_id; ?>">
			<div class="category-post-row row m-0">
			<?php
				if( have_posts() ) :
					while( have_posts() ): the_post();
						get_template_part( 'page-templates/theme-sections/category-transformation', 'section' ); 
					endwhile;
				endif;
			?>
			</div>
			<div class="my-5 loader category-loader d-none justify-content-center">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/loader.svg">
			</div> 
		</div>
	</div>
<?php

get_footer(); 

?>	