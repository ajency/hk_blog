<?php

add_action( 'cmb2_init', 'hk_post_cpt__metabox' );
function hk_post_cpt__metabox() {
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

add_action( 'show_user_profile', 'extra_user_profile_fields' );
add_action( 'edit_user_profile', 'extra_user_profile_fields' );
function extra_user_profile_fields( $user ) { 
    ?>
    <h3><?php _e("Extra profile information", "blank"); ?></h3>
    <table class="form-table">
    <tr>
        <th><label for="hk_designation"><?php _e("Designation"); ?></label></th>
        <td>
            <input type="text" name="hk_designation" id="hk_designation" value="<?php echo esc_attr( get_the_author_meta( 'hk_designation', $user->ID) ); ?>" class="regular-text" /><br />
        </td>
    </tr>
    </table>
<?php }

add_action( 'personal_options_update', 'save_extra_user_profile_fields' );
add_action( 'edit_user_profile_update', 'save_extra_user_profile_fields' );
function save_extra_user_profile_fields( $user_id ) {
    if ( !current_user_can( 'edit_user', $user_id ) ) { 
        return false; 
    }
    update_user_meta( $user_id, 'hk_designation', $_POST['hk_designation'] );
}