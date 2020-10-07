<?php
$nested_category = get_queried_object();
$categories = get_categories(
    array( 'parent' => $nested_category->term_id )
); ?>

<div class="nested-section my-3">
	<div class="nested-section-subcategory">
		<?php foreach ($categories as $category): ?>
		<div class="nested-section-subcategory-heading p-3"> <?php echo $category->name; ?></div>
		<div class="nested-section-subcategory-wrapper">
			<div class="nested-section-subcategory-content py-2">
				<?php 
					$args = array(
						'posts_per_page' => 8,
						'post_type' => array('post'),
						'post_status' => 'publish',
						'cat' => $category->term_id,
					);
					query_posts( $args ); ?>
					<?php if( have_posts() ) :
						while( have_posts() ): the_post(); ?>
							<div class="recent-post p-0">
								<div class="recent-post-featured-img my-3">
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
								<div class="recent-post-content">
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
									<div class="recent-post-header">
										<h2 class="title"><a href="<?php the_permalink(); ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
									</div>
									<div class="recent-post-excerpt"><?php echo hk_get_excerpt(90); echo "..."; ?>
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