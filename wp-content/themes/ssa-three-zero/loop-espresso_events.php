<?php

 if ( have_posts() ) : ?>
    <div class="content-holder">
        <div class="col-sm-12">
            <div class="row">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-offset-1 col-sm-10">
                            <div class="col-sm-4 blog-holder bg" data-bg="<?php echo get_the_post_thumbnail_url_raw(); ?>">
                                <a href="<?php the_permalink(); ?>" title="View this">
                                    <div class="overlay">
                                        <p class="animated display zoomOut">
                                            <i class="zmdi zmdi-search"></i>
                                        </p>
                                    </div>
                                </a>
                            </div>
                            <div class="col-sm-8">
                                <h1><a href="<?php the_permalink(); ?>" title="View this"><strong><?php the_title(); ?></strong></a>
                                    <?php
                                    if ( is_day() ) :
                                        printf( __( 'Today\'s Events: %s', 'event_espresso' ), get_the_date() );

                                    elseif ( is_month() ) :
                                        printf( __( 'Events This Month: %s', 'event_espresso' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'event_espresso' ) ) );

                                    elseif ( is_year() ) :
                                        printf( __( 'Events This Year: %s', 'event_espresso' ), get_the_date( _x( 'Y', 'yearly archives date format', 'event_espresso' ) ) );

                                    else :
                                        echo apply_filters( 'FHEE__archive_espresso_events_template__upcoming_events_h1', __( 'Upcoming Events', 'event_espresso' ));

                                    endif;
                                ?>
                                </h1>
                                <p class="author">
                                    <?php $fname =  get_the_author_meta( 'first_name' );
                                    $lname = get_the_author_meta( 'last_name' );
                                    echo $fname . "&nbsp;" . $lname; ?>
                                    <span><?php echo get_the_date(); ?></span>
                                    <?php echo get_the_category_list(', ') ?>
                                </p>
                                <?php the_excerpt(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="<?php echo ($i%2==0)?'col-lg-offset-4':''; ?> col-lg-8 border-bottom"></div>
        <div class="clearfix"></div>
    </div>

    <?php
        // allow other stuff
        // do_action( 'AHEE__archive_espresso_events_template__before_loop' );
        // // Start the Loop.
        // while ( have_posts() ) : the_post();
        //     // Include the post TYPE-specific template for the content.
        //     espresso_get_template_part( 'content', 'espresso_events-shortcode' );
        // endwhile;
        // // Previous/next page navigation.
        // espresso_pagination();
        // // allow moar other stuff
        // do_action( 'AHEE__archive_espresso_events_template__after_loop' );

    else :
        // If no content, include the "No posts found" template.
        espresso_get_template_part( 'content', 'none' );

    endif;

