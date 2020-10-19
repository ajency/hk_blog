<form action="/search" method="get" role="search" id="searchform">
	<div class="input-group">
		<input type="text" name="s" id="search" class="form-control search-bar" placeholder="Search Healthkart Blog" value="<?php the_search_query(); ?>">
		<div class="input-group-append button-icon">
			<button class="btn" type="button" id="searchBtn">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/search-icon.png" alt="search" class="search-icon-white">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/search-icon-grey.png" alt="search" class="search-icon-grey">
			</button>
		</div>
	</div>
</form>