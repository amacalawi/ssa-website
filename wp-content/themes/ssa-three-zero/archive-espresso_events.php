<?php
/**
 * Template Name: Event List
 *
 * This template will display a list of your events
 *
 * @ package        Event Espresso
 * @ author     Seth Shoultes
 * @ copyright  (c) 2008-2014 Event Espresso  All Rights Reserved.
 * @ license        http://eventespresso.com/support/terms-conditions/   * see Plugin Licensing *
 * @ link           http://www.eventespresso.com
 * @ version        EE4+
 */
?>
<!doctype html>

<!--[if IEMobile 7 ]> <html <?php language_attributes(); ?>class="no-js iem7"> <![endif]-->
<!--[if lt IE 7 ]> <html <?php language_attributes(); ?> class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html <?php language_attributes(); ?> class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html <?php language_attributes(); ?> class="no-js ie8"> <![endif]-->
<!--[if (gte IE 9)|(gt IEMobile 7)|!(IEMobile)|!(IE)]><!-->
<html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title><?php wp_title( '|', true, 'right' ); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

    <!-- wordpress head functions -->
    <?php wp_head(); ?>
    <!-- end of wordpress head -->

    <!-- IE8 fallback moved below head to work properly. Added respond as well. Tested to work. -->
        <!-- media-queries.js (fallback) -->
    <!--[if lt IE 9]>
        <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
    <![endif]-->

    <!-- html5.js -->
    <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- respond.js -->
    <!--[if lt IE 9]>
        <script type='text/javascript' src="http://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.js"></script>
    <![endif]-->
</head>

<body <?php body_class(); ?>>
    <?php
    $events_page = get_page_by_path('events');?>
    <section id="banner" class="banner <?php echo ($events_page->post_type=='page'?$events_page->post_name:$events_page->post_type) ?>_banner bg section" data-bg="<?php echo get_the_post_thumbnail_url_raw($events_page->ID) ?>">
        <nav class="navbar navbar-default navbar-static-top" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" title="<?php echo get_bloginfo('description'); ?>" href="<?php echo home_url(); ?>">
                        <img src="<?php echo get_stylesheet_directory_uri() ?>/img/logo.png" alt="<?php bloginfo('name'); ?>">
                    </a>
                </div>
                <div class="collapse navbar-collapse navbar-responsive-collapse">
                    <?php wp_bootstrap_main_nav(); // Adjust using Menus in Wordpress Admin ?>
                </div>
            </div> <!-- end .container -->
        </nav> <!-- end .navbar -->


        <?php
        $bg = get_post_meta( $events_page->ID, 'custom_bg', TRUE );
        $tagline = get_post_meta( $events_page->ID, 'custom_tagline', TRUE ); ?>
        <div class="overlay-pattern"></div>
        <div class="container">
            <div class="row">
                <div class="col-sm-offset-2 col-sm-8">
                    <div class="row">
                        <h1 class="wcolor title text-center">
                            <strong class="animated flipInX">
                                <em><?php echo $events_page->post_content; ?></em>
                            </strong>
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </section>

<section class="events_content">
    <div id="content" class="site-content" role="main">
        <?php espresso_get_template_part( 'loop', 'espresso_events' ); ?>
    </div><!-- #content -->
</section><!-- #primary -->

<?php if( !empty($tagline) && !empty($bg) ): ?>
<section class="taglines bg" data-bg="<?php echo $bg ?>">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h1 class="tcolor text-center">
                    <strong><em><?php echo $tagline ?></em></strong>
                </h1>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<?php
// get_sidebar( 'content' );
// get_sidebar();
get_footer();