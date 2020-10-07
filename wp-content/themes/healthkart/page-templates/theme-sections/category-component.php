<?php $category = get_query_var('category'); ?>
<div class="col-md-4 col-12 recent-post p-0">
	<div class="row py-4 m-0">
		<div class="col-12">
			<div class="recent-post-featured-img my-3">
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
		<div class="col-12 next-articles">
			<?php $categories = hk_get_category(get_the_ID()); ?>
			<span>
				<span class="category">
					<?php foreach($categories as $index => $category): ?>
					<a title="<?php echo $category->name; ?>" href="<?php echo get_category_link($category); ?>" rel="category tag"><?php echo $category->name; ?></a>
					<?php if($index+1 != count($categories)): ?>
						,
					<?php endif; endforeach; ?>
				</span>
				<span class="dot"><i class="fa fa-circle" aria-hidden="true"></i></span>
				<span class="last-read"><?php echo get_mins_read(); ?> MIN READ</span>
			</span>
			<div class="recent-post-header">
				<h2 class="title"><a href="<?php the_permalink(); ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
			</div>
			<div class="recent-post-excerpt"><?php echo hk_get_excerpt(90); ?>
			</div>
			<!-- <div class="recent-post-icons">
				<span class="mr-3 f-14 heart"><i class="fa fa-heart" aria-hidden="true"></i> 15 </span>
				<span class="mr-3 f-14 comment"><i class="fa fa-comments" aria-hidden="true"></i> 3</span>
			</div> -->
		</div>
	</div>
</div>