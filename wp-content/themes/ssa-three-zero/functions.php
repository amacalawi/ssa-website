<?php

// Add Translation Option
load_theme_textdomain( 'wpbootstrap', TEMPLATEPATH.'/languages' );
$locale = get_locale();
$locale_file = TEMPLATEPATH . "/languages/$locale.php";
if ( is_readable( $locale_file ) ) require_once( $locale_file );

// Clean up the WordPress Head
if( !function_exists( "wp_bootstrap_head_cleanup" ) ) {
  function wp_bootstrap_head_cleanup() {
    // remove header links
    remove_action( 'wp_head', 'feed_links_extra', 3 );                    // Category Feeds
    remove_action( 'wp_head', 'feed_links', 2 );                          // Post and Comment Feeds
    remove_action( 'wp_head', 'rsd_link' );                               // EditURI link
    remove_action( 'wp_head', 'wlwmanifest_link' );                       // Windows Live Writer
    remove_action( 'wp_head', 'index_rel_link' );                         // index link
    remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );            // previous link
    remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );             // start link
    remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 ); // Links for Adjacent Posts
    remove_action( 'wp_head', 'wp_generator' );                           // WP version
  }
}
// Launch operation cleanup
add_action( 'init', 'wp_bootstrap_head_cleanup' );

// remove WP version from RSS
if( !function_exists( "wp_bootstrap_rss_version" ) ) {
  function wp_bootstrap_rss_version() { return ''; }
}
add_filter( 'the_generator', 'wp_bootstrap_rss_version' );

// Remove the […] in a Read More link
if( !function_exists( "wp_bootstrap_excerpt_more" ) ) {
  function wp_bootstrap_excerpt_more( $more ) {
    global $post;
    return '...  <a href="'. get_permalink($post->ID) . '" class="more-link" title="Read '.get_the_title($post->ID).'">Read more &raquo;</a>';
  }
}
add_filter('excerpt_more', 'wp_bootstrap_excerpt_more');

// Add WP 3+ Functions & Theme Support
if( !function_exists( "wp_bootstrap_theme_support" ) ) {
  function wp_bootstrap_theme_support() {
    add_theme_support( 'post-thumbnails' );      // wp thumbnails (sizes handled in functions.php)
    set_post_thumbnail_size( 125, 125, true );   // default thumb size
    add_theme_support( 'custom-background' );  // wp custom background
    add_theme_support( 'automatic-feed-links' ); // rss

    // Add post format support - if these are not needed, comment them out
    add_theme_support( 'post-formats',      // post formats
      array(
        'aside',   // title less blurb
        'gallery', // gallery of images
        'link',    // quick link to other site
        'image',   // an image
        'quote',   // a quick quote
        'status',  // a Facebook like status update
        'video',   // video
        'audio',   // audio
        'chat'     // chat transcript
      )
    );

    add_theme_support( 'menus' );            // wp menus

    register_nav_menus(                      // wp3+ menus
      array(
        'main_nav' => 'The Main Menu',   // main nav in header
        'footer_links' => 'Footer Links', // secondary nav in footer,
        'social_links' => 'Social Links',
      )
    );
  }
}
// launching this stuff after theme setup
add_action( 'after_setup_theme','wp_bootstrap_theme_support' );

function wp_bootstrap_main_nav() {
  // Display the WordPress menu if available
  wp_nav_menu(
    array(
      'menu' => 'main_nav', /* menu name */
      'menu_class' => 'nav navbar-nav navbar-right',
      'theme_location' => 'main_nav', /* where in the theme it's assigned */
      'container' => 'false', /* container class */
      'fallback_cb' => 'wp_bootstrap_main_nav_fallback', /* menu fallback */
      'walker' => new Bootstrap_walker()
    )
  );
}

function wp_bootstrap_footer_links() {
  // Display the WordPress menu if available
  wp_nav_menu(
    array(
      'menu' => 'footer_links', /* menu name */
      'theme_location' => 'footer_links', /* where in the theme it's assigned */
      'container_class' => 'footer-links clearfix', /* container class */
      'fallback_cb' => 'wp_bootstrap_footer_links_fallback' /* menu fallback */
    )
  );
}

function wp_social_links()
{
    wp_nav_menu(
        array(
            'menu' => 'social_links', /* menu name */
            'menu_class' => 'list-unstyled icon-menu',
            'theme_location' => 'social_links', /* where in the theme it's assigned */
            'container_class' => 'social-links clearfix', /* container class */
    ));
}


// this is the fallback for header menu
function wp_bootstrap_main_nav_fallback() {
  /* you can put a default here if you like */
}

// this is the fallback for footer menu
function wp_bootstrap_footer_links_fallback() {
  /* you can put a default here if you like */
}

function prefix_menu_css_class( $classes ) {
    foreach( $classes as $key => $val ) {
        if ( 'icon-' == substr( $val, 0, 5 ) || 'zmdi-' == substr( $val, 0, 5 ) || 'zmdi' == substr( $val, 0, 5 ) ) {
            unset( $classes[$key] );
        }
    }
    return $classes;
}
add_filter( 'nav_menu_css_class', 'prefix_menu_css_class' );

