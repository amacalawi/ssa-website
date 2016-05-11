<?php


get_header(); ?>

<?php
$bg = get_post_meta( get_the_ID(), 'custom_bg', TRUE );
$tagline = get_post_meta( get_the_ID(), 'custom_tagline', TRUE );
$subheading = get_post_meta( get_the_ID(), 'custompageSubheading', TRUE ); ?>
<section id="banner" class="clients_banner banner banner-straight bg" data-bg="<?php echo get_the_post_thumbnail_url_raw() ?>">
    <div class="container">
        <div class="row">
            <div class="bottom_right_slanted"></div>
            <div class="col-md-offset-1 col-sm-10">
                <div class="row">
                    <div class="col-sm-12">
                        <h1 class="tcolor title animated fadeIn">
                            <strong >
                                <em>Clients</em>
                            </strong>
                        </h1>
                        <p class="wcolor subtitle animated fadeIn">
                            <?php echo $subheading; ?>
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="bottom_right_slanted"></div>
</section>
<section class="client_content">
    <div class="container">
        <div class="row">
            <div class="col-sm-offset-1 col-sm-10">
                <div class="row">
                    <?php echo do_shortcode($post->post_content); ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php if( !empty($tagline) && !empty($bg) ): ?>
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
<?php endif; ?>

<?php get_footer(); ?>