<h1 class="latest-articles-heading pt-3 pb-3">LATEST ARTICLES</h1>
<div class="latest-articles row mt-4">
<?php 
	$post_ids = get_query_var('post_ids');
	$args = array(
		'posts_per_page' => 1,
		'post_type' => array('post'),
		'post_status' => 'publish',
		'post__not_in' => $post_ids

	);
	$main_post = new wp_query( $args );
	if( $main_post->have_posts() ) :
		while( $main_post->have_posts() ) :
			$main_post->the_post(); 
			$post_ids[] = get_the_id();?>
			<div class="latest-articles-single latest-articles-single-main col-6">
				<div class="latest-articles-single-image mb-4"><a href="<?php the_permalink(); ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>">
					<?php if ( has_post_thumbnail() ) {
					the_post_thumbnail('medium', ['title' => get_the_title()]); ?>
					<?php
					} else { ?>
					<img src="<?php echo get_site_url(); ?>/wp-content/uploads/2020/09/default.jpg" alt="<?php the_title(); ?>" title="<?php the_title(); ?>"/>
					<?php } ?>
				</a></div>
				<div class="latest-articles-single-content">
					<div class="content-title">
						<?php $category = hk_get_category(get_the_ID());  ?>
						<span>
							<span class="category">
								<a title="<?php echo $category->name; ?>" href="<?php echo get_category_link($category); ?>" rel="category tag"><?php echo $category->name; ?></a>
							</span>
							<?php $mins_read = get_post_meta( get_the_ID(), 'hk_mins_read', true ); 
							if($mins_read): ?>
								<span class="dot"><i class="fa fa-circle" aria-hidden="true"></i></span>
								<span class="last-read"><?php echo $mins_read; ?> MIN READ</span>
							<?php endif; ?>
						</span>
						<h2 class="title"><a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					</div>
					<div class="content-description"><?php echo wp_trim_words(get_the_content(), 18, '...'); ?></div>
				</div>
			</div>
		<?php endwhile;
	endif; ?>

	<div class="col-6">
	<?php
	$args = array(
		'posts_per_page' => 3,
		'post_type' => array('post'),
		'post_status' => 'publish',
		'post__not_in' => $post_ids

	);
	$main_post = new wp_query( $args );
	if( $main_post->have_posts() ) :
		while( $main_post->have_posts() ) :
			$main_post->the_post(); 
			$post_ids[] = get_the_id();?>
			<div class="latest-articles-single row mb-3">
				<div class="latest-articles-single-image mb-5 col-md-4 col-12"><a href="<?php the_permalink(); ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>">
					<?php if ( has_post_thumbnail() ) {
					the_post_thumbnail('medium', ['title' => get_the_title()]); ?>
					<?php
					} else { ?>
					<img src="<?php echo get_site_url(); ?>/wp-content/uploads/2020/09/default.jpg" alt="<?php the_title(); ?>" title="<?php the_title(); ?>"/>
					<?php } ?>
					
				</a></div>
				<div class="latest-articles-single-content col-md-8 col-12">
					<div class="content-title">
						<?php $category = hk_get_category(get_the_ID()); ?>
						<span>
							<span class="category"><a href="<?php echo get_category_link($category); ?>" rel="category tag"><?php echo $category->name; ?></a></span>
							<span class="dot"><i class="fa fa-circle" aria-hidden="true"></i></span>
							<?php $mins_read = get_post_meta( get_the_ID(), 'hk_mins_read', true ); 
							if($mins_read): ?>
								<span class="last-read"><?php echo $mins_read; ?> MIN READ</span>
							<?php endif; ?>
						</span>
						<h2 class="title"><a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					</div>
					<div class="content-description"><?php echo wp_trim_words(get_the_content(), 18, '...'); ?></div>
				</div>
			</div>
		<?php endwhile;
	endif; 
	set_query_var( 'post_ids', $post_ids );
?>
	</div>
</div>