function prefix_nav_menu_link_attributes( $atts, $item, $args ) {
    if ( 'social_links' == $args->theme_location ) :
        // Default icon class
        $class = '';
        if ( $item->classes ) {
            foreach( $item->classes as $key => $val ) {
                if ( 'zmdi-' == substr( $val, 0, 5 ) || 'icon' == substr( $val, 0, 5 ) ) {
                    $args->link_before = '<i class="zmdi zmdi-hc-fw '.$val.'">&nbsp;</i><span>';
                    $args->link_after = '</span>';
                    $class = '';
                }
            }
        }
        if ( $class ) {
            $atts['class'] = $class;
        }
    endif;
    return $atts;
}
add_filter( 'nav_menu_link_attributes', 'prefix_nav_menu_link_attributes', 3, 10 );

// Shortcodes
require_once('library/shortcodes.php');

// Admin Functions (commented out by default)
// require_once('library/admin.php');         // custom admin functions

// Custom Backend Footer
add_filter('admin_footer_text', 'wp_bootstrap_custom_admin_footer');
function wp_bootstrap_custom_admin_footer() {
	echo '<span id="footer-thankyou">Developed by SSA Manila. Built using <a href="http://320press.com" target="_blank">320press</a>.';
}


// adding it to the admin area
add_filter('admin_footer_text', 'wp_bootstrap_custom_admin_footer');

// Set content width
if ( ! isset( $content_width ) ) $content_width = 580;

/************* THUMBNAIL SIZE OPTIONS *************/

// Thumbnail sizes
add_image_size( 'wpbs-featured', 780, 300, true );
add_image_size( 'wpbs-featured-home', 970, 311, true);
add_image_size( 'wpbs-featured-carousel', 970, 400, true);

/*
to add more sizes, simply copy a line from above
and change the dimensions & name. As long as you
upload a "featured image" as large as the biggest
set width or height, all the other sizes will be
auto-cropped.

To call a different size, simply change the text
inside the thumbnail function.

For example, to call the 300 x 300 sized image,
we would use the function:
<?php the_post_thumbnail( 'bones-thumb-300' ); ?>
for the 600 x 100 image:
<?php the_post_thumbnail( 'bones-thumb-600' ); ?>

You can change the names and dimensions to whatever
you like. Enjoy!
*/

/************* ACTIVE SIDEBARS ********************/

// Sidebars & Widgetizes Areas
function wp_bootstrap_register_sidebars() {
  register_sidebar(array(
  	'id' => 'sidebar1',
  	'name' => 'Main Sidebar',
  	'description' => 'Used on every page BUT the homepage page template.',
  	'before_widget' => '<div id="%1$s" class="widget %2$s">',
  	'after_widget' => '</div>',
  	'before_title' => '<h4 class="widgettitle">',
  	'after_title' => '</h4>',
  ));

  register_sidebar(array(
  	'id' => 'sidebar2',
  	'name' => 'Homepage Sidebar',
  	'description' => 'Used only on the homepage page template.',
  	'before_widget' => '<div id="%1$s" class="widget %2$s">',
  	'after_widget' => '</div>',
  	'before_title' => '<h4 class="widgettitle">',
  	'after_title' => '</h4>',
  ));

  register_sidebar(array(
    'id' => 'footer1',
    'name' => 'Footer 1',
    'before_widget' => '<div id="%1$s" class="widget col-sm-4 %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h4 class="widgettitle">',
    'after_title' => '</h4>',
  ));

  register_sidebar(array(
    'id' => 'footer2',
    'name' => 'Footer 2',
    'before_widget' => '<div id="%1$s" class="widget col-sm-4 %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h4 class="widgettitle">',
    'after_title' => '</h4>',
  ));

  register_sidebar(array(
    'id' => 'footer3',
    'name' => 'Footer 3',
    'before_widget' => '<div id="%1$s" class="widget col-sm-4 %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h4 class="widgettitle">',
    'after_title' => '</h4>',
  ));


  /*
  to add more sidebars or widgetized areas, just copy
  and edit the above sidebar code. In order to call
  your new sidebar just use the following code:

  Just change the name to whatever your new
  sidebar's id is, for example:

  To call the sidebar in your template, you can just copy
  the sidebar.php file and rename it to your sidebar's name.
  So using the above example, it would be:
  sidebar-sidebar2.php

  */
} // don't remove this bracket!
add_action( 'widgets_init', 'wp_bootstrap_register_sidebars' );

/************* COMMENT LAYOUT *********************/

