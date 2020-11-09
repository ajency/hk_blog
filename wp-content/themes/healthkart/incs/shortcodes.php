<?php
add_shortcode( 'banner', function(){?>
	<div class="banner-image">
		
	</div>
<?php });


add_shortcode( 'read-these-next', function(){?>
	<div class="read-these-next mt-4">
		<div class="section-title pb-3">Read these next</div>
		<?php
			$args = array(
				'posts_per_page' => 5,
				'post_type' => 'post',
				'post__not_in'   => array( get_the_ID() ),
				'no_found_rows'  => true, 
				'date_query'    => array(
			        'column'  => 'post_date',
			        'before'   => get_the_date('Y-m-d')
			    ),
			);
			// Query posts
			$wpex_query = new wp_query( $args );?>
			<?php  // Loop through posts
			if( $wpex_query->have_posts() ) :
			while( $wpex_query->have_posts() ) :
			$wpex_query->the_post(); ?>
				<div class="col-12 recent-post p-0">
					<div class="row py-4">
						<div class="col-md-4 col-12">
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
						</div>
						<div class="col-md-8 col-12 next-articles">
							<span>
								<span class="category">
									<?php the_category(' , '); ?>
								</span>
								<span class="dot"><i class="fa fa-circle" aria-hidden="true"></i></span>
								<span class="last-read"><?php echo get_mins_read(); ?> MIN READ</span>
							</span>
							<div class="recent-post-header">
								<h2 class="title"><a href="<?php the_permalink(); ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
							</div>
							<div class="recent-post-excerpt content-desktop"><?php echo wp_trim_words(get_the_content(), 18, '...'); ?>
							</div>
							<div class="content-description content-mobile"><?php echo hk_get_excerpt(220); ?></div>
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
<?php });


add_shortcode( 'related-articles', function(){?>
<div class="related-articles mt-4">
	<div class="section-title pb-3">Related Articles</div>
		<?php 
			global $post;
			$tags = wp_get_post_tags($post->ID);
			$post_ids = [];
			if($tags){
				$tag_ids = array();
				foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
				$args=array(
				'fields'         => 'ids',
				'tag__in' => $tag_ids,
				'post__not_in' => array($post->ID),
				'posts_per_page'=>4, // Number of related posts that will be shown.
				'post_status'    => 'publish',
				);
				$post_ids = get_posts( $args );
			}
			$page_post_ids = get_query_var('post_ids');
			if(count($post_ids) < 4){
				$count = 4 ;
				$args = array(
					'fields'         => 'ids',
					'posts_per_page' => 4 - count($post_ids),
					'post__not_in'   => array_merge(array($post->ID),$post_ids,(array)$page_post_ids),
					'post_status'    => 'publish',
				);
				// Check for current post category and add tax_query to the query arguments
				$cats = wp_get_post_terms( $post->ID, 'category' ); 
				$cats_ids = array();  
				foreach( $cats as $wpex_related_cat ) {
					$cats_ids[] = $wpex_related_cat->term_id; 
				}
				if ( ! empty( $cats_ids ) ) {
					$args['category__in'] = $cats_ids;
				}
				// Query posts
				$cat_post_ids = get_posts( $args );		
				$post_ids = array_merge($post_ids, $cat_post_ids);
			}
			$my_query = new WP_Query(array(
			    'post_type' => 'any',
			    'post__in'  => $post_ids, 
			    'orderby'   => 'date', 
			    'order'     => 'DESC'
			));
			if( $my_query->have_posts() ) {
				while( $my_query->have_posts() ) {
				$my_query->the_post(); ?>

					<div class="recent-post">
						<div class="row py-4">
							<div class="col-4">
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
							</div>
							<div class="col-8 pl-0">
								<span>
									<span class="category">
									<?php the_category(' , '); ?>
									</span>
									<span class="dot"><i class="fa fa-circle" aria-hidden="true"></i></span>
									<span class="last-read"><?php echo get_mins_read(); ?> MIN READ</span>
								</span>
								<div class="recent-post-header">
									<h2 class="title"><a href="<?php the_permalink(); ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
								</div>
							</div>
						</div>
					</div>
				<?php } ?>
			<?php }else{ ?>
			<p class="no-post"><?php _e( 'Sorry, there are no posts to show.' ); ?></p>
		<?php } ?>
	</div>
<?php });



