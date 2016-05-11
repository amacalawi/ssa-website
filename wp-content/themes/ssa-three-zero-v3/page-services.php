<?php
/**
 * Template Name: Services Template
 */
 ?>
<?php get_header(); ?>

<section id="banner" class="services_banner banner bg" data-bg="<?php echo get_the_post_thumbnail_url_raw() ?>">

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
        <div class="col-sm-6">

        </div>
        <div class="col-sm-6">
            <h1 class="tcolor"><strong><em><?php the_title(); ?></em></strong></h1>

            <?php the_content(); ?>
        </div>
    </div>
    <?php
    endwhile; wp_reset_postdata(); ?>

    <?php
    $parent_name = $post->post_name;
    $args = array(
        'post_type' => 'page',
        'order' => 'ASC',
        'orderby' => 'menu_order',
        'post_parent' => get_the_ID(),
        'posts_per_page' => 1,
        'offset' => 1,
        'taxonomy' => 'category',
                'field' => 'slug',
                'term' => 'section'
    );
    $posts = new WP_Query($args); $i=0;
    while ($posts->have_posts()) : $posts->the_post(); $i++; ?>
    <div class="bottom-content text-right">
        <div class="col-sm-6">
            <h1 class="tcolor text-right"><strong><em><?php the_title(); ?></em></strong></h1>
            <?php the_content(); ?>
        </div>
        <div class="col-sm-6">
        </div>
    </div>
    <?php
    endwhile; wp_reset_postdata(); ?>
    <div class="bottom_right_slanted"></div>

</section>


<?php get_footer(); ?>