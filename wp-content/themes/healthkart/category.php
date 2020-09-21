<?php

get_header(); 

?>	


	<div class="header_image position-relative">
		<div class="header">
			<div class="container">
				<div class="breadcrumbs-wrapper position-relative">
      				<div class="breadcrumbs-inside">
  						<a href="<?php echo get_site_url(); ?>/"><i class="fa fa-home" aria-hidden="true"></i></a>
  						<?php the_category(' , '); ?>
  					</div>
  				</div>
			</div>
		</div>
	</div>

	<div class="container p-0">
		<h2 class="category-name"><?php the_category(' , '); ?></h2>
		<p class="text-black pl-15 f-14 article-count">45 articles</p>
		<div class="latest-reads category-list-view">
			<div class="row m-0">
				<?php
				$args = array(
					'posts_per_page' => 5,
					'post__not_in'   => array( get_the_ID() ),
					'no_found_rows'  => true, 
				);
				// Check for current post category and add tax_query to the query arguments
				$cats = wp_get_post_terms( get_the_ID(), 'category' ); 
				$cats_ids = array();  
				foreach( $cats as $wpex_related_cat ) {
					$cats_ids[] = $wpex_related_cat->term_id; 
				}
				if ( ! empty( $cats_ids ) ) {
					$args['category__in'] = $cats_ids;
				}
				// Query posts
				$wpex_query = new wp_query( $args );?>

				<?php  // Loop through posts
				if( $wpex_query->have_posts() ) :

				while( $wpex_query->have_posts() ) :
				$wpex_query->the_post(); ?>
					<div class="col-md-4 col-12 recent-post p-0">
						<div class="row py-4 m-0">
							<div class="col-12">
								<div class="recent-post-featured-img my-3">
									<a href="<?php the_permalink(); ?>">
										<?php if ( has_post_thumbnail() ) {
										the_post_thumbnail('medium');
										} else { ?>
										<img src="<?php echo get_site_url(); ?>/wp-content/uploads/2020/09/default.jpg" alt="<?php the_title(); ?>" />
										<?php } ?>
									</a>
								</div>
							</div>
							<div class="col-12 next-articles">
								<span>
									<span class="category">
										<?php the_category(' , '); ?>
									</span>
									<span class="dot"><i class="fa fa-circle" aria-hidden="true"></i></span>
									<span class="last-read"><?php echo get_estimated_reading_time( get_the_content() ); ?></span>
								</span>
								<div class="recent-post-header">
									<h2 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
								</div>
								<div class="recent-post-excerpt"><?php echo wp_trim_words(get_the_content(), 18, '...'); ?>
								</div>
								<div class="recent-post-icons">
									<span class="mr-3 f-14 heart"><i class="fa fa-heart" aria-hidden="true"></i> 15 </span>
									<span class="mr-3 f-14 comment"><i class="fa fa-comments" aria-hidden="true"></i> 3</span>
								</div>
							</div>
						</div>
					</div>
					<?php endwhile; ?>
				<?php endif; ?>
			</div>	
		</div>
	</div>
<?php

get_footer(); 

?>	