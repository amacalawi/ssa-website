<?php
/**
 * Template Name: Special Template
 */
 ?>
<?php get_header(); ?>
    <?php
    $parent_name = $post->post_name;
    $args = array(
        'post_type' => 'page',
        'order' => 'ASC',
        'orderby' => 'menu_order',
        'post_parent' => get_the_ID(),
        'posts_per_page' => 1,
        'taxonomy' => 'category',
                'field' => 'slug',
                'term' => 'section'
    );
    $posts = new WP_Query($args); $i=0;
    while ($posts->have_posts()) : $posts->the_post(); $i++; ?>

        <div class="top-content">
            <div class="row">
                <div class="col-md-offset-1 col-sm-10">
                    <div class="row">
                        <div class="col-sm-5">
                            <h1 class="wcolor title text-right">
                                <strong class="animated flipInX">
                                    <em><span class="tcolor"><?php the_title(); ?></span></em>
                                </strong>
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-9"></div>
        <div class="clearfix"></div>
        <div class="bottom-content">
            <div class="row">
                <div class="col-md-offset-1 col-sm-10">
                    <div class="row">
                        <div class="col-sm-offset-4 col-sm-5 subtitle wcolor animated flipInX">
                            <?php the_content(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bottom_right_slanted"></div>
    <?php
    endwhile; wp_reset_postdata(); ?>
</section> <!-- END: from header -->

<?php
$args = array(
    'offset'=>1,
    'post_type' => 'page',
    'order' => 'ASC',
    'orderby' => 'menu_order',
    'post_parent' => get_the_ID(),
    'posts_per_page' => 2,
    'taxonomy' => 'category',
            'field' => 'slug',
            'term' => 'section'
);
$posts = new WP_Query($args); $i=2;
while ($posts->have_posts()) : $posts->the_post(); $i++; ?>
    <section class="<?php echo $parent_name ?>_consulting bg" id="<?php echo $parent_name ?>_consulting" data-bg="<?php echo get_the_post_thumbnail_url_raw() ?>">
        <div class="top_right_slanted"></div>
        <div class="top-content">
            <div class="row">
                <div class="col-sm-offset-1 col-sm-10">
                    <div class="row">
                        <div class="<?php echo ($i%3==0)?'col-sm-offset-7':'' ?> col-sm-5">
                            <h1 class="wcolor title text-left">
                                <strong class="animated flipInX">
                                    <em><span class="tcolor"><?php the_title() ?></span></em>
                                </strong>
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-offset-3 col-lg-9"></div>
        <div class="clearfix"></div>
        <div class="bottom-content">
            <div class="row">
                <div class="<?php echo ($i%3==0)?'col-md-offset-1':'' ?> col-sm-10">
                    <div class="row">
                        <div class="col-sm-offset-3 col-sm-5 text-right wcolor subtitle animated flipInX">
                            <?php the_content() ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bottom_right_slanted"></div>
    </section>
<?php
$i++; endwhile; wp_reset_postdata(); ?>
<?php get_footer(); ?>