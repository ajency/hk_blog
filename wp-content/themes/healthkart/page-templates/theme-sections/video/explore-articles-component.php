<div class="explore-articles row">
<?php 

	$post_ids = get_query_var('post_ids');
	$args = array(
		'posts_per_page' => 6,
		'post_type' => array('video'),
		'post_status' => 'publish',
		'tax_query' => array(
	        array (
	            'taxonomy' => 'video_category',
	            'field' => 'term_id',
	            'terms' => $_POST['category_id'],
	        )
	    ),
	);
// 	if(is_array($post_ids)){
// 		$args['post__not_in'] = $post_ids;
// 	};
	$main_post = new wp_query( $args );
	if( $main_post->have_posts() ) :
		while( $main_post->have_posts() ) :
			$main_post->the_post(); 
			preg_match("/<!-- wp:core-embed\/youtube(.*?)-->/", get_the_content(), $matches);
			if(isset($matches[1])):
				$embed_video = json_decode($matches[1], true);
				if(isset($embed_video['url'])):?>
					<div class="explore-articles-single row mb-4 col-6 m-0">
						<div class="explore-articles-single-image mb-2 col-md-5 col-12 pl-0">
							<a href="<?php the_permalink(); ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>">
								<div class="videos-single-image-overlay"></div>
									<iframe class="videos-single-image-iframe" width="100%" src="<?php echo $embed_video['url'];?>?modestbranding=1&autohide=1&showinfo=0&controls=0" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
							</a>
						</div>
						<div class="explore-articles-single-content col-md-7 col-12 p-0">
							<div class="content-title">
								<?php $categories = hk_get_category(get_the_ID(), 'video_category');  ?>
								<span>
									<span class="category">
										<?php foreach($categories as $index => $category): ?>
										<a title="<?php echo $category->name; ?>" href="<?php echo get_category_link($category); ?>" rel="category tag"><?php echo $category->name; ?></a>
										<?php if($index+1 != count($categories)): ?>
											,
										<?php endif; endforeach; ?>
									</span>
								</span>
								<h2 class="title"><a href="<?php the_permalink(); ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
							</div>
						</div>
					</div>
				<?php endif;
			endif;
		endwhile;
	endif; 
	set_query_var( 'post_ids', $post_ids );
?>
</div>
<div class="w-100 action-btn text-center">
	<a href="<?php echo get_category_link($_POST['category_id']); ?>" class="btn hk-button mr-3 py-2 px-5">VIEW ALL</a>
</div>
<div class="my-5 loader explore-articles-loader d-none">
		<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/loader.svg">
</div>
