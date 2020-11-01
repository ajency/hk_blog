<?php 
add_filter( 'posts_where', 'filter_posts_where', 10, 2 );
function filter_posts_where( $where, $query ) {
    global $wpdb;

    $starts_with = esc_sql( $query->get( 'starts_with' ) );

    if ( $starts_with ) {
        $where .= " AND $wpdb->posts.post_title LIKE '$starts_with%'";
    }

    return $where;
}

add_filter('wpseo_breadcrumb_links', 'hkSetBreadcrumbs');
//add_filter('wpseo_json_ld_output', 'hkSetBreadcrumbs');
function hkSetBreadcrumbs($links) {
	//echo json_encode($links);
	hkGlobals::$breadcrumb_links = $links;
/*    if(hkGlobals::$breadcrumb_str == ''){
	    hkGlobals::$breadcrumb_str = '<span>';
	    //echo json_encode($links);
		foreach ($links as $link) {
			hkGlobals::$breadcrumb_str .= "<span><a href='".$link['url']."'>".$link['text']."</span>";
		}
		hkGlobals::$breadcrumb_str .= "</span";
	}*/
	
	//echo json_encode(hkGlobals::$breadcrumb_str);
    return $links;
}

add_filter('wp_head', 'hkPrintBreadcrumbs');
function hkPrintBreadcrumbs(){
	if (is_single()){
	   	$custom_logo_id = get_theme_mod( 'custom_logo' );
	   	$image = wp_get_attachment_image_src( $custom_logo_id , 'full' );
		echo '<script type="application/ld+json">{
		"@context": "https://schema.org",
		"@type": "BlogPosting",
		"headline": "'.get_the_title().'",
		"description": "'.get_the_excerpt().'",
		"datePublished": "'.get_the_date('F j, Y').'",
		"datemodified": "'.get_the_modified_date('F j, Y').'",
		"mainEntityOfPage": "True",
		"image": {
			"@type": "imageObject",
			"url": "'.get_the_post_thumbnail_url( null, 'full' ).'",
			"height": "600",
			"width": "800"
		},
		"publisher": {
			"@type": "Organization",
			"name": "Publisher name",
			"sameAs": ["https://www.facebook.com/healthkart","https://twitter.com/healthkart","https://in.pinterest.com/healthkart/","https://www.instagram.com/healthkart/","https://www.youtube.com/user/healthkart"],
			"logo": {
				"@type": "imageObject",
				"url": "'.$image[0].'"
			}
		},
		"author": {
			"@type": "Person",
			"name": "Author Name"
		}
		}</script>
		';
		echo '<script type="application/ld+json">';
		$breadcrumb = [
			"@context" =>  "https://schema.org",
			"@type" => "BreadcrumbList",
		];

		foreach (hkGlobals::$breadcrumb_links as $index => $link) {
			$breadcrumb['itemListElement'][] = [
				"@type" => "ListItem",
				"position" => ($index+1),
				"name" => ($index) ? $link['text'] : "Home",
				"item" => $link['url']
			];
		}
		echo str_replace('\\', '', json_encode($breadcrumb, JSON_PRETTY_PRINT));
		echo '</script>';
	}
}


