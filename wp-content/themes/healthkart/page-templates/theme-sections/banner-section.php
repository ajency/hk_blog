<div class="banner">
	<div class="banner-animated col-12">
		<?php 
		$args = array(
			'post_type' => array('post'),
			'post_status' => 'publish',
			'posts_per_page' => 5,
			'meta_key' => 'hk_featured_banner_post',
			'ignore_sticky_posts' => true,
			'meta_query'     => [
		        [
		            'key'      => 'hk_featured_banner_post',
		            'value'    => 'on',
		        ]
		    ],
		);
		$banner_posts = new wp_query( $args );
		?>
		<?php  // Loop through posts
			if( $banner_posts->have_posts() ) :
				while( $banner_posts->have_posts() ) :
					$banner_posts->the_post(); 
					$post_ids[] = get_the_ID(); ?>
					<div class="slide-box">
							<div class="slide-box__img">
								<img src="<?php echo the_post_thumbnail_url('large');?>" alt="<?php echo get_the_title();?>" title="<?php echo get_the_title();?>" data-lazy="<?php echo the_post_thumbnail_url('large');?>" class="full-image"/>
							</div>
							<div class="overlay"></div>

							<div class="slide-box__content1">
								<h2 class="f-20 blog-title"><a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
								<span class="f-18 text-white"><?php echo hk_get_excerpt(100); ?></span>
								<?php $categories = hk_get_category(get_the_ID());  ?>
									<div class="category-container">
										<span class="category">
											<?php foreach($categories as $index => $category): ?>
											<a class="f-16 category" title="<?php echo $category->name; ?>" href="<?php echo get_category_link($category); ?>" rel="category tag"><?php echo $category->name; ?></a>
											<?php if($index+1 != count($categories)): ?>
												,
											<?php endif; endforeach; ?>
										</span>
										<span class="dot"><i class="fa fa-circle" aria-hidden="true"></i></span>
										<span class="last-read"><?php echo get_mins_read(); ?> Min Read</span>
										<span class="dot"><i class="fa fa-circle" aria-hidden="true"></i></span>
										<?php $post_date = get_the_date( 'M j, Y' ); ?>
										<span class="text-white f-16 date"><?php echo $post_date; ?></span>
									</div>
									<div class="w-100 action-btn">
										<a href="<?php the_permalink(); ?>" class="btn hk-button hk-button--transparent"><span>Read More</span></a>
									</div>
							</div>
							<div class="slide-box__content2 hide-mob">
									<h2 class="f-20 blog-title"><a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>"><?php echo wp_trim_words(get_the_title(),4);?></a></h2>
							</div>
							<div class="slide-box__content2 hide-desk">
									<h2 class="f-20 blog-title"><a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>"><?php the_title();?></a></h2>
							</div>
					</div>
				<?php endwhile;
		endif; ?>
	</div>
	<div class="banner-category col-12">
		<div class="banner-category-title">Top stories</div>
		<div class="d-flex category-container">
			<?php $categories = get_terms(['taxonomy' => 'category' ]); 
			foreach ($categories as $category):
				$is_featured = get_term_meta( $category->term_id, 'hk_featured_category', true );
				if($is_featured == 'on'): ?>
					<div class="flex-grow-1 banner-category-single"><a href="<?php echo get_category_link($category->term_id); ?>" >
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
</div>
<?php 
set_query_var( 'post_ids', $post_ids );