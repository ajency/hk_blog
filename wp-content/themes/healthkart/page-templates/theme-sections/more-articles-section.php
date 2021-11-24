<div class="more-articles-section p-0">
	<div class="container section-heading more-articles-heading">More Articles</div>
	<div class="more-articles">
		<div class="more-articles-slider">
		<?php
		$post_ids = get_query_var('post_ids');
		$args = array(
			'posts_per_page' => 3,
			'post_type' => array('post'),
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
		$count = 0;
		$main_post = new wp_query( $args );
		if( $main_post->have_posts() ) :
			while( $main_post->have_posts() ) :
				$main_post->the_post(); 
				$post_ids[] = get_the_id();
				$count ++;
				?>
				<div class="more-articles-single row">
					<div class="more-articles-single-content">
						<div class="content-title">
							<h2 class="title"><a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						</div>
						<div class="content-description hide-mob"><?php echo hk_get_excerpt(240); ?></div>
						<div class="content-description hide-desk"><?php echo hk_get_excerpt(140); ?></div>
					</div>
					<div class="more-articles-single-image"><a href="<?php the_permalink(); ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>">
						<?php 
						$thumbnail = get_post_meta(get_the_id(), 'hk_large_image', true);
						if ( $thumbnail ) { ?>
							<img src="<?php echo $thumbnail; ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>"/>
						<?php } else if ( has_post_thumbnail() ) {
						the_post_thumbnail('large', ['title' => get_the_title()]); ?>
						<?php
						} else { ?>
						<img src="<?php echo get_site_url(); ?>/wp-content/uploads/2020/09/default.jpg" alt="<?php the_title(); ?>" title="<?php the_title(); ?>"/>
						<?php } ?>
					</a></div>
				</div>
			<?php 
			if($count == 3){
				break;
			}

			endwhile;
		endif; ?>
		</div>
		<div class="slider-nav"><div class="arrows"><div class="dots"></div></div></div>
	</div>
</div>