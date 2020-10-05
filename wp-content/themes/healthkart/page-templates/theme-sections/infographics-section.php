<div class="infographics-section mb-3">
	<div class="infographics-heading pt-3 pb-3">INFOGRAPHICS</div>
	<div class="infographics-articles mt-4 row">
	<?php 
	$post_ids = get_query_var('post_ids');
	$args = array(
		'posts_per_page' => 3,
		'post_type' => array('infographic'),
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
			$main_post->the_post();  ?>
			<div class="infographics-single col-md-4 col-12">
				<div class="infographics-single-image mb-4">
					<a href="<?php the_permalink(); ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>">
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
					</a>
				</div>
			</div><?php
		endwhile;
	endif; ?>
	</div>
	<div class="w-100 action-btn text-center">
		<a href="<?php echo get_post_type_archive_link( 'video' ); ?>" class="btn hk-button  mr-3 py-2 px-5">More infographics</a>
	</div>
</div>

