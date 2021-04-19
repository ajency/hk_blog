
<?php
preg_match('/<div[^>]*>(.*?)<\/div>/s', get_the_content(), $matches);
if(isset($matches[1])):
foreach ($matches as $video) { 
 ?>
		<div class="videos-single video-each col-md-4 col-12">
			<div class="videos-single-image mb-1">
				<a href="<?php the_permalink(); ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>">
					<div class="videos-single-image-overlay"></div>
						<iframe class="videos-single-image-iframe" width="100%" src="<?php echo $video;?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
				</a>
			</div>
			<div class="recent-post-header">
				<h2 class="title"><a href="<?php the_permalink(); ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
			</div>
		</div>
	<?php 

	}
endif;
?>