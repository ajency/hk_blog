<?php
require_once( '../../../wp-admin/includes/image.php' );

$user_roles = [
	'administrator' => 'administrator',
	'Student' => 'contributor',
	'Expert' => 'editor',
	'Guru' => 'editor',
	'admin' => 'administrator',
	'main admin' => 'administrator',
	'SEO' => 'editor',
	'brand admin' => 'administrator',
	'consult team' => 'contributor',
	'Marketing' => 'editor',
	'content writer' => 'author'
];
$post_types = [
	'ama' => 'ama',
	'articles' => 'post',
	'blog' => 'post',
	'infographics' => 'post',
	'page' => 'page',
	'recipes' => 'post',
	'transformation_stories' => 'post',
	'video' => 'post'
];
$hk_types = [
	'articles' => 'Articles',
	'blog' => 'Articles',
	'infographics' => 'Infographics',
	'video' => 'Videos',
	'transformation_stories' => 'Transformation',
];
$taxonomy = [
	'primary_tags' => 'category',
	'secondary_tags' => 'secondary_tag',
	'tags' => 'post_tag',
	'transformation_stories_category' => 'category',
];
$field_mapping = [
	'taxonomy' => [
		'category' => [
			'Muscle Building' => 'Bodybuilding',
			'Weight Loss' => 'Weightloss',
		]
	],
	'post' => [
		'post_date' => [
			'field' => 'node.created',
			'change' => function($field){
				return date('Y-m-d H:i:s', $field );
			}
		],
		'post_date_gmt' => [
			'field' => 'node.created',
			'change' => function($field){
				return date('Y-m-d H:i:s', $field );
			}
		],
		'post_content' => [
			'field' => 'field_data_body.body_value'
		],
		'post_title' => [
			'field' => 'node.title'
		],
		'post_status' => [
			'field' => 'node.status',
			'change' => function($field){
				$status = ($field) ? 'publish' : 'draft';
				return $status;
			}
		],
		'post_name' => [
			'field' => 'url_alias.alias',
		],
		'post_modified' => [
			'field' => 'node.changed',
			'change' => function($field){
				return date('Y-m-d H:i:s', $field );
			}
		],
		'post_modified_gmt' => [
			'field' => 'node.changed',
			'change' => function($field){
				return date('Y-m-d H:i:s', $field );
			}
		],
		'post_type' => [
			'field' => 'node.type',
			'change' => function($field) use ($post_types){
				return $post_types[$field];
			}
		],
		'post_author' => [
			'field' => 'users.mail',
			'change' => function($field) {
				$user = get_user_by( 'email', $field );
				if(!$user){
					$user_id = fetch_user($field);
					return $user_id;
				}
				return $user->ID;
			}
		],
	],
	'meta' => [
		'hk_description' => [
			'field' => 'field_data_field_description.field_description_value',
		],
		'hk_views' => [
			'field' => 'node_counter.totalcount'
		],
		'hk_accomplish_goal' =>[
			'field' => 'field_data_field_accomplish_goal.field_accomplish_goal_value'
		],
		'hk_transform_reason' =>[
			'field' => 'field_data_field_reason_to_transform.field_reason_to_transform_value'
		],
		'hk_training_routine' =>[
			'field' => 'field_data_field_routien_training.field_data_field_routien_training'
		],
		'hk_future_suggestion' =>[
			'field' => 'field_data_field_suggestion_for_future.field_suggestion_for_future_value'
		],
		'hk_supplements_that_helped' =>[
			'field' => 'field_data_field_supplements_that_helped_yo.field_supplements_that_helped_yo_value'
		],
		'hk_age_after_diet' => [
			'field' => 'field_data_field_age_after_diet.field_age_after_diet_value'
		],
		'hk_age_before_diet' => [
			'field' => 'field_data_field_age_before_diet.field_age_before_diet_value'
		],
		'hk_weight_after_diet' => [
			'field' => 'field_data_field_weight_after_diet.field_weight_after_diet_value'
		],
		'hk_weight_before_diet' => [
			'field' => 'field_data_field_weight_before_diet.field_weight_before_diet_value'
		],
		'hk_body_fat_before_diet' => [
			'field' => 'field_data_field_body_fat_before_diet.field_body_fat_before_diet_value',
			'change' => function($field){
				return str_replace('%', '', $field);
			}
		],
		'hk_body_fat_after_diet' => [
			'field' => 'field_data_field_body_fat_after_diet.field_body_fat_after_diet_value',
			'change' => function($field){
				return str_replace('%', '', $field);
			}
		],
		'hk_how_did_you_overcome' => [
			'field' => 'field_data_field_how_did_you_overcome_these.field_how_did_you_overcome_these_value'
		],
		'custom_permalink' => [
			'field' => 	'url_alias.alias'
		],
		'hk_node_id' => [
			'field' => 	'node.nid'
		]
	],
	'user' => [
		'user_email' => [
			'field' => 'user.mail',
		],
		'role' => [
			'field' => 'user.role',
			'change' => function($field) use ($user_roles){
				return $user_roles[$field];
			}
		],
		'display_name' => [
			'field' => 'realname.realname',
		],
		'first_name' => [
			'field' => 'realname.realname',
			'change' => function($field){
				$name_parts = explode(' ', $field);
				$firstname =  $name_parts[0];
				if(strstr($firstname, ".") && isset($name_parts[1])){
					$firstname .= ' '.$name_parts[1];
				}
				return $firstname;
			}
		],
		'last_name' => [
			'field' => 'realname.realname',
			'change' => function($field){
				$name_parts = explode(' ', $field);
				$lastname = count($name_parts) > 1 ? end($name_parts) : '';
				return $lastname;
			}
		],
		'description' => [
			'field' => 'field_data_field_about.field_about_value',
		],
		'user_registered' => [
			'field' => 'user.created',
			'change' => function($field){
				return date('Y-m-d H:i:s', $field );
			}
		],
		'user_login' => [
			'field' => 'user.mail',
			'change' => function($field){
				return explode("@", $field)[0];
			}
		],
	]
];

