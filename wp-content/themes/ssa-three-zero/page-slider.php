<?php
/**
 * Template Name: Slider Page Template
 */
 ?>
<?php get_header(); ?>
<?php
$bg = get_post_meta( get_the_ID(), 'custom_bg', TRUE );
$tagline = get_post_meta( get_the_ID(), 'custom_tagline', TRUE ); ?>
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
                        while ($posts->have_posts()) : $posts->the_post(); $i++;
                            $event_meta_data_subheading = get_post_meta(get_the_ID(), 'custom_eventSubheading', true);
                            $event_meta_data_content = get_post_meta(get_the_ID(), 'custom_eventContent', true); ?>

                            <div class="item">
                                <div class="col-sm-7">
                                    <h1 class="tcolor title">
                                        <em><strong><?php the_title() ?></strong></em>
                                    </h1>
                                    <h3 class="wcolor sub-title">
                                        <em><strong><?php echo $event_meta_data_subheading ?></strong></em>
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
<section class="csr-content-blank" id="csr-content-blank">

</section>
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