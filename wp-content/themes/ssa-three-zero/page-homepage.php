<?php
/**
 * Template Name: Homepage
 */
 ?>
<?php get_header(); ?>

    <div class="container">
        <div class="row">
            <div class="col-md-offset-1 col-sm-10">

                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

                <?php
                /**
                 * homepage Video
                 */
                $homepage_video_url = get_post_meta( get_the_ID(), 'custom_video', TRUE );
                /**
                 * Jumbotron
                 * @var array
                 */
                $jumbotron = array(
                    'post_type' => 'page',
                    'order' => 'ASC',
                    'orderby' => 'menu_order',
                    'post_parent' => get_the_ID(),
                    'taxonomy' => 'category',
                        'field' => 'slug',
                        'term' => 'jumbotron'
                );
                $jumbotron = new WP_Query($jumbotron);
                while ($jumbotron->have_posts()) : $jumbotron->the_post(); ?>

                    <div class="row">
                        <div id="post-id-<?php the_ID(); ?>" <?php post_class('col-sm-8'); ?> >
                            <h1 class="wcolor title text-uppercase"><strong class="animated flipInX"><em><?php the_title() ?></em></strong></h1>
                            <p class="wcolor subtitle animated flipInX"><?php echo $post->post_content; ?></p>
                        </div> <!-- end article -->
                        <div class="col-sm-4">
                            <div class="video-container">
                                <img src="<?php echo get_template_directory_uri().'/img/anniversary1.small.png' ?>" class="anniv_logo homepage-logo">
                                <a href="#" class="btn-video btn-play">
                                    <video id="video-content" class="video-content animated hidden" preload loop>
                                        <!-- WCAG general accessibility recommendation is that media such as background video play through only once. Loop turned on for the purposes of illustration; if removed, the end of the video will fade in the same way created by pressing the "Pause" button  -->
                                        <source src="<?php echo $homepage_video_url; ?>" type="video/mp4">
                                    </video>
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php
                endwhile; wp_reset_query();
                 ?>

                <?php endwhile; ?>

                <?php endif; ?>

            </div> <!-- end #main -->
        </div> <!-- end #content -->
    </div>
    <div class="bottom_right_slanted"></div>
</section>

<?php /* START: Get all child pages */
if (have_posts()) : while (have_posts()) : the_post(); ?>

<?php $mypages = get_posts(array( 'post_type' => 'page', 'post_parent' => get_the_ID(), 'sort_column' => 'menu_order', 'sort_order' => 'ASC', 'category_name' => 'section', 'post_status' => 'publish')); ?>
<?php foreach( $mypages as $post ) {
    setup_postdata($post); ?>
    <section id="section_<?php the_ID(); ?>" class="section section-<?php the_ID(); ?> section-<?php echo $post->post_name ?>">
        <div class="border">
            <div class="container">
                <div class="row">
                    <div class="col-sm-offset-1 col-sm-10">
                        <div class="row">
                            <div class="col-sm-offset-2 col-sm-8">
                                <div class="row">
                                    <div class="arrow-straight"></div>
                                    <h1 class="title"><strong><?php the_title() ?></strong></h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-sm-offset-1 col-sm-10">
                    <div class="row">
                        <div class="col-sm-offset-2 col-sm-8">
                            <div class="row desc">
                                <?php the_content(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php
} ?>
<?php endwhile; ?>
<?php endif; ?>
<?php /* END: Got all child pages */ ?>


<?php echo do_shortcode('[testimonials]') ?>


<?php get_footer(); ?>