function fetch_user($email){
	global $field_mapping;
	$mydb = new wpdb('root','root','fitness_freak','localhost');
	if($email){
		$where = " WHERE u.mail = '".$email."'";
	}
	$user = $mydb->get_row("SELECT u.uid,u.mail,u.created,l.name as role FROM users_roles as r right join users as u on u.uid=r.uid left join role as l on r.rid=l.rid".$where);
	if($user){
		$realname = $mydb->get_row("select * from realname where uid='".$user->uid."'");
		$field_data_field_about = $mydb->get_row("select * from field_data_field_about where entity_type='user' and entity_id='".$user->uid."'");

		$user_data = ['role' => 'editor'];
		foreach ($field_mapping['user'] as $user_field => $field_data) {
			$params = explode(".", $field_data['field']);
			if(isset(${$params[0]}->{$params[1]})){
				if(isset($field_data['change']) && is_callable($field_data['change'])){
					$value = $field_data['change'](${$params[0]}->{$params[1]});
				}
				else{
					$value = ${$params[0]}->{$params[1]};
				}
				$user_data[$user_field] = $value;
			}
		}
		$user_id = wp_insert_user($user_data);
		return $user_id;
	}
	else {
		return false;
	}
}


function fetch_image($fid, $alt, $title){
	global $wpdb;
	$post_meta = $wpdb->get_row("SELECT *  FROM wp_postmeta WHERE meta_key = 'hk_file_id' and meta_value = '".$fid."'");
	if(!$post_meta){
		return false;
	}
	$attach_id = $post_meta->post_id;
	if($alt){
		update_post_meta($attach_id, '_wp_attachment_image_alt', $alt);
	}
	if($title){
		$image_post = array(
			'ID'		 => $attach_id,			
			'post_title' => $title,		
		);
		wp_update_post( $image_post );
	}
	return $attach_id;
}

function get_data($url) {
	$userAgent = "Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.2.12) Gecko/20101026 Firefox/3.6.12";

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_USERAGENT, $userAgent);
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_FAILONERROR, true);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($ch, CURLOPT_TIMEOUT,0);
	curl_setopt($ch, CURLOPT_AUTOREFERER, true);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
	curl_setopt($ch, CURLOPT_TIMEOUT, 10);
	$html = curl_exec($ch);
	if (!$html) {
	    echo "<br />cURL error number:" .curl_errno($ch);
	    echo "<br />cURL error:" . curl_error($ch);
	    return false;
	}
	else{
	    return $html;
	}
}

function get_video($url){
	return '<!-- wp:core-embed/youtube {"url":"'.$url.'","type":"video","providerNameSlug":"youtube","className":"wp-embed-aspect-16-9 wp-has-aspect-ratio"} -->
<figure class="wp-block-embed-youtube wp-block-embed is-type-video is-provider-youtube wp-embed-aspect-16-9 wp-has-aspect-ratio"><div class="wp-block-embed__wrapper">
'.$url.'
</div></figure>
<!-- /wp:core-embed/youtube -->';
}