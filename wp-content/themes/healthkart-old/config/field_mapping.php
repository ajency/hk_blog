<?php
$post_types = [
	'ama' => 'ama',
	'articles' => 'post',
	'blog' => 'post',
	'infographics' => 'post',
	'page' => 'page',
	'recipes' => 'post',
	'transformation_stories' => 'transformation',
];
$taxonomy = [
	'primary_tags' => 'category',
	'secondary_tags' => 'secondary_tag',
	'tags' => 'post_tag',
	'transformation_stories_category' => 'transformation_category',
];
$field_mapping = [
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
		'hk_age_after_diet' => [
			'field' => 'field_data_field_age_after_diet.field_age_after_diet_value'
		],
		'hk_age_before_diet' => [
			'field' => 'field_data_field_age_before_diet.field_age_before_diet_value'
		],
		'hk_body_fat_before_diet' => [
			'field' => 'field_data_field_body_fat_before_diet.field_age_before_diet_value'
		],
		'hk_body_fat_after_diet' => [
			'field' => 'field_data_field_body_fat_after_diet.field_data_field_body_fat_after_diet'
		],
		'hk_how_did_you_overcome' => [
			'field' => 'field_data_field_how_did_you_overcome_these.field_how_did_you_overcome_these_value'
		]
	]
];