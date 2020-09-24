<h1>LATEST ARTICLES</h1>
<div class="latest-articles row">
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
			<div class="latest-articles-single col-6">
				<div class="latest-articles-single-image">
					<?php if ( has_post_thumbnail() ) {
					the_post_thumbnail('medium', ['title' => get_the_title()]); ?>
					<?php
					} else { ?>
					<img src="<?php echo get_site_url(); ?>/wp-content/uploads/2020/09/default.jpg" alt="<?php the_title(); ?>" title="<?php the_title(); ?>"/>
					<?php } ?>
				</div>
				<div class="latest-articles-single-content">
					<div class="content-title">
						<span class="category-name"><?php echo hk_get_category(get_the_ID()); ?></span>
						<?php $mins_read = get_post_meta( get_the_ID(), 'hk_mins_read', true ); 
						if($mins_read): ?>
							<span class="mins-read"><?php echo $mins_read; ?> MIN READ</span>
						<?php endif; ?>
						<h2><?php the_title(); ?></h2>
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
			<div class="latest-articles-single">
				<div class="latest-articles-single-image">
					<?php if ( has_post_thumbnail() ) {
					the_post_thumbnail('medium', ['title' => get_the_title()]); ?>
					<?php
					} else { ?>
					<img src="<?php echo get_site_url(); ?>/wp-content/uploads/2020/09/default.jpg" alt="<?php the_title(); ?>" title="<?php the_title(); ?>"/>
					<?php } ?>
					
				</div>
				<div class="latest-articles-single-content">
					<div class="content-title">
						<span class="category-name"><?php echo hk_get_category(get_the_ID()); ?></span>
						<?php $mins_read = get_post_meta( get_the_ID(), 'hk_mins_read', true ); 
						if($mins_read): ?>
							<span class="mins-read"><?php echo $mins_read; ?> MIN READ</span>
						<?php endif; ?>
						<h2><?php the_title(); ?></h2>
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