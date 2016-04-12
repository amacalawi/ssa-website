<?php
/* ssaThreeZeroT Testimonials Post Type Example
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
add_action( 'after_switch_theme', 'ssaThreeZeroTflush_rewrite_rules' );

// Flush your rewrite rules
function ssaThreeZeroTflush_rewrite_rules() {
	flush_rewrite_rules();
}

// let's create the function for the custom type
function testimonial_custom_post_type_init() {
	// creating (registering) the custom type
	register_post_type( 'testimonials', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
		// let's now add all the options for this post type
		array( 'labels' => array(
			'name' => __( 'Testimonials', 'ssaThreeZeroTheme' ), /* This is the Title of the Group */
			'singular_name' => __( 'Testimonial', 'ssaThreeZeroTheme' ), /* This is the individual type */
			'all_items' => __( 'All Testimonials', 'ssaThreeZeroTheme' ), /* the all items menu item */
			'add_new' => __( 'Add New', 'ssaThreeZeroTheme' ), /* The add new menu item */
			'add_new_item' => __( 'Add New Testimonial', 'ssaThreeZeroTheme' ), /* Add New Display Title */
			'edit' => __( 'Edit', 'ssaThreeZeroTheme' ), /* Edit Dialog */
			'edit_item' => __( 'Edit Testimonial', 'ssaThreeZeroTheme' ), /* Edit Display Title */
			'new_item' => __( 'New Testimonial', 'ssaThreeZeroTheme' ), /* New Display Title */
			'view_item' => __( 'View Testimonial', 'ssaThreeZeroTheme' ), /* View Display Title */
			'search_items' => __( 'Search Testimonial', 'ssaThreeZeroTheme' ), /* Search Testimonials Type Title */
			'not_found' =>  __( 'Nothing found in record.', 'ssaThreeZeroTheme' ), /* This displays if there are no entries yet */
			'not_found_in_trash' => __( 'Nothing found in Trash', 'ssaThreeZeroTheme' ), /* This displays if there is nothing in the trash */
			'parent_item_colon' => ''
			), /* end of arrays */
			'description' => __( 'For testimonials', 'ssaThreeZeroTheme' ), /* Testimonials Type Description */
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 8, /* this is what order you want it to appear in on the left hand side menu */
			'menu_icon' => 'dashicons-editor-quote', /* the icon for the custom post type menu */
			'rewrite'	=> array( 'slug' => 'testimonials', 'with_front' => false ), /* you can specify its url slug */
			'has_archive' => 'testimonials', /* you can rename the slug here */
			'capability_type' => 'post',
			'hierarchical' => false,
			/* the next one is important, it tells what's enabled in the post editor */
			'supports' => array( 'title', 'excerpt')
		) /* end of options */
	); /* end of register post type */

	/* this adds your post categories to your custom post type */
	register_taxonomy_for_object_type( 'category', 'testimonials' );
	/* this adds your post tags to your custom post type */
	// register_taxonomy_for_object_type( 'post_tag', 'testimonials' );

}

	// adding the function to the Wordpress init
	add_action( 'init', 'testimonial_custom_post_type_init');

	/*
	for more information on taxonomies, go here:
	http://codex.wordpress.org/Function_Reference/register_taxonomy
	*/

	// now let's add custom categories (these act like categories)
	register_taxonomy( 'testimonial_cat',
		array('testimonials'), /* if you change the name of register_post_type( 'testimonials', then you have to change this */
		array('hierarchical' => true,     /* if this is true, it acts like categories */
			'labels' => array(
				'name' => __( 'Testimonials Categories', 'ssaThreeZeroTheme' ), /* name of the custom taxonomy */
				'singular_name' => __( 'Testimonials Category', 'ssaThreeZeroTheme' ), /* single taxonomy name */
				'search_items' =>  __( 'Search Testimonials Categories', 'ssaThreeZeroTheme' ), /* search title for taxomony */
				'all_items' => __( 'All Categories', 'ssaThreeZeroTheme' ), /* all title for taxonomies */
				'parent_item' => __( 'Parent Testimonials Category', 'ssaThreeZeroTheme' ), /* parent title for taxonomy */
				'parent_item_colon' => __( 'Parent Testimonials Category:', 'ssaThreeZeroTheme' ), /* parent taxonomy title */
				'edit_item' => __( 'Edit Testimonials Category', 'ssaThreeZeroTheme' ), /* edit custom taxonomy title */
				'update_item' => __( 'Update Testimonials Category', 'ssaThreeZeroTheme' ), /* update title for taxonomy */
				'add_new_item' => __( 'Add New Testimonials Category', 'ssaThreeZeroTheme' ), /* add new title for taxonomy */
				'new_item_name' => __( 'New Testimonials Category Name', 'ssaThreeZeroTheme' ) /* name title for taxonomy */
			),
			'show_admin_column' => true,
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => array( 'slug' => 'testimonial-category' ),
		)
	);

	add_action('admin_menu' , 'testimonial_settings_page');
	function testimonial_settings_page() {
	    add_submenu_page('edit.php?post_type=testimonials', 'Settings', 'Settings', 'edit_posts', basename(__FILE__), function(){
	    	$options = get_option('testimonials_settings');
	    	require 'views/testimonials/settings.php';
	    });
	    add_action( 'admin_init', 'register_testimonials_settings' ); //call register settings function
 	}
	function register_testimonials_settings() {
		register_setting( 'testimonials-settings', 'testimonials_settings' );
	}

	/*
		looking for custom meta boxes?
		check out this fantastic tool:
		https://github.com/jaredatch/Testimonials-Metaboxes-and-Fields-for-WordPress
	*/


?>
