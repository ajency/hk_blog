<?php

/*
* Template Name: Import Users
* The template for migrating data
*/
require_once("../../../wp-load.php");
require_once( '../../../wp-admin/includes/post.php' );
require_once(__DIR__."/config/field_mapping.php");
//header("Content-Type: text/plain");

$mydb = new wpdb('root','root','fitness_freak','localhost');
$users = $mydb->get_results("SELECT u.uid,u.mail,u.created,l.name as role FROM users_roles as r inner join users as u on u.uid=r.uid inner join role as l on r.rid=l.rid");
foreach ($users as $user) {
	$realname = $mydb->get_row("select * from realname where uid='".$user->uid."'");
	$field_data_field_about = $mydb->get_row("select * from field_data_field_about where entity_type='user' and entity_id='".$user->uid."'");

	$user_data = [];
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
	echo 'ID: '.$user->uid.", User ID: ".json_encode($user_id).", Data: ".json_encode($user_data)."<hr>";
}