// Comment Layout
function wp_bootstrap_comments($comment, $args, $depth) {
    global $post;
    $GLOBALS['comment'] = $comment; ?>
	<li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
        <p class="commentator <?php echo $comment->user_id === $post->post_author ? 'author' : ''; ?>">
            <a href="#"><?php echo get_comment_author_link() ?><?php echo $comment->user_id === $post->post_author ? ' <span>(post author)</span>' : ''; ?></a>
        </p>
        <?php if ($comment->comment_approved == '0') : ?>
            <div class="alert alert-success">
                <p><?php _e('Your comment is awaiting moderation.','wpbootstrap') ?></p>
            </div>
        <?php else: ?>
            <p class="date">
                <time datetime="<?php echo comment_time('Y-m-j'); ?>"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php comment_time('F jS, Y \a\t H:sa'); ?> </a></time>
            </p>
            <div class="comment-info">
                <?php comment_text() ?>
            </div>
            <p class="reply-link">
                <span><?php edit_comment_link(__('Edit','wpbootstrap'),'<span class="edit-comment"><i class="zmdi zmdi-edit">&nbsp;</i>','</span>') ?></span>
                <span><?php comment_reply_link(array_merge( $args, array('before'=>'<i class="zmdi zmdi-mail-reply">&nbsp;</i>', 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?></span>
            </p>
        <?php endif; ?>
		<!-- <article id="comment-<?php comment_ID(); ?>" class="clearfix">
			<div class="comment-author vcard clearfix">
				<div class="avatar col-sm-3">
					<?php echo get_avatar( $comment, $size='75' ); ?>
				</div>
				<div class="col-sm-9 comment-text">
					<?php printf('<h4>%s</h4>', get_comment_author_link()) ?>
					<?php edit_comment_link(__('Edit','wpbootstrap'),'<span class="edit-comment btn btn-sm btn-info"><i class="glyphicon-white glyphicon-pencil"></i>','</span>') ?>

                    <?php if ($comment->comment_approved == '0') : ?>
       					<div class="alert-message success">
          				<p><?php _e('Your comment is awaiting moderation.','wpbootstrap') ?></p>
          				</div>
					<?php endif; ?>

                    <?php comment_text() ?>

                    <time datetime="<?php echo comment_time('Y-m-j'); ?>"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php comment_time('F jS, Y'); ?> </a></time>

					<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
                </div>
			</div>
		</article> -->
    <!-- </li> is added by wordpress automatically -->
<?php
} // don't remove this bracket!

// Display trackbacks/pings callback function
function list_pings($comment, $args, $depth) {
       $GLOBALS['comment'] = $comment;
?>
        <li id="comment-<?php comment_ID(); ?>"><i class="icon icon-share-alt"></i>&nbsp;<?php comment_author_link(); ?>
<?php

}

/************* SEARCH FORM LAYOUT *****************/

/****************** password protected post form *****/

add_filter( 'the_password_form', 'wp_bootstrap_custom_password_form' );

function wp_bootstrap_custom_password_form() {
	global $post;
	$label = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );
	$o = '<div class="clearfix"><form class="protected-post-form" action="' . get_option('siteurl') . '/wp-login.php?action=postpass" method="post">
	' . '<p>' . __( "This post is password protected. To view it please enter your password below:" ,'wpbootstrap') . '</p>' . '
	<label for="' . $label . '">' . __( "Password:" ,'wpbootstrap') . ' </label><div class="input-append"><input name="post_password" id="' . $label . '" type="password" size="20" /><input type="submit" name="Submit" class="btn btn-primary" value="' . esc_attr__( "Submit",'wpbootstrap' ) . '" /></div>
	</form></div>
	';
	return $o;
}

/*********** update standard wp tag cloud widget so it looks better ************/

add_filter( 'widget_tag_cloud_args', 'wp_bootstrap_my_widget_tag_cloud_args' );

function wp_bootstrap_my_widget_tag_cloud_args( $args ) {
	$args['number'] = 20; // show less tags
	$args['largest'] = 9.75; // make largest and smallest the same - i don't like the varying font-size look
	$args['smallest'] = 9.75;
	$args['unit'] = 'px';
	return $args;
}

// filter tag clould output so that it can be styled by CSS
function wp_bootstrap_add_tag_class( $taglinks ) {
    $tags = explode('</a>', $taglinks);
    $regex = "#(.*tag-link[-])(.*)(' title.*)#e";

    foreach( $tags as $tag ) {
    	$tagn[] = preg_replace($regex, "('$1$2 label tag-'.get_tag($2)->slug.'$3')", $tag );
    }

    $taglinks = implode('</a>', $tagn);

    return $taglinks;
}

add_action( 'wp_tag_cloud', 'wp_bootstrap_add_tag_class' );

add_filter( 'wp_tag_cloud','wp_bootstrap_wp_tag_cloud_filter', 10, 2) ;

function wp_bootstrap_wp_tag_cloud_filter( $return, $args )
{
  return '<div id="tag-cloud">' . $return . '</div>';
}

// Enable shortcodes in widgets
add_filter( 'widget_text', 'do_shortcode' );

// Disable jump in 'read more' link
function wp_bootstrap_remove_more_jump_link( $link ) {
	$offset = strpos($link, '#more-');
	if ( $offset ) {
		$end = strpos( $link, '"',$offset );
	}
	if ( $end ) {
		$link = substr_replace( $link, '', $offset, $end-$offset );
	}
	return $link;
}
add_filter( 'the_content_more_link', 'wp_bootstrap_remove_more_jump_link' );

// Remove height/width attributes on images so they can be responsive
add_filter( 'post_thumbnail_html', 'wp_bootstrap_remove_thumbnail_dimensions', 10 );
add_filter( 'image_send_to_editor', 'wp_bootstrap_remove_thumbnail_dimensions', 10 );

function wp_bootstrap_remove_thumbnail_dimensions( $html ) {
    $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
    return $html;
}

// Add the Meta Box to the homepage template
function wp_bootstrap_add_homepage_meta_box() {
	global $post;

	// Only add homepage meta box if template being used is the homepage template
	// $post_id = isset($_GET['post']) ? $_GET['post'] : (isset($_POST['post_ID']) ? $_POST['post_ID'] : "");
	$post_id = $post->ID;
	$template_file = get_post_meta($post_id,'_wp_page_template',TRUE);

	if ( $template_file == 'page-homepage.php' ) {
	    add_meta_box(
	        'homepage_meta_box', // $id
	        'Homepage Content', // $title
	        'wp_bootstrap_show_homepage_meta_box', // $callback
	        'page', // $page
	        'normal', // $context
	        'high'); // $priority
    }

    if ( $template_file == 'page-standard.php' || $template_file == 'page-blog.php' || $template_file == get_post_meta($post_id,'_wp_page_template',TRUE) ) {
        add_meta_box(
            'standard_meta_box', // $id
            'Tagline Content', // $title
            'wp_bootstrap_show_standard_meta_box', // $callback
            'page', // $page
            'normal', // $context
            'high'); // $priority
    }

    if ( $template_file == 'page-single-event.php' ) {
        add_meta_box(
            'my_event_meta_box', // $id
            'Event subheading', // $title
            'wp_bootstrap_show_event_meta_box', // $callback
            'page', // $page
            'normal', // $context
            'high'); // $priority
    }
}

add_action( 'add_meta_boxes', 'wp_bootstrap_add_homepage_meta_box' );


// Field Array
$prefix = 'custom_';
$custom_meta_fields = array(
    array(
        'label'=> 'Video URL',
        'desc'  => 'The video on the homepage. Only select an mp4 file.',
        'id'    => $prefix.'video',
        'type'  => 'text'
    )
);
$custom_standard_meta_fields = array(
    array(
        'label'=> 'Background Image',
        'desc'  => '',
        'id'    => $prefix.'bg',
        'type'  => 'text'
    ),
    array(
        'label'=> 'Tagline',
        'desc'  => '',
        'id'    => $prefix.'tagline',
        'type'  => 'textarea'
    ),
);
$custom_event_meta_fields = array(
    array(
        'label'=> 'Event Subheading',
        'desc'  => '',
        'id'    => $prefix.'eventSubheading',
        'type'  => 'text'
    ),
    array(
        'label'=> 'Content',
        'desc'  => '',
        'id'    => $prefix.'eventContent',
        'type'  => 'textarea'
    ),
);

// The Homepage Meta Box Callback
function wp_bootstrap_show_homepage_meta_box() {
  global $custom_meta_fields, $post;

  // Use nonce for verification
  wp_nonce_field( basename( __FILE__ ), 'wpbs_nonce' );

  // Begin the field table and loop
  echo '<table class="form-table">';

  foreach ( $custom_meta_fields as $field ) {
      // get value of this field if it exists for this post
      $meta = get_post_meta($post->ID, $field['id'], true);
      // begin a table row with
      echo '<tr>
              <th><label for="'.$field['id'].'">'.$field['label'].'</label></th>
              <td>';
              switch($field['type']) {
                  // text
                  case 'text':
                      echo '<input class="regular-text" name="'.$field['id'].'" id="'.$field['id'].'" value="'.$meta.'" /> <button id="homepage-button-media" type="button" class="button button-default button-media" data-target-input="#'.$field['id'].'" data-buttonName="Select Media">Browse</button>
                          <br /><span class="description">'.$field['desc'].'</span>';
                  break;

                  // textarea
                  case 'textarea':
                      echo '<input class="regular-text" name="'.$field['id'].'" id="'.$field['id'].'" value="'.$meta.'" /> <button id="homepage-button-media" type="button" class="button button-default button-media" data-target-input="#'.$field['id'].'" data-buttonName="Select Media">Browse</button>
                          <br /><span class="description">'.$field['desc'].'</span>';
                  break;
              } //end switch
      echo '</td></tr>';
  } // end foreach
  echo '</table>'; // end table
}

function wp_bootstrap_show_standard_meta_box() {
  global $custom_standard_meta_fields, $post;

  // Use nonce for verification
  wp_nonce_field( basename( __FILE__ ), 'wpbs_nonce' );

  // Begin the field table and loop
  echo '<table class="form-table">';

  foreach ( $custom_standard_meta_fields as $field ) {
      // get value of this field if it exists for this post
      $meta = get_post_meta($post->ID, $field['id'], true);
      // begin a table row with
      echo '<tr>
              <th><label for="'.$field['id'].'">'.$field['label'].'</label></th>
              <td>';
              switch($field['type']) {
                  // text
                  case 'text':
                      echo '<input class="regular-text" name="'.$field['id'].'" id="'.$field['id'].'" value="'.$meta.'" /> <button id="standard-button-media" type="button" class="button button-default button-media" data-target-input="#'.$field['id'].'" data-buttonName="Select Media">Browse</button>
                          <br /><span class="description">'.$field['desc'].'</span>';
                  break;

                  // textarea
                  case 'textarea':
                      echo '<textarea class="textarea" style="width:100%" name="'.$field['id'].'" id="'.$field['id'].'" >'.$meta.'</textarea>
                          <br /><span class="description">'.$field['desc'].'</span>';
                  break;
              } //end switch
      echo '</td></tr>';
  } // end foreach
  echo '</table>'; // end table
}

function wp_bootstrap_show_event_meta_box()
{
  global $custom_event_meta_fields, $post;
  // Use nonce for verification
  wp_nonce_field( basename( __FILE__ ), 'wpbs_nonce' );

  // Begin the field table and loop
  echo '<table class="form-table">';

  foreach ( $custom_event_meta_fields as $field ) {
      // get value of this field if it exists for this post
      $meta = get_post_meta($post->ID, $field['id'], true);
      // begin a table row with
      echo '<tr>
              <th><label for="'.$field['id'].'">'.$field['label'].'</label></th>
              <td>';
              switch($field['type']) {
                  // text
                  case 'text':
                      echo '<input class="regular-text" name="'.$field['id'].'" id="'.$field['id'].'" value="'.$meta.'" /><br /><span class="description">'.$field['desc'].'</span>';
                  break;

                  // textarea
                  case 'textarea':
                      echo '<textarea class="textarea" style="width:100%" name="'.$field['id'].'" id="'.$field['id'].'" >'.$meta.'</textarea><br /><span class="description">'.$field['desc'].'</span>';
                  break;
              } //end switch
      echo '</td></tr>';
  } // end foreach
  echo '</table>'; // end table
}

// Save the Data
function wp_bootstrap_save_homepage_meta( $post_id ) {

    global $custom_meta_fields, $custom_standard_meta_fields, $custom_event_meta_fields;

    // verify nonce
    if ( !isset( $_POST['wpbs_nonce'] ) || !wp_verify_nonce($_POST['wpbs_nonce'], basename(__FILE__)) )
        return $post_id;

    // check autosave
    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE )
        return $post_id;

    // check permissions
    if ( 'page' == $_POST['post_type'] ) {
        if ( !current_user_can( 'edit_page', $post_id ) )
            return $post_id;
        } elseif ( !current_user_can( 'edit_post', $post_id ) ) {
            return $post_id;
    }

    // loop through fields and save the data
    foreach ( $custom_meta_fields as $field ) {
        $old = get_post_meta( $post_id, $field['id'], true );
        $new = $_POST[$field['id']];

        if ($new && $new != $old) {
            update_post_meta( $post_id, $field['id'], $new );
        } elseif ( '' == $new && $old ) {
            delete_post_meta( $post_id, $field['id'], $old );
        }
    } // end foreach

    foreach ( $custom_standard_meta_fields as $field ) {
        $old = get_post_meta( $post_id, $field['id'], true );
        $new = $_POST[$field['id']];

        if ($new && $new != $old) {
            update_post_meta( $post_id, $field['id'], $new );
        } elseif ( '' == $new && $old ) {
            delete_post_meta( $post_id, $field['id'], $old );
        }
    } // end foreach

    foreach ( $custom_event_meta_fields as $field ) {
        $old = get_post_meta( $post_id, $field['id'], true );
        $new = $_POST[$field['id']];

        if ($new && $new != $old) {
            update_post_meta( $post_id, $field['id'], $new );
        } elseif ( '' == $new && $old ) {
            delete_post_meta( $post_id, $field['id'], $old );
        }
    } // end foreach
}
add_action( 'save_post', 'wp_bootstrap_save_homepage_meta' );

// Add thumbnail class to thumbnail links
function wp_bootstrap_add_class_attachment_link( $html ) {
    $postid = get_the_ID();
    $html = str_replace( '<a','<a class="thumbnail"',$html );
    return $html;
}
add_filter( 'wp_get_attachment_link', 'wp_bootstrap_add_class_attachment_link', 10, 1 );

// Add lead class to first paragraph
function wp_bootstrap_first_paragraph( $content ){
    global $post;

    // if we're on the homepage, don't add the lead class to the first paragraph of text
    if( is_page_template( 'page-homepage.php' ) )
        return $content;
    else
        return preg_replace('/<p([^>]+)?>/', '<p$1 class="lead">', $content, 1);
}
add_filter( 'the_content', 'wp_bootstrap_first_paragraph' );

// Menu output mods
class Bootstrap_walker extends Walker_Nav_Menu{

  function start_el(&$output, $object, $depth = 0, $args = Array(), $current_object_id = 0){

	 global $wp_query;
	 $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

	 $class_names = $value = '';

		// If the item has children, add the dropdown class for bootstrap
		if ( $args->has_children ) {
			$class_names = "dropdown ";
		}

		$classes = empty( $object->classes ) ? array() : (array) $object->classes;

		$class_names .= join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $object ) );
		$class_names = ' class="'. esc_attr( $class_names ) . '"';

   	$output .= $indent . '<li id="menu-item-'. $object->ID . '"' . $value . $class_names .'>';

   	$attributes  = ! empty( $object->attr_title ) ? ' title="'  . esc_attr( $object->attr_title ) .'"' : '';
   	$attributes .= ! empty( $object->target )     ? ' target="' . esc_attr( $object->target     ) .'"' : '';
   	$attributes .= ! empty( $object->xfn )        ? ' rel="'    . esc_attr( $object->xfn        ) .'"' : '';
   	$attributes .= ! empty( $object->url )        ? ' href="'   . esc_attr( $object->url        ) .'"' : '';

   	// if the item has children add these two attributes to the anchor tag
   	if ( $args->has_children ) {
		  $attributes .= ' class="dropdown-toggle" data-toggle="dropdown"';
    }

    $item_output = $args->before;
    $item_output .= '<a'. $attributes .'>';
    $item_output .= $args->link_before .apply_filters( 'the_title', $object->title, $object->ID );
    $item_output .= $args->link_after;

    // if the item has children add the caret just before closing the anchor tag
    if ( $args->has_children ) {
    	$item_output .= '<b class="caret"></b></a>';
    }
    else {
    	$item_output .= '</a>';
    }

    $item_output .= $args->after;

    $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $object, $depth, $args );
  } // end start_el function

  function start_lvl(&$output, $depth = 0, $args = Array()) {
    $indent = str_repeat("\t", $depth);
    $output .= "\n$indent<ul class=\"dropdown-menu\">\n";
  }

	function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ){
    $id_field = $this->db_fields['id'];
    if ( is_object( $args[0] ) ) {
        $args[0]->has_children = ! empty( $children_elements[$element->$id_field] );
    }
    return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
  }
}

