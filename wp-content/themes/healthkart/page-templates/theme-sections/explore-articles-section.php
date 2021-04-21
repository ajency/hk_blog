<div class="explore-articles-section">
	<div class="explore-articles-heading pt-3 pb-3">EXPLORE ARTICLES</div>
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
	<div class="category-buttons mt-2 content-desktop">
		<?php foreach ($categories as $index => $category): ?>
			<button type="button" class="btn m-0 mt-2 mr-3 py-2 px-3 category-buttons-single <?php if(!$index){
				echo 'category-buttons-single-active'; $_POST['category_id'] = $category->term_id; }?>" data-val="<?php echo $category->term_id; ?>"><?php echo $category->name; ?></button>
		<?php endforeach; ?>
	</div>

	<!-- mobile -->
	<div class="content-mobile">
		<div class="category-buttons mt-2 explore-articles-slider">
			<?php foreach ($categories as $index => $category): ?>
				<button type="button" class="btn m-0 mt-2 mr-3 py-2 px-3 category-buttons-single <?php if(!$index){
					echo 'category-buttons-single-active'; $_POST['category_id'] = $category->term_id; }?>" data-val="<?php echo $category->term_id; ?>"><?php echo $category->name; ?></button>
			<?php endforeach; ?>
		</div>
	</div>

	<!-- desktop -->
	<div class = "category_articles_container position-relative content-desktop">
	    <div class="explore-articles row">
			<?php get_template_part( 'page-templates/theme-sections/explore-articles', 'component' ); ?>
		</div>
		<div class="w-100 action-btn text-center">
			<a href="<?php echo get_category_link($_POST['category_id']); ?>" class="btn hk-button">VIEW ALL</a>
		</div>
		<div class="my-5 loader explore-articles-loader d-none">
			<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/loader.svg">
		</div>
	</div>

	<!-- mobile -->
	<div class = "category_articles_container position-relative content-mobile">
	    <div class="explore-articles row explore-articles-slider">
			<?php get_template_part( 'page-templates/theme-sections/explore-articles', 'component' ); ?>
		</div>
		<div class="w-100 action-btn text-center">
			<a href="<?php echo get_category_link($_POST['category_id']); ?>" class="btn hk-button">VIEW ALL</a>
		</div>
		<div class="my-5 loader explore-articles-loader d-none">
			<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/loader.svg">
		</div>
	</div>
</div>