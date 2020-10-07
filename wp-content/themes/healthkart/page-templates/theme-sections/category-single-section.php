<?php
$category = get_queried_object();
$args = array(
	'posts_per_page' => 6,
	'post_type' => array('post'),
	'post_status' => 'publish',
	'cat' => $category->term_id,
);
if(isset($_GET['page'])){
	$args['paged'] = $_GET['page'];
}
query_posts( $args );
global $wp_query; 
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
	<div class="latest-reads category-list-view position-relative" data-category="<?php echo $category->term_id; ?>" data-type="post" data-count="<?php echo $wp_query->found_posts; ?>">
		<div class="category-post-row row m-0">
			<?php if( have_posts() ) :
				while( have_posts() ): the_post();
					get_template_part( 'page-templates/theme-sections/category', 'component' );
				endwhile;
			endif; ?>
		</div>
		<div class="my-5 loader category-loader d-none justify-content-center">
			<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/loader.svg">
		</div>
	</div>
	
	<nav class="my-4">
		<ul class="pagination justify-content-center pagination-sm">
		<?php 
			$pages = paginate_links( array(
				'format' => '?page=%#%',
		    	'mid_size'=>1,
		    	'prev_next' => FALSE,
			  	'type'  => 'array',
			) ); 
			preg_match_all('/\d+/', end($pages), $matches);
    		$end = $matches[0][0];
			?>

			<li class="page-item <?php echo !$_GET['page'] || $_GET['page'] == 1 ? 'disabled' : ''; ?>" id="previous-page"> <a class="prev page-link" href="#">Prev</a></li>
			<?php foreach ($pages as $index => $page) {
				echo '<li class="current-page page-item' . (strpos($page, 'current') !== false ? ' active' : '').'"> ' . str_replace('page-numbers', 'page-link', $page) . '</li>';
			} ?>
			<li class="page-item <?php echo $_GET['page'] == $end ? 'disabled' : ''; ?>" id="next-page"> <a class="next page-link" href="#">Next</a></li>
		</ul>
	</nav> 
	
</div>