add_editor_style('editor-style.css');

function wp_bootstrap_add_active_class($classes, $item) {
	if( $item->menu_item_parent == 0 && in_array('current-menu-item', $classes) ) {
    $classes[] = "active";
	}

  return $classes;
}

// Add Twitter Bootstrap's standard 'active' class name to the active nav link item
add_filter('nav_menu_css_class', 'wp_bootstrap_add_active_class', 10, 2 );

// enqueue styles
if( !function_exists("wp_bootstrap_theme_styles") ) {
    function wp_bootstrap_theme_styles() {
        // This is the compiled css file from LESS - this means you compile the LESS file locally and put it in the appropriate directory if you want to make any changes to the master bootstrap.css.
        wp_register_style( 'bootstrap', get_template_directory_uri() . '/vendor/bootstrap/dist/css/bootstrap.min.css', array(), '3.3.1', 'all' );
        wp_enqueue_style( 'bootstrap' );

        wp_register_style( 'animate', get_template_directory_uri() . '/vendor/animate.css/animate.min.css', array(), '1.0.0', 'all' );
        wp_enqueue_style( 'animate' );

        wp_register_style( 'bootstrap-sweetalert', get_template_directory_uri() . '/vendor/bootstrap-sweetalert/lib/sweet-alert.css', array(), '0.4.5', 'all' );
        wp_enqueue_style( 'bootstrap-sweetalert' );

        wp_register_style( 'md-icons', get_template_directory_uri() . '/vendor/material-design-iconic-font/dist/css/material-design-iconic-font.min.css', array(), '0.4.5', 'all' );
        wp_enqueue_style( 'md-icons' );

        wp_register_style( 'owl-carousel', get_template_directory_uri() . '/vendor/owl-carousel/dist/css/owl.carousel.css', array(), '0.4.5', 'all' );
        wp_enqueue_style( 'owl-carousel' );

        wp_register_style( 'app-1', get_stylesheet_directory_uri() . '/css/app.min.1.css', array(), '1.0', 'all' );
        wp_enqueue_style( 'app-1' );
        wp_register_style( 'app-2', get_stylesheet_directory_uri() . '/css/app.min.2.css', array(), '1.0', 'all' );
        wp_enqueue_style( 'app-2' );

        // For child themes
        wp_register_style( 'custom', get_stylesheet_directory_uri() . '/custom.css', array(), '1.0.0.1', 'all' );
        wp_enqueue_style( 'custom' );

        wp_register_style( 'homepage-video', get_stylesheet_directory_uri() . '/css/homepage-video.css', array(), '1.0.0.1', 'all' );
        wp_enqueue_style( 'homepage-video' );

        wp_register_style( 'style', get_stylesheet_directory_uri() . '/style.css', array(), '1.0.0.1', 'all' );
        // wp_enqueue_style( 'style' );
    }
}
add_action( 'wp_enqueue_scripts', 'wp_bootstrap_theme_styles' );

