<div class="explore-articles-section">
	<h2 class="explore-articles-heading pt-3 pb-3">EXPLORE ARTICLES</h2>
	<?php 
	$uncategorized_id = get_cat_ID( 'Uncategorized' );
	$args = array(
		'hide_empty'      => true,
		'exclude' => $uncategorized_id
	);
	$categories = get_categories($args); ?>
	<div class="category-buttons my-4">
	<?php foreach ($categories as $index => $category): ?>
		<button type="button" class="btn mr-3 py-2 px-3 category-buttons-single <?php if(!$index){
			echo 'category-buttons-single-active'; $_POST['category_id'] = $category->term_id; }?>" data-val="<?php echo $category->term_id; ?>"><?php echo $category->name; ?></button>
	<?php endforeach; ?>
	</div>
	<div class = "category_articles_container position-relative">
		<?php get_template_part( 'page-templates/theme-sections/explore-articles', 'component' ); ?>
	</div>
</div>