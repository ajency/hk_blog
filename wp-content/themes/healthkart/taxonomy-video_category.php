<?php
get_header(); 
$category = get_queried_object();
$args = array(
	'posts_per_page' => 6,
	'post_type' => array('video'),
	'post_status' => 'publish',
	'tax_query' => array(
        array (
            'taxonomy' => 'video_category',
            'field' => 'term_id',
            'terms' => $category->term_id,
        )
    ),
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
	<div class="latest-reads category-list-view position-relative my-4"  data-taxtype='video_category' data-taxonomy="<?php echo $category->term_id; ?>" data-type="video" data-count="<?php echo $wp_query->found_posts; ?>">
		<div class="category-post-row row m-0">
			<?php if( have_posts() ) :
				while( have_posts() ): the_post();
					get_template_part( 'page-templates/theme-sections/video', 'component' );
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
			<?php endforeach;?>
			<li class="page-item <?php echo $currentPage == end($pages) ? 'disabled' : ''; ?>" id="next-page"> <a class="next page-link" href="#">Next</a></li>
		</ul>
	</nav> 
	
</div>
<?php get_footer(); ?>	
