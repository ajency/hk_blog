<div class="latest-articles-section my-3">
	<div class="latest-articles-heading pt-3 pb-3">LATEST VIDEOS</div>
	<div class="latest-articles row mt-4">
	<?php 
		$post_ids = get_query_var('post_ids');
		$args = array(
			'posts_per_page' => 1,
			'post_type' => array('video'),
			'post_status' => 'publish',
			'post__not_in' => $post_ids

		);
		$main_post = new wp_query( $args );
		if( $main_post->have_posts() ) :
			while( $main_post->have_posts() ) :
				$main_post->the_post(); 
				$post_ids[] = get_the_id();
				preg_match("/<!-- wp:core-embed\/youtube(.*?)-->/", get_the_content(), $matches);
				if(isset($matches[1])):
					$embed_video = json_decode($matches[1], true);
					if(isset($embed_video['url'])):?>
						<div class="videos-single latest-articles-single-main col-md-6 col-12">
							<div class="videos-single-image latest-articles-single-image mb-1">
								<iframe class="videos-single-image-iframe" width="100%" src="<?php echo $embed_video['url'];?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
							</div>
							<div class="latest-articles-single-content">
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
					<?php endif;
				endif;
			endwhile;
		endif; ?>

	<div class="col-12 col-md-6">
	<?php
	$args = array(
		'posts_per_page' => 3,
		'post_type' => array('video'),
		'post_status' => 'publish',
		'post__not_in' => $post_ids

		);
		$main_post = new wp_query( $args );
		if( $main_post->have_posts() ) :
			while( $main_post->have_posts() ) :
				$main_post->the_post(); 
				$post_ids[] = get_the_id();
				preg_match("/<!-- wp:core-embed\/youtube(.*?)-->/", get_the_content(), $matches);
				if(isset($matches[1])):
					$embed_video = json_decode($matches[1], true);
					if(isset($embed_video['url'])):?>
						<div class="videos-single latest-articles-single row mb-4">
							<div class="videos-single-image latest-articles-single-image col-md-5 col-12">
								<a href="<?php the_permalink(); ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>">
									<div class="videos-single-image-overlay"></div>
										<iframe class="videos-single-image-iframe" width="100%" src="<?php echo $embed_video['url'];?>?modestbranding=1&autohide=1&showinfo=0&controls=0" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
								</a>
							</div>
							<div class="latest-articles-single-content col-md-7 col-12">
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
					<?php endif;
				endif; 
			endwhile;
		endif; 
		set_query_var( 'post_ids', $post_ids );
	?>
		</div>
	</div>
</div>
