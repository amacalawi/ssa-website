<?php
/**
 * Template Name: Event List
 *
 * This template will display a list of your events
 *
 * @ package        Event Espresso
 * @ author     Seth Shoultes
 * @ copyright  (c) 2008-2014 Event Espresso  All Rights Reserved.
 * @ license        http://eventespresso.com/support/terms-conditions/   * see Plugin Licensing *
 * @ link           http://www.eventespresso.com
 * @ version        EE4+
 */
?>
<?php get_header(); ?>

<?php
$events_page = get_page_by_path('events');?>
<section id="banner" class="events_banner banner bg" data-bg="<?php echo get_the_post_thumbnail_url_raw($events_page->ID) ?>">

    <?php
    $bg = get_post_meta( $events_page->ID, 'custom_bg', TRUE );
    $tagline = get_post_meta( $events_page->ID, 'custom_tagline', TRUE ); ?>
    <div class="container">
        <div class="row">
            <div class="col-md-offset-1 col-sm-10">
                <div class="row">
                    <div class="col-sm-12">
                        <h1 class="tcolor title animated flipInX">
                            <strong>
                                <em><?php echo $events_page->post_title ?></em>
                            </strong>
                        </h1>
                        <p class="wcolor subtitle animated fadeIn">
                           <?php echo $events_page->post_content ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bottom_right_slanted"></div>
</section>

<section class="event_content">
    <?php espresso_get_template_part( 'loop', 'espresso_events' ); ?>
</section><!-- #primary -->

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

<?php
// get_sidebar( 'content' );
// get_sidebar();
get_footer();