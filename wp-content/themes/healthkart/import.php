<?php

/*
* Template Name: Import
* The template for migrating data
*/
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
set_time_limit(0);
require_once("../../../wp-load.php");
require_once( '../../../wp-admin/includes/post.php' );
require_once(__DIR__."/config/field_mapping.php");
header("Content-Type: text/plain");
exit;

/*$posts = $wpdb->get_results("SELECT *  FROM wp_posts WHERE `post_content` LIKE '%http://healthkart.wpengine.com%' order by id asc");
foreach ($posts as $post) {
	$post_content = str_replace( "http://healthkart.wpengine.com", "https://healthkart.wpengine.com", $post->post_content );
	$post_arr = array(
			'ID'		 => $post->ID,			
			'post_content' => $post_content,		
		);
	wp_update_post( $post_arr );
	echo $post->ID."<hr>";
}*/


/*$mydb = new wpdb('root','root','fitness_freak','localhost');
$imgs = $mydb->get_results("select * from field_data_field_img_d where bundle='articles'");
foreach ($imgs as $img) {
	$node = $wpdb->get_row("SELECT *  FROM wp_postmeta WHERE meta_key = 'hk_node_id' and meta_value = '".$img->entity_id."'");
	$image = $wpdb->get_row("SELECT *  FROM wp_postmeta WHERE meta_key = 'hk_file_id' and meta_value = '".$img->field_img_d_fid."'");
	if($node && $image){
		$media_id = get_post_meta($node->post_id, 'hk_thumbnail_image_id', true);
		if(!$media_id){
			$image_url = wp_get_attachment_image_src( $image->post_id, 'full' )[0];
			$image_url = str_replace( get_site_url(), HK_DOMAIN, $image_url );
			add_post_meta($node->post_id, 'hk_thumbnail_image', $image_url);
			add_post_meta($node->post_id, 'hk_thumbnail_image_id', $image->post_id);
			echo "Post: ".$node->post_id.", ".$image_url."\n\n";
		}
	}
}
*/


/*$mydb = new wpdb('root','root','fitness_freak','localhost');
$posts = $wpdb->get_results("SELECT *  FROM wp_posts where post_type='infographic' order by id asc");
$node_ids = [];
foreach ($posts as $post) {
	$node_id = get_post_meta($post->ID, 'hk_node_id', true);
	if($node_id){
		$body = $mydb->get_row("select * from field_data_field_text where entity_id='".$node_id."'");
		$post_content = $body->field_text_value;
		$post_arr = array(
				'ID'		 => $post->ID,			
				'post_content' => $post_content,		
			);
		echo json_encode($post_arr);
		wp_update_post( $post_arr );
		$image = $mydb->get_row("select * from field_data_field_infographics_image where entity_id='".$node_id."'");
		if($image){
			$media_id = fetch_image($image->field_infographics_image_fid, $image->field_infographics_image_alt, $image->field_infographics_image_title);
			$wp_media_id = get_post_meta($post->ID, '_thumbnail_id', true);
			if($media_id && !$wp_media_id){
				echo "\nMedia: ".$media_id;
				add_post_meta($post->ID, '_thumbnail_id', $media_id);
			}
		}
	}
	echo "\n\n";
}*/



/*
$mydb = new wpdb('root','root','fitness_freak','localhost');
$imgs = $mydb->get_results("select * from field_data_field_goal");
foreach ($imgs as $img) {
	$node = $wpdb->get_row("SELECT *  FROM wp_postmeta WHERE meta_key = 'hk_node_id' and meta_value = '".$img->entity_id."'");
	if($node){
		$goals = $mydb->get_results("select * from field_data_field_diet_plan where entity_id='".$img->field_goal_value."' order by delta");
		foreach ($goals as $index => $goal) {
			$foods = $mydb->get_results("select * from field_data_field_food where entity_id='".$goal->field_diet_plan_value."'");
			$time = $mydb->get_results("select * from field_data_field_timing where entity_id='".$goal->field_diet_plan_value."'");
			foreach ($foods as $food) {
				echo "Time: ".$time->field_timing_value.", Food: ".$food->field_food_value."\n";
			}
		}
		
		$wp_meta = get_post_meta($node->post_id, 'hk_challenges', true);
		if(!$wp_postmeta){
			echo "Node: ".$img->entity_id.", Post: ".$node->post_id.", Title: ".$node->post_name."\n\n";
			//add_post_meta($node->post_id, 'hk_challenges', $img->field_what_challenges_did_you_fa_value);
		}
	}
}
*/


