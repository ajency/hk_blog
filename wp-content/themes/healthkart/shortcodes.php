<?php
add_shortcode( 'banner', function(){?>
	<div class="banner-image">
		
	</div>
<?php });

add_shortcode( 'related-articles', function(){?>
<div class="related-articles">
	<div class="section-title pb-3">Related Articles</div>
		<?php 
			global $post;
			$tags = wp_get_post_tags($post->ID);
			if ($tags) {

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
							<div class="col-md-3">
								<div class="recent-post-featured-img">
									<a href="<?php the_permalink(); ?>">
		
										<img src="<?php echo $post_thumbnail_url ?>" alt="<?php echo $post_title;?>" title="<?php echo $post_title;?>">
									</a>
								</div>
							</div>
							<div class="col-md-9">
								<span>
									<span class="category">
									<?php the_category(' , '); ?>
									</span>
									<span class="dot"><i class="fa fa-circle" aria-hidden="true"></i></span>
									<span class="last-read">2 MINS READ</span>
									</span>
								<div class="recent-post-header">
									<h2 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
								</div>
							</div>
						</div>
					</div>
				<?php } ?>
			<?php } ?>
		<?php } ?>	
	</div>
<?php });



add_shortcode( 'form', function(){?>
	<div class="form-wrapper">
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
		<hr>
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
