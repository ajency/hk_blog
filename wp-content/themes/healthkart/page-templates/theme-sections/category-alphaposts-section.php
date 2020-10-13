<?php 
	$posts_letter = $_POST['posts_letter'] ?? 'A'; 
	$category_id = $_POST['category_id'] ?? get_query_var('category_id'); 
?>
<div class="nested-section-posts-title">
	Starting with - <span class="nested-section-posts-alphabet"><?php echo $posts_letter; ?></span>
</div>
<div class="nested-section-posts-container">
	<?php 
	$args = array(
		'posts_per_page' => 10,
		'post_type' => array('post'),
		'post_status' => 'publish',
		'cat' => $category_id,
		'starts_with' => $posts_letter,
	);
	$query = new WP_Query(  $args ); 
	if( $query->have_posts() ) :
		while( $query->have_posts() ): $query->the_post(); ?>
			<a class="nested-section-posts-single" href="<?php the_permalink(); ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>">
				<div class="nested-section-posts-single-img">
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
				</div>
				<div class="nested-section-posts-single-content">
					<div class="nested-section-posts-single-header" title="<?php the_title(); ?>">
						<?php the_title(); ?>
					</div>
					<div class="nested-section-posts-single-excerpt excerpt-desktop"><?php echo hk_get_excerpt(40); ?></div>
					<div class="nested-section-posts-single-excerpt excerpt-mobile"><?php echo hk_get_excerpt(100); ?></div>
					<div class="nested-section-posts-single-readmore">read more</div>
				</div>
			</a>
		<?php endwhile;
	endif; ?>
</div>
