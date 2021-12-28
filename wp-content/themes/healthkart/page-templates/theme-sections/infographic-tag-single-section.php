<?php
$category = get_queried_object();
$hindi_cat = get_category_by_slug('hindi');
$args = array(
	'posts_per_page' => 24,
	'post_type' => 'infographic',
	'post_status' => 'publish',
	'tax_query' => array(
		array(
			'taxonomy' => $category->taxonomy,
			'field' => 'term_id',
			'terms' => $category->term_id,
		)
	)
);
if(isset($_GET['page'])){
	$args['paged'] = $_GET['page'];
}
if($category->term_id != $hindi_cat->term_id){
	$args['category__not_in'] = array($hindi_cat->term_id);
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
<div class="container category-container">
	<h1 class="category-name">
		<?php echo $category->name;  ?>
	</h1>
	<p class="text-black f-14 article-count">
		<?php echo $category->count . ' Articles '; ?>
	</p>
	<div class="latest-reads category-list-view position-relative mt-4" data-category="<?php echo $category->term_id; ?>" data-type="infographic" data-count="<?php echo $wp_query->found_posts; ?>" data-taxonomy="<?php echo $category->taxonomy; ?>">
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
			$currentPage = $_GET['page'] ?? 1;
			$pages = hk_get_pagination($wp_query->found_posts, $currentPage); ?>

			<li class="page-item <?php echo $currentPage == 1 ? 'disabled' : ''; ?>" id="previous-page"> <a class="prev page-link" href="#">Prev</a></li>
			<?php  foreach ($pages as $page) : ?>
				<li class="page-item <?php echo ($currentPage == $page ? 'active' : ''); echo is_numeric($page) ? ' current-page' : ''; ?>" data-page="<?php echo is_numeric($page) ? $page : 0; ?>">
					<a class="page-link" href="javascript:void(0)"><?php echo $page; ?></a>
				</li>
			<?php endforeach; ?>
			<li class="page-item <?php echo $currentPage == end($pages) ? 'disabled' : ''; ?>" id="next-page"> <a class="next page-link" href="#">Next</a></li>
		</ul>
	</nav> 
	<div class="latest-reads category-reads">
		<div class="read-these-next">
			<div class="section-title pb-3">Read these next</div>
			<div class="read-these-next-content mt-3">
			<?php
				$args = array(
					'posts_per_page' => 10,
					'post__not_in'   => array( get_the_ID() ),
					'no_found_rows'  => true, 
					/* 'post__not_in' => $post_ids, */
					'meta_key' => 'hk_next_post',
					'meta_query'     => [
				        [
				            'key'      => 'hk_next_post',
				            'value'    => 'on',
				        ]
				    ],
				);
				query_posts( $args ); 
				if( have_posts() ) :
					while( have_posts() ): the_post(); $post_ids[] = get_the_id();?>
						<?php get_template_part( 'page-templates/theme-sections/category', 'component' ); ?>
					<?php endwhile;
				endif; ?>
			</div>
		</div>
	</div>
</div>