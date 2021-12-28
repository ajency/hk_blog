<div class="explore-articles-section explore-video-section">
	<div class="section-heading">Explore Videos</div>
	<?php 
	$args = array(
		'hide_empty'      => true,
	);
	$categories = get_terms('video_category', $args); ?>
	<div class="category-buttons">
	<?php foreach ($categories as $index => $category): ?>
		<button type="button" class="btn category-buttons-single <?php if(!$index){
			echo 'category-buttons-single-active'; $_POST['category_id'] = $category->term_id; }?>" data-type="video" data-val="<?php echo $category->term_id; ?>"><?php echo $category->name; ?></button>
	<?php endforeach; ?>
	</div>
	<div class = "category_articles_container position-relative">
		<?php get_template_part( 'page-templates/theme-sections/video/explore-articles', 'component' ); ?>
	</div>
</div>