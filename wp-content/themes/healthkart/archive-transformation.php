<?php

get_header(); 
$args = array(
	'posts_per_page' => 6,
	'post_type' => array('transformation'),
	'post_status' => 'publish',
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
		<h2 class="category-name pl-15">Transformation</h2>
		<p class="text-black pl-15 f-14 article-count">
			<?php echo wp_count_posts( 'transformation' )->publish . ' Articles '; ?>
		</p>
		<div class="category-list-view transformation-list-view" data-type="transformation">
			<div class="category-post-row row m-0">
			<?php
				if( have_posts() ) :
					while( have_posts() ): the_post();
						get_template_part( 'page-templates/theme-sections/transformations-single', 'component' ); 
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