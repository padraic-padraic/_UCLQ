<?php
/* TODO: Cohort as a taxonomy? */
// function register_cohort_taxonomy(){
//     register_taxonomy(
//         'cohort', 'uclq_student')
// }

require(get_template_directory() . '/includes/post_types/uclq_meta_style.php');

function uclq_student_type() {
    $labels = array(
        'name'                  => _x( 'Students', 'Post Type General Name', 'text_domain' ),
        'singular_name'         => _x( 'Student', 'Post Type Singular Name', 'text_domain' ),
        'menu_name'             => __( 'Students', 'text_domain' ),
        'name_admin_bar'        => __( 'Students', 'text_domain' ),
        'archives'              => __( 'Student Archives', 'text_domain' ),
        'attributes'            => __( 'Student Attributes', 'text_domain' ),
        'parent_item_colon'     => __( 'Student Parent', 'text_domain' ),
        'all_items'             => __( 'All Students', 'text_domain' ),
        'add_new_item'          => __( 'Add New Student', 'text_domain' ),
        'add_new'               => __( 'Add New', 'text_domain' ),
        'new_item'              => __( 'New Student', 'text_domain' ),
        'edit_item'             => __( 'Edit Student', 'text_domain' ),
        'update_item'           => __( 'Update Student', 'text_domain' ),
        'view_item'             => __( 'View Student', 'text_domain' ),
        'view_items'            => __( 'View Students', 'text_domain' ),
        'search_items'          => __( 'Search Students', 'text_domain' ),
        'not_found'             => __( 'Not found', 'text_domain' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
        'featured_image'        => __( 'Photo', 'text_domain' ),
        'set_featured_image'    => __( 'Set Photo', 'text_domain' ),
        'remove_featured_image' => __( 'Remove Photo', 'text_domain' ),
        'use_featured_image'    => __( 'Use as Photo', 'text_domain' ),
        'insert_into_item'      => __( 'Insert into Student', 'text_domain' ),
        'uploaded_to_this_item' => __( 'Uploaded to this Student', 'text_domain' ),
        'items_list'            => __( 'Student list', 'text_domain' ),
        'items_list_navigation' => __( 'Student list navigation', 'text_domain' ),
        'filter_items_list'     => __( 'Filter Student list', 'text_domain' ),
    );
    $rewrite = array(
        'slug'                  => 'student',
        'with_front'            => true,
        'pages'                 => false,
        'feeds'                 => false,
    );
    $args = array(
        'label'                 => __( 'Student', 'text_domain' ),
        'description'           => __( 'A Student of the UCLQ CDT', 'text_domain' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'thumbnail', ),
        'taxonomies'            => array( 'post_tag' ),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-id',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => false,        
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'rewrite'               => $rewrite,
        'capability_type'       => 'page',
        'show_in_rest'          => true,
    );
    register_post_type( 'uclq_student', $args );
}

function student_columns( $cols ){
    $cols = array(
            'cb'       => '<input type="checkbox" />',
            'title'    => __('Name', 'student_type'),
            'cohort'   => __('Cohort', 'student_type'),
            'programme' => __('Programme', 'student_type'),
            'graduated' => __('Graduated', 'student_type')
    );
    return $cols;
}

function display_student_columns($column, $post_id){
    switch ($column) {
        case 'title':
            echo get_post_title($post_id);
            break;
        case 'cohort':
            echo get_post_meta($post_id, 'cohort', true);
            break;
        case 'programme':
            echo get_post_meta($post_id, 'programme', true);
            break;
        case 'graduated':
            $graduated = get_post_meta($post_id, 'graduated', true);
            if ($graduated === True){
                echo 'Yes';
            }
            else {
                echo 'No';
            }
            break;
    }
}

function sortable_student_columns(){
    return array(
        'title' => 'title',
        'cohort' => 'cohort',
    );
}

function add_student_meta(){
    add_meta_box('student_meta', 'Details', 'student_details_meta_box', 'uclq_student', 'normal');
}

function student_details_meta_box($post) {
    echo '<input type="hidden" name="uclq_student_noncename" value="' . wp_create_nonce( wp_basename(__FILE__) ) . '" />';
    $student_programme = get_post_meta($post->ID, 'programme', true);
    $student_graduated = get_post_meta($post->ID, 'graduated', true);
    $student_cohort = get_post_meta($post->ID, 'cohort', true);
    $student_research = get_post_meta($post->ID, 'research', true);    
    $student_supervisor = get_post_meta($post->ID, 'supervisor', true);
    /*TODO: Computationally determine if they have a project yet, and grey out the form accordingly*/
    $now = new DateTime("now");
    $then = new DateTime("2014-10-01");
    $diff = $now->diff($then);
    $years = $diff->y +1;
    meta_style();
    ?>
    <div class="form-row">
    <label for="uclq_programme">Programme Title:</label>
    <input type="text" name="uclq_programme" value="<?php echo $student_programme?>">
    </div>
    <div class="form-row">
    <label for="uclq_cohort">Cohort:</label>
    <select name="uclq_cohort">
        <?php
        for($x=1; $x<$years+1; $x++){
            echo '<option value="'.$x.'" ';
            if ($student_cohort==$x){
                echo 'selected';
            }
            echo '>'.$x.'</option>';
        }
        ?>
    </select>
    </div>
    <div class="form-row">
    <label for="uclq_graduated">Graduated?</label>
    <input name="uclq_graduated" type="checkbox" <?php if($student_graduated){echo 'checked';}?>>
    </div>
    <?php
}

function save_uclq_student_meta( $post_id ) { 
        if ( ! isset( $_POST['uclq_student_noncename'] ) ) { // Check if our nonce is set.
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
        $uclq_student_meta['programme'] = $_POST['uclq_programme'];
        $uclq_student_meta['cohort'] = $_POST['uclq_cohort'];
        $uclq_student_meta['graduated'] = $_POST['uclq_graduated'];
        // add values as custom fields
        foreach( $uclq_student_meta as $key => $value ) { // cycle through the $uclq_student_meta array
            // if( $post->post_type == 'revision' ) return; // don't store custom data twice
            if ($value){
                update_post_meta($post_id, $key, $value);
            }
        }
    }
    add_action( 'save_post', 'save_uclq_student_meta');

add_action( 'init', 'uclq_student_type', 0 );
add_filter('manage_uclq_student_posts_columns', 'student_columns');
add_filter('manage_uclq_student_posts_custom_column', 'display_student_columns', 10, 2);
add_filter('manage_uclq_student_sortable_columns', 'sortable_student_columns');
add_action('add_meta_boxes', 'add_student_meta');   
?>