<?php

get_header(); 
get_template_part( 'page-templates/theme-sections/follow-sidebar', 'section' ); 
$category = get_queried_object();
	get_template_part( 'page-templates/theme-sections/transformation-tag-single', 'section' );
get_footer(); 

?>	
