<?php
/**
 * Template Name: Contact Page Template
 */

get_header(); ?>

<?php
$bg = get_post_meta( get_the_ID(), 'custom_bg', TRUE );
$tagline = get_post_meta( get_the_ID(), 'custom_tagline', TRUE ); ?>
<section id="banner" class="contact_us_banner banner bg" data-bg="<?php echo get_the_post_thumbnail_url_raw() ?>">
    <div class="map-layer">
        <div id="map"></div>
    </div>
    <div class="black-overlay-pattern"></div>

    <div class="col-sm-offset-2 col-sm-10 address-holder">
        <div role="tabpanel">
            <div class="row">
                <ul class="tab-nav" role="tablist" tabindex="1" >
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
                    <?php } wp_reset_postdata(); // endforeach ?>
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
    </div>
    <div class="clearfix"></div>
    <div class="bottom_right_slanted"></div>
</section>

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

<?php if( !empty($tagline) && !empty($bg) ): ?>
<section class="taglines bg" data-bg="<?php echo $bg ?>">
    <div class="black-overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h1 class="tcolor">
                    <strong>
                        <em><?php echo $tagline ?></em>
                    </strong>
                </h1>
            </div>
        </div>
    </div>
    <div class="col-sm-offset-4 col-sm-8 bottom_white_border"></div>
    <div class="clearfix"></div>
</section>
<?php endif; ?>

<?php get_footer() ?>