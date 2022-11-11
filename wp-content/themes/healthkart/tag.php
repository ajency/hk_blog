<?php
// This file handles single entries, but only exists for the sake of child theme forward compatibility.
// genesis();

get_header(); 
get_template_part( 'page-templates/theme-sections/follow-sidebar', 'section' ); 
?>

<div class="single-post pt-25">
	<div class="header_image position-relative">
		<div class="header">
			<div class="container">
				
			</div>
		</div>
	</div>

	<div class="single_post_page">
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-12 single-post-content"> 
					<div class="latest-reads">
						<div class="read-these-next">
							<div class="section-title pb-3">Latest Articles</div>
							<?php
								$post_ids = [];
								$tag_ids = wp_get_post_tags( $post->ID, array( "fields" => "ids" ) ); // current tags
								$args = array(
									"tax_query" => array(
										array(
											'post_type' => 'secondary_tag',
											"taxonomy" => "post_tag",
											"field"    => "term_id",
											"terms"    => $tag_ids
										)
									)
								);
								
								// Query posts
								$wpex_query = new wp_query( $args );?>
								<?php  // Loop through posts
								if( $wpex_query->have_posts() ) :
								while( $wpex_query->have_posts() ) :
								$wpex_query->the_post(); 
								$post_ids[] = get_the_id(); ?>
									<div class="col-12 recent-post p-0">
										<div class="row py-4">
											<div class="col-md-4 col-12">
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
											</div>
											<div class="col-md-8 col-12 next-articles">
												<span>
													<span class="category">
														<?php the_category(' , '); ?>
													</span>
													<span class="dot"><i class="fa fa-circle" aria-hidden="true"></i></span>
													<span class="last-read"><?php echo get_mins_read(); ?> MIN READ</span>
												</span>
												<div class="recent-post-header">
													<h2 class="title"><a href="<?php the_permalink(); ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
												</div>
												<div class="recent-post-excerpt"><?php echo wp_trim_words(get_the_content(), 18, '...'); ?>
												</div>
												<div class="recent-post-icons">
													<span class="mr-3 f-14 heart"><i class="fa fa-heart" aria-hidden="true"></i> 15 </span>
													<span class="mr-3 f-14 comment"><i class="fa fa-comments" aria-hidden="true"></i> 3</span>
												</div>
											</div>
										</div>
									</div>
								<?php endwhile; ?>
							<?php endif; ?>
						</div>
					</div>
				</div>
				<div class="col-md-4 col-12">
					<?php
						set_query_var( 'post_ids', $post_ids );
	                    get_sidebar();
	                ?>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
get_footer();

?>
