<div class="transformation-section-single">
    <div class="transformation-section-single-image">
        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
            <?php
			$before_image_id = get_post_meta(get_the_id(), 'hk_image_before_diet_id', true);
			$before_image_url = wp_get_attachment_image_src($before_image_id, 'medium')[0];
			$after_image_id = get_post_meta(get_the_id(), 'hk_image_after_diet_id', true);
			$after_image_url = wp_get_attachment_image_src($after_image_id, 'medium')[0];
			$thumbnail_before_image_id = get_post_meta(get_the_id(), 'hk_thumbnail_image_before_diet_id', true);
			$thumbnail_before_image_url = wp_get_attachment_image_src($thumbnail_before_image_id, 'medium')[0];
			$thumbnail_after_image_id = get_post_meta(get_the_id(), 'hk_thumbnail_image_after_diet_id', true);
			$thumbnail_after_image_url = wp_get_attachment_image_src($thumbnail_after_image_id, 'medium')[0];

			$before_weight = get_post_meta(get_the_id(), 'hk_weight_before_diet', true);
			$after_weight = get_post_meta(get_the_id(), 'hk_weight_after_diet', true);
			$before_age = get_post_meta(get_the_id(), 'hk_age_before_diet', true);
			$after_age = get_post_meta(get_the_id(), 'hk_age_after_diet', true);
			$before_fat = get_post_meta(get_the_id(), 'hk_body_fat_before_diet', true);
			$after_fat = get_post_meta(get_the_id(), 'hk_body_fat_after_diet', true);
			?>
            <div class="image-container">
                <div class="before-image">
                    <?php if( !empty( $thumbnail_before_image_id ) ) : ?>
                    <img src="<?php echo $thumbnail_before_image_url; ?>" />
                    <?php endif; ?>
                    <?php if( empty( $thumbnail_before_image_id ) ) : ?>
                    <img src="<?php echo $before_image_url; ?>" />
                    <?php endif; ?>
                </div>
                <div class="after-image">
                    <?php if( !empty( $thumbnail_after_image_id ) ) : ?>
                    <img src="<?php echo $thumbnail_after_image_url; ?>" />
                    <?php endif; ?>
                    <?php if( empty( $thumbnail_after_image_id ) ) : ?>
                    <img src="<?php echo $after_image_url; ?>" />
                    <?php endif; ?>
                </div>
            </div>
            <div class="slider-overlay"></div>
			<h2 class="title"><a title="<?php the_title(); ?>"href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        </a>
    </div>
</div>