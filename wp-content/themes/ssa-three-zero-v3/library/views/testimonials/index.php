<section id="home_testimonial" class="home_testimonial bg" data-bg="<?php echo $options['background_image'] ?>">
    <div class="top_right_slanted"></div>
    <div class="container">
        <div class="row">
            <div class="col-sm-offset-1 col-sm-10">
                <div class="row">
                    <div class="col-sm-8">
                        <div class="row">
                            <div class="owl-carousel">
                                <?php
                                if( $records->have_posts() ) {
                                    while ($records->have_posts()) : $records->the_post(); ?>
                                        <div class="item">
                                            <p class="testimonial wcolor">
                                                <i class="zmdi zmdi-quote zmdi-hc-fw"></i>
                                                <?php echo get_the_excerpt(); ?>
                                                <span class="pull-right tcolor">
                                                    - <?php the_title(); ?>
                                                </span>
                                            </p>
                                        </div>
                                         <?php
                                    endwhile;
                                } ?>
                            </div>

                        </div>
                    </div><div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="bottom_right_slanted"></div>
</section>
