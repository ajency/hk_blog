<div class="container more-articles-section my-4">
	<div class="more-articles-heading pt-3 pb-3">MORE ARTICLES</div>
	<div class="more-articles row mt-4">
		<div class="col-md-6 col-12">
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
				<div class="more-articles-single row mb-4">
					<div class="more-articles-single-image col-md-5 col-lg-4 col-12 pr-0"><a href="<?php the_permalink(); ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>">
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
					</a></div>
					<div class="more-articles-single-content col-md-7 col-lg-8 col-12">
						<div class="content-title">
							<?php $categories = hk_get_category(get_the_ID()); ?>
							<span>
								<span class="category">
									<?php foreach($categories as $index => $category): ?>
									<a title="<?php echo $category->name; ?>" href="<?php echo get_category_link($category); ?>" rel="category tag"><?php echo $category->name; ?></a>
									<?php if($index+1 != count($categories)): ?>
										,
									<?php endif; endforeach; ?>
								</span>
								<span class="dot"><i class="fa fa-circle" aria-hidden="true"></i></span>
								<span class="last-read"><?php echo get_mins_read(); ?> MIN READ</span>
								<span class="dot"><i class="fa fa-circle" aria-hidden="true"></i></span>
								<?php $post_date = get_the_date( 'M j, Y' ); ?>
								<span class="last-read"><?php echo $post_date; ?></span>
							</span>
							<h2 class="title"><a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						</div>
						<div class="content-description"><?php echo hk_get_excerpt(140); ?></div>
					</div>
				</div>
			<?php 
			if($count == 3){
				break;
			}

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