// enqueue javascript
if( !function_exists( "wp_bootstrap_theme_js" ) ) {
  function wp_bootstrap_theme_js(){

    if ( !is_admin() ){
      if ( is_singular() AND comments_open() AND ( get_option( 'thread_comments' ) == 1) )
        wp_enqueue_script( 'comment-reply' );
    }

    // This is the full Bootstrap js distribution file. If you only use a few components that require the js files consider loading them individually instead
    wp_register_script( 'modernizr',
      get_template_directory_uri() . '/vendor/modernizer/modernizr.js',
      array('jquery'),
      '1.2', true );

    wp_register_script( 'jquery-version-2.1.1',
      get_template_directory_uri() . '/vendor/jquery/dist/jquery.min.js',
      array('jquery'),
      '1.2', true );

    wp_register_script( 'jquery-nicescroll',
      get_template_directory_uri() . '/vendor/jquery.nicescroll/dist/jquery.nicescroll.min.js',
      array('jquery'),
      '1.2', true );
    wp_register_script( 'jquery-easing',
      get_template_directory_uri() . '/vendor/jquery-easing/jquery.easing.min.js',
      array('jquery'),
      '1.2', true );

    wp_register_script( 'bootstrap',
      get_template_directory_uri() . '/vendor/bootstrap/dist/js/bootstrap.min.js',
      array('jquery'),
      '1.2', true );

    wp_register_script( 'owl-carousel',
      get_template_directory_uri() . '/vendor/owl-carousel/dist/js/owl.carousel.min.js',
      array('jquery'),
      '1.2', true );

    wp_register_script( 'waves',
      get_template_directory_uri() . '/vendor/Waves/dist/waves.min.js',
      array('jquery'),
      '1.2', true );

    wp_register_script( 'functions',
      get_template_directory_uri() . '/js/functions.js',
      array('jquery'),
      '1.0.0', true );

    wp_register_script( 'gmaps',
      get_template_directory_uri() . '/js/gmaps.js',
      array('jquery'),
      '1.0.0', true );
    wp_register_script( 'gmap-api',
      'http://maps.google.com/maps/api/js?sensor=true',
      array('jquery'),
      '1.0.0', true );

    wp_enqueue_script( 'jquery-version-2.1.1' );
    wp_enqueue_script( 'jquery-nicescroll' );
    wp_enqueue_script( 'jquery-easing' );
    wp_enqueue_script( 'bootstrap' );
    wp_enqueue_script( 'modernizr' );
    wp_enqueue_script( 'owl-carousel' );
    wp_enqueue_script( 'waves' );
    wp_enqueue_script( 'gmaps' );
    wp_enqueue_script( 'gmap-api' );
    wp_enqueue_script( 'functions' );

  }
}
add_action( 'wp_enqueue_scripts', 'wp_bootstrap_theme_js' );

