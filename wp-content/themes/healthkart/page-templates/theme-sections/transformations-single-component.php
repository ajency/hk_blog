<div class="transformation-section-single col-md-4 col-12 my-4">
	<div class="transformation-section-single-image mb-2">
		<a class="row" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
		<?php
			$thumbnail_before_image_id = get_post_meta(get_the_id(), 'hk_thumbnail_image_before_diet_id', true);
			$thumbnail_before_image_url = wp_get_attachment_image_src($thumbnail_before_image_id, 'medium')[0];
			$after_image_id = get_post_meta(get_the_id(), 'hk_image_after_diet_id', true);
			$after_image_url = wp_get_attachment_image_src($after_image_id, 'medium')[0];

			$before_weight = get_post_meta(get_the_id(), 'hk_weight_before_diet', true);
			$after_weight = get_post_meta(get_the_id(), 'hk_weight_after_diet', true);
			$before_age = get_post_meta(get_the_id(), 'hk_age_before_diet', true);
			$after_age = get_post_meta(get_the_id(), 'hk_age_after_diet', true);
			$before_fat = get_post_meta(get_the_id(), 'hk_body_fat_before_diet', true);
			$after_fat = get_post_meta(get_the_id(), 'hk_body_fat_after_diet', true);
		?>
		<div class="position-relative col-md-6 pl-3 pr-1 transform">
			<img src="<?php echo $thumbnail_before_image_url; ?>"/>
			<div class="img-tag px-3 py-1">Before</div>
		</div>
		<div class="position-relative col-md-6 pl-1 pr-3 transform">
			<img src="<?php echo $after_image_url; ?>"/>
			<div class="img-tag px-3 py-1">After</div>
		</div>
		</a>
	</div>
	<div class="transformation-section-single-content">
		<div class="content-title">
			<span>
				<span class="category">
					<a target="_blank" title="Transformation" href="<?php echo get_post_type_archive_link(get_post_type()); ?>" rel="category tag">Transformation</a>
				</span>
				<span class="dot"><i class="fa fa-circle" aria-hidden="true"></i></span>
				<span class="last-read"><?php echo get_mins_read(); ?> MIN READ</span>
				<span class="dot"><i class="fa fa-circle" aria-hidden="true"></i></span>
				<?php $post_date = get_the_date( 'M j, Y' ); ?>
				<span class="last-read"><?php echo $post_date; ?></span>
			</span>
			<h2 class="title"><a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		</div>
		<div class="content-fields p-3">
			<div class="content-fields-titles row">
				<label class="content-fields-titles-single col-md-2 pr-2">Age</label>
				<label class="content-fields-titles-single col-md-3 px-2">Then</label>
				<label class="content-fields-titles-single col-md-2 px-2 transformation-border-right">Now</label>
				<label class="content-fields-titles-single col-md-3 px-2">Bodyfat then</label>
				<label class="content-fields-titles-single col-md-2 px-2">Now</label>
			</div>
			<div class="content-fields-values row">
				<span class="content-fields-values-single col-md-2 pr-2"><?php echo $before_age.'/'.$after_age; ?></span>
				<span class="content-fields-values-single transformation-before col-md-2 px-2"><?php echo $before_weight; ?>kg</span>
				<span class="content-fields-values-single transformation-seperator col-md-1 px-2">></span>
				<span class="content-fields-values-single transformation-after transformation-border-right col-md-2 px-2"><?php echo $after_weight; ?>kg</span>
				<span class="content-fields-values-single transformation-before col-md-2 px-2"><?php echo is_numeric($before_fat) ? $before_fat.'%' : $before_fat; ?></span>
				<span class="content-fields-values-single transformation-seperator col-md-1 px-2">></span>
				<span class="content-fields-values-single transformation-after col-md-2 px-2"><?php echo is_numeric($after_fat) ? $after_fat.'%' : $after_fat; ?></span>
			</div>
		</div>
	</div>
</div>