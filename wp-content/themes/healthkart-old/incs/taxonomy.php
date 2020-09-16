<?php

add_action( 'init', 'hk_taxonomy', 0 );
function hk_taxonomy()  {
    $labels = array(
        'name'                       => 'Category',
        'singular_name'              => 'Category',
        'menu_name'                  => 'Categories',
        'all_items'                  => 'All Categories',
        'parent_item'                => 'Parent Category',
        'parent_item_colon'          => 'Parent Category:',
        'new_item_name'              => 'New Category',
        'add_new_item'               => 'Add Category',
        'edit_item'                  => 'Edit Category',
        'update_item'                => 'Update Category',
        'separate_items_with_commas' => 'Separate Categories with commas',
        'search_items'               => 'Search Categories',
        'add_or_remove_items'        => 'Add or remove Categories',
        'choose_from_most_used'      => 'Choose from the most used Categories',
    );
    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'rewrite'                    => array( 'slug' => 'transformation_category' ),
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
        'show_in_rest'               => true,
    );
    register_taxonomy( 'transformation_category', 'transformation', $args );

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