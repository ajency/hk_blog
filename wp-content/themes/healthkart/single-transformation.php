<?php
/**
 * Genesis Framework.
 *
 * WARNING: This file is part of the core Genesis Framework. DO NOT edit this file under any circumstances.
 * Please do all modifications in the form of a child theme.
 *
 * @package Genesis\Templates
 * @author  StudioPress
 * @license GPL-2.0-or-later
 * @link    https://my.studiopress.com/themes/genesis/
 */

// This file handles single entries, but only exists for the sake of child theme forward compatibility.
// genesis();

get_header(); 

?>
<div id="fb-root"></div>
<script>(function(d, s, id) {
 var js, fjs = d.getElementsByTagName(s)[0];
 if (d.getElementById(id)) return;
 js = d.createElement(s); js.id = id;
 js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=<?php echo FB_APP_ID; ?>";
 fjs.parentNode.insertBefore(js, fjs); }
(document, 'script', 'facebook-jssdk'));
</script>

<div class="single-post pt-25">
	<div class="header_image position-relative">
		<div class="header">
			<div class="container">
				<div class="breadcrumbs-wrapper position-relative">
      				<div class="breadcrumbs-inside">
      					<?php echo yoast_breadcrumb(); ?>
  					</div>
  				</div>
			</div>
		</div>
	</div>

	<div class="single_post_page">
		<div class="container">
			<div class="row">
				<?php if ( have_posts() ) : ?>
					<?php			
					while ( have_posts() ) :
					  the_post();
					  update_post_meta($post->ID, 'hk_views', get_post_meta($post->ID, 'hk_views', true) + 1);
					?>
						<header class="entry-header col-12">
							<span>
								<span class="category">
									<?php the_category(' , '); ?>
								</span>
								<span class="dot"><i class="fa fa-circle" aria-hidden="true"></i></span>
								<span class="last-read"><?php echo get_mins_read(); ?> MIN READ</span>
							</span>
							<div class="post-title">
								<h1 class="entry-title"><?php the_title(); ?></h1>
								<div class="d-flex flex-row align-items-center author">
									<div class="author-image">
										<?php 
										$user_info = get_userdata($post->post_author);
										echo get_avatar($user_info->ID);
										?>
									</div>
									<div class="">
										<div class="date f-12 text-black font-weight-bold">Written By
										<a href="<?php echo get_author_posts_url($user_info->ID); ?>" class="author-link"> 
											<?php 
												echo $user_info->display_name;
											?>
										</a>
										</div>
										<div class="role f-12"><?php echo get_the_author_meta( 'hk_designation', $user_info->ID); ?></div>
									</div>
								</div>
							</div>
						</header>
						<div class="col-md-8 col-12">
							<div class="transformation-section-single-image mb-2">
								<div class="content-fields p-3">
									<?php
										$before_image_id = get_post_meta(get_the_id(), 'hk_image_before_diet_id', true);
										$before_image_url = wp_get_attachment_image_src($before_image_id, 'medium')[0];
										$after_image_id = get_post_meta(get_the_id(), 'hk_image_after_diet_id', true);
										$after_image_url = wp_get_attachment_image_src($after_image_id, 'medium')[0];

										$before_weight = get_post_meta(get_the_id(), 'hk_weight_before_diet', true);
										$after_weight = get_post_meta(get_the_id(), 'hk_weight_after_diet', true);
										$before_age = get_post_meta(get_the_id(), 'hk_age_before_diet', true);
										$after_age = get_post_meta(get_the_id(), 'hk_age_after_diet', true);
										$before_fat = get_post_meta(get_the_id(), 'hk_body_fat_before_diet', true);
										$after_fat = get_post_meta(get_the_id(), 'hk_body_fat_after_diet', true);
									?>
									<div class="content-fields-titles row">
										<label class="content-fields-titles-single col-md-2 pr-2">Age</label>
										<label class="content-fields-titles-single col-md-3 px-2">Than</label>
										<label class="content-fields-titles-single col-md-2 px-2 transformation-border-right">Now</label>
										<label class="content-fields-titles-single col-md-3 px-2">Bodyfat than</label>
										<label class="content-fields-titles-single col-md-2 px-2">Now</label>
									</div>
									<div class="content-fields-values row">
										<span class="content-fields-values-single col-md-2 pr-2"><?php echo $before_age.'/'.$after_age; ?></span>
										<span class="content-fields-value-single transformation-before col-md-2 px-2"><?php echo $before_weight; ?>kg</span>
										<span class="content-fields-value-single transformation-seperator col-md-1 px-2">></span>
										<span class="content-fields-values-single transformation-after transformation-border-right col-md-2 px-2"><?php echo $after_weight; ?>kg</span>
										<span class="content-fields-values-single transformation-before col-md-2 px-2"><?php echo $before_fat; ?>%</span>
										<span class="content-fields-values-single transformation-seperator col-md-1 px-2">></span>
										<span class="content-fields-values-single transformation-after col-md-2 px-2"><?php echo $after_fat; ?>%</span>
									</div>
								</div>
								<div class="blog_featured_img my-4">
									<a class="row" href="<?php the_permalink(); ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>">
									<div class="position-relative col-md-6 pl-3 pr-1 transform">
										<img src="<?php echo $before_image_url; ?>"/>
										<div class="img-tag px-3 py-1">Before</div>
									</div>
									<div class="position-relative col-md-6 pl-1 pr-3 transform">
										<img src="<?php echo $after_image_url; ?>"/>
										<div class="img-tag px-3 py-1">After</div>
									</div>
									</a>
								</div>
							</div>
							<?php
								$description = get_post_meta($post->ID, 'hk_description', true);
								if ($description) :
								?><div class="entry-description"><?php echo $description; ?></div><?php 
								endif;
							?>
							<div class="entry-content"><?php the_content(); ?></div>  
							  <?php 
                                $postUrl = 'http' . ( isset( $_SERVER['HTTPS'] ) ? 's' : '' ) . '://' . "{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}"; 
                                $title = urlencode(html_entity_decode(get_the_title(), ENT_COMPAT, 'UTF-8'));
                            ?>
							<div class="share share-desktop">
								<div class="share-title section-title"> Share </div>
								<div class="share-icons">
									<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $postUrl; ?>" class="text-orange f-28" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a>
									<a href="https://twitter.com/intent/tweet?text=<?php echo $title; ?>&amp;url=<?php echo $postUrl; ?>" class="text-orange f-28" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a>
								</div>
							</div>
							<div class="share share-mob">
								<div class="share-title section-title"> Share Article </div>
								<div class="share-icons">
									<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $postUrl; ?>" class="text-orange f-28" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a>
									<a href="https://twitter.com/intent/tweet?text=<?php echo $title; ?>&amp;url=<?php echo $postUrl; ?>&amp;via=WPCrumbs" class="text-orange f-28" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a>
								</div>
							</div>
							<div class="latest-reads">
								<?php echo do_shortcode('[read-these-next]'); ?>
							</div>
						</div>
					<?php endwhile; ?>
				<?php endif; ?>
				<div class="col-md-4 col-12">
					<?php
	                    get_sidebar();
	                ?>
				</div>
			</div>
			<div class="fb-comments" data-href="<?php the_permalink() ?>"></div>
		</div>
	</div>
</div>

<?php
get_footer();

?>