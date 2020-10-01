<div class="explore-articles row">
<?php 
	$post_ids = get_query_var('post_ids');
	$args = array(
		'posts_per_page' => 6,
		'post_type' => array('post'),
		'post_status' => 'publish',
		'cat' => $_POST['category_id']
	);
	if(is_array($post_ids)){
		$args['post__not_in'] = $post_ids;
	};
	$main_post = new wp_query( $args );
	if( $main_post->have_posts() ) :
		while( $main_post->have_posts() ) :
			$main_post->the_post(); 
			if(is_array($post_ids)){
				$post_ids[] = get_the_id();
			}
			?>
			<div class="explore-articles-single row mb-4 col-6 m-0">
				<div class="explore-articles-single-image mb-2 col-md-5 col-12 pl-0"><a href="<?php the_permalink(); ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>">
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
					
				</a></div>
				<div class="explore-articles-single-content col-md-7 col-12 p-0">
					<div class="content-title">
						<?php $categories = hk_get_category(get_the_ID()); ?>
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
					<div class="content-description"><?php echo hk_get_excerpt(90); echo "..."; ?></div>
				</div>
			</div>
		<?php endwhile;
	endif; 
	set_query_var( 'post_ids', $post_ids );
?>
</div>
<div class="m-auto text-center"><button type="button" class="btn mr-3 py-2 px-5 view-all">View All</button></div>
<div class="my-5 loader explore-articles-loader d-none">
		<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/loader.svg">
</div>