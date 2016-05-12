<?php
/**
 * Template Name: Homepage
 */

get_header(); ?>

<?php
$banner_class = $post->post_type == "page" ? $post->post_name : $post->post_type;
$banner_class = is_page('home') ? 'homepage' : $banner_class; ?>
<section class="section child-section <?php echo $banner_class ?>_section main-section bg" data-bg="<?php echo get_the_post_thumbnail_url_raw() ?>">
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
                        <div id="post-id-<?php the_ID(); ?>" <?php post_class('col-sm-8 wcolor'); ?> >
                            <h1 class="wcolor title"><strong class="animated flipInX"><em><?php the_title() ?></em></strong></h1>
                            <?php the_content(); ?>
                        </div> <!-- end article -->
                        <div class="col-sm-4">
                            <img src="<?php echo get_stylesheet_directory_uri() ?>/img/anniversary1.png" class="anniv_logo" width="300"/>
                        </div>
                    </div>
                    <?php
                endwhile; wp_reset_query();
                 ?>

                <?php endwhile; ?>

                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="bottom_right_slanted"></div>
</section>


<?php /* START: Get all child pages */
if (have_posts()) : while (have_posts()) : the_post(); ?>
<?php
$mypages = get_posts(array( 'post_type' => 'page', 'post_parent' => get_the_ID(), 'sort_column' => 'menu_order', 'sort_order' => 'ASC', 'category_name' => 'section', 'post_status' => 'publish')); ?>
<?php
foreach( $mypages as $post ) {
    setup_postdata($post); ?>
    <section id="home_about" class="home_about">
        <div class="border">
            <div class="container">
                <div class="row">
                    <div class="col-sm-offset-1 col-sm-10">

                        <div class="row">
                            <div class="col-sm-offset-2 col-sm-8">
                                <div class="row">
                                    <div class="arrow-straight"></div>
                                    <h1 class="title">
                                        <em><?php the_title(); ?></em>
                                    </h1>
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
                            <div class="row">
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

<!-- START: Homepage player -->
<div class="overlay overlay-cornershape" data-path-to="m 0,0 1439.999975,0 0,805.99999 -1439.999975,0 z">
    <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 1440 806" preserveAspectRatio="none">
        <path class="overlay-path" d="m 0,0 1439.999975,0 0,805.99999 0,-805.99999 z"/>
    </svg>
    <button type="button" class="overlay-close">Close</button>
    <div id="player-overlay">
      <video id="anniv_video" preload="auto" style="display: none">
          <source src="<?php echo get_template_directory_uri() ?>/img/placeholder.mp4" type="video/mp4"/>
          <!-- <source src="<?php echo get_template_directory_uri() ?>/img/movie.ogg" type="video/ogg"> -->
      </video>
    </div>
</div>
<div id="replay_button">
    <a href="#"><i class="fa fa-play-circle-o"></i></a>
</div>
<div id="play_button">
    <a href="#"><i class="fa fa-play-circle-o"></i></a>
</div>
<!-- END: Homepage player -->

<?php
get_footer(); ?>