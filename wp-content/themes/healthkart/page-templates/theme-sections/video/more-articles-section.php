<div class="more-articles-section my-4">
	<div class="more-articles-heading pt-3 pb-3"> VIDEOS</div>
	<div class="more-articles row mt-4">
		<div class="col-md-6 col-12">
		<?php
		$post_ids = get_query_var('post_ids');
		$args = array(
			'posts_per_page' => 3,
			'post_type' => array('video'),
			'post_status' => 'publish',
			'post__not_in' => $post_ids,
			'meta_key' => 'hk_more_post',
			'meta_query'     => [
		        [
		            'key'      => 'hk_more_post',
		            'value'    => 'on',
		        ]
		    ],
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
			<div class="more-articles-single row mb-4">
							<div class="more-articles-single-image col-md-5 col-lg-4 col-12 pr-0">
								<a href="<?php the_permalink(); ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>">
									<div class="videos-single-image-overlay"></div>
										<iframe class="videos-single-image-iframe" width="100%" src="<?php echo $video;?>?modestbranding=1&autohide=1&showinfo=0&controls=0" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
								</a>
							</div>
							<div class="more-articles-single-content col-md-7 col-lg-8 col-12">
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
									<h2 class="title"><a href="<?php the_permalink(); ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
								</div>
							</div>
						</div>
	<?php 

	}
endif;
			endwhile;
		endif; ?>
		</div>
		<div class="col-md-6 col-12">
			<?php
                dynamic_sidebar('sidebar-home-banner-space');
            ?>
		</div>
	</div>
</div>