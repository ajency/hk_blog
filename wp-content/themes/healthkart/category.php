<?php

get_header(); 
get_template_part( 'page-templates/theme-sections/follow-sidebar', 'section' ); 
$category = get_queried_object();
$is_nested = get_term_meta($category->term_id, 'hk_nested_category', true);
if($is_nested){
	get_template_part( 'page-templates/theme-sections/category-nested', 'section' );
}
else{
	get_template_part( 'page-templates/theme-sections/category-single', 'section' );
}
get_footer(); 

?>	
