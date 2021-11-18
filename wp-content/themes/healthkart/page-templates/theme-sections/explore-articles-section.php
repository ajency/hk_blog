<div class="container explore-articles-section">
	<div class="section-heading explore-articles-heading text-center">Explore Articles</div>
	<?php 
	$args = array(
		'hide_empty'      => true,
		'meta_query' => array(
            array(
                'key'     => 'hk_explore_category',    
                'value'   => 'on',   
            )
        )
	);
	$categories = get_categories($args); ?>
	<!-- desktop -->
	<div class="category-buttons content-desktop">
		<?php foreach ($categories as $index => $category): ?>
			<button type="button" class="btn m-0 mt-2 mr-3 py-2 px-3 category-buttons-single <?php if(!$index){
				echo 'category-buttons-single-active'; $_POST['category_id'] = $category->term_id; }?>" data-val="<?php echo $category->term_id; ?>"><?php echo $category->name; ?></button>
		<?php endforeach; ?>
	</div>

	<!-- desktop -->
	<div class = "category_articles_container position-relative">
		<?php get_template_part( 'page-templates/theme-sections/explore-articles', 'component' ); ?>
	</div>
</div>