<div class="explore-articles-section explore-video-section">
	<div class="section-heading pt-3 pb-3">Explore Videos</div>
	<?php 
	$args = array(
		'hide_empty'      => true,
	);
	$categories = get_terms('video_category', $args); ?>
	<div class="category-buttons my-4">
	<?php foreach ($categories as $index => $category): ?>
		<button type="button" class="btn m-0 mr-3 py-2 px-3 category-buttons-single <?php if(!$index){
			echo 'category-buttons-single-active'; $_POST['category_id'] = $category->term_id; }?>" data-type="video" data-val="<?php echo $category->term_id; ?>"><?php echo $category->name; ?></button>
	<?php endforeach; ?>
	</div>
	<div class = "category_articles_container position-relative">
		<?php get_template_part( 'page-templates/theme-sections/video/explore-articles', 'component' ); ?>
	</div>
</div>