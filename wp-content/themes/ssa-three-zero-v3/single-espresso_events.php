<?php
/**
 * Template Name: Event Details
 *
 * This is template will display all of your event's details
 *
 * @ package        Event Espresso - Event Registration and Management Plugin for WordPress
 * @ link           http://www.eventespresso.com
 * @ version        EE4+
 */

get_header();

$bg = get_post_meta( get_the_ID(), 'custom_bg', TRUE );
$tagline = get_post_meta( get_the_ID(), 'custom_tagline', TRUE );

if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
<section id="banner" class="event_inner_banner banner bg" data-bg="<?php echo get_the_post_thumbnail_url_raw() ?>">

    <div class="blog-banner-holder">
        <div class="col-sm-10 widths-10">
            <div class="row">
                <div class="col-sm-offset-2 col-sm-10">
                    <div class="row">
                        <h1 class="wcolor title">
                            <strong class="animated flipInX">
                                <em class="tcolor"><?php the_title() ?></em>
                            </strong>
                        </h1>
                        <div class="desc wcolor clearfix">
                            <?php
                            $meta_event_subheading = get_post_meta( get_the_ID(), 'custom_eventSubheading', TRUE );
                            $meta_event_content = get_post_meta( get_the_ID(), 'custom_eventContent', TRUE );
                            // echo $meta_event_subheading;
                            // echo "<br>";
                            // echo $meta_event_content; ?>
                            <?php espresso_get_template_part( 'content', 'espresso_events-datetimes' ); ?>
                            <?php espresso_get_template_part( 'content', 'espresso_events-venues' ); ?>
                            <a href="#" class="pull-right">
                                <i class="fa fa-twitter"></i>
                            </a>
                            <a href="#" class="pull-right">
                                <i class="fa fa-linkedin"></i>
                            </a>
                            <a href="#" class="pull-right">
                                <i class="fa fa-facebook"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div><div class="clearfix"></div>

        <div class="col-sm-10 border-top">
            <!-- <div class="row">
                <a href="#" class="pull-right">Click here to register!</a>
            </div> -->
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
                        <div class="espresso-event-wrapper-dv">
                            <hr role="separator">
                            <?php espresso_get_template_part( 'content', 'espresso_events-tickets' ); ?>
                        </form>
                            <?php #espresso_get_template_part( 'content', 'espresso_events-details' ); ?>
                        </div>

                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div><!--row-->
    </div>
</section>

<?php if( !empty($tagline) && !empty($bg) ) { ?>
<section class="taglines bg" data-bg="<?php echo $bg ?>">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h1 class="tcolor">
                    <strong><em><?php echo $tagline ?></em></strong>
                </h1>
            </div>
        </div>
    </div>
    <div class="col-sm-offset-4 col-sm-8 bottom_white_border"></div>
    <div class="clearfix"></div>
</section>
<?php } #endif; ?>

<?php
endwhile;

get_footer(); ?>