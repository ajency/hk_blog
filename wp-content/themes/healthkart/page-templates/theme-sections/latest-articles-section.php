
<div class="latest-articles-section">
	<div class="container">
		<div class="latest-articles-heading">Latest & Trending Articles</div>
	</div>
	<div class="latest-articles">
	<?php 
		wp_reset_query();
		$post_ids = (array) get_query_var('post_ids');
		$required_posts = 2;
		$args = array(
			'posts_per_page' => $required_posts,
			'post_type' => array('post'),
			'post_status' => 'publish',
		);
		$post_count = 0;
		$main_post = new wp_query( $args );
		if( $main_post->have_posts() ) :
			while( $main_post->have_posts() ) :
				$main_post->the_post(); 
				$post_id = get_the_id();
				$post_count++;
				?>
				<div class="latest-articles-single latest-articles-single-main col-12">
					<div class="latest-articles-single-image"><a href="<?php the_permalink(); ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>">
						<?php 
						$thumbnail = get_post_meta(get_the_id(), 'hk_thumbnail_image', true);
						if ( $thumbnail ) { ?>
							<img src="<?php echo $thumbnail; ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>"/>
						<?php } else if ( has_post_thumbnail() ) {
						the_post_thumbnail('medium', ['title' => get_the_title()], ['alt' => get_the_title()]); ?>
						<?php
						} else { ?>
						<img src="<?php echo get_site_url(); ?>/wp-content/uploads/2020/09/default.jpg" alt="<?php the_title(); ?>" title="<?php the_title(); ?>"/>
						<?php } ?>
					</a></div>
					<div class="latest-articles-single-content">
						<div class="content-title">
							<h2 class="title"><a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						</div>
						<div class="content-description content-desktop"><?php echo hk_get_excerpt(190); ?></div>
						<div class="content-description content-mobile"><?php echo hk_get_excerpt(220); ?></div>
						<div class="w-100 action-btn hide-mob">
							<a href="<?php the_permalink(); ?>" class="btn hk-button">Read more</a>
						</div>
					</div>
				</div>
			<?php
			if($post_count == $required_posts){
				break;
			}
			 endwhile;
			 wp_reset_postdata();
		endif; ?>
	</div>
</div>
