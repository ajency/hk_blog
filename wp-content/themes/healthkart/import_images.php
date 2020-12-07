<?php

/*
* Template Name: Import
* The template for migrating data
*/
require_once("../../../wp-load.php");
require_once( '../../../wp-admin/includes/image.php' );
require_once(__DIR__."/config/field_mapping.php");

$files = scandir('../../uploads/2020/12/');
$files = array_values(array_filter($files, function($var){
	return !in_array($var, ['..','.']);
}));
echo count($files).'<hr>';
$path = "/Applications/MAMP/htdocs/hk-blog/wp-content/uploads/2020/12/";
foreach ($files as $index => $file) {
	$lower = strtolower($file);
	rename($path.$file, $path.$lower);
	echo $index.'<br>'.$path.$file. '<br>'.$path.$lower.'<hr>';
}
exit;

$mydb = new wpdb('root','root','fitness_freak','localhost');
$images = $mydb->get_results("SELECT *  FROM file_managed ORDER BY fid ASC");
$x=0;
set_time_limit(0);
foreach ($images as $image) {
	$image_present = $wpdb->get_row("SELECT *  FROM wp_postmeta WHERE meta_key = 'hk_file_id' and meta_value = '".$image->fid."'");
	if(!$image_present){
		$image_name = $image->uri;
		if(strstr($image_name, "public://")){
			$image_name = str_replace("public://", "", $image_name);
			$image_url = "https://www.healthkart.com/connect/sites/default/files/". $image_name ;
		}
		if(strstr($image_name, "s3://")){
			$image_name = str_replace("s3://", "", $image_name);
			$image_url = "https://img1.hkrtcdn.com/ff/". $image_name ;
		}

		$image_data = get_data( $image_url );
		if($image_data){
			$upload_dir = wp_upload_dir();
			$filename = strtolower(basename( $image_url ));

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
			add_post_meta($attach_id, 'hk_file_id', $image->fid);
			echo 'ID: '.$image->fid.", Post: ".$attach_id.", URL: ".$image_url."<hr>";
		}
	}
	$x++;
	if($x == 11){
		//break;
	}
}
