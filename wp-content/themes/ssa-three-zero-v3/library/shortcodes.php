<?php

// shortcodes


// Buttons
function buttons( $atts, $content = null ) {
	extract( shortcode_atts( array(
	'class' => 'link1', /* primary, default, info, success, danger, warning, inverse */
	'size' => '', /* mini, small, default, large */
	'url'  => '',
	'text' => '',
	'role' => 'button',
	'icon' => '',
	'id' => '',
	), $atts ) );

	$output = '<a id="'.$id.'" role="'.$role.'" href="' . $url . '" class="btn waves-effect link '. $class . '">';
	$output .= null !== $icon ? '<i class="'.$icon.'">&nbsp;</i>' : '';
	$output .= $text;
	$output .= '</a>';

	return $output;
}

add_shortcode('button', 'buttons');

// Alerts
function alerts( $atts, $content = null ) {
	extract( shortcode_atts( array(
	'type' => 'alert-info', /* alert-info, alert-success, alert-error */
	'close' => 'false', /* display close link */
	'text' => '',
	), $atts ) );

	$output = '<div class="fade in alert alert-'. $type . '">';
	if($close == 'true') {
		$output .= '<a class="close" data-dismiss="alert">×</a>';
	}
	$output .= $text . '</div>';

	return $output;
}

add_shortcode('alert', 'alerts');

// Block Messages
function block_messages( $atts, $content = null ) {
	extract( shortcode_atts( array(
	'type' => 'alert-info', /* alert-info, alert-success, alert-error */
	'close' => 'false', /* display close link */
	'text' => '',
	), $atts ) );

	$output = '<div class="fade in alert alert-block alert-'. $type . '">';
	if($close == 'true') {
		$output .= '<a class="close" data-dismiss="alert">×</a>';
	}
	$output .= '<p>' . $text . '</p></div>';

	return $output;
}

add_shortcode('block-message', 'block_messages');

// Block Messages
function blockquotes( $atts, $content = null ) {
	extract( shortcode_atts( array(
	'float' => '', /* left, right */
	'cite' => '', /* text for cite */
	), $atts ) );

	$output = '<blockquote';
	if($float == 'left') {
		$output .= ' class="pull-left"';
	}
	elseif($float == 'right'){
		$output .= ' class="pull-right"';
	}
	$output .= '><p>' . $content . '</p>';

	if($cite){
		$output .= '<small>' . $cite . '</small>';
	}

	$output .= '</blockquote>';

	return $output;
}

add_shortcode('blockquote', 'blockquotes');

// Testimonials
function testimonials( $atts, $content = null ) {
	extract( shortcode_atts( array(
	'order' => 'menu_order',
	'sort' => 'ASC',
	), $atts ) );

	$records = new WP_Query( array( 'post_type' => 'testimonials', 'post_status' => 'publish', 'sort_column' => $order, 'sort_order' => $sort ) );
	ob_start();
	$options = get_option('testimonials_settings');
	require "views/testimonials/index.php";
	wp_reset_query();  // Restore global post data stomped by the_post().
	return ob_get_clean();
}
add_shortcode('testimonials', 'testimonials');

// Social links
function social_links( $atts, $content = null ) {
	$a = shortcode_atts( array(
		'facebook' => '',
		'twitter' => '',
		'linkedin' => '',
		'instagram' => '',
		'youtube' => '',
	), $atts );

	ob_start(); ?>
	<p class="social"><?php
	foreach ($a as $key => $value) {
		if('' !== $value) { ?>
            <a target="_blank" href="<?php echo $value ?>"><i class="fa fa-<?php echo $key ?>"></i><span class="sr-only"><?php echo ucwords($key); ?></span></a>
        <?php
		}
	} ?>
	</p><?php
	return ob_get_clean();
}
add_shortcode('social_links', 'social_links');