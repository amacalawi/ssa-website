<?php
/**
 * Plugin Name: Mail Manager v3.0
 * Plugin URI: https://plus.google.com/john-lioneil
 * Description: A simple email manager for your site.
 * Author: John Lioneil Dionisio
 * Author URI: https://plus.google.com/john-lioneil
 * Version: 3.0
 */

if ( !function_exists( 'add_action' ) ) {
    echo "Hi there!  I'm just a plugin, not much I can do when called directly.";
    exit;
}
require "globals.php";

$Mailman = new MailManController();
$Mailmailer = new MailManMailMailerController();

# Init
add_action('init', function() {
    global $Mailman, $Mailmailer;
    $Mailman->register();
    $Mailman->status_types();
    $Mailman->notification();

    $Maildash = new MailManDashboardController();
});

# Plugin Links
# Display Settings Link in the Plugins List
$plugin = plugin_basename(__FILE__);
add_filter(
    "plugin_action_links_$plugin",
    function ($links) {
      $settings_link = '<a href="'.admin_url("edit.php?post_type=email&page=".MailManController::$cpt_url_settings_link).'">Settings</a>';
      array_unshift($links, $settings_link);
      return $links;
    }
);

# Metaboxes
add_action('add_meta_boxes_'.MailManController::$cpt_name_singular, function() {
    global $Mailman;
    $Mailman->metaboxes();
});

add_action('save_post', function ($post_id) {
    global $Mailman;
    $Mailman->save($post_id);
});


# Display the Form
add_filter(
    'the_content',
    function( $the_content ) {
        global $Mailman;
        $mailman_options = get_option( MailManController::$cpt_options_name );

        if( array_key_exists('page', $mailman_options) && $mailman_options['page'] == get_the_ID() )
        {
            $the_content = $the_content . do_shortcode("[mail_form]");
        }

        return $the_content;
    }
);

# Manage Columns
add_filter( 'manage_edit-'.MailManController::$cpt_name_singular.'_columns', function($columns){
    global $Mailman;
    return $Mailman->columns($columns);
});

# Manage Every Column's values
add_action( 'manage_'.MailManController::$cpt_name_singular.'_posts_custom_column', function($column, $post_id){
    global $Mailman;
    return $Mailman->custom_column($column, $post_id);
}, 10, 2 );

# Column Sortable
add_filter( 'manage_edit-'.MailManController::$cpt_name_singular.'_sortable_columns', function($sortable_columns){
    global $Mailman;
    return $Mailman->sortable($sortable_columns);
});


// THE FUNCTION
function do_send_message(){
/* this area is very simple but being serverside it affords the possibility of retreiving data from the server and passing it back to the javascript function */
include MAIL_MAN_DIR_INCLUDES . "sender.php";
// this is passed back to the javascript function
die();// wordpress may print out a spurious zero without this – can be particularly bad if using json
}
// THE AJAX ADD ACTIONS
add_action( 'wp_ajax_send_message', 'do_send_message' );
add_action( 'wp_ajax_nopriv_send_message', 'do_send_message' ); // need this to serve non logged in users


// Change default functionality of the publish button
function dont_publish( $post_ID )
{
    global $Mailman, $post;
    if(get_post_type($post_ID) == MailManController::$cpt_name_singular)
    {
        $new_post = array( 'ID' => $post_ID, 'post_status' => 'read' );
        if( $post->post_status == 'unread' )
        {
            wp_update_post($new_post);
        }
        elseif(  $post->post_status == 'read' )
        {
            wp_update_post($new_post);
        }
    }
}
//the dont_publish function will be called after the publish button is clicked
add_action( 'publish_'.MailManController::$cpt_name_singular, 'dont_publish' );


# Content Type
function wpse27856_set_content_type(){
    return "text/html";
}
add_filter( 'wp_mail_content_type','wpse27856_set_content_type' );
?>