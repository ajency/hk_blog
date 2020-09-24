<?php
function hk_get_category($post_id){
	if ( class_exists('WPSEO_Primary_Term') ) {
	     // Show the post's 'Primary' category, if this Yoast feature is available, & one is set
		$wpseo_primary_term = new WPSEO_Primary_Term( 'category', $post_id );
		$wpseo_primary_term = $wpseo_primary_term->get_primary_term();
		if(!$wpseo_primary_term){
			$category = wp_get_post_terms( $post_id, 'category' ); 
			$category_display =  $category[0]->name;
		}else{
			$term = get_term( $wpseo_primary_term );
		     if ( is_wp_error( $term ) ) {
		          // Default to first category (not Yoast) if an error is returned
		        $category = wp_get_post_terms( $post_id, 'category' ); 
				$category_display =  $category[0]->name;;
		     } else {
		          // Set variables for category_display & category_slug based on Primary Yoast Term
		          $category_id = $term->term_id;
		          $category_term = get_category($category_id);
		          $category_display = $term->name;

		     }
		}
	} else {
	     // Default, display the first category in WP's list of assigned categories
	    $category = wp_get_post_terms( $post_id, 'category' ); 
		$category_display =  $category[0]->name;
	}
	return $category_display;
}