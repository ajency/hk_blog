<?php
/*
Template Name: Search Page
*/
get_header(); 
global $query_string;

wp_parse_str( $query_string, $search_query );
$search_query['paged'] = $search_query['page'];
$search = new WP_Query( $search_query );
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
<div class="container p-0 category-container">
	<p class="text-black pl-15 f-14 article-count">
		<?php echo $search->found_posts . ' Articles Found'; ?>
	</p>
	<?php if ($search->found_posts) : ?>
	<div class="latest-reads category-list-view position-relative" data-category="<?php echo $category->term_id; ?>" data-type="post" data-count="<?php echo $wp_query->found_posts; ?>">
		<div class="category-post-row row m-0">
			<?php if( $search->have_posts() ) :
				while( $search->have_posts() ): $search->the_post(); ?>
					<div class="col-md-4 col-12 recent-post p-0">
						<div class="row py-4 m-0">
							<div class="col-12">
								<div class="recent-post-featured-img my-3">
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
							</div>
							<div class="col-12 next-articles">
								<?php $categories = hk_get_category(get_the_ID()); ?>
								<span>
									<span class="category">
										<?php if ($categories): ?>
											<?php foreach($categories as $index => $category): ?>
											<a title="<?php echo $category->name; ?>" href="<?php echo get_category_link($category); ?>" rel="category tag"><?php echo $category->name; ?></a>
											<?php if($index+1 != count($categories)): ?>
												,
											<?php endif; endforeach; ?>
										<?php else: ?>
											<a title="<?php echo ucwords(get_post_type()); ?>" href="<?php echo get_post_type_archive_link(get_post_type()); ?>" rel="category tag"><?php echo ucwords(get_post_type()); ?></a>
										<?php endif; ?>
									</span>
									<span class="dot"><i class="fa fa-circle" aria-hidden="true"></i></span>
									<span class="last-read"><?php echo get_mins_read(); ?> MIN READ</span>
								</span>
								<div class="recent-post-header">
									<h2 class="title"><a href="<?php the_permalink(); ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
								</div>
								<div class="recent-post-excerpt"><?php echo hk_get_excerpt(140); ?>
								</div>
								<!-- <div class="recent-post-icons">
									<span class="mr-3 f-14 heart"><i class="fa fa-heart" aria-hidden="true"></i> 15 </span>
									<span class="mr-3 f-14 comment"><i class="fa fa-comments" aria-hidden="true"></i> 3</span>
								</div> -->
							</div>
						</div>
					</div>
				<?php endwhile;
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
			$pages = hk_get_pagination($search->found_posts, $currentPage); ?>

			<li class="page-item <?php echo $currentPage == 1 ? 'disabled' : ''; ?>" id="previous-page"> <a class="prev page-link" href="#">Prev</a></li>
			<?php  foreach ($pages as $page) : ?>
				<li class="page-item <?php echo ($currentPage == $page ? 'active' : ''); echo is_numeric($page) ? ' current-page' : ''; ?>" data-page="<?php echo is_numeric($page) ? $page : 0; ?>">
					<a class="page-link" href="javascript:void(0)"><?php echo $page; ?></a>
				</li>
			<?php endforeach; ?>
			<li class="page-item <?php echo $currentPage == end($pages) ? 'disabled' : ''; ?>" id="next-page"> <a class="next page-link" href="#">Next</a></li>
		</ul>
	</nav> 
	<?php else: ?>
		<div class="my-5 text-center"><h3>No results have been found.</h3></div>
	<?php endif; ?>
	<div class="latest-reads category-reads">
		<div class="read-these-next">
			<div class="section-title pb-3">Read these next</div>
			<div class="row">
			<?php
				$args = array(
					'posts_per_page' => 4,
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
				// Query posts
				$wpex_query = new wp_query( $args );?>
				<?php  // Loop through posts
				if( $wpex_query->have_posts() ) :
				while( $wpex_query->have_posts() ) :
				$wpex_query->the_post(); ?>
				<div class="col-md-3 col-12 recent-post p-0">
					<div class="row py-4 m-0">
						<div class="col-12">
							<div class="recent-post-featured-img my-3">
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
						</div>
						<div class="col-12 next-articles">
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
							</span>
							<div class="recent-post-header">
								<h2 class="title"><a href="<?php the_permalink(); ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
							</div>
							<div class="recent-post-excerpt"><?php echo hk_get_excerpt(140); ?>
							</div>
							<!-- <div class="recent-post-icons">
								<span class="mr-3 f-14 heart"><i class="fa fa-heart" aria-hidden="true"></i> 15 </span>
								<span class="mr-3 f-14 comment"><i class="fa fa-comments" aria-hidden="true"></i> 3</span>
							</div> -->
						</div>
					</div>
				</div>
				<?php endwhile; ?>
			<?php endif; ?>
			</div>
		</div>
	</div>
</div>
<?php
get_footer(); 

?>	
