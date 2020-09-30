<?php

add_action( 'cmb2_init', 'hk_post_cpt__metabox' );
function hk_post_cpt__metabox() {
    $prefix = 'hk_';
    //post meta 
    $cmb_term = new_cmb2_box( array(
        'id'                => $prefix . 'common_metabox',
        'title'             => 'Common Fields',
        'object_types'      => array( 'post', 'video', 'transformation', 'ama', 'infographic' ),
    ) );
    $cmb_term->add_field( array(
        'name' => 'Featured Article',
        'id'   => $prefix . 'featured_post',
        'type' => 'checkbox',
    ) );
    $cmb_term->add_field( array(
        'name' => 'Minutes Read',
        'id'   => $prefix . 'mins_read',
        'type' => 'text',
        'attributes' => array(
            'type' => 'number',
            'pattern' => '\d*',
    )));
    $cmb_term = new_cmb2_box( array(
        'id'                => $prefix . 'metabox',
        'title'             => 'Article Fields',
        'object_types'      => array( 'post' ),
    ) );
    $cmb_term->add_field( array(
        'name'    => 'Description',
        'id'      =>  $prefix . 'description',
        'type'    => 'textarea_small',
    ) );
    $cmb_term->add_field( array(
        'name' => 'Banner Article',
        'id'   => $prefix . 'featured_banner_post',
        'type' => 'checkbox',
    ) );
    $cmb_term->add_field( array(
        'name' => 'More Article Section',
        'id'   => $prefix . 'more_post',
        'type' => 'checkbox',
    ) );
    $cmb_term = new_cmb2_box( array(
        'id'                => $prefix . 'ama_video',
        'title'             => 'Live AMA',
        'object_types'      => array( 'ama' ),
    ) );
    $cmb_term->add_field( array(
        'name'    => 'Video',
        'id'      =>  $prefix . 'ama_video',
        'type'    => 'text',
    ) );
    $cmb_term = new_cmb2_box( array(
        'id'                => $prefix . 'statistics',
        'title'             => 'Statistics',
        'object_types'      => array( 'post' ),
    ) );
   
    $cmb_term->add_field( array(
        'name'    => 'Views',
        'id'      => $prefix . 'views',
        'type'    => 'text',
        'save_field' => false,
   		'attributes' => array(
            'type' => 'number',
            'pattern' => '\d*',
            'disabled' => 'disabled',
			'readonly' => 'readonly',
    )));
    //transformation meta
    $cmb_term = new_cmb2_box( array(
        'id'                => $prefix . 'transformation_metabox',
        'title'             => 'Transformation Fields',
        'object_types'      => array( 'transformation' ),
    ) );
    $cmb_term->add_field( array(
        'name'             => 'How did you overcome',
        'id'               => $prefix . 'how_did_you_overcome',
        'type'    => 'textarea',
    ) );
    $cmb_term->add_field( array(
        'name'             => 'Accomplish Goal',
        'id'               => $prefix . 'accomplish_goal',
        'type'    => 'textarea',
    ) );
    $cmb_term->add_field( array(
        'name'             => 'Transform Reason',
        'id'               => $prefix . 'transform_reason',
        'type'    => 'textarea',
    ) );
    $cmb_term->add_field( array(
        'name'             => 'Training Routine',
        'id'               => $prefix . 'training_routine',
        'type'    => 'wysiwyg',
    ) );
        $cmb_term->add_field( array(
        'name'             => 'Future Suggestion',
        'id'               => $prefix . 'future_suggestion',
        'type'    => 'textarea',
    ) );
    $cmb_term->add_field( array(
        'name'             => 'Supplements',
        'id'               => $prefix . 'supplements_that_helped',
        'type'    => 'textarea',
    ) );
    $cmb_term = new_cmb2_box( array(
        'id'                => $prefix . 'age_metabox',
        'title'             => 'Age',
        'object_types'      => array( 'transformation' ),
    ) );
    $cmb_term->add_field( array(
        'name' => 'Before',
        'id'   => $prefix . 'age_before_diet',
        'type' => 'text',
        'attributes' => array(
            'type' => 'number',
            'pattern' => '\d*',
    )));
    $cmb_term->add_field( array(
        'name' => 'After',
        'id'   => $prefix . 'age_after_diet',
        'type' => 'text',
        'attributes' => array(
            'type' => 'number',
            'pattern' => '\d*',
    )));
    $cmb_term = new_cmb2_box( array(
        'id'                => $prefix . 'bodyfat_metabox',
        'title'             => 'Body Fat',
        'object_types'      => array( 'transformation' ),
    ) );
    $cmb_term->add_field( array(
        'name' => 'Before',
        'id'   => $prefix . 'body_fat_before_diet',
        'type' => 'text',
        'attributes' => array(
            'type' => 'number',
            'pattern' => '\d*',
    )));
    $cmb_term->add_field( array(
        'name' => 'After',
        'id'   => $prefix . 'body_fat_after_diet',
        'type' => 'text',
        'attributes' => array(
            'type' => 'number',
            'pattern' => '\d*',
    )));
    $cmb_term = new_cmb2_box( array(
        'id'                => $prefix . 'weight_metabox',
        'title'             => 'Weight',
        'object_types'      => array( 'transformation' ),
    ) );
    $cmb_term->add_field( array(
        'name' => 'Before',
        'id'   => $prefix . 'weight_before_diet',
        'type' => 'text',
        'attributes' => array(
            'type' => 'number',
            'pattern' => '\d*',
    )));
    $cmb_term->add_field( array(
        'name' => 'After',
        'id'   => $prefix . 'weight_after_diet',
        'type' => 'text',
        'attributes' => array(
            'type' => 'number',
            'pattern' => '\d*',
    )));
    $cmb_term = new_cmb2_box( array(
        'id'                => $prefix . 'image_metabox',
        'title'             => 'Image',
        'object_types'      => array( 'transformation' ),
    ) );
    $cmb_term->add_field( array(
        'name' => esc_html__( 'Before', 'cmb2' ),
        'desc' => esc_html__( 'Upload an image or enter a URL.', 'cmb2' ),
        'id'   => $prefix . 'image_before_diet',
        'type' => 'file',
    ) );
    $cmb_term->add_field( array(
        'name' => esc_html__( 'After', 'cmb2' ),
        'desc' => esc_html__( 'Upload an image or enter a URL.', 'cmb2' ),
        'id'   => $prefix . 'image_after_diet',
        'type' => 'file',
    ) );
    $cmb_term = new_cmb2_box( array(
        'id'               => $prefix . 'edit',
        'title'            => esc_html__( 'Category Metabox', 'cmb2' ), // Doesn't output for term boxes
        'object_types'     => array( 'term' ), // Tells CMB2 to use term_meta vs post_meta
        'taxonomies'       => array( 'category' ), // Tells CMB2 which taxonomies should have these fields
        // 'new_term_section' => true, // Will display in the "Add New Category" section
    ) );
    $cmb_term->add_field( array(
        'name'     => esc_html__( 'Featured Category', 'cmb2' ),
        'id'       => $prefix . 'featured_category',
        'type'     => 'checkbox',
        'on_front' => false,
    ) );

    $cmb_term->add_field( array(
        'name' => esc_html__( 'Featured Image', 'cmb2' ),
        'id'   => $prefix . 'featured_image',
        'type' => 'file',
    ) );
}
