<?php
/**
 * Template Name: Careers Page Template
 */

get_header(); ?>

<?php
$bg = get_post_meta( get_the_ID(), 'custom_bg', TRUE );
$tagline = get_post_meta( get_the_ID(), 'custom_tagline', TRUE );

$subscript = get_post_meta( get_the_ID(), 'custom_subscript', true ); ?>
<section id="banner" class="careers_banner banner bg" data-bg="<?php echo get_the_post_thumbnail_url_raw(); ?>">

    <div class="container">
        <div class="row">
            <div class="col-md-offset-1 col-sm-10">
                <div class="row">
                    <div class="col-sm-12">
                        <h1 class="tcolor title animated fadeIn">
                            <strong >
                                <em><?php the_title(); ?></em>
                            </strong>
                        </h1>
                        <p class="wcolor subtitle animated fadeIn">
                            <?php echo $post->post_content; ?>
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="bottom_right_slanted"></div>
</section>

<section class="career-content" id="career-content">
    <div class="container">
        <div class="row">
            <div class="col-md-offset-1 col-sm-10">
                <div class="row">
                    <div class="col-sm-4">
                        <h1 class="text-right"><em><strong>Open <span class="tcolor">Positions</span></strong></em></h1>
                    </div>
                    <div class="col-sm-8">
                        <?php
                        $custom_terms = get_terms('career_cat');
                        foreach($custom_terms as $custom_term) {
                            wp_reset_query();
                            $args = array('post_type' => 'careers',
                                'orderby' => 'title',
                                'order' => 'DESC',
                                'tax_query' => array(
                                    array(
                                        'taxonomy' => 'career_cat',
                                        'field' => 'slug',
                                        'terms' => $custom_term->slug,
                                        'orderby' => 'date',
                                        'order' => 'ASC',
                                    ),
                                ),
                            );

                            $loop = new WP_Query($args);
                            if($loop->have_posts()) {
                                $i=1; ?>
                                <h3 class="tcolor pos-title">
                                    <strong><em><?php echo $custom_term->name ?></em></strong>
                                </h3>
                                <div class="panel-group" id="career-accordion" role="tablist" aria-multiselectable="true">
                                    <?php while($loop->have_posts()) : $loop->the_post(); ?>
                                        <div class="panel panel-default fulltime">
                                            <div class="panel-heading" role="tab" id="careerHeading_<?php the_ID() ?>">
                                              <h4 class="panel-title">
                                                <a data-toggle="collapse" data-parent="#career-accordion" href="#career_<?php the_ID() ?>" aria-expanded="true" aria-controls="collapseOne">
                                                   <?php the_title(); ?>
                                                </a>
                                              </h4>
                                            </div>
                                            <div id="career_<?php the_ID() ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="careerHeading_<?php the_ID() ?>">
                                                <div class="panel-body">
                                                    <?php the_content(); ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endwhile; ?>
                                </div><!-- panel-group -->
                            <?php }
                        } ?>
                        <h5 class="sub-script">
                            <em><?php echo $subscript; ?></em>
                        </h5>
                    </div><!--col-8-->
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>



</section>

<?php if( !empty($tagline) && !empty($bg) ): ?>
<section class="taglines bg" data-bg="<?php echo $bg ?>">
    <div class="black-overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h1 class="tcolor">
                    <strong>
                        <em><?php echo $tagline ?></em>
                    </strong>
                </h1>
            </div>
        </div>
    </div>
    <div class="col-sm-offset-4 col-sm-8 bottom_white_border"></div>
    <div class="clearfix"></div>
</section>
<?php endif; ?>

<?php get_footer(); ?>