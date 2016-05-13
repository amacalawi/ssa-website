<?php
/* ssaThreeZeroT Careers Post Type Example
This page walks you through creating
a custom post type and taxonomies. You
can edit this one or copy the following code
to create another one.

I put this in a separate file so as to
keep it organized. I find it easier to edit
and change things if they are concentrated
in their own file.
*/

// Flush rewrite rules for custom post types
add_action( 'after_switch_theme', 'careers_ssaThreeZeroTflush_rewrite_rules' );

// Flush your rewrite rules
function careers_ssaThreeZeroTflush_rewrite_rules() {
    flush_rewrite_rules();
}

// let's create the function for the custom type
function career_custom_post_type_init() {
    // creating (registering) the custom type
    register_post_type( 'careers', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
        // let's now add all the options for this post type
        array( 'labels' => array(
            'name' => __( 'Careers', 'ssaThreeZeroTheme' ), /* This is the Title of the Group */
            'singular_name' => __( 'Career', 'ssaThreeZeroTheme' ), /* This is the individual type */
            'all_items' => __( 'All Careers', 'ssaThreeZeroTheme' ), /* the all items menu item */
            'add_new' => __( 'Add New', 'ssaThreeZeroTheme' ), /* The add new menu item */
            'add_new_item' => __( 'Add New Career', 'ssaThreeZeroTheme' ), /* Add New Display Title */
            'edit' => __( 'Edit', 'ssaThreeZeroTheme' ), /* Edit Dialog */
            'edit_item' => __( 'Edit Career', 'ssaThreeZeroTheme' ), /* Edit Display Title */
            'new_item' => __( 'New Career', 'ssaThreeZeroTheme' ), /* New Display Title */
            'view_item' => __( 'View Career', 'ssaThreeZeroTheme' ), /* View Display Title */
            'search_items' => __( 'Search Career', 'ssaThreeZeroTheme' ), /* Search Careers Type Title */
            'not_found' =>  __( 'Nothing found in record.', 'ssaThreeZeroTheme' ), /* This displays if there are no entries yet */
            'not_found_in_trash' => __( 'Nothing found in Trash', 'ssaThreeZeroTheme' ), /* This displays if there is nothing in the trash */
            'parent_item_colon' => ''
            ), /* end of arrays */
            'description' => __( 'For careers', 'ssaThreeZeroTheme' ), /* Careers Type Description */
            'public' => true,
            'publicly_queryable' => false,
            'exclude_from_search' => true,
            'show_ui' => true,
            'query_var' => true,
            'menu_position' => 8, /* this is what order you want it to appear in on the left hand side menu */
            'menu_icon' => 'dashicons-businessman', /* the icon for the custom post type menu */
            'rewrite'   => array( 'slug' => 'careers', 'with_front' => false ), /* you can specify its url slug */
            'has_archive' => 'careers', /* you can rename the slug here */
            'capability_type' => 'post',
            'hierarchical' => false,
            /* the next one is important, it tells what's enabled in the post editor */
            'supports' => array( 'title', 'editor')
        ) /* end of options */
    ); /* end of register post type */

    /* this adds your post categories to your custom post type */
    register_taxonomy_for_object_type( 'category', 'careers' );
    /* this adds your post tags to your custom post type */
    // register_taxonomy_for_object_type( 'post_tag', 'careers' );

}

    // adding the function to the Wordpress init
    add_action( 'init', 'career_custom_post_type_init');

    /*
    for more information on taxonomies, go here:
    http://codex.wordpress.org/Function_Reference/register_taxonomy
    */

    // now let's add custom categories (these act like categories)
    register_taxonomy( 'career_cat',
        array('careers'), /* if you change the name of register_post_type( 'careers', then you have to change this */
        array('hierarchical' => true,     /* if this is true, it acts like categories */
            'labels' => array(
                'name' => __( 'Careers Categories', 'ssaThreeZeroTheme' ), /* name of the custom taxonomy */
                'singular_name' => __( 'Careers Category', 'ssaThreeZeroTheme' ), /* single taxonomy name */
                'search_items' =>  __( 'Search Careers Categories', 'ssaThreeZeroTheme' ), /* search title for taxomony */
                'all_items' => __( 'All Categories', 'ssaThreeZeroTheme' ), /* all title for taxonomies */
                'parent_item' => __( 'Parent Careers Category', 'ssaThreeZeroTheme' ), /* parent title for taxonomy */
                'parent_item_colon' => __( 'Parent Careers Category:', 'ssaThreeZeroTheme' ), /* parent taxonomy title */
                'edit_item' => __( 'Edit Careers Category', 'ssaThreeZeroTheme' ), /* edit custom taxonomy title */
                'update_item' => __( 'Update Careers Category', 'ssaThreeZeroTheme' ), /* update title for taxonomy */
                'add_new_item' => __( 'Add New Careers Category', 'ssaThreeZeroTheme' ), /* add new title for taxonomy */
                'new_item_name' => __( 'New Careers Category Name', 'ssaThreeZeroTheme' ) /* name title for taxonomy */
            ),
            'show_admin_column' => true,
            'show_ui' => true,
            'query_var' => true,
            'rewrite' => array( 'slug' => 'career-category' ),
        )
    );

    // add_action('admin_menu' , 'career_settings_page');
    // function career_settings_page() {
    //     add_submenu_page('edit.php?post_type=careers', 'Settings', 'Settings', 'edit_posts', basename(__FILE__), function(){
    //         $options = get_option('careers_settings');
    //         require 'views/careers/settings.php';
    //     });
    //     add_action( 'admin_init', 'register_careers_settings' ); //call register settings function
    // }
    // function register_careers_settings() {
    //     register_setting( 'careers-settings', 'careers_settings' );
    // }

    /*
        looking for custom meta boxes?
        check out this fantastic tool:
        https://github.com/jaredatch/Careers-Metaboxes-and-Fields-for-WordPress
    */


?>
