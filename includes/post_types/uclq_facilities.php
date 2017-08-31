<?php

function uclq_facility_type() {
    $labels = array(
        'name'                  => _x( 'Facility', 'Post Type General Name', 'text_domain' ),
        'singular_name'         => _x( 'Facility', 'Post Type Singular Name', 'text_domain' ),
        'menu_name'             => __( 'Facility', 'text_domain' ),
        'name_admin_bar'        => __( 'Facility', 'text_domain' ),
        'archives'              => __( 'Facility Archives', 'text_domain' ),
        'attributes'            => __( 'Facility Attributes', 'text_domain' ),
        'parent_item_colon'     => __( 'Facility Parent', 'text_domain' ),
        'all_items'             => __( 'All Facility', 'text_domain' ),
        'add_new_item'          => __( 'Add New Facility Member', 'text_domain' ),
        'add_new'               => __( 'Add New', 'text_domain' ),
        'new_item'              => __( 'New Facility', 'text_domain' ),
        'edit_item'             => __( 'Edit Facility', 'text_domain' ),
        'update_item'           => __( 'Update Facility', 'text_domain' ),
        'view_item'             => __( 'View Facility', 'text_domain' ),
        'view_items'            => __( 'View Facilities', 'text_domain' ),
        'search_items'          => __( 'Search Facilities', 'text_domain' ),
        'not_found'             => __( 'Not found', 'text_domain' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
        'featured_image'        => __( 'Photo', 'text_domain' ),
        'set_featured_image'    => __( 'Set Photo', 'text_domain' ),
        'remove_featured_image' => __( 'Remove Photo', 'text_domain' ),
        'use_featured_image'    => __( 'Use as Photo', 'text_domain' ),
        'insert_into_item'      => __( 'Insert into Facility', 'text_domain' ),
        'uploaded_to_this_item' => __( 'Uploaded to this Facility', 'text_domain' ),
        'items_list'            => __( 'Facility list', 'text_domain' ),
        'items_list_navigation' => __( 'Facility list navigation', 'text_domain' ),
        'filter_items_list'     => __( 'Filter Facility list', 'text_domain' ),
    );
    $rewrite = array(
        'slug'                  => 'facility',
        'with_front'            => true,
        'pages'                 => false,
        'feeds'                 => false,
    );
    $args = array(
        'label'                 => __( 'Facilities', 'text_domain' ),
        'description'           => __( 'A UCLQ Facility', 'text_domain' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'thumbnail', ),
        'taxonomies'            => array('job_title'),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 8,
        'menu_icon'             => 'dashicons-feedback',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'rewrite'               => $rewrite,
        'capability_type'       => 'page',
        'show_in_rest'          => true,
    );
    register_post_type( 'uclq_facility', $args );
}

function register_uclq_facility_taxonomy(){
    $labels = [
        'name' => _x('Facility Type', 'taxonomy general name', 'research_type'),
        'singular_name' => _x('Facility Type', 'taxonomy singular name', 'research_type'),
        'search_items' => __('Search Facility Types'),
        'all_items' => __('All Facility Types'),
        'edit_item' => __('Edit Facility Type'),
        'update_item' => __('Update Facility Type'),
        'add_new_item' => __('Add New Facility Type'),
        'new_item_name' => __('New Facility Type'),
        'menu_name' => __('Facility Type')
    ];
    $args = [
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => ['slug' => 'research_type'],
        'sort' => true,
    ];
    register_taxonomy('facility_type', ['uclq_facility'], $args);
}

function facility_meta_box($post){
    echo '<input type="hidden" name="uclq_facility_noncename" value="' . wp_create_nonce( wp_basename(__FILE__) ) . '" />';
     meta_style();
     $facility_types = get_terms(array('taxonomy'=>'facility_type', 'hide_empty'=>0));
     $departments = get_terms(array('taxonomy'=>'department', 'hide_empty'=>0));
     $post_location = get_post_meta($post->ID, 'facility_location', true);
     $post_description = get_post_meta($post->ID, 'facility_description', true);
     $post_department = array_shift(wp_get_post_terms($post->ID, 'department'));
     $post_type = array_shift(wp_get_post_terms($post->ID, 'facility_type'));
     ?>
     <div class="form-row">
        <label for="uclq_location">Location:</label>
        <input type="text" name="uclq_location" value="<?php echo $post_location; ?>">
     </div>
     <div class="form-row">
        <label for="uclq_department">Department:</label>
        <select name="uclq_department">
        <?php
            foreach($departments as $department) {
                echo '<option value="'.$department->name.'"';
                if ($department->name == $post_department->name){
                    echo " selected";
                }
                echo '> '.$department->name.'</option>';
            } 
        ?>
        </select>
     </div>
     <div class="form-row">
        <label for="uclq_facility_type">Facility Type:</label>
        <select name="uclq_facility_type">
            <?php 
            foreach($facility_types as $facility_type){
                echo '<option value="'.$facility_type->name.'"';
                if ($facility_type->name == $post_type->name){
                    echo " selected";
                }
                echo '> '.$facility_type->name.'</option>';
            }
            ?>
        </select>
    </div>
    <div class="form-row">
        <label for="uclq_description">Description:</label><br>
        <textarea cols="90" rows="20" name="uclq_description">
<?php echo $facility_description;?>
        </textarea>
    </div>
    <?php
}

function do_facility_meta( $post_id ){
    add_meta_box('facility_meta', 'Details', 'facility_meta_box', 'uclq_facility', 'normal', 'low');
}

function save_uclq_facility_meta() {
    if ( ! isset( $_POST['uclq_facility_noncename'] ) ) { // Check if our nonce is set.
        return;
    }
    // verify this came from the our screen and with proper authorization,
    // because save_post can be triggered at other times
    if( !wp_verify_nonce( $_POST['uclq_student_noncename'], wp_basename(__FILE__) ) ) {
        return $post_id;
    } 
    // is the user allowed to edit the post or page?
    if( ! current_user_can( 'edit_post', $post_id )){
        return $post_id;
    }
    $thumbnail_id = $_POST['_thumbnail_id'];
    if (!empty($thumbnail_id)){
        set_post_thumbnail($post_id, $thumbnail_id);
    }
    $facility_meta['facility_location'] = sanitize_text_field($_POST['uclq_location']);
    $facility_meta['facility_description'] = sanitize_textarea_field($_POST['uclq_description']);
    $new_department = $_POST['uclq_department'];
    $new_facility_type = $_POST['uclq_facility_type'];
    foreach( $facility_meta as $key=>$value){
        if ($value){
            update_post_meta($post_id, $key, $value);
        }
    }
    $facility_types = get_terms(array('taxonomy'=>'facility_type', 'hide_empty'=>0));
    $departments = get_terms(array('taxonomy'=>'department', 'hide_empty'=>0));
    foreach($departments as $department){
        if($department->name == $new_department){
            wp_set_object_terms($post_id, $department->term_id, 'department', false);
        }
    }    
    foreach($facility_types as $facility_type){
        if($facility_type->name == $new_facility_type){
            wp_set_object_terms($post_id, $facility_type->term_id, 'facility_type', false);
        }
    }
}


add_action('init', 'uclq_facility_type', 0);
add_action('init', 'register_uclq_facility_taxonomy');
add_action('add_meta_boxes', 'do_facility_meta');
add_action('save_post', 'save_uclq_facility_meta');
?>