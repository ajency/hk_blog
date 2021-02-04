<?php

get_header(); 
get_template_part( 'page-templates/theme-sections/follow-sidebar', 'section' ); 
$args = array(
	'posts_per_page' => 24,
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
		<div class="category-list-view transformation-list-view position-relative" data-type="transformation" data-count="<?php echo $wp_query->found_posts; ?>">
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
				<div class="section-title pb-3">View Articles</div>
				<div class="read-these-next-content mt-3">
				<?php
					$args = array(
						'posts_per_page' => 10,
						'post__not_in'   => array( get_the_ID() ),
						'no_found_rows'  => true, 
						'post__not_in' => $post_ids,
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
							<div class="recent-post mx-4">
								<div class="recent-post-featured-img">
									<a href="<?php the_permalink(); ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>">
										<?php 
										$thumbnail = get_post_meta(get_the_id(), 'hk_thumbnail_image', true);
										if ( $thumbnail ) { ?>
											<img src="<?php echo $thumbnail; ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>"/>
										<?php } else if ( has_post_thumbnail() ) {
										the_post_thumbnail('medium', ['title' => get_the_title()]); ?>
										<?php
										} else { ?>
										<img src="<?php echo get_site_url(); ?>/wp-content/uploads/2020/09/default.jpg" alt="<?php the_title(); ?>" title="<?php the_title(); ?>"/>
										<?php } ?>
									</a>
								</div>
								<div class="recent-post-content pt-3">
									<?php $categories = hk_get_category(get_the_ID()); ?>
									<span>
										<span class="category">
											<?php foreach($categories as $index => $category): ?>
											<a title="<?php echo $category->name; ?>" href="<?php echo get_category_link($category); ?>" rel="category tag"><?php echo $category->name; ?></a>
											<?php if($index+1 != count($categories)): ?>
												,
											<?php endif; endforeach; ?>
										</span>
										<span class="dot"><i class="fa fa-circle" aria-hidden="true"></i></span>
										<span class="last-read"><?php echo get_mins_read(); ?> MIN READ</span>
										<span class="dot"><i class="fa fa-circle" aria-hidden="true"></i></span>
										<?php $post_date = get_the_date( 'M j, Y' ); ?>
										<span class="last-read"><?php echo $post_date; ?></span>
									</span>
									<div class="recent-post-header">
										<h2 class="title"><a href="<?php the_permalink(); ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
									</div>
									<div class="recent-post-excerpt"><?php echo hk_get_excerpt(140); ?>
									</div>
								</div>
							</div>
						<?php endwhile;
					endif; ?>
				</div>
			</div>
		</div>
	</div>
<?php

get_footer(); 

?>	