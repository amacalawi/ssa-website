<?php
/**
 * Template Name: Events Page
 */
 ?>
<?php get_header(); ?>

<?php
$bg = get_post_meta( get_the_ID(), 'custom_bg', TRUE );
$tagline = get_post_meta( get_the_ID(), 'custom_tagline', TRUE ); ?>
    <div class="container">
        <div class="row">
            <div class="col-sm-offset-2 col-sm-8">
                <div class="row">
                    <h1 class="wcolor title text-center">
                        <strong class="animated flipInX">
                            <?php echo $post->post_content; ?>
                        </strong>
                    </h1>
                </div>
            </div>
        </div>
    </div>
</section> <!-- END: from header -->

<section class="<?php echo $post->post_name ?>_content">
    <?php
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    $args = array(
        'post_type' => 'page',
        'post_parent' => get_the_ID(),
        'order' => 'ASC',
        'orderby' => 'date',
        'posts_per_page'   => 10,
        'paged' => $paged,
        // 'taxonomy' => 'category',
        //         'field' => 'slug',
        //         'term' => $post->post_name,
    );
    $posts = new WP_Query($args); $i=0;
    while ($posts->have_posts()) : $posts->the_post(); ?>
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
                                    <h1><a href="<?php the_permalink(); ?>" title="View this"><strong><?php the_title(); ?></strong></a></h1>
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
        </div> <?php

    $i++; endwhile; ?>
    <div class="nav-holder">
        <div class="col-sm-12">
            <div class="row">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-offset-1 col-sm-10">
                             <div class="paginates">
                                <!-- <div id="page-nav"></div> -->
                                <?php echo get_pagination_bar($posts); ?>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php wp_reset_postdata(); ?>
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