// enqueue admin scripts
function enqueue_admin_scripts($hook) {
    if ( 'post.php' != $hook ) {
        return;
    }

    wp_enqueue_script( 'admin_custom_script', get_template_directory_uri() . '/js/admin-scripts.js' );
}
add_action( 'admin_enqueue_scripts', 'enqueue_admin_scripts' );

// Get <head> <title> to behave like other themes
function wp_bootstrap_wp_title( $title, $sep ) {
  global $paged, $page;

  if ( is_feed() ) {
    return $title;
  }

  // Add the site name.
  $title .= get_bloginfo( 'name' );

  // Add the site description for the home/front page.
  $site_description = get_bloginfo( 'description', 'display' );
  if ( $site_description && ( is_home() || is_front_page() ) ) {
    $title = "$title $sep $site_description";
  }

  // Add a page number if necessary.
  if ( $paged >= 2 || $page >= 2 ) {
    $title = "$title $sep " . sprintf( __( 'Page %s', 'wpbootstrap' ), max( $paged, $page ) );
  }

  return $title;
}
add_filter( 'wp_title', 'wp_bootstrap_wp_title', 10, 2 );

// Related Posts Function (call using wp_bootstrap_related_posts(); )
function wp_bootstrap_related_posts() {
  echo '<ul id="bones-related-posts">';
  global $post;
  $tags = wp_get_post_tags($post->ID);
  if($tags) {
    foreach($tags as $tag) { $tag_arr .= $tag->slug . ','; }
        $args = array(
          'tag' => $tag_arr,
          'numberposts' => 5, /* you can change this to show more */
          'post__not_in' => array($post->ID)
      );
        $related_posts = get_posts($args);
        if($related_posts) {
          foreach ($related_posts as $post) : setup_postdata($post); ?>
              <li class="related_post"><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></li>
          <?php endforeach; }
      else { ?>
            <li class="no_related_post">No Related Posts Yet!</li>
    <?php }
  }
  wp_reset_query();
  echo '</ul>';
}

