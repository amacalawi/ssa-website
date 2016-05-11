<?php
/**
 * Template Name: About Page Template
 */
 ?>
<?php
get_header();
$banner_class = $post->post_type == "page" ? $post->post_name : $post->post_type;
$banner_class = is_page('home') ? 'homepage' : $banner_class; ?>
<section id="banner" class="about_us_banner banner bg" data-bg="<?php echo get_the_post_thumbnail_url_raw() ?>">
    <div class="about-us-banner-holder">
        <div class="container">
            <div class="row">
                <div class="col-sm-8">
                    <h3 class="tcolor"><em><strong><?php the_title() ?></strong></em></h3>
                    <?php echo wpautop($post->post_content); ?>
                </div><div class="clearfix"></div>
            </div>
        </div>
    </div>
    <div class="bottom_right_slanted"></div>
</section>

<?php
$children = get_posts(array(
    'post_type' => 'page',
    'order' => 'ASC',
    'orderby' => 'menu_order',
    'post_parent' => get_the_ID(),
    'posts_per_page' => -1,
    'taxonomy' => 'category',
    'field' => 'slug',
    'term' => 'key-executives',
));
foreach ($children as $post) {
    setup_postdata($post); ?>
    <section class="executives" id="executives">

        <div class="col-sm-4">
            <h1 class="text-right"><em><strong><?php the_title() ?></strong></em></h1>
            <div class="border-right-straight"></div>
        </div>

        <div class="col-sm-8 content-right">
            <?php
            $children = get_posts(array(
                'post_type' => 'page',
                'order' => 'ASC',
                'orderby' => 'menu_order',
                'post_parent' => get_the_ID(),
                'posts_per_page' => -1,
            ));
            foreach ($children as $post) {
                setup_postdata($post); ?>
                <div class="info">
                    <div class="col-sm-offset-1 col-sm-3 text-right">
                        <img src="<?php echo get_the_post_thumbnail_url_raw() ?>" alt="<?php the_title() ?>" title="<?php the_title() ?>" />
                    </div>
                    <div class="col-sm-8">
                        <h5 class="tcolor"><strong><em><?php the_title() ?></em></strong></h5>
                        <p class="designation"><?php echo do_shortcode($post->post_content) ?></p>
                        <!-- <p class="social">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-linkedin"></i></a>
                        </p> -->
                    </div><div class="clearfix"></div>
                </div>
                <?php
            } ?>
        </div>
        <div class="bottom_right_slanted"></div>
    </section>
<?php
} wp_reset_postdata(); ?>

<?php
$children = get_posts(array(
    'post_type' => 'page',
    'order' => 'ASC',
    'orderby' => 'menu_order',
    'post_parent' => get_the_ID(),
    'posts_per_page' => -1,
    'taxonomy' => 'category',
    'field' => 'slug',
    'term' => 'mission-vision',
));
foreach ($children as $post) {
    setup_postdata($post); ?>
    <section class="mission-vision bg" data-bg="<?php echo get_the_post_thumbnail_url_raw() ?>">
        <div class="black-overlay"></div>
        <div class="top-content">
            <div class="col-sm-6">

            </div>
            <div class="col-sm-6">
                <h1 class="tcolor"><strong><em>Our Mission</em></strong></h1>

                <p class="col-sm-10 wcolor">
                    Provide strategic and creative solutions to our clients’ business challenges.
                </p>
                <p class="col-sm-10 wcolor">
                    Provide quality and innovative human capital development programmes.
                </p>
                <p class="col-sm-10 wcolor">
                    Pursue a win-win approach in our partnership with clients, partners, associates, employees and other stakeholders.
                </p>
            </div>
        </div>
        <div class="bottom-content">
            <div class="col-sm-6">
                <h1 class="tcolor text-right"><strong><em>Our Vision</em></strong></h1>
                <p class="col-sm-offset-2 col-sm-10 wcolor text-right">
                    To be a premier advisory and human capital development organization well recognized for its distinctive and world-class services.
                </p>
            </div>
            <div class="col-sm-6">
            </div>
        </div>
        <div class="bottom_right_slanted"></div>
    </section>
<?php
} wp_reset_postdata(); ?>


<?php
$children = get_posts(array(
    'post_type' => 'page',
    'order' => 'ASC',
    'orderby' => 'menu_order',
    'post_parent' => get_the_ID(),
    'posts_per_page' => -1,
    'taxonomy' => 'category',
    'field' => 'slug',
    'term' => 'values',
));
foreach($children as $post) {
    setup_postdata($post); ?>
    <section class="values bg bg-default" id="values" data-bg="<?php echo get_the_post_thumbnail_url_raw(); ?>">

        <div class="col-sm-4">
            <h1 class="text-right"><em><strong><?php the_title() ?></strong></em></h1>
            <div class="border-right-straight"></div>
            <?php
            $children = get_posts(array(
                'post_type' => 'page',
                'order' => 'ASC',
                'orderby' => 'menu_order',
                'post_parent' => get_the_ID(),
                'posts_per_page' => -1,
            )); $active=1; ?>
            <div class="drives">
                <ul>
                    <?php
                    foreach ($children as $post) {
                        setup_postdata($post); ?>
                        <li class="<?php echo $active ? 'active' : ''; $active=0; ?>">
                            <a href="#drives_<?php echo $post->post_name ?>">
                                <em class="fadeInRight animated"><?php echo substr(get_the_title(), 0, 1); ?></em>
                                <span class="fadeInRight animated"><?php echo substr(get_the_title(), 1); ?></span>
                            </a>
                        </li>
                        <?php
                    } ?>
                </ul>
            </div>
        </div>

        <div class="col-sm-8 content-right">
            <div class="info">
                <div class="col-sm-offset-1 col-sm-6">
                    <?php foreach($children as $post) {
                        ?>
                        <p class="drives-content" id="drives_<?php echo $post->post_name ?>">
                            <?php echo do_shortcode($post->post_content) ?>
                        </p>
                        <?php
                    } ?>
                </div>
                <div class="clearfix"></div>
            </div>


        </div><!--col-sm-7-->
        <div class="bottom_right_slanted"></div>
    </section>
<?php
} wp_reset_postdata(); ?>

<section class="milestones">
    <div class="black-overlay"></div>
    <div class="milestone-content">
        <?php
        $custom_terms = get_terms('milestone_cat');
        foreach($custom_terms as $custom_term) {
            wp_reset_query();
            $args = array('post_type' => 'milestones',
                'tax_query' => array(
                    array(
                        'taxonomy' => 'milestone_cat',
                        'field' => 'slug',
                        'terms' => $custom_term->slug,
                    ),
                ),
            );

            $loop = new WP_Query($args);
            if($loop->have_posts()) {
                $i=1; ?>
                <div class="item milestone-<?php echo $custom_term->name ?>">
                    <ul class="timeline">
                        <?php
                        while($loop->have_posts()) : $loop->the_post(); ?>
                            <li <?php echo $i%2==0?'class="invert"':''; $i++; ?> >
                                <spans class="badges"></spans>
                                <h2 class="tcolor sr-only"><?php the_title(); ?></h2>
                                <?php echo do_shortcode($post->post_content); ?>
                            </li><?php
                        endwhile; ?>
                    </ul>
                </div><?php
            }
        } ?>
    </div>
    <div class="milestone-year">
        <?php
        foreach($custom_terms as $custom_term) {
            ?>
            <div class="item">
                <h4><?php echo $custom_term->name ?></h4>
            </div>
            <?php
        } wp_reset_query(); ?>
    </div>
</section>


<?php get_footer(); ?>