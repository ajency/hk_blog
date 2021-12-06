<div class="infographics-section">
	<div class="section-heading infographics-heading text-center">Trending Infographics</div>
	<div class="container infographics-articles row">
	<?php 
	$post_ids = get_query_var('post_ids');
	$args = array(
		'posts_per_page' => 6,
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
			<div class="infographics-articles-single col-lg-4 col-12">
				<div class="wraper">
				<div class="infographics-articles-single-image"><a href="<?php the_permalink(); ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>">
					<?php if ( has_post_thumbnail() ) {
					the_post_thumbnail('medium', ['title' => get_the_title()]); ?>
					<?php
					} else { ?>
					<img src="<?php echo get_site_url(); ?>/wp-content/uploads/2020/09/default.jpg" alt="<?php the_title(); ?>" title="<?php the_title(); ?>"/>
					<?php } ?>
					<div class="gradient-overlay"></div>
				</a>
				<span class="date-time-info">
					<span class="last-read"><?php echo get_mins_read(); ?> Min read</span>
					<span class="dot"><i class="fa fa-circle" aria-hidden="true"></i></span>
					<?php $post_date = get_the_date( 'M j, Y' ); ?>
					<span class="last-read"><?php echo $post_date; ?></span>
				</span>
			</div>
				<div class="infographics-articles-single-content">
					<div class="content-title">
						<h2 class="on-smaller-hide title"><a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						<h2 class="on-smaller-show title"><a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>"><?php echo wp_trim_words(get_the_title(), 6) ?></a></h2>
					</div>
					<div class="on-smaller-hide content-description"><?php echo hk_get_excerpt(64); ?></div>
					<div class="on-smaller-show content-description"><?php echo hk_get_excerpt(50); ?></div>
				</div>
				</div>
			</div><?php
		endwhile;
	endif; ?>
	</div>
	<div class="w-100 action-btn text-center">
		<a href="<?php echo get_post_type_archive_link( 'infographic' ); ?>" class="btn hk-button mr-3">View more</a>
	</div>
</div>

