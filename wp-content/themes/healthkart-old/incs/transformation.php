<?php
// Our custom post type function
function transformation_post_type() {
 
    register_post_type( 'transformation',
    // CPT Options
        array(
            'labels' => array(
                'name' => __( 'Transformations' ),
                'singular_name' => __( 'Transformation' )
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'transformation'),
            'show_in_rest' => true,
 
        )
    );
}
// Hooking up our function to theme setup
add_action( 'init', 'transformation_post_type' );