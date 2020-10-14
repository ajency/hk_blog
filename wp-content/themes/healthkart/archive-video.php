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
?>
<div class="container">
<?php 
	set_query_var( 'post_ids', array() );
	get_template_part( 'page-templates/theme-sections/video/banner', 'section' );
	get_template_part( 'page-templates/theme-sections/video/latest-articles', 'section' ); 
	get_template_part( 'page-templates/theme-sections/video/trending-articles', 'section' ); 
	get_template_part( 'page-templates/theme-sections/video/explore-articles', 'section' );
	get_template_part( 'page-templates/theme-sections/video/more-articles', 'section' ); 
?>
</div>
<?php get_footer(); ?>


exclude
count