// Numeric Page Navi (built into the theme by default)
function wp_bootstrap_page_navi($before = '', $after = '') {
  global $wpdb, $wp_query;
  $request = $wp_query->request;
  $posts_per_page = intval(get_query_var('posts_per_page'));
  $paged = intval(get_query_var('paged'));
  $numposts = $wp_query->found_posts;
  $max_page = $wp_query->max_num_pages;
  if ( $numposts <= $posts_per_page ) { return; }
  if(empty($paged) || $paged == 0) {
    $paged = 1;
  }
  $pages_to_show = 7;
  $pages_to_show_minus_1 = $pages_to_show-1;
  $half_page_start = floor($pages_to_show_minus_1/2);
  $half_page_end = ceil($pages_to_show_minus_1/2);
  $start_page = $paged - $half_page_start;
  if($start_page <= 0) {
    $start_page = 1;
  }
  $end_page = $paged + $half_page_end;
  if(($end_page - $start_page) != $pages_to_show_minus_1) {
    $end_page = $start_page + $pages_to_show_minus_1;
  }
  if($end_page > $max_page) {
    $start_page = $max_page - $pages_to_show_minus_1;
    $end_page = $max_page;
  }
  if($start_page <= 0) {
    $start_page = 1;
  }

  echo $before.'<ul class="pagination">'."";
  if ($paged > 1) {
    $first_page_text = "&laquo";
    echo '<li class="prev"><a href="'.get_pagenum_link().'" title="' . __('First','wpbootstrap') . '">'.$first_page_text.'</a></li>';
  }

  $prevposts = get_previous_posts_link( __('&larr; Previous','wpbootstrap') );
  if($prevposts) { echo '<li>' . $prevposts  . '</li>'; }
  else { echo '<li class="disabled"><a href="#">' . __('&larr; Previous','wpbootstrap') . '</a></li>'; }

  for($i = $start_page; $i  <= $end_page; $i++) {
    if($i == $paged) {
      echo '<li class="active"><a href="#">'.$i.'</a></li>';
    } else {
      echo '<li><a href="'.get_pagenum_link($i).'">'.$i.'</a></li>';
    }
  }
  echo '<li class="">';
  next_posts_link( __('Next &rarr;','wpbootstrap') );
  echo '</li>';
  if ($end_page < $max_page) {
    $last_page_text = "&raquo;";
    echo '<li class="next"><a href="'.get_pagenum_link($max_page).'" title="' . __('Last','wpbootstrap') . '">'.$last_page_text.'</a></li>';
  }
  echo '</ul>'.$after."";
}

