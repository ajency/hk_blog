<?php
/**
 * Genesis Sample.
 *
 * This file adds the landing page template to the Genesis Sample Theme.
 *
 * Template Name: Home
 *
 * @package Genesis Sample
 * @author  StudioPress
 * @license GPL-2.0-or-later
 * @link    https://www.studiopress.com/
 */
get_header(); 
?>
<div class="banner row">
	<div class="banner-slider col-8">
		<div class="slider stick-dots">
		<?php 
		$args = array(
			'posts_per_page' => 3,
			'post_type' => array('post'),
			'post_status' => 'publish',
			'meta_key' => 'hk_featured_banner_post',
			'meta_query'     => [
		        [
		            'key'      => 'hk_featured_banner_post',
		            'value'    => 'on',
		        ]
		    ],
		);
		$banner_posts = new wp_query( $args );?>
		<?php  // Loop through posts
			if( $banner_posts->have_posts() ) :
				while( $banner_posts->have_posts() ) :
				$banner_posts->the_post(); ?>
					<div class="slide">
						<div class="slide__img">
							<img src="" alt="" data-lazy="<?php echo the_post_thumbnail_url('large');?>" class="full-image animated" data-animation-in="zoomInImage"/>
						</div>
						<div class="slide__content">
							<div class="slide__content--headings">
								<div class="animated" data-animation-in="fadeInUp" data-delay-in="0.3">
									<p class="category-name">
										<?php 
										if ( class_exists('WPSEO_Primary_Term') ) {
										     // Show the post's 'Primary' category, if this Yoast feature is available, & one is set
											$wpseo_primary_term = new WPSEO_Primary_Term( 'category', get_the_id() );
											$wpseo_primary_term = $wpseo_primary_term->get_primary_term();
											$term = get_term( $wpseo_primary_term );
										     if ( is_wp_error( $term ) ) {
										          // Default to first category (not Yoast) if an error is returned
										          $category_display = $category[0]->name;
										     } else {
										          // Set variables for category_display & category_slug based on Primary Yoast Term
										          $category_id = $term->term_id;
										          $category_term = get_category($category_id);
										          $category_display = $term->name;

										     }
										} else {
										     // Default, display the first category in WP's list of assigned categories
										     $category_display = $category[0]->name;
										}
										echo $category_display;
										?>
									</p>
									<p class="mins-read"><?php echo get_post_meta( get_the_ID(), 'hk_mins_read', true );  ?> MIN READ</p>
									<p class="post-date"><?php echo get_the_date('M d, Y')  ?></p>
								</div>
								<h2 class="animated" data-animation-in="fadeInUp"><?php the_title(); ?></h2>
							</div>
						</div>
					</div>
				<?php endwhile;
		endif; ?>
		</div>
	</div>
	<div class="banner-category col-4">
		<?php $categories = get_terms(['taxonomy' => 'category' ]); 
		foreach ($categories as $category):
			$is_featured = get_term_meta( $category->term_id, 'hk_featured_category', true );
			if($is_featured == 'on'): ?>
				<div class="banner-category-single">
					<div class="banner-category-single-image">
						<?php
						$image_id = get_term_meta( $category->term_id, 'hk_featured_image_id', true );
						$image_url = wp_get_attachment_image_src($image_id, 'large')[0];
						?>
						<img src="<?php echo $image_url; ?>"/>
					</div>
					<div class="banner-category-single-title"><?php echo $category->name; ?></div>
				</div>
			<?php endif; ?>
		<?php endforeach; ?>
	</div>
</div>

<?php get_footer(); ?>
