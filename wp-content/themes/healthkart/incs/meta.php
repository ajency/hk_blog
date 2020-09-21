<?php

add_action( 'cmb2_init', 'tmc_post_cpt__metabox' );
function tmc_post_cpt__metabox() {
    $prefix = 'hk_';
    //post meta
    $cmb_term = new_cmb2_box( array(
        'id'                => $prefix . 'metabox',
        'title'             => 'Meta Fields',
        'object_types'      => array( 'post' ),
        'show_on_cb' => function($cmb){
            $response = false;
            $terms = wp_get_post_terms( $cmb->object_id, 'hk_type' );
            if($terms) {
                $response = ($terms[0]->slug != 'transformation');
            }
            return $response;
        },
    ) );
    $cmb_term->add_field( array(
        'name'    => 'Description',
        'id'      =>  $prefix . 'description',
        'type'    => 'textarea_small',
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
        'title'             => 'Meta Fields',
        'object_types'      => array( 'post' ),
        'show_on_cb' => function($cmb){
            $response = false;
            $terms = wp_get_post_terms( $cmb->object_id, 'hk_type' );
            if($terms) {
                $response = ($terms[0]->slug == 'transformation');
            }
            return $response;
        },
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
        'object_types'      => array( 'post' ),
        'show_on_cb' => function($cmb){
            $response = false;
            $terms = wp_get_post_terms( $cmb->object_id, 'hk_type' );
            if($terms) {
                $response = ($terms[0]->slug == 'transformation');
            }
            return $response;
        },
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
        'object_types'      => array( 'post' ),
        'show_on_cb' => function($cmb){
            $response = false;
            $terms = wp_get_post_terms( $cmb->object_id, 'hk_type' );
            if($terms) {
                $response = ($terms[0]->slug == 'transformation');
            }
            return $response;
        },
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
        'object_types'      => array( 'post' ),
        'show_on_cb' => function($cmb){
            $response = false;
            $terms = wp_get_post_terms( $cmb->object_id, 'hk_type' );
            if($terms) {
                $response = ($terms[0]->slug == 'transformation');
            }
            return $response;
        },
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
        'object_types'      => array( 'post' ),
        'show_on_cb' => function($cmb){
            $response = false;
            $terms = wp_get_post_terms( $cmb->object_id, 'hk_type' );
            if($terms) {
                $response = ($terms[0]->slug == 'transformation');
            }
            return $response;
        },
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
}