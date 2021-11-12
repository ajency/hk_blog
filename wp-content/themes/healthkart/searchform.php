<form action="<?php echo get_site_url();?>/search" method="get" role="search" id="searchform">
	<div class="input-group">
		<input type="text" name="s" id="search" class="form-control search-bar" placeholder="Search" value="<?php the_search_query(); ?>">
		<div class="input-group-append button-icon">
			<button class="btn" type="button" id="searchBtn">
				<i class="fa fa-search search-icon-grey"></i>
			</button>
		</div>
	</div>
</form>