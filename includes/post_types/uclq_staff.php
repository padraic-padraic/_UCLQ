<?php


function uclq_staff_type() {
    $labels = array(
        'name'                  => _x( 'Staff', 'Post Type General Name', 'text_domain' ),
        'singular_name'         => _x( 'Staff', 'Post Type Singular Name', 'text_domain' ),
        'menu_name'             => __( 'Staff', 'text_domain' ),
        'name_admin_bar'        => __( 'Staff', 'text_domain' ),
        'archives'              => __( 'Staff Archives', 'text_domain' ),
        'attributes'            => __( 'Staff Attributes', 'text_domain' ),
        'parent_item_colon'     => __( 'Staff Parent', 'text_domain' ),
        'all_items'             => __( 'All Staff', 'text_domain' ),
        'add_new_item'          => __( 'Add New Staff Member', 'text_domain' ),
        'add_new'               => __( 'Add New', 'text_domain' ),
        'new_item'              => __( 'New Staff', 'text_domain' ),
        'edit_item'             => __( 'Edit Staff', 'text_domain' ),
        'update_item'           => __( 'Update Staff', 'text_domain' ),
        'view_item'             => __( 'View Staff', 'text_domain' ),
        'view_items'            => __( 'View Staff', 'text_domain' ),
        'search_items'          => __( 'Search Staff', 'text_domain' ),
        'not_found'             => __( 'Not found', 'text_domain' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
        'featured_image'        => __( 'Photo', 'text_domain' ),
        'set_featured_image'    => __( 'Set Photo', 'text_domain' ),
        'remove_featured_image' => __( 'Remove Photo', 'text_domain' ),
        'use_featured_image'    => __( 'Use as Photo', 'text_domain' ),
        'insert_into_item'      => __( 'Insert into Staff Member', 'text_domain' ),
        'uploaded_to_this_item' => __( 'Uploaded to this Staff Member', 'text_domain' ),
        'items_list'            => __( 'Staff list', 'text_domain' ),
        'items_list_navigation' => __( 'Staff list navigation', 'text_domain' ),
        'filter_items_list'     => __( 'Filter Staff list', 'text_domain' ),
    );
    $rewrite = array(
        'slug'                  => 'staff',
        'with_front'            => true,
        'pages'                 => false,
        'feeds'                 => false,
    );
    $args = array(
        'label'                 => __( 'Staff', 'text_domain' ),
        'description'           => __( 'A UCLQ Staff Member', 'text_domain' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'thumbnail', ),
        'taxonomies'            => array('job_title'),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 7,
        'menu_icon'             => 'dashicons-businessman',
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
    register_post_type( 'uclq_staff', $args );
}

// function student_columns( $cols ){
//     $cols = array(
//             'cb'       => '<input type="checkbox" />',
//             'title'    => __('Name', 'student_type'),
//             'cohort'   => __('Cohort', 'student_type'),
//             'programme' => __('Programme', 'student_type'),
//             'graduated' => __('Graduated', 'student_type')
//     );
//     return $cols;
// }

// function display_student_columns($column, $post_id){
//     switch ($column) {
//         case 'title':
//             echo get_post_title($post_id);
//             break;
//         case 'cohort':
//             $terms = get_the_terms($post_id, 'cohort');
//             $s = '';
//             foreach ($terms as $term){
//                 $s = $s .$term->name.', ';
//             }
//             $s = rtrim($s, ', ');
//             echo $s;
//             break;
//         case 'programme':
//             echo get_post_meta($post_id, 'programme', true);
//             break;
//         case 'graduated':
//             $graduated = get_post_meta($post_id, 'graduated', true);
//             if ($graduated === True){
//                 echo 'Yes';
//             }
//             else {
//                 echo 'No';
//             }
//             break;
//     }
// }

// function sortable_student_columns(){
//     return array(
//         'title' => 'title',
//         'cohort' => 'cohort',
//     );
// }

function staff_register_job_taxonomy()
{
    $labels = [
        'name' => _x('Job Titles', 'taxonomy general name', 'staff_role'),
        'singular_name' => _x('Job Title', 'taxonomy singular name', 'staff_role'),
        'search_items' => __('Search Job Titles'),
        'all_items' => __('All Job Titles'),
        'edit_item' => __('Edit Job Title'),
        'update_item' => __('Update Job Title'),
        'add_new_item' => __('Add New Job Title'),
        'new_item_name' => __('New Job Title'),
        'menu_name' => __('Job Titles')
    ];
    $args = [
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => ['slug' => 'cohort'],
        'sort' => true,
    ];
    register_taxonomy('job_title', ['uclq_staff'], $args);
}

function add_staff_meta(){
    add_meta_box('staff_meta', 'Details', 'staff_details_meta_box', 'uclq_staff', 'normal', 'high');
    add_meta_box('staff_research_meta', 'Project', 'staff_research_meta_box', 'uclq_staff', 'normal','low');
}

function staff_details_meta_box($post) {
    $post_office = get_post_meta($post->ID, 'office', true);
    echo '<input type="hidden" name="uclq_staff_noncename" value="' . wp_create_nonce( wp_basename(__FILE__) ) . '" />';
    /*TODO: Computationally determine if they have a project yet, and grey out the form accordingly*/
    meta_style();
    ?>
    <div class="form-row">
        <label for="uclq_staff_office">Office</label>
        <input type="text" name="uclq_staff_office" value="<?php echo $post_office;?>">
    </div>
    <?php
}

function staff_research_meta_box($post){
    echo '<input type="hidden" name="uclq_student_noncename" value="' . wp_create_nonce( wp_basename(__FILE__) ) . '" />';
    $student_research_title = get_post_meta($post->ID, 'research_title', true);
    $student_research_description = get_post_meta($post->ID, 'research_description', true);   
    $student_supervisor = get_post_meta($post->ID, 'group', true);
    ?>
    <div class="form-row">
      <label for="uclq_research_title">Project Title:</label>
      <input type="text" name="uclq_research_title" value="<?php echo $student_research_title; ?>">
    </div>
    <div class="form-row">
      <label for="uclq_group">Research Group:</label>
      <input type="text" name="uclq_supervisor" value="<?php echo $student_supervisor; ?>">
    </div>
    <div class="form-row">
      <label for="uclq_research_desc">Project Description:</label><br>
      <textarea cols="90" rows ="20" name="uclq_research_desc">
      <?php echo $student_research_description; ?>
      </textarea>
    </div>
    <?php
}

function save_uclq_staff_meta( $post_id ) { 
    if ( ! isset( $_POST['uclq_staff_noncename'] ) ) { // Check if our nonce is set.
        return;
    }
    // verify this came from the our screen and with proper authorization,
    // because save_post can be triggered at other times
    if( !wp_verify_nonce( $_POST['uclq_staff_noncename'], wp_basename(__FILE__) ) ) {
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
    $new_job = $_POST['uclq_job'];
    $uclq_staff_meta['group'] = sanitize_text_field($_POST['uclq_group']);
    $uclq_staff_meta['research_title'] = sanitize_text_field($_POST['uclq_research_title']);
    $uclq_staff_meta['research_description'] = sanitize_textarea_field($_POST['uclq_research_desc']);
    foreach( $uclq_staff_meta as $key => $value ) { // cycle through the $uclq_student_meta array
        if ($value){
            update_post_meta($post_id, $key, $value);
        }
    }
    $jobs = get_terms(array('taxonomy'=>'job_title', 'hide_empty'=>false));
    foreach($jobs as $job){
        if($job->name == $new_job){
            wp_set_object_terms($post_id, $cohort->term_id,'cohort',false);
        }
    }
}
add_action( 'save_post', 'save_uclq_staff_meta');

// add_action('init', 'student_register_cohort_taxonomy');
// add_action('init', 'student_register_programme_taxonomy');
add_action('init', 'staff_register_job_taxonomy');
add_action( 'init', 'uclq_staff_type', 0 );
// add_filter('manage_uclq_student_posts_columns', 'student_columns');
// add_filter('manage_uclq_student_posts_custom_column', 'display_student_columns', 10, 2);
// add_filter('manage_uclq_student_sortable_columns', 'sortable_student_columns');
add_action('add_meta_boxes', 'add_staff_meta');   
?>