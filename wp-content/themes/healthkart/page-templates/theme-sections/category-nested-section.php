<?php
$nested_category = get_queried_object();
$categories = get_categories(
    array( 'parent' => $nested_category->term_id )
); 
$post_ids = array();
?>

<div class="nested-section mb-3">
	<div class="nested-section-subcategory mb-4">
		<?php foreach ($categories as $category): ?>
		<div class="nested-section-subcategory-heading py-3  container"> <?php echo $category->name; ?></div>
		<div class="nested-section-subcategory-wrapper">
			<div class="nested-section-subcategory-content pb-4 pt-2 container">
				<?php 
					$args = array(
						'posts_per_page' => 10,
						'post_type' => array('post'),
						'post_status' => 'publish',
						'cat' => $category->term_id,
						'post__not_in' => $post_ids
					);
					query_posts( $args ); 
					if( have_posts() ) :
						while( have_posts() ): the_post(); $post_ids[] = get_the_id();?>
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
	<div class="nested-section-posts position-relative" data-cat="<?php echo $nested_category->term_id; ?>">
		<div class="nested-section-posts-wrapper my-4">
			<?php 
				set_query_var( 'category_id', $nested_category->term_id );
				get_template_part( 'page-templates/theme-sections/category-alphaposts', 'section' ); 
			?>
		</div>
		<div class="my-5 loader nested-section-posts-loader d-none">
			<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/loader.svg">
		</div>
	</div>
</div>