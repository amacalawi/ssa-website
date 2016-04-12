<?php
/**
 * Template Name: Single Event Page
 */
get_header();

$bg = get_post_meta( get_the_ID(), 'custom_bg', TRUE );
$tagline = get_post_meta( get_the_ID(), 'custom_tagline', TRUE );

if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
    <div class="overlay-pattern2"></div>
    <div class="event_inner_banner blog-banner-holder">

        <div class="col-sm-10">
            <div class="row">
                <div class="col-sm-offset-4 col-sm-8">
                    <div class="row">
                        <h1 class="wcolor title">
                            <strong class="animated flipInX">
                                <em class="tcolor"><?php the_title() ?></em>
                            </strong>
                        </h1>
                        <p class="desc wcolor">
                            <?php
                            $meta_event_subheading = get_post_meta( get_the_ID(), 'custom_eventSubheading', TRUE );
                            $meta_event_content = get_post_meta( get_the_ID(), 'custom_eventContent', TRUE );
                            echo $meta_event_subheading;
                            echo "<br>";
                            echo $meta_event_content; ?>
                            <a href="#" class="pull-right">
                                <i class="zmdi zmdi-twitter"></i>
                            </a>
                            <a href="#" class="pull-right">
                                <i class="zmdi zmdi-linkedin-box"></i>
                            </a>
                            <a href="#" class="pull-right">
                                <i class="zmdi zmdi-facebook"></i>
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div><div class="clearfix"></div>

        <div class="col-sm-10 border-top">
            <div class="row">
                <a href="#" class="pull-right">Click here to register!</a>
            </div>
        </div>

    </div>
    <div class="bottom_right_slanted"></div>
</section>

<section class="event-inner-content">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="item">
                    <div class="col-sm-7">
                        <img src="<?php echo get_the_post_thumbnail_url_raw() ?>" />
                    </div>
                    <div class="col-sm-5">
                        <?php the_content(); ?>
                    </div><div class="clearfix"></div>
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
</section>

<?php
endwhile;

get_footer(); ?>