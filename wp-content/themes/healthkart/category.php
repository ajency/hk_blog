<?php

get_header(); 

?>	

	<div class="header_image position-relative">
		<div class="header">
			<div class="container">
				<div class="breadcrumbs-wrapper position-relative">
      				<div class="breadcrumbs-inside">
  						<a href="<?php echo get_site_url(); ?>/"><i class="fa fa-home" aria-hidden="true"></i></a>
  						<a href=""><?php $categories = get_the_category();
							if ( ! empty( $categories ) ) {
							    echo esc_html( $categories[0]->name );   
						} ?></a>
  					</div>
  				</div>
			</div>
		</div>
	</div>
	<div class="container p-0">
		<h2 class="category-name pl-15">
		<?php $categories = get_the_category();
			if ( ! empty( $categories ) ) {
			    echo esc_html( $categories[0]->name );   
		} ?>
		</h2>
		<p class="text-black pl-15 f-14 article-count">
		<?php
			$categories = get_the_category();
			if ( ! empty( $categories ) ) {
				echo esc_html( $categories[0]->count ) . ' Articles ';
			}
		?>
		</p>
		<div class="latest-reads category-list-view">
			<?php get_template_part( 'page-templates/content', 'category' );	?>
		</div>
	</div>
<?php

get_footer(); 

?>	