// Register Custom Post Type
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
        'feeds'                 => true,
    );
    $args = array(
        'label'                 => __( 'Student', 'text_domain' ),
        'description'           => __( 'A Student of the UCLQ CDT', 'text_domain' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'thumbnail', 'custom-fields', 'page-attributes', 'post-formats', ),
        'taxonomies'            => array( 'category', 'post_tag' ),
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
    register_post_type( 'uclq_stdeunt', $args );

}
add_action( 'init', 'uclq_student_type', 0 );