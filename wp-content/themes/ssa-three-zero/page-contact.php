<?php
/**
 * Template Name: Contact Template
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
    <section id="banner" class="banner contact_us_banner bg section">
        <div class="map-layer">
            <div id="map"></div>
        </div>
        <div class="overlay-pattern1"></div>
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


        <div class="col-sm-offset-2 col-sm-10 address-holder">
            <div role="tabpanel">
                <div class="row">
                    <ul class="tab-nav" role="tablist" tabindex="1">
                        <?php
                        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                        $args = array(
                            'post_type' => 'page',
                            'post_parent' => get_the_ID(),
                            'order' => 'ASC',
                            'orderby' => 'menu_order',
                            'posts_per_page'   => -1,
                            'paged' => $paged,
                            'taxonomy' => 'category',
                                'field' => 'slug',
                                'term' => 'tab',
                        );
                        $posts = new WP_Query($args); $i=0; $active=true;
                        while ($posts->have_posts()) : $posts->the_post();
                        ?>
                            <li class="<?php echo $active==1?'active':''; $active=false; ?>">
                                <a href="#tab-nav-<?php echo get_the_ID() ?>" aria-controls="tab-nav-<?php echo get_the_ID() ?>" role="tab" data-toggle="tab" aria-expanded="true"><?php the_title() ?></a>
                            </li>
                        <?php
                        endwhile; wp_reset_query(); ?>
                    </ul>

                    <div class="tab-content tabz-hq">
                        <?php
                        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                        $args = array(
                            'post_type' => 'page',
                            'post_parent' => get_the_ID(),
                            'order' => 'ASC',
                            'orderby' => 'menu_order',
                            'posts_per_page'   => -1,
                            'paged' => $paged,
                            'taxonomy' => 'category',
                            'field' => 'slug',
                            'term' => 'tab',
                        );
                        $posts = new WP_Query($args); $i=0; $active=true;
                        while ($posts->have_posts()) : $posts->the_post();
                        ?>
                            <div role="tabpanel" class="tab-pane <?php echo $active==1?'active':''; $active=false; ?>" id="tab-nav-<?php echo get_the_ID() ?>">
                                <?php the_content() ?>
                                <ul class="nav nav-tabs tabz-office" role="tablist">
                                    <?php
                                    $args = array(
                                        'post_parent' => get_the_ID(),
                                        'post_type'   => 'page',
                                        'post_status' => 'publish',
                                        'taxonomy' => 'category',
                                        'field' => 'slug',
                                        'term' => 'tab',
                                    );
                                    $children = new WP_Query($args); $i=0; $active=true;
                                    while ($children->have_posts()) : $children->the_post();
                                    ?>
                                        <li class="<?php echo $active==1?'active':''; $active=false; ?>">
                                            <a href="#tab-nav-<?php echo get_the_ID() ?>" role="tab" data-toggle="tab"><?php the_title() ?></a>
                                        </li>
                                    <?php
                                    endwhile; wp_reset_postdata(); ?>
                                </ul>
                                <div class="tab-content wcolor">
                                    <?php
                                    $args = array(
                                        'post_parent' => get_the_ID(),
                                        'post_type'   => 'page',
                                        'post_status' => 'publish',
                                        'taxonomy' => 'category',
                                        'field' => 'slug',
                                        'term' => 'tab',
                                    );
                                    $children = new WP_Query($args); $i=0; $active=true;
                                    while ($children->have_posts()) : $children->the_post();
                                    ?>
                                        <div class="tab-pane fade in active" id="tab-nav-<?php echo get_the_ID() ?>">
                                            <?php the_content(); ?>
                                        </div>
                                    <?php
                                    endwhile; wp_reset_postdata(); ?>
                                </div>
                            </div>
                        <?php
                        endwhile; wp_reset_postdata(); ?>

                    </div>
                </div><div class="clearfix"></div>
            </div>
        </div><div class="clearfix"></div>
    </section> <!-- END: from header -->

<?php get_footer(); ?>