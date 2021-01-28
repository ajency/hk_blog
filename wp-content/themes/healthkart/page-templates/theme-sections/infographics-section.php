<div class="infographics-section mb-3">
	<div class="infographics-heading pt-3 pb-3">TRENDING INFOGRAPHICS</div>
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
			<div class="infographics-articles-single col-md-4 col-12">
				<div class="infographics-articles-single-image mb-4"><a href="<?php the_permalink(); ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>">
					<?php if ( has_post_thumbnail() ) {
					the_post_thumbnail('medium', ['title' => get_the_title()]); ?>
					<?php
					} else { ?>
					<img src="<?php echo get_site_url(); ?>/wp-content/uploads/2020/09/default.jpg" alt="<?php the_title(); ?>" title="<?php the_title(); ?>"/>
					<?php } ?>
				</a></div>
				<div class="infographics-articles-single-content">
					<div class="content-title">
						<?php $categories = hk_get_category(get_the_ID());  ?>
						<span>
							<span class="category">
								<a target="_blank" title="Infographics" href="<?php echo get_post_type_archive_link(get_post_type()); ?>" rel="category tag">Infographics</a>
							</span>
							<span class="dot"><i class="fa fa-circle" aria-hidden="true"></i></span>
							<span class="last-read"><?php echo get_mins_read(); ?> MIN READ</span>
							<span class="dot"><i class="fa fa-circle" aria-hidden="true"></i></span>
							<?php $post_date = get_the_date( 'M j, Y' ); ?>
							<span class="last-read"><?php echo $post_date; ?></span>
						</span>
						<h2 class="title"><a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					</div>
					<div class="content-description"><?php echo hk_get_excerpt(140); ?></div>
				</div>
			</div><?php
		endwhile;
	endif; ?>
	</div>
	<div class="w-100 action-btn text-center">
		<a href="<?php echo get_post_type_archive_link( 'infographic' ); ?>" class="btn hk-button mr-3">MORE FROM INFOGRAPHICS</a>
	</div>
</div>

