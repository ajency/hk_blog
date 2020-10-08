<?php
$nested_category = get_queried_object();
$categories = get_categories(
    array( 'parent' => $nested_category->term_id )
); ?>

<div class="nested-section mb-3">
	<div class="nested-section-subcategory mb-4">
		<?php foreach ($categories as $category): ?>
		<div class="nested-section-subcategory-heading py-3  container"> <?php echo $category->name; ?></div>
		<div class="nested-section-subcategory-wrapper">
			<div class="nested-section-subcategory-content py-4 container">
				<?php 
					$args = array(
						'posts_per_page' => 10,
						'post_type' => array('post'),
						'post_status' => 'publish',
						'cat' => $category->term_id,
					);
					query_posts( $args ); 
					if( have_posts() ) :
						while( have_posts() ): the_post(); ?>
							<div class="recent-post mx-4">
								<div class="recent-post-featured-img">
									<a href="<?php the_permalink(); ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>">
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
									</a>
								</div>
								<div class="recent-post-content p-3">
									<div class="recent-post-header">
										<h2 class="title"><a href="<?php the_permalink(); ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
									</div>
									<div class="recent-post-excerpt"><?php echo hk_get_excerpt(40); ?>
									</div>
								</div>
							</div>
						<?php endwhile;
					endif; ?>
			</div>
		</div>
		<?php endforeach; ?>	
	</div>
	<div class="nested-section-chips px-4 py-3">
		<?php for ($i=65; $i < 91; $i++) : ?>
				<span class="py-1 px-2 single-chip <?php echo $i==65 ? 'active' : '' ?>" data-value="<?php echo chr($i); ?>"> <?php echo chr($i); ?></span>
		<?php endfor; ?>
	</div>
	<div class="nested-section-posts">
		<div class="nested-section-posts-wrapper my-4">
			<div class="nested-section-posts-title">Starting with - <span class="nested-section-posts-alphabet">A</span></div>
			<div class="nested-section-posts-container">
			<?php 
				$args = array(
					'posts_per_page' => 10,
					'post_type' => array('post'),
					'post_status' => 'publish',
					'cat' => $category->term_id,
					'starts_with' => 'A',
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
							<div class="nested-section-posts-single-content col-7">
								<div class="nested-section-posts-single-header" title="<?php the_title(); ?>">
									<?php the_title(); ?>
								</div>
								<div class="nested-section-posts-single-excerpt"><?php echo hk_get_excerpt(40); ?></div>
								<div class="nested-section-posts-single-readmore">read more</div>
							</div>
						</a>
					<?php endwhile;
				endif; ?>
			</div>
		</div>
	</div>
</div>