<?php
/**
 * Template Name: About Page Template
 */
 ?>

<?php get_header() ?>
    <div class="overlay-pattern0"></div>

    <div class="<?php echo $post->post_name ?>-banner-holder">
        <div class="col-sm-8 white-bg"></div>
        <div class="clearfix"></div>

        <div class="container">
            <div class="row">
                <div class="col-sm-8">
                    <h3><em><strong><?php the_title() ?></strong></em></h3>
                    <h1><strong><em><span class="tcolor">SSA</span> Consulting Group</em></strong></h1>
                    <p class="col-sm-offset-3 col-sm-8">
                        SSA Consulting Group (SSA) is an umbrella corporation providing professional services, for nearly three decades, in the areas of training, management consulting, public accounting, estate planning.

                    </p>
                    <p class="col-sm-offset-3 col-sm-8">
                        SSA has been consistently ranked among the top 1,000 SMEs in Singapore (2011-2014). To date, we have consulted for more than 200 companies, business enterprises and non-profit organisations and trained more than 100,000 members of Singapore's workforce.
                    </p>
                </div><div class="clearfix"></div>
            </div>
        </div>
    </div>
    <div class="bottom_left_slanted"></div>
</section><!-- End Header Section Banner -->

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
    <section class="<?php echo $post->post_name ?>" id="<?php echo $post->post_name ?>">
        <a name="<?php echo $post->post_name ?>" class="sr-only"><?php the_title() ?></a>
        <div class="col-sm-5">
            <h1 class="text-right"><em><strong><?php the_title() ?></strong></em></h1>
            <?php the_content(); ?>
            <div class="border-right-straight"></div>
        </div>
        <div class="col-sm-7 content-right">
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
                        <img src="<?php echo get_the_post_thumbnail_url_raw() ?>" alt="<?php the_title() ?>">
                    </div>
                    <div class="col-sm-8">
                        <h5 class="tcolor"><strong><em><?php the_title() ?></em></strong></h5>
                        <p class="designation"><?php echo do_shortcode($post->post_content) ?></p>
                    </div><div class="clearfix"></div>
                </div>
                <?php
            } ?>
        </div>
        <div class="bottom_left_slanted"></div>
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
    <section class="<?php echo $post->post_name ?> bg" id="<?php echo $post->post_name ?>" data-bg="<?php echo get_the_post_thumbnail_url_raw() ?>">
        <a name="<?php echo $post->post_name ?>" class="sr-only"><?php the_title() ?></a>
        <div class="overlay-pattern0"></div>
        <?php
        $parent_id = get_the_ID();
        $children = get_posts(array(
            'post_type' => 'page',
            'order' => 'ASC',
            'orderby' => 'menu_order',
            'post_parent' => $parent_id,
            'posts_per_page' => 1,
        ));
        foreach ($children as $post) {
            setup_postdata($post); ?>
            <div class="top-content">
                <div class="col-sm-7"></div>
                <div class="col-sm-5">
                    <h1 class="tcolor"><strong><em><?php the_title(); ?></em></strong></h1>
                    <div class="col-sm-7 wcolor">
                        <?php echo do_shortcode($post->post_content); ?>
                    </div>
                </div>
            </div>
            <?php
        } wp_reset_postdata(); ?>

        <?php
        $children = get_posts(array(
            'post_type' => 'page',
            'order' => 'ASC',
            'orderby' => 'menu_order',
            'post_parent' => $parent_id,
            'posts_per_page' => 1,
            'offset' => 1,
        ));
        foreach ($children as $post) {
            setup_postdata($post); ?>
            <div class="bottom-content">
                <div class="col-sm-7 wcolor text-right">
                    <h1 class="tcolor text-right"><strong><em><?php the_title() ?></em></strong></h1>
                    <div class="row">
                        <div class="col-sm-offset-6 col-sm-6">
                            <?php the_content() ?>
                        </div>
                    </div>
                </div>
                <div class="col-sm-5"></div>
            </div>
            <?php
        } wp_reset_postdata(); ?>
        <div class="bottom_left_slanted"></div>
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
    <section class="<?php echo $post->post_name ?> bg" id="<?php echo $post->post_name ?>" data-bg="<?php echo get_the_post_thumbnail_url_raw(); ?>">
        <a name="<?php echo $post->post_name ?>" class="sr-only"><?php the_title() ?></a>
        <div class="col-sm-5">
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

        <div class="col-sm-7 content-right">
            <div class="info">
                <div class="col-sm-offset-1 col-sm-5">
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
        <div class="bottom_left_slanted"></div>
    </section>
<?php
} wp_reset_postdata(); ?>

<section class="milestones">
    <a name="milestones" class="sr-only">Milestones</a>
    <div class="overlay-pattern0"></div>
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
                                <h2 class="wcolor sr-only"><?php the_title(); ?></h2>
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