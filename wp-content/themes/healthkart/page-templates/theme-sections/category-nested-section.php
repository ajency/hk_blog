<?php
$nested_category = get_queried_object();
$categories = get_categories(
    array( 'parent' => $nested_category->term_id )
); ?>

<div class="nested-section mb-3">
	<div class="nested-section-subcategory">
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
					query_posts( $args ); ?>
					<?php if( have_posts() ) :
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
									<?php $categories = hk_get_category(get_the_ID()); ?>
									<span>
										<span class="category">
											<?php foreach(array_slice($categories, 0, 2) as $index => $category): ?>
											<a title="<?php echo $category->name; ?>" href="<?php echo get_category_link($category); ?>" rel="category tag"><?php echo $category->name; ?></a>
											<?php if($index+1 != count(array_slice($categories, 0, 2))): ?>
												,
											<?php endif; endforeach; ?>
										</span>
										<span class="dot"><i class="fa fa-circle" aria-hidden="true"></i></span>
										<span class="last-read"><?php echo get_mins_read(); ?> MIN READ</span>
									</span>
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
</div>