add_shortcode( 'Question_form', function(){?>
	<div class="form-wrapper qna">
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
	</div>
<?php });


add_shortcode( 'Subscribe-form', function(){?>
	<div class="form-wrapper subscribe">
		<div class="wrap">
			<h2 class="form-title">Subscribe to Healthkart Blog</h2>
			<p>We’ll email you the latest developments about the Fitness & nutrition and Muscleblaze’s top health news stories, daily.</p>
			<div class="form-group">
		      	<?php echo do_shortcode( '[formidable id=1]' ) ?>
			</div>
		</div>
	</div>
<?php });


add_shortcode( 'read-these-next-transformations', function(){?>
	<div class="read-these-next">
		<div class="section-title pb-3">Read these next</div>
		<?php
			$args = array(
				'posts_per_page' => 5,
				'post__not_in'   => array( get_the_ID() ),
				'no_found_rows'  => true, 
				'post_type' => array('transformation'),
			);
			// Query posts
			$wpex_query = new wp_query( $args );?>
			<?php  // Loop through posts
			if( $wpex_query->have_posts() ) :
			while( $wpex_query->have_posts() ) :
			$wpex_query->the_post(); ?>
				<div class="col-12 recent-post p-0">
					<div class="row py-4">
						<div class="col-md-4 col-12">
							<div class="transformation-section-single-image mb-2">
								<a class="row" href="<?php the_permalink(); ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>">
								<?php
									$before_image_id = get_post_meta(get_the_id(), 'hk_image_before_diet_id', true);
									$before_image_url = wp_get_attachment_image_src($before_image_id, 'medium')[0];
									$after_image_id = get_post_meta(get_the_id(), 'hk_image_after_diet_id', true);
									$after_image_url = wp_get_attachment_image_src($after_image_id, 'medium')[0];
								?>
								<div class="position-relative col-md-6 pl-3 pr-1 transform">
									<img src="<?php echo $before_image_url; ?>"/>
									<div class="img-tag px-3 py-1">Before</div>
								</div>
								<div class="position-relative col-md-6 pl-1 pr-3 transform">
									<img src="<?php echo $after_image_url; ?>"/>
									<div class="img-tag px-3 py-1">After</div>
								</div>
								</a>
							</div>
						</div>
						<div class="col-md-8 col-12 next-articles">
							<span>
								<a target="_blank" title="Transformation" href="<?php echo get_post_type_archive_link(get_post_type()); ?>" rel="category tag">Transformation</a>
								<span class="dot"><i class="fa fa-circle" aria-hidden="true"></i></span>
								<span class="last-read"><?php echo get_mins_read(); ?> MIN READ</span>
							</span>
							<div class="recent-post-header">
								<h2 class="title"><a href="<?php the_permalink(); ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
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
<?php });

add_shortcode( 'latest-articles', function(){
	ob_start(); 
	?> <div class="container">
		<div class="banner row mt-4">
			<div class="banner-category col-12 col-md-4">
				<div class="banner-category-title">Top Topics</div>
				<?php $categories = get_terms(['taxonomy' => 'category' ]); 
				foreach ($categories as $category):
					$is_featured = get_term_meta( $category->term_id, 'hk_featured_category', true );
					if($is_featured == 'on'): ?>
						<div class="banner-category-single"><a href="<?php echo get_category_link($category->term_id); ?>" >
							<div class="banner-category-single-image">
								<?php
								$image_id = get_term_meta( $category->term_id, 'hk_featured_image_id', true );
								$image_url = wp_get_attachment_image_src($image_id, 'large')[0];
								?>
								<img title="<?php echo $category->name; ?>" src="<?php echo $image_url; ?>" alt="<?php echo $category->name; ?>"/>
								<div class="overlay"></div>
							</div>
							<div class="banner-category-single-title"><?php echo $category->name; ?></div>
						</a></div>
					<?php endif; ?>
				<?php endforeach; ?>
			</div>
		</div>
		<?php get_template_part( 'page-templates/theme-sections/latest-articles', 'section' );?>
	</div> 
	<?php $content = ob_get_clean();
	return $content;
});