//migrate hk user ids
/*$mydb = new wpdb('root','root','fitness_freak','localhost');
$users = $wpdb->get_results("SELECT *  FROM wp_users WHERE id > 1");
foreach ($users as $user) {
	$name = "";
	$hk_user = $mydb->get_row("select * from users where mail LIKE '".$user->user_login."%'");
	//add_user_meta($user->ID, 'hk_user_id', $hk_user->uid);
	$comment = $mydb->get_row("select * from comment where uid = '".$hk_user->uid."' order by cid desc");
	if($comment && $comment->name){
		$name = $comment->name;
		//echo "1: ".$comment->name.' = '.$user->ID."\n";
	}
	else{
		$questions = $mydb->get_results("select * from node where type='question' and uid = '".$hk_user->uid."'");
		foreach ($questions as $question) {
			$email = $mydb->get_row("select * from field_data_field_email where entity_id = '".$question->nid."'");
			if($email){
				//echo "2: ".$email->field_email_value.' = '.$user->ID."\n";
				$name = $email->field_email_value;
				break;
			}
		}
	}
	if($name){
		$nice_name = explode("@", $name)[0];
		$nice_name_parts = explode(".", $nice_name);
		$display_name = "";
		foreach ($nice_name_parts as $nice_name_part) {
			$display_name .= ucfirst($nice_name_part)." ";
		}
		$display_name = trim($display_name, " ");
		echo $user->ID.": ".$name.": ".str_replace(".", "-", $nice_name).": ".$display_name."\n";
		wp_update_user( array(
	        'ID' => $user->ID,
	        'user_email' => $name,
	        'user_nicename' => str_replace(".", "-", strtolower($nice_name)),
	        'display_name' => $display_name,
	   ) );
	}
}*/

