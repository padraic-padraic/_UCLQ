<?php
function register_department_taxonomy()
{
    $labels = [
        'name' => _x('Department', 'taxonomy general name', 'student_department'),
        'singular_name' => _x('Department', 'taxonomy singular name', 'student_department'),
        'search_items' => __('Search Departments'),
        'all_items' => __('All Departments'),
        'edit_item' => __('Edit Department'),
        'update_item' => __('Update Department'),
        'add_new_item' => __('Add New Department'),
        'new_item_name' => __('New Department'),
        'menu_name' => __('Department')
    ];
    $args = [
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => ['slug' => 'department'],
        'sort' => true,
    ];
    register_taxonomy('department', ['uclq_student', 'uclq_staff', 'uclq_facility'], $args);
}

add_action('init', 'register_department_taxonomy');

?>