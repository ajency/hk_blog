<div class="container videos-section mb-3">
	<div class="videos-heading pt-3 pb-3">TRENDING VIDEOS</div>
	<div class="videos-articles mt-4 row">
	<?php 
	$post_ids = get_query_var('post_ids');
	$args = array(
		'posts_per_page' => 3,
		'post_type' => array('video'),
		'post_status' => 'publish',
		'post__not_in' => $post_ids,
		'meta_key' => 'hk_featured_post',
		'meta_query'     => [
	        [
	            'key'      => 'hk_featured_post',
	            'value'    => 'on',
	        ]
	    ],
	);
	$main_post = new wp_query( $args );
	if( $main_post->have_posts() ) :
		while( $main_post->have_posts() ) :
			$main_post->the_post(); 
			preg_match('/<div[^>]*>(.*?)<\/div>/s', get_the_content(), $matches);
				if(isset($matches[1])):
					foreach ($matches as $video) { 
 						?>
 					<div class="videos-single col-md-4 col-12">
						<div class="videos-single-image mb-4">
							<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
								<div class="videos-single-image-overlay"></div>
									<iframe class="videos-single-image-iframe" width="100%" src="<?php echo $video;?>?modestbranding=1&autohide=1&showinfo=0&controls=0" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
							</a>
						</div>
					</div>
	<?php 

	}
endif;
		endwhile;
	endif; ?>
	</div>
	<div class="w-100 action-btn text-center">
		<a href="<?php echo get_post_type_archive_link( 'video' ); ?>" class="btn hk-button mr-3">MORE VIDEOS</a>
	</div>
</div>