$posts = $wpdb->get_results("SELECT *  FROM wp_posts WHERE post_content LIKE '%/sites/default/files/%' and post_status='publish' and post_type='post' order by id desc");
foreach ($posts as $post) {
	preg_match_all( "/<img(.*?)src=\"(.*?)\/sites\/default\/files\/(.*?)\"(.*?)>/", $post->post_content , $matches);
	$content = $post->post_content;
	for ($i=0; $i < count($matches[2]); $i++) { 
		$image_url = "https://www.healthkart.com/connect/sites/default/files/".$matches[3][$i];
		$image_data = get_data( $image_url );
		if($image_data){
			$upload_dir = wp_upload_dir();
			$filename = str_replace(" ", "_", urldecode(strtolower(basename( $image_url )))); 

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
			//add_post_meta($attach_id, 'hk_file_id', $image->fid);
			$wp_url = str_replace("http://localhost/hk-blog", "", wp_get_attachment_url($attach_id)); 
			echo "\nPost: ".$post->ID.", URL: ".$image_url.", WP URL: ".$wp_url."\n";
			
			
			$img_tag = "<img".$matches[1][$i]."src=\"".$wp_url."\"".$matches[4][$i].">";
			$filename =  str_replace("/", "\/", $matches[3][$i]);
			$content = preg_replace("/<img(.*?)src=\"(.*?)\/sites\/default\/files\/".$filename."\"(.*?)>/", $img_tag ,$content);
		}
		else{
			echo "\nError Image: -".$image_url."-\n";
		}
	}
	//echo "\n\n".$content;
	//exit;
	$post_arr = array(
		'ID'		 => $post->ID,			
		'post_content' => $content,		
	);
	wp_update_post( $post_arr );
}
exit;
/*$post_arr = array(
		'ID'		 => $post->ID,			
		'post_content' => $post_content,		
	);
wp_update_post( $post_arr );
echo $post->ID."<hr>";

exit;
$mydb = new wpdb('root','root','fitness_freak','localhost');
$nodes = $mydb->get_results("select * from node where type in ('".implode("','", array_keys($post_types))."')");
$x=1;
foreach ($nodes as $node) {
	$node_present = $wpdb->get_row("SELECT *  FROM wp_postmeta WHERE meta_key = 'hk_node_id' and meta_value = '".$node->nid."'");
	if(!$node_present){
		$field_data_body = $mydb->get_row("select * from field_data_body where entity_type='node' and bundle='".$node->type."' and entity_id='".$node->nid."'");
		if(!$field_data_body){
			$body = '';
			$field_data_field_enter_story = $mydb->get_results("select * from field_data_field_enter_story where entity_type='node' and bundle='".$node->type."' and entity_id='".$node->nid."'");
			foreach ($field_data_field_enter_story as $field_enter_story) {
				$field_data_field_text = $mydb->get_row("select * from field_data_field_text where entity_id='".$field_enter_story->field_enter_story_value."' and entity_type='field_collection_item' and bundle='field_enter_story'");
				if($field_data_field_text){
					$body .= $field_data_field_text->field_text_value;
				}
				$field_data_field_image_upload = $mydb->get_row("select * from field_data_field_image_upload where entity_id='".$field_enter_story->field_enter_story_value."' and entity_type='field_collection_item' and bundle='field_enter_story'");
				if($field_data_field_image_upload){
					$field_data_field_upload_image = $mydb->get_row("select * from field_data_field_upload_image where entity_id='".$field_data_field_image_upload->field_image_upload_value."' and entity_type='field_collection_item' and bundle='field_image_upload'");
					if($field_data_field_upload_image){
						$file_managed = $mydb->get_row("select * from file_managed where fid='".$field_data_field_upload_image->field_upload_image_fid."'");
						if($file_managed){
							$media_id = fetch_image($file_managed->fid, $field_data_field_upload_image->field_upload_image_alt, $field_data_field_upload_image->field_upload_image_title);
							if($media_id){
								$image_url = wp_get_attachment_image_src( $media_id, 'large' )[0];
	  							$image_url = str_replace( get_site_url(), HK_DOMAIN, $image_url );
								$image_markup = "<div class='row'><div class='col-12'><div class='hk-content-image'><img src='".$image_url."'></div></div></div>";
								$body .= $image_markup;
							}
						}
					}
				}
			}
			if($body){
				$field_data_body = new stdClass;
				$field_data_body->body_value = str_replace("https://www.healthkart.com/connect", "", $body);
			}
		}
		$field_data_field_url = $mydb->get_row("select * from field_data_field_url where entity_id='".$node->nid."' and entity_type='node' and bundle='video'");
		if($field_data_field_url){
			$video_body = $field_data_field_url->field_url_value;
			preg_match('/src=\"(.*?)\"/', $video_body, $matches);
			if($matches[1]){
				$field_data_body = new stdClass;
				$field_data_body->body_value = get_video($matches[1]);
			}
		}

		$url_alias = $mydb->get_row("select * from url_alias where source='node/".$node->nid."'");
		$users = $mydb->get_row("select * from users where uid='".$node->uid."'");

		$post_data = [];
		foreach ($field_mapping['post'] as $post_field => $field_data) {
			$params = explode(".", $field_data['field']);
			if(isset(${$params[0]}->{$params[1]})){
				if(isset($field_data['change']) && is_callable($field_data['change'])){
					$value = $field_data['change'](${$params[0]}->{$params[1]});
				}
				else{
					$value = ${$params[0]}->{$params[1]};
				}
				$post_data[$post_field] = $value;
			}
		}
		echo "ID: ".$node->nid;
		$post_id = wp_insert_post($post_data, true);
		echo ", Post: ".json_encode($post_id);
		add_post_meta($post_id, 'hk_node_id', $node->nid);
		//echo ", Data: ".json_encode($post_data);
		$field_data_field_image = $mydb->get_row("select * from field_data_field_image where entity_id='".$node->nid."'");
		if($field_data_field_image){
			$file_managed = $mydb->get_row("select * from file_managed where fid='".$field_data_field_image->field_image_fid."'");
			if($file_managed){
				$media_id = fetch_image($file_managed->fid, $field_data_field_image->field_image_alt, $field_data_field_image->field_image_title);
				if($media_id){
					add_post_meta($post_id, '_thumbnail_id', $media_id);
				}
			}
		}
		$field_data_field_avatar = $mydb->get_row("select * from field_data_field_avatar where entity_id='".$node->nid."'");
		if($field_data_field_avatar){
			$file_managed = $mydb->get_row("select * from file_managed where fid='".$field_data_field_avatar->field_avatar_fid."'");
			if($file_managed){
				$media_id = fetch_image($file_managed->fid, $field_data_field_avatar->field_avatar_alt, $field_data_field_avatar->field_avatar_title);
				if($media_id){
					add_post_meta($post_id, '_thumbnail_id', $media_id);
				}
			}
		}
		$field_data_field_before_img = $mydb->get_row("select * from field_data_field_before_img where entity_id='".$node->nid."'");
		if($field_data_field_before_img){
			$file_managed = $mydb->get_row("select * from file_managed where fid='".$field_data_field_before_img->field_before_img_fid."'");
			if($file_managed){
				$media_id = fetch_image($file_managed->fid, $field_data_field_before_img->field_before_img_alt, $field_data_field_before_img->field_before_img_title);
				if($media_id){
					$image_url = wp_get_attachment_image_src( $media_id, 'full' )[0];
	  				$image_url = str_replace( get_site_url(), HK_DOMAIN, $image_url );
					add_post_meta($post_id, 'hk_image_before_diet', $image_url);
					add_post_meta($post_id, 'hk_image_before_diet_id', $media_id);
				}
			}
		}
		$field_data_field_after_img = $mydb->get_row("select * from field_data_field_after_img where entity_id='".$node->nid."'");
		if($field_data_field_after_img){
			$file_managed = $mydb->get_row("select * from file_managed where fid='".$field_data_field_after_img->field_after_img_fid."'");
			if($file_managed){
				$media_id = fetch_image($file_managed->fid, $field_data_field_after_img->field_after_img_alt, $field_data_field_after_img->field_after_img_title);
				if($media_id){
					$image_url = wp_get_attachment_image_src( $media_id, 'full' )[0];
	  				$image_url = str_replace( get_site_url(), HK_DOMAIN, $image_url );
					add_post_meta($post_id, 'hk_image_after_diet', $image_url);
					add_post_meta($post_id, 'hk_image_after_diet_id', $media_id);
				}
			}
		}
		
		$field_data_field_description = $mydb->get_row("select * from field_data_field_description where entity_type='node' and bundle='".$node->type."' and entity_id='".$node->nid."'");
		$field_data_field_accomplish_goal = $mydb->get_row("select * from field_data_field_accomplish_goal where entity_type='node' and bundle='".$node->type."' and entity_id='".$node->nid."'");
		$field_data_field_age_after_diet = $mydb->get_row("select * from field_data_field_age_after_diet where entity_type='node' and bundle='".$node->type."' and entity_id='".$node->nid."'");
		$field_data_field_age_before_diet = $mydb->get_row("select * from field_data_field_age_before_diet where entity_type='node' and bundle='".$node->type."' and entity_id='".$node->nid."'");
		$field_data_field_body_fat_before_diet = $mydb->get_row("select * from field_data_field_body_fat_before_diet where entity_type='node' and bundle='".$node->type."' and entity_id='".$node->nid."'");
		$field_data_field_body_fat_after_diet = $mydb->get_row("select * from field_data_field_body_fat_after_diet where entity_type='node' and bundle='".$node->type."' and entity_id='".$node->nid."'");
		$field_data_field_reason_to_transform = $mydb->get_row("select * from field_data_field_reason_to_transform where entity_type='node' and bundle='".$node->type."' and entity_id='".$node->nid."'");
		$field_data_field_routien_training = $mydb->get_row("select * from field_data_field_routien_training where entity_type='node' and bundle='".$node->type."' and entity_id='".$node->nid."'");
		$field_data_field_suggestion_for_future = $mydb->get_row("select * from field_data_field_suggestion_for_future where entity_type='node' and bundle='".$node->type."' and entity_id='".$node->nid."'");
		$field_data_field_supplements_that_helped_yo = $mydb->get_row("select * from field_data_field_supplements_that_helped_yo where entity_type='node' and bundle='".$node->type."' and entity_id='".$node->nid."'");
		$field_data_field_weight_after_diet = $mydb->get_row("select * from field_data_field_weight_after_diet where entity_type='node' and bundle='".$node->type."' and entity_id='".$node->nid."'");
		$field_data_field_weight_before_diet = $mydb->get_row("select * from field_data_field_weight_before_diet where entity_type='node' and bundle='".$node->type."' and entity_id='".$node->nid."'");
		$field_data_field_how_did_you_overcome_these = $mydb->get_row("select * from field_data_field_how_did_you_overcome_these where entity_type='node' and bundle='".$node->type."' and entity_id='".$node->nid."'");
		$field_data_field_live_ama_video = $mydb->get_row("select * from field_data_field_live_ama_video where entity_type='node' and bundle='".$node->type."' and entity_id='".$node->nid."'");
		$node_counter = $mydb->get_row("select * from node_counter where nid='".$node->nid."'");
		foreach ($field_mapping['meta'] as $field => $field_data) {
			$params = explode(".", $field_data['field']);
			if(isset(${$params[0]}->{$params[1]})){
				if(isset($field_data['change']) && is_callable($field_data['change'])){
					$value = $field_data['change'](${$params[0]}->{$params[1]});
				}
				else{
					$value = ${$params[0]}->{$params[1]};
				}
				update_post_meta($post_id, $field, $value);
			}
		}
		$taxonomies = $mydb->get_results("select v.name as tax_name, v.machine_name as tax_slug, v.description as tax_description, t.name as term_name, i.sticky
			from taxonomy_vocabulary as v inner join taxonomy_term_data as t on t.vid=v.vid 
			inner join taxonomy_index as i on t.tid=i.tid 
			left join field_data_field_display_name as f on t.tid=f.entity_id 
			where i.nid = '".$node->nid."'
		");
		$term_ids = [];
		echo ", Tax: ";
		foreach ($taxonomies as $tax) {
			if(isset($taxonomy[$tax->tax_slug])){
				$current_tax = $taxonomy[$tax->tax_slug];
				if($post_types[$node->type] != 'post'){
					if($current_tax == 'post_tag'){
						$current_tax = 'tag';
					}
					$current_tax = $post_types[$node->type].'_'.$current_tax;
				}
				$term_names = explode('#', $tax->term_name);
				foreach ($term_names as $term_name) {
					$term_name = trim($term_name);
					if($term_name){
						$term = term_exists($term_name, $current_tax);
						if(!$term){
							echo $current_tax.'(';
							$term = wp_insert_term($term_name, $current_tax );
							echo $term_name."), ";
							if($tax->sticky){
								update_term_meta($term['term_id'], 'is_sticky', 'true');
							}
						}
						if(is_wp_error($term)){
							echo json_encode($term);
						}else{
							$term_ids[$current_tax][] = (int)$term['term_id'];
						}
					}
				}
			}
		}

		foreach ($term_ids as $tax => $ids) {
			wp_set_post_terms($post_id, $ids, $tax);
		}
		echo "\n\n---------------------\n\n";
	}
	$x++;
	if($x == 100){
		//break;
	}
} 
