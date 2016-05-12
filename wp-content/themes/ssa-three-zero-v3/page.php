<?php get_header(); ?>

<?php
$bg = get_post_meta( get_the_ID(), 'custom_bg', TRUE );
$tagline = get_post_meta( get_the_ID(), 'custom_tagline', TRUE );
$subheading = get_post_meta( get_the_ID(), 'custompageSubheading', TRUE ); ?>
    <div class="overlay-pattern"></div>
    <div class="col-sm-offset-4 col-sm-8">
        <div class="row">
            <div class="col-sm-12">
                <div class="row">
                <h1 class="tcolor title">
                    <strong class="animated flipInX">
                        <em><?php the_title() ?></em>
                    </strong>
                </h1>
                <p class="wcolor subtitle animated flipInX">
                    <?php echo $subheading; ?>
                </p>
                </div>
            </div>
        </div>
    </div>
</section> <!-- END: from header -->

<section class="<?php echo $post->post_name ?>_content">
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
                <h1 class="tcolor text-center">
                    <strong><em><?php echo $tagline ?></em></strong>
                </h1>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>
<?php get_footer(); ?>