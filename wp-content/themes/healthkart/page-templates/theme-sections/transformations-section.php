<div class="transformation-section my-4">
	<div class="transformation-section-heading pt-3 pb-3">TRANSFORMATION STORIES</div>
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
			$main_post->the_post(); 
			get_template_part( 'page-templates/theme-sections/transformations-single', 'component' ); 
		endwhile;
	endif; ?>
	</div>
</div>

