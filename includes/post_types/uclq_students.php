<?php

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
        'description'           => __( 'A UCLQ Student', 'text_domain' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'thumbnail', ),
        'taxonomies'            => array( 'cohort', 'programme' ),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-id',
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
    register_post_type( 'uclq_student', $args );
}

function register_graduate_taxonomy()
{
    $labels = [
        'name' => _x('Graduated', 'taxonomy general name', 'student_cohort'),
        'singular_name' => _x('Graduated', 'taxonomy singular name', 'student_cohort'),
        'search_items' => __('Search Graduated'),
        'all_items' => __('All Graduateds'),
        'edit_item' => __('Edit Graduated'),
        'update_item' => __('Update Graduated'),
        'add_new_item' => __('Add New Graduated'),
        'new_item_name' => __('New Graduated'),
        'menu_name' => __('Graduated')
    ];
    $args = [
        'hierarchical' => false,
        'labels' => $labels,
        'show_ui' => false,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => ['slug' => 'graduated'],
        'sort' => true,
    ];
    register_taxonomy('graduated', ['uclq_student'], $args);
    wp_insert_term('0', 'graduated', array('slug'=>'still-studying'));
    wp_insert_term('1', 'graduated', array('slug'=>'graduated'));
}

function register_student_type_taxonomy(){
    $labels = [
        'name' => _x('Student Type', 'taxonomy general name', 'student_type'),
        'singular_name' => _x('Student Type', 'taxonomy singular name', 'student_type'),
        'search_items' => __('Search Student Types'),
        'all_items' => __('All Student Types'),
        'edit_item' => __('Edit Student Type'),
        'update_item' => __('Update Student Type'),
        'add_new_item' => __('Add New Student Type'),
        'new_item_name' => __('New Student Type'),
        'menu_name' => __('Student Type')
    ];
    $args = [
        'hierarchical' => false,
        'labels' => $labels,
        'show_ui' => false,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => ['slug' => 'cohort'],
        'sort' => true,
        capabilities => array(
                'manage_terms' => 'non_exsistant',
                'edit_terms' => 'non_exsistant',
                'delete_terms' => 'non_exsistant',
                'assign_terms' => 'edit_posts'
            ),
    ];
    register_taxonomy('student_type', ['uclq_student'], $args);
    wp_insert_term('CDT Student', 'student_type', array('slug'=>'cdt_student'));
    wp_insert_term('PhD Student', 'student_type', array('slug'=>'phd_student'));
}

function student_register_cohort_taxonomy()
{
    $labels = [
        'name' => _x('Cohorts', 'taxonomy general name', 'student_cohort'),
        'singular_name' => _x('Cohort', 'taxonomy singular name', 'student_cohort'),
        'search_items' => __('Search Cohorts'),
        'all_items' => __('All Cohorts'),
        'edit_item' => __('Edit Cohort'),
        'update_item' => __('Update Cohort'),
        'add_new_item' => __('Add New Cohort'),
        'new_item_name' => __('New Cohort'),
        'menu_name' => __('Cohort')
    ];
    $args = [
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => false,
        'show_admin_column' => false,
        'query_var' => true,
        'rewrite' => ['slug' => 'cohort'],
        'sort' => true,
        capabilities => array(
                'manage_terms' => 'non_exsistant',
                'edit_terms' => 'non_exsistant',
                'delete_terms' => 'non_exsistant',
                'assign_terms' => 'edit_posts'
            ),
    ];
    register_taxonomy('cohort', ['uclq_student'], $args);
    $now = new DateTime("now");
    $then = new DateTime("2014-10-01");
    $diff = $now->diff($then);
    $years = $diff->y + 1;
    $cohorts = get_terms(array('taxonomy'=>'cohort', 'hide_empty'=>false));
    $max_year = 0;
    foreach($cohorts as $cohort){
        $cohort_int = (int)$cohort->name;
        if ($cohort_int > $max_year){
            $max_year = $cohort_int;
        }
    }
    if ($max_year < $years){
        for ($x = $max_year; $x<$years+1; $x++){
            wp_insert_term($x, 'cohort', array('slug' => 'cohort-'.$x));
        }
    }
    wp_insert_term('N/A', 'cohort');
}

function student_register_programme_taxonomy()
{
    $labels = [
        'name' => _x('CDT Programmes', 'taxonomy general name', 'student_cohort'),
        'singular_name' => _x('CDT Programme', 'taxonomy singular name', 'student_cohort'),
        'search_items' => __('Search CDT Programmes'),
        'all_items' => __('All CDT Programmes'),
        'edit_item' => __('Edit CDT Programme'),
        'update_item' => __('Update CDT Programme'),
        'add_new_item' => __('Add New CDT Programme'),
        'new_item_name' => __('New CDT Programme'),
        'menu_name' => __('CDT Programme')
    ];
    $args = [
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => false,
        'query_var' => true,
        'rewrite' => ['slug' => 'programme'],
        'sort' => true,
    ];
    register_taxonomy('programme', ['uclq_student'], $args);
}

function add_student_meta(){
    add_meta_box('student_meta', 'Details', 'student_details_meta_box', 'uclq_student', 'normal', 'low');
    add_meta_box('student_research_meta', 'Project', 'student_research_meta_box', 'uclq_student', 'normal','low');
}

