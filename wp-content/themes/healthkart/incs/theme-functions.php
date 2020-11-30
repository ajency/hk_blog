<?php
function hk_get_category($post_id, $tax = "category"){
	if ( class_exists('WPSEO_Primary_Term') ) {
	     // Show the post's 'Primary' category, if this Yoast feature is available, & one is set
		$wpseo_primary_term = new WPSEO_Primary_Term( $tax, $post_id );
		$wpseo_primary_term = $wpseo_primary_term->get_primary_term();
		if(!$wpseo_primary_term){
			$category = wp_get_post_terms( $post_id, $tax ); 

		}else{
			$term = get_term( $wpseo_primary_term );
		     if ( is_wp_error( $term ) ) {
		          // Default to first category (not Yoast) if an error is returned
		        $category = wp_get_post_terms( $post_id, $tax ); 
		     } else {
		          // Set variables for category_display & category_slug based on Primary Yoast Term
		          $category_id = $term->term_id;
		          $category[] = get_term($category_id, $tax);
		     }
		}
	} else {
	     // Default, display the first category in WP's list of assigned categories
	    $category = wp_get_post_terms( $post_id, $tax ); 
	}
	return $category;
}

/**
 * Function calculate the estimates reading time of the post content.
 * @param string $content Post content.
 * @return string estimated reading time.
 */
function get_estimated_reading_time( $content = '') {
    $wpm = 265;
    $text_content = strip_shortcodes( $content );   // Remove shortcodes
    $str_content = strip_tags( $text_content );     // remove tags
    $word_count = str_word_count( $str_content );
    $readtime = ceil( $word_count / $wpm );
    return $readtime;
}

function get_mins_read(){
	$mins_read = get_post_meta( get_the_ID(), 'hk_mins_read', true ); 
	if(!$mins_read){
		$mins_read = get_estimated_reading_time(get_the_content());
	}
	return $mins_read;
}

function hk_get_excerpt($limit) {
	$content = get_the_excerpt();
	if(strlen($content) > $limit){
		$limit_pos = strpos($content, " ", $limit);
		$excerpt = substr($content, 0, $limit_pos);
	}
	else{
		$excerpt = $content;
	}
	return $excerpt;
}
function hk_get_pagination($totalposts, $currentPage){
	$limitPerPage = 6;
	// Total pages rounded upwards
	$totalPages = ceil($totalposts / $limitPerPage);
	// Number of buttons at the top, not counting prev/next,
	// but including the dotted buttons.
	// Must be at least 5:
	$paginationSize = 7;
	$numberSize = $paginationSize - 3;
	$index = 1;
	$pages = [$index];

	if($currentPage <= $numberSize){
		for ($i=$numberSize; $i > 0 && $index < $totalPages; $i--) { 
			$pages[] = ++$index;
		}
		if(!$i){
			$pages[] = "...";
		}
	}
	if($currentPage > $numberSize && $currentPage <= $totalPages - $numberSize){
		$pages = array_merge($pages, ["...", $currentPage-1, $currentPage, $currentPage+1,"..."]);
	}
	if($currentPage > $totalPages - $numberSize && $index < $totalPages){
		$index = $totalPages - $numberSize;
		$pages[] = "...";
		for ($i=$numberSize; $i > 0 ; $i--) { 
			$pages[] = $index++;
		}
	}
	if($totalPages > $numberSize){
		$pages[] = $totalPages;
	}
	return $pages;
}
function display_human_readable_time($olddate){
	$now = time();                  //pick present time from server     
	$old = strtotime( $olddate);  //create integer value of old time
	$diff =  $now-$old;             //calculate difference
	$old = new DateTime($olddate);
	$old = $old->format('Y M d');       //format date to "2015 Aug 2015" format

    if ($diff /60 <1)                       //check the difference and do echo as required
    {
    echo intval($diff%60)." seconds ago";
    }
    else if (intval($diff/60) == 1) 
    {
    echo " 1 minute ago";
    }
    else if ($diff / 60 < 60)
    {
    echo intval($diff/60)." minutes ago";
    }
    else if (intval($diff / 3600) == 1)
    {
    echo "1 hour ago";
    }
    else if ($diff / 3600 <24)
    {
    echo intval($diff/3600) . " hours ago";
    }
    else if ($diff/86400 < 30)
    {
    echo intval($diff/86400) . " days ago";
    }
    else
    {
    echo $old;  ////format date to "2015 Aug 2015" format
    }
}