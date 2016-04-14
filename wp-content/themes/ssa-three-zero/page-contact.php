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
    <script>
        var template_url = "<?php echo get_template_directory_uri() ?>";
    </script>
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
        <!-- END HEADER COPY -->

        <div class="col-sm-offset-2 col-sm-10 address-holder">
            <div role="tabpanel">
                <div class="row">
                    <ul class="tab-nav" role="tablist" tabindex="1">
                        <?php
                        $root_page_id = get_the_ID();
                        $args = array(
                            'post_type' => 'page',
                            'order' => 'ASC',
                            'orderby' => 'menu_order',
                            'post_parent' => $root_page_id,
                            'taxonomy' => 'category',
                            'field' => 'slug',
                            'term' => 'tab',
                        );
                        $posts = get_posts($args);
                        $active=1;
                        foreach ($posts as $post) {
                            setup_postdata($post); ?>
                            <li class="<?php echo $active?'active':'';$active=0; ?>">
                                <a onclick="go_<?php echo slugify($post->post_name, 'lower', array('-'=>'_'), "_", "_") ?>()" href="#nav-item-<?php echo get_the_ID(); ?>" role="tab" data-toggle="tab"><?php the_title(); ?></a>
                            </li>
                            <?php
                        } wp_reset_postdata(); ?>
                    </ul>
                    <div class="tab-content">
                        <?php
                        $active=1;
                        foreach ($posts as $post) {
                            setup_postdata($post); ?>
                            <div role="tabpanel" class="wcolor tab-pane <?php echo $active?'active':'';$active=0; ?>" id="nav-item-<?php echo get_the_ID(); ?>">
                                <?php the_content(); ?>
                                <?php /*<!-- Sub tab depth 2 / Tabception -->*/ ?>
                                <?php
                                $child_page_id = get_the_ID();
                                $args = array(
                                    'post_type' => 'page',
                                    'order' => 'ASC',
                                    'orderby' => 'menu_order',
                                    'post_parent' => $child_page_id,
                                    'taxonomy' => 'category',
                                    'field' => 'slug',
                                    'term' => 'tab',
                                );
                                $child_posts = get_posts($args);
                                if($child_posts):
                                $active=1; ?>
                                <ul class="nav nav-tabs <?php echo slugify($post->post_name, 'lower', array('-'=>'_'), "_", "_") ?>" role="tablist"> <?php
                                foreach ($child_posts as $post) {
                                    setup_postdata($post); ?>
                                    <li class="<?php echo $active?'active':'';$active=0; ?>">
                                        <a href="#nav-child-tab-<?php echo get_the_ID() ?>" onclick="go_<?php echo slugify($post->post_name, 'lower', array('-'=>'_'), "_", "_") ?>();" role="tab" data-toggle="tab"><?php the_title() ?></a>
                                    </li>
                                <?php
                                } wp_reset_postdata(); ?>
                                </ul>
                                <div class="tab-content wcolor">
                                    <?php
                                    $active=1;
                                    foreach ($child_posts as $post) {
                                        setup_postdata($post); ?>
                                        <div class="tab-pane fade in <?php echo $active?'active':'';$active=0; ?>" id="nav-child-tab-<?php echo get_the_ID() ?>">
                                            <?php the_content() ?>
                                        </div><?php
                                    } wp_reset_postdata(); ?>
                                </div><?php
                                endif; ?>
                            </div>
                        <?php
                        } wp_reset_postdata(); ?>
                    </div>

                </div><div class="clearfix"></div>
            </div>
        </div><div class="clearfix"></div>


        <div class="bottom_right_slanted"></div>
    </section> <!-- END: from header -->

    <section class="contact-us-content" id="contact-us-content">

        <div class="container">
            <div class="row">
                <div class="col-sm-offset-3 col-sm-8 inside1">
                    <div class="row">
                    <div class="arrow-straight2"></div>
                        <?php the_content() ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="divider-bottom"></div>
        <div class="clearfix"></div>

        <div class="container">
            <div class="row">
                <div class="col-sm-offset-3 col-sm-7 inside2">
                    <div class="row">
                        <?php echo do_shortcode('[mail_form form_class="commenting" label_class="sr-only"]') ?>
                        <!-- <form class="commenting">
                            <div class="form-group">
                                    <input type="text" class="form-control input-lg" placeholder="Name">
                            </div>
                            <div class="form-group">
                                    <input type="text" class="form-control input-lg" placeholder="Email">
                            </div>
                            <div class="form-group">
                                    <textarea class="form-control input-lg" rows="5" placeholder="Message"></textarea>
                            </div>
                            <button type="submit">Submit</button>
                        </form> -->
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php
$bg = get_post_meta( get_the_ID(), 'custom_bg', TRUE );
$tagline = get_post_meta( get_the_ID(), 'custom_tagline', TRUE ); ?>
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

<?php get_footer(); ?>