function student_details_meta_box($post) {
    $cohorts = get_terms(array('taxonomy'=>'cohort', 'hide_empty'=>0));
    $post_cohort = array_shift(wp_get_post_terms($post->ID, 'cohort'));
    $post_graduate = array_shift(wp_get_post_terms($post->ID, 'graduated'));
    $post_type = array_shift(wp_get_post_terms($post->ID, 'student_type'));
    echo '<input type="hidden" name="uclq_student_noncename" value="' . wp_create_nonce( wp_basename(__FILE__) ) . '" />';
    /*TODO: Computationally determine if they have a project yet, and grey out the form accordingly*/
    meta_style();
    ?>
    <script type="application/javascript">
    function toggle_cohort(){
        select = document.getElementById("student_type");
        row = document.getElementById('cohort_row');
        if (select.value=='CDT Student'){
            row.style.visibility = 'visible';
        } else {
            row.style.visibility ='hidden';
        }
    };
   </script>
    <div class="form-row">
    <label for="uclq_student_type">Type:</label>
        <select id="student_type" name="uclq_student_type" onchange="toggle_cohort()">
           <option value="PhD Student" <?php if($post_type->name=='PhD Student'){echo'selected';}?>>PhD Student</option>
           <option value="CDT Student" <?php if($post_type->name=='CDT Student'){echo'selected';}?>>CDT Student</option>
        </select>
    </div>
    <div class="form-row" id="cohort_row" <?php if($post_type->name != 'CDT Student'){echo'style="visibility:hidden"';}?>>
      <label for="uclq_cohort">Cohort</label>
      <select name="uclq_cohort">
      <?php 
      foreach ($cohorts as $cohort) {
        if($cohort->name == 'N/A'){
           continue;
        } else {
            echo '<option value="'.$cohort->name.'"';
            if ($cohort->name == $post_cohort->name){
                echo " selected";
            }
            echo '>Cohort '. $cohort->name . '</option>';
        }
      }
      ?>
      </select>
    </div>
    <div class="form-row">
    <label for="uclq_graduated">Graduated?</label>
    <input name="uclq_graduated" type="checkbox" <?php if($post_graduate->name=='1'){echo 'checked';}?>>
    </div>
    <?php
}

function student_research_meta_box($post){
    echo '<input type="hidden" name="uclq_student_noncename" value="' . wp_create_nonce( wp_basename(__FILE__) ) . '" />';
    $student_research_title = get_post_meta($post->ID, 'research_title', true);
    $student_research_description = get_post_meta($post->ID, 'research_description', true);   
    $student_supervisor = get_post_meta($post->ID, 'supervisor', true);
    ?>
    <div class="form-row">
      <label for="uclq_research_title">Project Title:</label>
      <input type="text" name="uclq_research_title" value="<?php echo $student_research_title; ?>">
    </div>
    <div class="form-row">
      <label for="uclq_supervisor">Supervisor:</label>
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
    $thumbnail_id = $_POST['_thumbnail_id'];
    if (!empty($thumbnail_id)){
        set_post_thumbnail($post_id, $thumbnail_id);
    }
    $new_type = $_POST['uclq_student_type'];
    $new_cohort = $_POST['uclq_cohort'];
    if (! empty($_POST['uclq_graduated'])){
        $new_graduated = '1';
    } else {
        $new_graduated = '0';
    }
    $uclq_student_meta['supervisor'] = sanitize_text_field($_POST['uclq_supervisor']);
    $uclq_student_meta['research_title'] = sanitize_text_field($_POST['uclq_research_title']);
    $uclq_student_meta['research_description'] = sanitize_textarea_field($_POST['uclq_research_desc']);
    foreach( $uclq_student_meta as $key => $value ) { // cycle through the $uclq_student_meta array
        if ($value){
            update_post_meta($post_id, $key, $value);
        }
    }
    if ($new_type=='PhD Student'){
        wp_set_object_terms($post_id, 'PhD Student','student_type', false);
        wp_set_object_terms($post_id, 'N/A', 'cohort', false);
    } else {
        wp_set_object_terms($post_id, 'CDT Student', 'student_type', false);
        $cohorts = get_terms(array('taxonomy'=>'cohort', 'hide_empty'=>false));
        foreach($cohorts as $cohort){
        if($cohort->name == $new_cohort){
            wp_set_object_terms($post_id, $cohort->term_id,'cohort',false);
        }
    }
    }
    $grad_status = get_terms(array('taxonomy'=>'graduated', 'hide_empty'=>false));
    foreach ($grad_status as $grad) {
       if($grad->name == $new_graduated){
            wp_set_object_terms($post_id, $grad->term_id,'graduated',false);
       }
    }
}
add_action( 'save_post', 'save_uclq_student_meta');

add_action('init', 'register_student_type_taxonomy');
add_action('init', 'register_graduate_taxonomy');
add_action('init', 'student_register_cohort_taxonomy');
add_action('init', 'student_register_programme_taxonomy');
add_action( 'init', 'uclq_student_type', 0 );
// add_filter('manage_uclq_student_posts_columns', 'student_columns');
// add_filter('manage_uclq_student_posts_custom_column', 'display_student_columns', 10, 2);
// add_filter('manage_uclq_student_sortable_columns', 'sortable_student_columns');
add_action('add_meta_boxes', 'add_student_meta');   
?>