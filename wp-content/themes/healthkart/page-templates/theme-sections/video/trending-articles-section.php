<div class="trending-articles-section trending-videos-section  mt-3">
	<div class="section-heading pt-3 pb-3">Trending Videos</div>
	<div class="trending-articles mt-4">
		<div class="row">
			<div class="col-12 row m-0 p-0">
			<?php 
				$post_ids = get_query_var('post_ids');
				$args = array(
					'posts_per_page' => 3,
					'post_type' => array('video'),
					'post_status' => 'publish',
					'post__not_in' => $post_ids,
					'meta_key' => 'hk_views',
					'order' => 'DESC',
					'orderby' => 'meta_value_num'
				);
				$main_post = new wp_query( $args );
				if( $main_post->have_posts() ) :
					while( $main_post->have_posts() ) :
						$main_post->the_post(); 
						$post_ids[] = get_the_id();


preg_match('/<div[^>]*>(.*?)<\/div>/s', get_the_content(), $matches);
if(isset($matches[1])):
foreach ($matches as $video) { 
 ?>
	<div class="trending-articles-single trending-articles-single-main col-md-4 col-12">
									<div class="trending-articles-single-image mb-4">
										<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
											<div class="videos-single-image-overlay"></div>
												<iframe class="videos-single-image-iframe" width="100%" src="<?php echo $video;?>?modestbranding=1&autohide=1&showinfo=0&controls=0" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
										</a>
									</div>
									<div class="trending-articles-single-content">
										<div class="content-title">
											<?php $categories = hk_get_category(get_the_ID(), 'video_category');  ?>
											<span>
												<span class="category">
													<?php foreach($categories as $index => $category): ?>
													<a title="<?php echo $category->name; ?>" href="<?php echo get_category_link($category); ?>" rel="category tag"><?php echo $category->name; ?></a>
													<?php if($index+1 != count($categories)): ?>
														,
													<?php endif; endforeach; ?>
												</span>
											</span>
											<h2 class="title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
										</div>
									</div>
								</div>
	<?php 

	}
endif;
					endwhile;
				endif; ?>
			</div>
<!-- 			<div class="col-md-4 col-12 sidebar">
				<?php
	                /* do_shortcode('[Subscribe-form]'); */
	            ?>
			</div> -->
		</div>
		<div class="newsletter-section">
			<?php do_shortcode('[Subscribe-form]'); ?>
		</div>
		<h2 class="section-heading similar-articles pt-3 pb-3 mt-5 mb-4">Similar</h2>
		<div class="row similar-articles">
		<?php
		$args = array(
			'posts_per_page' => 6,
			'post_type' => array('video'),
			'post_status' => 'publish',
			'post__not_in' => $post_ids,
			'meta_key' => 'hk_views',
			'order' => 'DESC',
			'orderby' => 'meta_value_num'
		);
		$main_post = new wp_query( $args );
		if( $main_post->have_posts() ) :
			while( $main_post->have_posts() ) :
				$main_post->the_post(); 
				$post_ids[] = get_the_id();

				preg_match('/<div[^>]*>(.*?)<\/div>/s', get_the_content(), $matches);
if(isset($matches[1])):
foreach ($matches as $video) { 
 ?>
			<div class="trending-articles-single row mb-3 col-md-6 col-12 m-0 pl-0 pr-0">
							<div class="trending-articles-single-image mb-3 col-md-5 col-lg-4 col-12">
								<a href="<?php the_permalink(); ?>"  title="<?php the_title(); ?>">
									<div class="videos-single-image-overlay"></div>
										<iframe class="videos-single-image-iframe" width="100%" src="<?php echo $video;?>?modestbranding=1&autohide=1&showinfo=0&controls=0" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
								</a>
							</div>
							<div class="trending-articles-single-content mt-2 col-md-7 col-lg-8 col-12 p-0">
								<div class="content-title">
									<?php $categories = hk_get_category(get_the_ID(), 'video_category');  ?>
									<span>
										<span class="category">
											<?php foreach($categories as $index => $category): ?>
											<a title="<?php echo $category->name; ?>" href="<?php echo get_category_link($category); ?>" rel="category tag"><?php echo $category->name; ?></a>
											<?php if($index+1 != count($categories)): ?>
												,
											<?php endif; endforeach; ?>
										</span>
									</span>
									<h2 class="title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
								</div>
							</div>
						</div>
	<?php 

	}
endif;



			
			endwhile;
		endif; 
		set_query_var( 'post_ids', $post_ids );
	?>
		</div>
	</div>
</div>
