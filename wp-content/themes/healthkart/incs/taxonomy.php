<?php

add_action( 'init', 'hk_taxonomy', 0 );
function hk_taxonomy()  {
    $post_types = [
        //'ama' => ['singular' => 'Ask Me Anything','plural' => 'Ask Me Anything'], 
        'infographic' => ['singular' => 'Infographic','plural' => 'Infographics'], 
        'transformation' => ['singular' => 'Transformation','plural' => 'Transformations'], 
        'video' => ['singular' => 'Video','plural' => 'Videos'], 
    ];
    $taxonomies = [
        /*'ama' => [
            'tag' => ['singular' => 'Tag','plural' => 'Tags'], 
        ],*/
        'infographic' => [
            'tag' => ['singular' => 'Tag','plural' => 'Tags'], 
        ],
        'transformation' => [
            'tag' => ['singular' => 'Tag','plural' => 'Tags'], 
        ],
        'video' => [
            'category' => ['singular' => 'Category','plural' => 'Categories', 'slug' => 'videos'], 
            'tag' => ['singular' => 'Tag','plural' => 'Tags'], 
        ],
    ];
    add_theme_support('post-thumbnails');
    add_post_type_support( 'infographic', 'thumbnail' );  
    foreach ($post_types as $post_type => $name) {
        register_post_type( $post_type,
            array(
                'labels' => array(
                    'name' => $name['plural'],
                    'singular_name' => $name['singular']
                ),
                'public' => true,
                'has_archive' => true,
                'rewrite' => array('slug' => $post_type),
                'show_in_rest' => true,
                'menu_position' => 5,
                'supports' => array('title',
  'thumbnail',
  'comments',
  'editor')
            )
        );
    }


    foreach ($post_types as $post_type => $post_name) {
        foreach ($taxonomies as $post_type => $taxonomy_data) {
            foreach ($taxonomy_data as $taxonomy => $name) {
                $labels = array(
                    'name'                       => $name['plural'],
                    'singular_name'              => $name['singular'],
                    'menu_name'                  => $name['plural'],
                    'all_items'                  => 'All '.$name['plural'],
                    'parent_item'                => 'Parent '. $name['singular'],
                    'parent_item_colon'          => 'Parent '. $name['singular'].':',
                    'new_item_name'              => 'New '. $name['singular'],
                    'add_new_item'               => 'Add '.$name['singular'],
                    'edit_item'                  => 'Edit '.$name['singular'],
                    'update_item'                => 'Update '.$name['singular'],
                    'separate_items_with_commas' => 'Separate '.$name['plural'].' with commas',
                    'search_items'               => 'Search '.$name['plural'],
                    'add_or_remove_items'        => 'Add or remove '.$name['plural'],
                    'choose_from_most_used'      => 'Choose from the most used '.$name['plural'],
                );
                $slug = isset($name['slug']) ? $name['slug'] : $post_type.'-'.$taxonomy;
                $args = array(
                    'labels'                     => $labels,
                    'hierarchical'               => true,
                    'rewrite'                    => array( 'slug' => $slug ),
                    'public'                     => true,
                    'show_ui'                    => true,
                    'show_admin_column'          => true,
                    'show_in_nav_menus'          => true,
                    'show_tagcloud'              => true,
                    'show_in_rest'               => true,
                );
                register_taxonomy( $post_type.'_'.$taxonomy, $post_type, $args );
            }
        }
    }

    $labels = array(
        'name'                       => 'Secondary Tag',
        'singular_name'              => 'Secondary Tag',
        'menu_name'                  => 'Secondary Tags',
        'all_items'                  => 'All Secondary Tags',
        'parent_item'                => 'Parent Secondary Tag',
        'parent_item_colon'          => 'Parent Secondary Tag:',
        'new_item_name'              => 'New Secondary Tag',
        'add_new_item'               => 'Add Secondary Tag',
        'edit_item'                  => 'Edit Secondary Tag',
        'update_item'                => 'Update Secondary Tag',
        'separate_items_with_commas' => 'Separate Secondary Tags with commas',
        'search_items'               => 'Search Secondary Tags',
        'add_or_remove_items'        => 'Add or remove Secondary Tags',
        'choose_from_most_used'      => 'Choose from the most used Secondary Tags',
    );
    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'rewrite'                    => array( 'slug' => 'secondary_tag' ),
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
        'show_in_rest'               => true,
    );
    register_taxonomy( 'secondary_tag', 'post', $args );
}