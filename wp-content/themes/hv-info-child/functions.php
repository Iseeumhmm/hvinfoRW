<?php
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );
function my_theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
 
}

function ag_rcp_require_email_verification( $required, $posted, $user_id, $price ) {
	if ( $price >= 50 ) {
		return false;
	} else {
		return true;
	}
}
add_filter( 'rcp_require_email_verification', 'ag_rcp_require_email_verification', 10, 4 );

// Company Profiles cpt

function profiles_init() {
    
    $labels = array(
        'name' => 'Company Profiles',
        'singular_name' => 'Company Profiles',
        'add_new' => 'Add New Profile',
        'add_new_item' => 'New Profile',
        'edit_item' => 'Edit Profile',
        'new_item' => 'New Profile',
        'all_items' => 'All Company Profiles',
        'view_item' => 'View Profile',
        'search_items' => 'Search Company Profiles',
        'not_found' =>  'No Profile Found',
        'not_found_in_trash' => 'No Profiles found in Trash', 
        'parent_item_colon' => '',
        'menu_name' => 'Company Profiles',
    );
    
    // register post type
    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => false,
        'show_ui' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'rewrite' => array('slug' => 'profiles'),
        'query_var' => true,
        'menu_icon' => 'dashicons-paperclip',
        'supports' => array(
			'title',
            'custom-fields'
        )
    );
    register_post_type( 'profiles', $args );
    
}
add_action( 'init', 'profiles_init' );
