<div class="banner row">
	<div class="banner-slider col-8">
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
					<div class="slide">
						<div class="slide__img">
							<img src="" alt="" title="<?php echo get_the_title();?>" data-lazy="<?php echo the_post_thumbnail_url('large');?>" class="full-image animated" data-animation-in="zoomInImage"/>
						</div>
						<div class="slide__content">
							<div class="slide__content--headings">
								<div class="animated" data-animation-in="fadeInUp" data-delay-in="0.3">
									<?php $category = hk_get_category(get_the_ID()); ?>
									<a href="<?php echo get_category_link($category); ?>" ><?php echo $category->name; ?></a>
									<p class="mins-read"><?php echo get_post_meta( get_the_ID(), 'hk_mins_read', true );  ?> MIN READ</p>
									<p class="post-date"><?php echo get_the_date('M d, Y')  ?></p>
								</div>
								<h2 class="animated" data-animation-in="fadeInUp"><?php the_title(); ?></h2>
							</div>
						</div>
					</div>
				<?php endwhile;
		endif; ?>
		</div>
	</div>
	<div class="banner-category col-4">
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
					</div>
					<div class="banner-category-single-title"><?php echo $category->name; ?></div>
				</a></div>
			<?php endif; ?>
		<?php endforeach; ?>
	</div>
</div>
<?php 
set_query_var( 'post_ids', $post_ids );