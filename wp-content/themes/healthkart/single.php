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

<div class="single-post">
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
		<div>
			<div>
				<?php if ( have_posts() ) : ?>
					<?php			
					while ( have_posts() ) :
					  the_post();
					  $views = (int) get_post_meta($post->ID, 'hk_views', true);
					  update_post_meta($post->ID, 'hk_views', $views + 1);
					  $hindi_url = get_post_meta($post->ID, 'hk_hindi_post', true);
					  $english_url = get_post_meta($post->ID, 'hk_english_post', true);
					?>
						<header class="entry-header">
						<?php $categories = hk_get_category(get_the_ID()); 
								 	$GLOBALS['global_article_id']  = get_the_ID();

								 ?>
							<div class="blog_featured_img">
								<?php
								if ( has_post_thumbnail() ) :
								the_post_thumbnail( 'large', ['title' => get_the_title()] );
								endif;
								?>
							</div>
							<div class="container post-title">
								<h1 class="entry-title"><?php the_title(); ?></h1>
							</div>
							<div class="container">
								<?php get_template_part( 'page-templates/theme-sections/author-bar-top', 'section' ); ?>
							</div>
						</header>
						<div class="container single-post-content">
							<?php
								$description = get_post_meta($post->ID, 'hk_description', true);
								if ($description) :
							?>
							<div class="entry-content entry-description mt-2"><p><?php if(has_excerpt(get_the_ID())): echo get_the_excerpt(); endif; ?></p></div>
							<div class="popupOverlay">
								<?php
								if ( has_post_thumbnail() ) :
								the_post_thumbnail( 'large', ['title' => get_the_title()] );
								endif;
								?>
							</div>
								<div class="entry-content entry-description"><p><?php echo $description; ?></p></div><?php 
								endif;
							?>
							<div class="entry-content"><?php the_content(); ?></div>  
							  <?php 
                                $postUrl = 'http' . ( isset( $_SERVER['HTTPS'] ) ? 's' : '' ) . '://' . "{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}"; 
                                $title = urlencode(html_entity_decode(get_the_title(), ENT_COMPAT, 'UTF-8'));
                            ?>
							<div class="share share-desktop">
								<div class="share-icons">
									<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $postUrl; ?>" class="share-icons__icon" target="_blank"><i class="fa fa-facebook-square" aria-hidden="true"></i>Share on Facebook</a>
									<a href="https://twitter.com/intent/tweet?text=<?php echo $title; ?>&amp;url=<?php echo $postUrl; ?>&amp;via=Healthkart" class="share-icons__icon" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i>Share on Twitter</a>
									<!-- linkedin -->
									<a href="https://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo $postUrl; ?>&amp;title=<?php echo $title; ?>&amp;source=healthkart.com/connect/" class="share-icons__icon" target="_blank"><i class="fa fa-linkedin-square" aria-hidden="true"></i>Share on LinkedIn</a>
									<!-- Whatsapp sharing onn desktop -->
									<!-- <a href="https://web.whatsapp.com/send?text=<?php /* echo $postUrl; */ ?>" id="whatsapp-desktop" class="whatsapp social boxed-icon white-fill" data-href="<?php /* echo $postUrl; */ ?>" data-action="share/whatsapp/share"><i class="fa fa-whatsapp"></i></a> -->
								</div>
							</div>
							<div class="share share-mob">
								<div class="share-icons">
									<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $postUrl; ?>" class="share-icons__icon" target="_blank"><i class="fa fa-facebook-square" aria-hidden="true"></i></a>
									<a href="https://twitter.com/intent/tweet?text=<?php echo $title; ?>&amp;url=<?php echo $postUrl; ?>&amp;via=Healthkart" class="share-icons__icon" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a>
									<a href="https://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo $postUrl; ?>&amp;title=<?php echo $title; ?>&amp;source=healthkart.com/connect/" class="share-icons__icon" target="_blank"><i class="fa fa-linkedin-square" aria-hidden="true"></i></a>
									<!-- Whatsapp sharing onn mobile -->
									<!-- <a href="whatsapp://send?text=<?php /* echo $postUrl; */ ?>" id="whatsapp-mobile" class="whatsapp social boxed-icon white-fill" data-href="<?php /* echo $postUrl; */ ?>" data-action="share/whatsapp/share"><i class="fa fa-whatsapp"></i></a> -->
								</div>
							</div>
								<?php $post_tags = get_the_tags();
 
 									if ( $post_tags ) { ?>
										<div class="article-tags">
										<span class="article-tags__heading">Tags:</span>
	 									<?php foreach( $post_tags as $tag ) { ?>
											 <a href="" class="article-tags__tag"><?php echo $tag->name ?></a>
	 									<?php 
										 }
 									} ?>
							</div>
							<div class="container">
								<?php get_template_part( 'page-templates/theme-sections/author-bar-bottom', 'section' ); ?>
							</div>
							<div class="container product-listing-section">
								<?php echo do_shortcode('[product-listing]'); ?>
							</div>
							<div class="container m-auto latest-reads">
								<?php echo do_shortcode('[read-these-next]'); ?>
							</div>
						</div>
					<?php endwhile; ?>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<a id="back-to-top" href="#" class="btn btn-lg back-to-top" role="button"><i class="fa fa-chevron-up"></i></a>
</div>
<?php
get_footer();

?>
