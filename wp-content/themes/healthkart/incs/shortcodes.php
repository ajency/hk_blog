<?php
add_shortcode( 'banner', function(){?>
	<div class="banner-image">
		
	</div>
<?php });


add_shortcode( 'read-these-next', function(){?>
	<div class="read-these-next">
		<div class="section-title pb-3">Read these next</div>
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


				<div class="col-12 recent-post p-0">
					<div class="row py-4">
						<div class="col-md-4 col-12">
							<div class="recent-post-featured-img">
								<a href="<?php the_permalink(); ?>">
									<?php if ( has_post_thumbnail() ) {
									the_post_thumbnail('medium');
									} else { ?>
									<img src="<?php echo get_site_url(); ?>/wp-content/uploads/2020/09/default.jpg" alt="<?php the_title(); ?>" />
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
<?php });


add_shortcode( 'related-articles', function(){?>
<div class="related-articles">
	<div class="section-title pb-3">Related Articles</div>
		<?php 
			global $post;
			$tags = wp_get_post_tags($post->ID);
			if ($tags) :

			$tag_ids = array();
			foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
			$args=array(
			'tag__in' => $tag_ids,
			'post__not_in' => array($post->ID),
			'posts_per_page'=>4, // Number of related posts that will be shown.
			'ignore_sticky_posts'=>1
			);

			$my_query = new wp_query( $args );
			if( $my_query->have_posts() ) {

				while( $my_query->have_posts() ) {
				$my_query->the_post(); ?>

					<div class="recent-post">
						<div class="row py-4">
							<div class="col-4">
								<div class="recent-post-featured-img">
									<a href="<?php the_permalink(); ?>">
										<?php if ( has_post_thumbnail() ) {
										the_post_thumbnail('thumbnail');
										} else { ?>
										<img src="<?php echo get_site_url(); ?>/wp-content/uploads/2020/09/default.jpg" alt="<?php the_title(); ?>" />
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
									<span class="last-read"><?php echo get_estimated_reading_time( get_the_content() ); ?></span>
								</span>
								<div class="recent-post-header">
									<h2 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
								</div>
							</div>
						</div>
					</div>
				<?php } ?>
			<?php } ?>
			<?php else : ?>
			<p class="no-post"><?php _e( 'Sorry, there are no posts to show.' ); ?></p>
			<?php endif; ?>
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
		      	<input type="email" class="form-control" id="email" placeholder="Enter email">
			</div>
			<button type="submit" class="hk-btn">Subscribe Now</button>
		</div>
	</div>
<?php });
