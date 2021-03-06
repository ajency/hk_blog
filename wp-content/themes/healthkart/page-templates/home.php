<?php
/**
 * Genesis Sample.
 *
 * This file adds the landing page template to the Genesis Sample Theme.
 *
 * Template Name: Home
 *
 * @package Genesis Sample
 * @author  StudioPress
 * @license GPL-2.0-or-later
 * @link    https://www.studiopress.com/
 */
get_header(); 
get_template_part( 'page-templates/theme-sections/follow-sidebar', 'section' ); 
?>
<div class="container">
<?php 
	set_query_var( 'post_ids', array() );
	get_template_part( 'page-templates/theme-sections/banner', 'section' );
	get_template_part( 'page-templates/theme-sections/latest-articles', 'section' ); 
	get_template_part( 'page-templates/theme-sections/trending-articles', 'section' ); 
	get_template_part( 'page-templates/theme-sections/explore-articles', 'section' );
	get_template_part( 'page-templates/theme-sections/videos', 'section' ); 
	get_template_part( 'page-templates/theme-sections/infographics', 'section' ); 
	get_template_part( 'page-templates/theme-sections/transformations', 'section' ); 
	get_template_part( 'page-templates/theme-sections/more-articles', 'section' ); 
?>
</div>
<?php get_footer(); ?>
