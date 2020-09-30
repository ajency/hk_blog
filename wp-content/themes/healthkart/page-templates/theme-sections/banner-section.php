<div class="banner row mt-4">
	<div class="banner-slider slideshow col-12 col-md-8">
		<div class="slider stick-dots">
		<?php 
		$args = array(
			'posts_per_page' => 3,
			'post_type' => array('post'),
			'post_status' => 'publish',
			'meta_key' => 'hk_featured_banner_post',
			'meta_query'     => [
		        [
		            'key'      => 'hk_featured_banner_post',
		            'value'    => 'on',
		        ]
		    ],
		);
		$banner_posts = new wp_query( $args );?>
		<?php  // Loop through posts
			if( $banner_posts->have_posts() ) :
				while( $banner_posts->have_posts() ) :
					$banner_posts->the_post(); 
					$post_ids[] = get_the_ID(); ?>
					<div class="slide item"><a href="<?php the_permalink(); ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>">
						<div class="slide__img">
							<img src="" alt="" title="<?php echo get_the_title();?>" data-lazy="<?php echo the_post_thumbnail_url('large');?>" class="full-image animated" data-animation-in="zoomInImage"/>
						</div>
						<div class="overlay"></div>
						<div class="slide__content">
							<div class="slide__content--headings">
								<div class="content-title">
									<?php $categories = hk_get_category(get_the_ID());  ?>
									<span>
										<span class="category">
											<?php foreach($categories as $index => $category): ?>
											<a class="category" title="<?php echo $category->name; ?>" href="<?php echo get_category_link($category); ?>" rel="category tag"><?php echo $category->name; ?></a>
											<?php if($index+1 != count($categories)): ?>
												,
											<?php endif; endforeach; ?>
										</span>
										<span class="dot"><i class="fa fa-circle" aria-hidden="true"></i></span>
										<span class="last-read"><?php echo get_mins_read(); ?> MIN READ</span>
									</span>
									<h2 class="title"><a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
								</div>
							</div>
						</div>
					</a></div>
				<?php endwhile;
		endif; ?>
		</div>
	</div>
	<div class="banner-category col-12 col-md-4">
		<div class="banner-category-title">Top Topics</div>
		<?php $categories = get_terms(['taxonomy' => 'category' ]); 
		foreach ($categories as $category):
			$is_featured = get_term_meta( $category->term_id, 'hk_featured_category', true );
			if($is_featured == 'on'): ?>
				<div class="banner-category-single"><a href="<?php echo get_category_link($category->term_id); ?>" >
					<div class="banner-category-single-image">
						<?php
						$image_id = get_term_meta( $category->term_id, 'hk_featured_image_id', true );
						$image_url = wp_get_attachment_image_src($image_id, 'large')[0];
						?>
						<img title="<?php echo $category->name; ?>" src="<?php echo $image_url; ?>"/>
						<div class="overlay"></div>
					</div>
					<div class="banner-category-single-title"><?php echo $category->name; ?></div>
				</a></div>
			<?php endif; ?>
		<?php endforeach; ?>
	</div>
</div>
<?php 
set_query_var( 'post_ids', $post_ids );