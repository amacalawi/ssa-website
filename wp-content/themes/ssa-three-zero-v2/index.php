<?php
/**
 * The main template file.
 *
 * One Loop to rule them all,
 * One Loop to find them,
 * One Loop to bring them all and in the darkness bind them.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package SSA
 * @subpackage Three_Zero
 * @version 2.0.0
 * @since SSA 0.0.1
 */


get_header();

if ( have_posts() ) while ( have_posts() ) : the_post();

    switch ($post->post_type) {
        case 'page':
            /*
            | -------------------------------------------------------------
            | # PAGE
            | -------------------------------------------------------------
            | First attempt is to look for the file
            | in the '_wp_page_template' page meta data.
            | The second attempt, if the first has a file and is not empty,
            | is to look for 'page.php'.
            */
            get_page_template();
            break;
        case 'post':
            /*
            | -------------------------------------------------------------
            | # POST
            | -------------------------------------------------------------
            | Get the post.php
            */
            get_template_part( 'post' );
            break;
        default:
            /*
            | -------------------------------------------------------------
            | # CUSTOM POST TYPE
            | -------------------------------------------------------------
            | Get the template based on the custom_post_type name.
            | Ex. If the CPT is called 'event',
            | retrieve the event.php
            */
            get_template_part( $post->post_type );
            break;
    }

endwhile; // end of the loop.

get_sidebar();



get_footer(); ?>