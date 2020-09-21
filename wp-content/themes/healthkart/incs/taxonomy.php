<?php

add_action( 'init', 'hk_taxonomy', 0 );
function hk_taxonomy()  {

    $labels = array(
        'name'                       => 'Type',
        'singular_name'              => 'Type',
        'menu_name'                  => 'Types',
        'all_items'                  => 'All Types',
        'parent_item'                => 'Parent Type',
        'parent_item_colon'          => 'Parent Type:',
        'new_item_name'              => 'New Type',
        'add_new_item'               => 'Add Type',
        'edit_item'                  => 'Edit Type',
        'update_item'                => 'Update Type',
        'separate_items_with_commas' => 'Separate Types with commas',
        'search_items'               => 'Search Types',
        'add_or_remove_items'        => 'Add or remove Types',
        'choose_from_most_used'      => 'Choose from the most used Types',
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
    register_taxonomy( 'hk_type', 'post', $args );

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