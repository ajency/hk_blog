<div class="banner row mt-4">
	<div class="banner-slider col-12 col-md-8">
		<?php 
		$args = array(
			'posts_per_page' => 1,
			'post_type' => array('video'),
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
					$post_ids[] = get_the_ID(); 
					preg_match("/<!-- wp:core-embed\/youtube(.*?)-->/", get_the_content(), $matches);
					if(isset($matches[1])):
						$embed_video = json_decode($matches[1], true);
						if(isset($embed_video['url'])): ?>
							<iframe class="videos-banner-iframe" width="100%" src="<?php echo $embed_video['url'];?>?modestbranding=1&autohide=1&showinfo=0&controls=0" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
						<?php endif;
					endif;
				endwhile;
		endif; ?>
	</div>
	<div class="banner-category col-12 col-md-4">
		<div class="banner-category-title">Top Topics</div>
		<?php $categories = get_terms('video_category');
		foreach ($categories as $category):
			$is_featured = get_term_meta( $category->term_id, 'hk_featured_category', true );
			if($is_featured == 'on'): ?>
				<div class="banner-category-single"><a href="<?php echo get_category_link($category->term_id); ?>" >
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
<?php 
set_query_var( 'post_ids', $post_ids );