// Remove <p> tags from around images
function wp_bootstrap_filter_ptags_on_images( $content ){
  return preg_replace( '/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content );
}
add_filter( 'the_content', 'wp_bootstrap_filter_ptags_on_images' );


// Custom Post Types
require_once "library/testimonial-custom-post-type.php";


// Enable span tags in the Editor
function ssaThreeZeroExtensionTinyMCE($init) {
    // Command separated string of extended elements
    $ext = 'span[id|name|class|style]';

    // Add to extended_valid_elements if it alreay exists
    if ( isset( $init['extended_valid_elements'] ) ) {
        $init['extended_valid_elements'] .= ',' . $ext;
    } else {
        $init['extended_valid_elements'] = $ext;
    }

    // Super important: return $init!
    return $init;
}

add_filter('tiny_mce_before_init', 'ssaThreeZeroExtensionTinyMCE' );

function get_the_post_thumbnail_url_raw()
{
    global $post;
    return wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
}

// Add Categories to Pages
function ssa_add_metaboxes_to_pages() {
    // Add tag metabox to page
    // register_taxonomy_for_object_type('post_tag', 'page');
    // Add category metabox to page
    register_taxonomy_for_object_type('category', 'page');
}
 // Add to the admin_init hook of your theme functions.php file
add_action( 'init', 'ssa_add_metaboxes_to_pages' );


function the_copyright($dateNow)
{ ?>
    <span class="sitename"><?php bloginfo( 'name' ); ?></span> &copy; <?php _e('Copyright', 'blanket'); ?> <?php echo $dateNow; ?> <?php if(date('Y') !== $dateNow){ echo "- " . date('Y');} ?>.<?php
}

function get_pagination_bar($q) {

    $total_pages = $q->max_num_pages;

    if ($total_pages > 1){
        $current_page = max(1, get_query_var('paged'));

        $return =  paginate_links(array(
            'base' => get_pagenum_link(1) . '%_%',
            'format' => '/page/%#%',
            'current' => $current_page,
            'total' => $total_pages,
            'type'=>'list',
            'prev_text'          => __('Previous'),
            'next_text'          => __('Next'),
        ));
        return str_replace( "<ul class='page-numbers'>", '<ul>', $return );
    }
}

function add_custom_class_on_nav_menu($classes=array(), $menu_item=false) {
    if ( !is_page() && 'Blog' == $menu_item->title &&
            !in_array( 'current-menu-item', $classes ) ) {
        $classes[] = 'current-menu-item active';
    }
    return $classes;
}
add_filter('nav_menu_css_class', 'add_custom_class_on_nav_menu', 100, 2);

// Diable Self-Pinging
function disable_self_ping( &$links ) {
    foreach ( $links as $l => $link )
        if ( 0 === strpos( $link, get_option( 'home' ) ) )
            unset($links[$l]);
}
add_action( 'pre_ping', 'disable_self_ping' );

function change_comment_classes( $classes ) {
    // Classes is an array of class names, so for each item - $array_key => $class_name
    // foreach( $classes as $key => $class ) {
    //     // Check the class name
    //     switch( $class ) {
    //         // If the the class name is comment, move along
    //         case 'comment':
    //             continue;
    //         // If it's anything else, unset the item from the array (change)
    //         default:
    //             unset( $classes[$key] );
    //             continue;
    //         break;
    //     }
    // }
    // Clean out the variables no longer needed
    // unset($key,$class);

    // Return the result
    $classes[] = 'comment-item';
    return $classes;
}
add_filter( 'comment_class' , 'change_comment_classes' );

add_filter( 'comment_form_defaults', 'edit_comment_form_notes' );
function edit_comment_form_notes($fields) {
    $fields['comment_notes_before'] = '<p class="comment-notes before">Your email address will not be published.</p>'; // Removes comment before notes
    $fields['comment_notes_after'] = ''; // Removes comment after notes
    return $fields;
}

// Move Comment Textarea at bottom
function move_comment_field_to_bottom( $fields ) {
    $comment_field = $fields['comment'];
    unset( $fields['comment'] );
    $fields['comment'] = $comment_field;
    return $fields;
}
add_filter( 'comment_form_fields', 'move_comment_field_to_bottom' );

// Comments Validation
// function ssa_validate_comment_url() {
//     if( !empty( $_POST['url'] ) && !preg_match( '\b(https?|ftp|file)://[-A-Z0-9+&@#/%?=~_|!:,.;]*[-A-Z0-9+&@#/%=~_|]', $_POST['url'])
//         wp_die( __('Error: please enter a valid url or leave the homepage field empty') );
// }

// add_action('pre_comment_on_post', 'ssa_validate_comment_url');