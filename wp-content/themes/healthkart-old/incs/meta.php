<?php

add_action( 'cmb2_init', 'tmc_post_cpt__metabox' );
function tmc_post_cpt__metabox() {
    $prefix = 'hk_';
    //post meta
    $cmb_term = new_cmb2_box( array(
        'id'                => $prefix . 'metabox',
        'title'             => 'Meta Fields',
        'object_types'      => array( 'post' ),
    ) );
    $cmb_term->add_field( array(
        'name'    => 'Description',
        'id'      =>  'hk_description',
        'type'    => 'textarea_small',
    ) );
    $cmb_term->add_field( array(
        'name'    => 'Views',
        'id'      => 'hk_views',
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
        'object_types'      => array( 'transformation' ),
    ) );
    $cmb_term->add_field( array(
        'name'             => 'How did you overcome',
        'id'               => 'hk_how_did_you_overcome',
        'type'    => 'textarea',
    ) );
    $cmb_term->add_field( array(
        'name'             => 'Accomplish Goal',
        'id'               => 'hk_accomplish_goal',
        'type'    => 'textarea',
    ) );
    $cmb_term = new_cmb2_box( array(
        'id'                => $prefix . 'age_metabox',
        'title'             => 'Age',
        'object_types'      => array( 'transformation' ),
    ) );
    $cmb_term->add_field( array(
        'name' => 'Before',
        'id'   => 'hk_age_before_diet',
        'type' => 'text',
        'attributes' => array(
            'type' => 'number',
            'pattern' => '\d*',
    )));
    $cmb_term->add_field( array(
        'name' => 'After',
        'id'   => 'hk_age_after_diet',
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
        'id'   => 'hk_body_fat_before_diet',
        'type' => 'text',
        'attributes' => array(
            'type' => 'number',
            'pattern' => '\d*',
    )));
    $cmb_term->add_field( array(
        'name' => 'After',
        'id'   => 'hk_body_fat_after_diet',
        'type' => 'text',
        'attributes' => array(
            'type' => 'number',
            'pattern' => '\d*',
    )));
}