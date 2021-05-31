<div class="trending-articles-section mt-3">
	<div class="trending-articles-heading pt-3 pb-3">TRENDING ARTICLES</div>
	<div class="trending-articles mt-4">
		<div class="row">
			<div class="col-md-8 col-12 row m-0 p-0">
			<?php 
				$post_ids = get_query_var('post_ids');
				$args = array(
					'posts_per_page' => 2,
					'post_type' => array('post'),
					'post_status' => 'publish',
					'post__not_in' => $post_ids,
					'meta_key' => 'hk_views',
					'order' => 'DESC',
					'orderby' => 'date',
					'date_query' => array(
        array(
            'after' => '1 week ago'
        )
    )
				);
				$count = 0;
				$main_post = new wp_query( $args );
				if( $main_post->have_posts() ) :
					while( $main_post->have_posts() ) :
						$main_post->the_post(); 
						$post_ids[] = get_the_id();
						$count ++;
						?>
						<div class="trending-articles-single trending-articles-single-main col-md-6 col-12">
							<div class="trending-articles-single-image mb-4"><a href="<?php the_permalink(); ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>">
								<?php if ( has_post_thumbnail() ) {
								the_post_thumbnail('medium', ['title' => get_the_title()]); ?>
								<?php
								} else { ?>
								<img src="<?php echo get_site_url(); ?>/wp-content/uploads/2020/09/default.jpg" alt="<?php the_title(); ?>" title="<?php the_title(); ?>"/>
								<?php } ?>
							</a></div>
							<div class="trending-articles-single-content">
								<div class="content-title">
									<?php $categories = hk_get_category(get_the_ID());  ?>
									<div class="cat-detail">
										<span class="category">
											<?php foreach($categories as $index => $category): ?>
											<a title="<?php echo $category->name; ?>" href="<?php echo get_category_link($category); ?>" rel="category tag"><?php echo $category->name; ?></a>
											<?php if($index+1 != count($categories)): ?>
												,
											<?php endif; endforeach; ?>
										</span>
										<span class="dot"><i class="fa fa-circle" aria-hidden="true"></i></span>
										<span class="last-read"><?php echo get_mins_read(); ?> MIN READ</span>
										<span class="dot"><i class="fa fa-circle" aria-hidden="true"></i></span>
										<?php $post_date = get_the_date( 'M j, Y' ); ?>
										<span class="last-read"><?php echo $post_date; ?></span>
									</div>
									<h2 class="title"><a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
								</div>
								<div class="content-description content-desktop"><?php echo hk_get_excerpt(140); ?></div>
								<div class="content-description content-mobile"><?php echo hk_get_excerpt(220); ?></div>
							</div>
						</div>
					<?php 
				if($count == 2){
					break;
				}

				endwhile;
				endif; ?>
			</div>
			<div class="col-md-4 col-12 sidebar">
				<?php
	                do_shortcode('[Subscribe-form]');
	            ?>
			</div>
		</div>
		<h2 class="trending-articles-heading similar-articles pt-3 pb-3 mt-5 mb-4">EDITOR'S PICK</h2>
		<div class="row similar-articles">
		<?php
query_posts( array( 'meta_key' => 'hk_views',
 'orderby' => 'meta_value_num',
  'order' => 'DESC',
  'showposts' => '6', 
  'year' => '. date( "W", current_time( "timestamp" ) )' ) );
while(have_posts()) : the_post();?>
<ul>
<li><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></li>
</ul>
<?php endwhile;wp_reset_query();
?>
		<?php


// $date_range = strtotime ( '-15 day' );  

// 		$args = array(
// 			'posts_per_page' => 6,
// 			'post_type' => array('post'),
// 			'post_status' => 'publish',
// 			'post__not_in' => $post_ids,
// 			'meta_key' => 'hk_views',
// 			'order' => 'DESC',
// 			'orderby' => 'date',
// 			 // Using the date_query to filter posts from last week
//     'date_query' => array(
//        array(
//                             'after' => array(
//                                 'year'  => date('Y', $date_range ),
//                                 'month' => date('m', $date_range ),
//                                 'day'   => date('d', $date_range ),
//                             ),
//                         )
//     )

		$args = array(
			'posts_per_page' => 6,
			'post_type' => array('post'),
			'post_status' => 'publish',
			'post__not_in' => $post_ids,
			'meta_key' => 'hk_views',
			'order' => 'DESC',
			'orderby' => 'date',
			 // Using the date_query to filter posts from last week
    'date_query' => array(
        array(
            'after' => '2 week ago'
        )
    )
		);
		$count = 0;
		$main_post = new wp_query( $args );
		if( $main_post->have_posts() ) :
			while( $main_post->have_posts() ) :
				$main_post->the_post(); 
				$post_ids[] = get_the_id();
				$count ++;
				?>
				<div class="trending-articles-single row mb-3 col-md-6 col-12 m-0 pl-0 pr-0">
					<div class="trending-articles-single-image mb-3 col-md-5 col-lg-4 col-12"><a href="<?php the_permalink(); ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>">
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
					<div class="trending-articles-single-content mt-2 col-md-7 col-lg-8 col-12 p-0">
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
								<span class="dot"><i class="fa fa-circle" aria-hidden="true"></i></span>
								<?php $post_date = get_the_date( 'M j, Y' ); ?>
								<span class="last-read"><?php echo $post_date; ?></span>
							</span>
							<h2 class="title"><a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						</div>
					</div>
				</div>
			<?php 
			if($count == 6){
				break;
			}
		endwhile;
		endif; 
		set_query_var( 'post_ids', $post_ids );
	?>
		</div>
	</div>
</div>
