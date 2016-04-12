<?php
/**
 * Template Name: Slider Page Template
 */
 ?>
<?php get_header(); ?>

    <div class="csr-container">
        <div class="owl-carousel-csr1">
            <?php
            $parent_name = $post->post_name;
            $args = array(
                'post_type' => 'page',
                'order' => 'ASC',
                'orderby' => 'menu_order',
                'post_parent' => get_the_ID(),
                'posts_per_page' => -1,
                'taxonomy' => 'category',
                    'field' => 'slug',
                    'term' => 'slider',
            );
            $posts = new WP_Query($args); $i=0;
            while ($posts->have_posts()) : $posts->the_post(); $i++; ?>

                <div class="item bg" data-bg="<?php echo get_the_post_thumbnail_url_raw() ?>"></div>

            <?php
            endwhile; wp_reset_postdata(); ?>
        </div>

    </div>

    <div class="overlay-pattern1"></div>
    <div class="bottom_right_slanted"></div>
</section> <!-- END: from header -->

<section class="csr-content">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="row">
                    <div class="owl-carousel-csr2">
                        <?php
                        $parent_name = $post->post_name;
                        $args = array(
                            'post_type' => 'page',
                            'order' => 'ASC',
                            'orderby' => 'menu_order',
                            'post_parent' => get_the_ID(),
                            'posts_per_page' => -1,
                            'taxonomy' => 'category',
                                    'field' => 'slug',
                                    'term' => 'slider'
                        );
                        $posts = new WP_Query($args); $i=0;
                        while ($posts->have_posts()) : $posts->the_post(); $i++; ?>

                            <div class="item">
                                <div class="col-sm-7">
                                    <h1 class="tcolor title">
                                        <em><strong><?php the_title() ?></strong></em>
                                    </h1>
                                    <h3 class="wcolor sub-title">
                                        <em><strong>@Jamiyah Home for the Aged (Darul akrim)</strong></em>
                                    </h3>
                                    <img src="<?php echo get_the_post_thumbnail_url_raw() ?>" />
                                </div>
                                <div class="col-sm-5 csr-carousel-content">
                                    <?php the_content() ?>
                                </div><div class="clearfix"></div>
                            </div>

                        <?php
                        endwhile; wp_reset_postdata(); ?>
                    </div>
                </div>
            </div>
        </div><!--row-->
    </div>
</section>

<?php get_footer(); ?>