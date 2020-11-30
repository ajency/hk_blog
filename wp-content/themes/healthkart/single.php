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
get_template_part( 'page-templates/theme-sections/follow-sidebar', 'section' ); 
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
					  $views = (int) get_post_meta($post->ID, 'hk_views', true);
					  update_post_meta($post->ID, 'hk_views', $views + 1);
					  $hindi_url = get_post_meta($post->ID, 'hk_hindi_post', true);
					  $english_url = get_post_meta($post->ID, 'hk_english_post', true);
					?>
						<header class="entry-header col-12">
							<span>
								<?php $categories = hk_get_category(get_the_ID()); ?>
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
								<span class="last-read"><?php echo $views+1; ?> VIEWS</span>
							</span>
							<?php if($hindi_url): ?>
								<a href="/<?php echo $hindi_url; ?>" class="btn hk-button">Read in Hindi</a>
							<?php endif; ?>
							<?php if($english_url): ?>
								<a href="/<?php echo $english_url; ?>" class="btn hk-button">Read in English</a>
							<?php endif; ?>
							<div class="post-title">
								<h1 class="entry-title mt-2"><?php the_title(); ?></h1>
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
						<div class="col-md-8 col-12 single-post-content">
							<div class="blog_featured_img my-4">
								<?php
								if ( has_post_thumbnail() ) :
								the_post_thumbnail( 'large', ['title' => get_the_title()] );
								endif;
								?>
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
									<a href="https://twitter.com/intent/tweet?text=<?php echo $title; ?>&amp;url=<?php echo $postUrl; ?>&amp;via=Healthkart" class="text-orange f-28" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a>
									<!-- Whatsapp sharing onn desktop -->
									<a href="https://web.whatsapp.com/send?text=<?php echo $postUrl; ?>" id="whatsapp-desktop" class="whatsapp social boxed-icon white-fill" data-href="<?php echo $postUrl; ?>" data-action="share/whatsapp/share"><i class="fa fa-whatsapp"></i></a>
								</div>
							</div>
							<div class="share share-mob">
								<div class="share-title section-title"> Share Article </div>
								<div class="share-icons">
									<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $postUrl; ?>" class="text-orange f-28" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a>
									<a href="https://twitter.com/intent/tweet?text=<?php echo $title; ?>&amp;url=<?php echo $postUrl; ?>&amp;via=Healthkart" class="text-orange f-28" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a>
									<!-- Whatsapp sharing onn mobile -->
									<a href="whatsapp://send?text=<?php echo $postUrl; ?>" id="whatsapp-mobile" class="whatsapp social boxed-icon white-fill" data-href="<?php echo $postUrl; ?>" data-action="share/whatsapp/share"><i class="fa fa-whatsapp"></i></a>
								</div>
							</div>
							<div class="fb-comments" data-href="<?php the_permalink() ?>" data-num-posts="15" data-width="100%" data-colorscheme="light"></div>
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
		</div>
	</div>
	<a id="back-to-top" href="#" class="btn btn-lg back-to-top" role="button"><i class="fa fa-chevron-up"></i></a>
</div>

<?php
get_footer();

?>
