<?php $category = get_query_var('category'); 
preg_match("/<!-- wp:core-embed\/youtube(.*?)-->/", get_the_content(), $matches);
if(isset($matches[1])):
	$embed_video = json_decode($matches[1], true);
	if(isset($embed_video['url'])): ?>
		<div class="videos-single col-md-4 col-12">
			<div class="videos-single-image mb-1">
				<a href="<?php the_permalink(); ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>">
					<div class="videos-single-image-overlay"></div>
						<iframe class="videos-single-image-iframe" width="100%" src="<?php echo $embed_video['url'];?>?modestbranding=1&autohide=1&showinfo=0&controls=0" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
				</a>
			</div>
			<div class="recent-post-header">
				<h2 class="title"><a href="<?php the_permalink(); ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
			</div>
		</div>
	<?php endif;
endif;