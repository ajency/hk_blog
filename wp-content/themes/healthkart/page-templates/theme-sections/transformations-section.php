<div class="transformation-section">
	<h1 class="transformation-section-heading pt-3 pb-3">TRANSFORMATION STORIES</h1>
	<div class="transformation-section-articles mt-4 row">
	<?php 
	$post_ids = get_query_var('post_ids');
	$args = array(
		'posts_per_page' => 3,
		'post_type' => array('transformation'),
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
			$main_post->the_post(); ?>
			<div class="transformation-section-single col-md-4 col-12">
				<div class="transformation-section-single-image mb-4">
					<a class="row" href="<?php the_permalink(); ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>">
					<?php
						$before_image_id = get_post_meta(get_the_id(), 'hk_image_before_diet_id', true);
						$before_image_url = wp_get_attachment_image_src($before_image_id, 'medium')[0];
						$after_image_id = get_post_meta(get_the_id(), 'hk_image_after_diet_id', true);
						$after_image_url = wp_get_attachment_image_src($after_image_id, 'medium')[0];

						$before_weight = get_post_meta(get_the_id(), 'hk_weight_before_diet', true);
						$after_weight = get_post_meta(get_the_id(), 'hk_weight_after_diet', true);
						$before_age = get_post_meta(get_the_id(), 'hk_age_before_diet', true);
						$after_age = get_post_meta(get_the_id(), 'hk_age_after_diet', true);
						$before_fat = get_post_meta(get_the_id(), 'hk_body_fat_before_diet', true);
						$after_fat = get_post_meta(get_the_id(), 'hk_body_fat_after_diet', true);
					?>
					<div class="position-relative col-md-6 pl-3 pr-1">
						<img src="<?php echo $before_image_url; ?>"/>
						<div class="img-tag px-3 py-1">Before</div>
					</div>
					<div class="position-relative col-md-6 pl-1 pr-3">
						<img src="<?php echo $after_image_url; ?>"/>
						<div class="img-tag px-3 py-1">After</div>
					</div>
					</a>
				</div>
				<div class="transformation-section-single-content">
					<div class="content-title">
						<?php $categories = hk_get_category(get_the_ID(), 'transformation_category');  ?>
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
						</span>
						<h2 class="title"><a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					</div>
					<div class="content-fields p-3">
						<div class="content-fields-titles row">
							<label class="content-fields-titles-single col-md-2 pr-2">Age</label>
							<label class="content-fields-titles-single col-md-3 px-2">Weight than</label>
							<label class="content-fields-titles-single col-md-2 px-2 transformation-border-right">Now</label>
							<label class="content-fields-titles-single col-md-3 px-2">Bodyfat than</label>
							<label class="content-fields-titles-single col-md-2 px-2">Now</label>
						</div>
						<div class="content-fields-values row">
							<span class="content-fields-values-single col-md-2 pr-2"><?php echo $before_age.'/'.$after_age; ?></span>
							<span class="content-fields-value-single transformation-before col-md-2 px-2"><?php echo $before_weight; ?>kg</span>
							<span class="content-fields-value-single transformation-seperator col-md-1 px-2">></span>
							<span class="content-fields-values-single transformation-after transformation-border-right col-md-2 px-2"><?php echo $after_weight; ?>kg</span>
							<span class="content-fields-values-single transformation-before col-md-2 px-2"><?php echo $before_fat; ?>%</span>
							<span class="content-fields-values-single transformation-seperator col-md-1 px-2">></span>
							<span class="content-fields-values-single transformation-after col-md-2 px-2"><?php echo $after_fat; ?>%</span>
						</div>
					</div>
				</div>
			</div>
		<?php endwhile;
	endif; ?>
	</div>
</div>

