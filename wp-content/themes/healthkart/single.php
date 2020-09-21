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
  						<a href="<?php echo get_site_url(); ?>/"><i class="fa fa-home" aria-hidden="true"></i></a>
  						<?php the_category(' , '); ?>
  						<span class="breadcrumb-title"><?php the_title(); ?></span>
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
					?>
						<header class="entry-header col-12">
							<span>
								<span class="category">
									<?php the_category(' , '); ?>
								</span>
								<span class="dot"><i class="fa fa-circle" aria-hidden="true"></i></span>
								<span class="last-read"><?php echo get_estimated_reading_time( get_the_content() ); ?></span>
							</span>
							<div class="post-title">
								<h2 class="entry-title"><?php the_title(); ?></h2>
								<div class="d-flex flex-row align-items-center author">
									<div class="author-image">
										<?php 
										$user_info = get_userdata($post->post_author);
										echo get_avatar($user_info->ID);
										?>
									</div>
									<div class="">
										<div class="date f-12 text-black font-weight-bold">Written By 
											<?php 
												echo $user_info->display_name;
											?>
										</div>
										<div class="role f-12"><?php echo get_the_author_meta( 'hk_designation', $user_info->ID); ?></div>
									</div>
								</div>
							</div>
						</header>
						<div class="col-md-8 col-12">
							<div class="blog_featured_img my-4">
								<?php
								if ( has_post_thumbnail() ) :
								the_post_thumbnail( 'large' );
								endif;
								?>
							</div>
							<div class="entry-content"><?php the_content(); ?></div>  
							  <?php 
                                $postUrl = 'http' . ( isset( $_SERVER['HTTPS'] ) ? 's' : '' ) . '://' . "{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}"; 
                                $title = urlencode(html_entity_decode(get_the_title(), ENT_COMPAT, 'UTF-8'));
                            ?>
							<div class="share share-desktop">
								<div class="share-title section-title"> Share </div>
								<div class="share-icons">
									<a href="#"><i class="fa fa-print" aria-hidden="true"></i></a>
									<a href="mailto:?Subject=<?php echo $title; ?>&amp;Body=<?php echo $postUrl; ?>">
									<i class="fa fa-envelope" aria-hidden="true"></i>
									</a>
									<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $postUrl; ?>" class="text-orange f-28" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a>
									<a href="https://twitter.com/intent/tweet?text=<?php echo $title; ?>&amp;url=<?php echo $postUrl; ?>" class="text-orange f-28" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a>
									<a href="javascript:void((function()%7Bvar%20e=document.createElement('script');e.setAttribute('type','text/javascript');e.setAttribute('charset','UTF-8');e.setAttribute('src','http://assets.pinterest.com/js/pinmarklet.js?r='+Math.random()*99999999);document.body.appendChild(e)%7D)());"><i class="fa fa-pinterest-p" aria-hidden="true"></i></a>
									<a href=""><i class="fa fa-reddit" aria-hidden="true"></i></a>
									<span class="ml-2">FEEDBACK:</span>
									<i class="fa fa-smile-o mr-1" aria-hidden="true"></i>
									<i class="fa fa-frown-o" aria-hidden="true"></i>
								</div>
							</div>
							<div class="share share-mob">
								<div class="share-title section-title"> Share Article </div>
								<div class="share-icons">
									<a href="mailto:?Subject=Simple Share Buttons&amp;Body=I%20saw%20this%20and%20thought%20of%20you!%20 https://simplesharebuttons.com">
									<i class="fa fa-envelope" aria-hidden="true"></i>
									</a>
									<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $postUrl; ?>" class="text-orange f-28" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a>
									<a href="https://twitter.com/intent/tweet?text=<?php echo $title; ?>&amp;url=<?php echo $postUrl; ?>&amp;via=WPCrumbs" class="text-orange f-28" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a>
									<i class="fa fa-ellipsis-h" aria-hidden="true"></i>
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
