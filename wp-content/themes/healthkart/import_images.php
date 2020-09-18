<?php

/*
* Template Name: Import
* The template for migrating data
*/
require_once("../../../wp-load.php");
require_once( '../../../wp-admin/includes/image.php' );
require_once(__DIR__."/config/field_mapping.php");
header("Content-Type: text/plain");

$mydb = new wpdb('root','root','fitness_freak','localhost');
$images = $mydb->get_results("SELECT *  FROM `file_managed` WHERE `uri` LIKE 'public%' ORDER BY `fid` ASC");

foreach ($images as $image) {
	$image_url = str_replace("public://", "https://www.healthkart.com/connect/sites/default/files/", $image->uri) ;
	echo $image_url."\n";

	$upload_dir = wp_upload_dir();

	$image_data = file_get_contents( $image_url );

	$filename = basename( $image_url );

	if ( wp_mkdir_p( $upload_dir['path'] ) ) {
	  $file = $upload_dir['path'] . '/' . $filename;
	}
	else {
	  $file = $upload_dir['basedir'] . '/' . $filename;
	}

	file_put_contents( $file, $image_data );

	$wp_filetype = wp_check_filetype( $filename, null );

	$attachment = array(
	  'post_mime_type' => $wp_filetype['type'],
	  'post_title' => sanitize_file_name( $filename ),
	  'post_content' => '',
	  'post_status' => 'inherit'
	);

	$attach_id = wp_insert_attachment( $attachment, $file );
	$attach_data = wp_generate_attachment_metadata( $attach_id, $file );
	wp_update_attachment_metadata( $attach_id, $attach_data );
	$x++;
	if($x == 2){
		//break;
	}
}