<?php
get_header();

if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

    <div class="blog-banner-holder">
        <div class="col-sm-8">
            <div class="row">
                <div class="col-sm-offset-4 col-sm-8">
                    <div class="row">
                        <h1 class="wcolor title">
                            <strong class="animated flipInX">
                                <em class="tcolor"><?php the_title(); ?></em>
                            </strong>
                        </h1>
                        <p class="desc wcolor post-meta-info">
                            <span class="author">
                                <?php $fname =  get_the_author_meta( 'first_name' );
                                $lname = get_the_author_meta( 'last_name' );
                                $author_fullname = $fname . "&nbsp;" . $lname;
                                echo $fname . "&nbsp;" . $lname; ?>
                            </span>
                            <span class="post-date"><?php echo get_the_date(); ?></span>
                            <span class="category-list"><?php echo get_the_category_list(', ') ?></span>
                            <span class="pull-right">
                                <a href="#" class="btn btn-circle icon">
                                    <i class="zmdi zmdi-twitter"></i>
                                </a>
                                <a href="#" class="btn btn-circle icon">
                                    <i class="zmdi zmdi-linkedin-box"></i>
                                </a>
                                <a href="#" class="btn btn-circle icon">
                                    <i class="zmdi zmdi-facebook"></i>
                                </a>
                            </span>
                        </p>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-sm-8 border-bottom">

        </div>
    </div>
    <div class="bottom_right_slanted"></div>

    <div class="bouncing_arrow text-center">
        <a href="#blog-inner-content" class="navigates">
            <i class="zmdi zmdi-chevron-down tcolor"></i>
        </a>
    </div>
</section>

<section class="blog-inner-content" id="blog-inner-content">
    <div class="container">
        <div class="row">
            <div class="col-sm-offset-2 col-sm-8 insider">
                <div class="inside">

                    <?php the_content(); ?>

                    <div class="share-post">
                        <div class="col-sm-6">
                            <p class="author-post">
                                <strong><?php echo $author_fullname; ?></strong>
                            </p>
                            <p>Read <a href="<?php echo get_author_posts_url(get_the_author_meta( 'ID' )); ?>"><strong>more post</strong></a> by this author.</p>
                        </div>
                        <div class="col-sm-6">
                            <p class="share-it text-right">
                                 <strong>Share this post</strong>
                            </p>
                            <p class="share-link">
                                <a href="#"><i class="zmdi zmdi-twitter"></i></a>
                                <a href="#"><i class="zmdi zmdi-linkedin-box"></i></a>
                                <a href="#"><i class="zmdi zmdi-facebook"></i></a>
                            </p>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <?php
                    if(is_page('blog'))
                        comments_template(); ?>

                </div>
            </div><div class="clearfix"></div>
        </div>
    </div>
</section>

<?php
$orig_post = $post;
global $post;
$tags = wp_get_post_tags($post->ID);
$tag_ids = array();
foreach($tags as $individual_tag) {
    $tag_ids[] = $individual_tag->term_id;
}
$args = array(
    'tag__in' => $tag_ids,
    // 'category__in' => wp_get_post_categories($post->ID),
    'post__not_in' => array($post->ID),
    'posts_per_page'=>2, // Number of related posts to display.
    'orderby' => 'rand',
    'ignore_sticky_posts'=>1,
);
$my_query = new WP_Query($args);
if( $my_query->have_posts() ) { ?>
    <section class="related-post">
        <div class="row">
            <div class="col-sm-12">
                <p class="text-center other-articles">
                    <span>Other articles you might enjoy</span>
                </p>
            </div>
        </div><?php
        while ($my_query->have_posts()) : $my_query->the_post(); ?>
            <div class="col-sm-6">
                <a href="<?php the_permalink(); ?>">
                    <div class="row">
                        <div class="overlay-pattern"></div>
                        <?php the_post_thumbnail() ?>
                        <div class="col-sm-offset-1 col-sm-10">
                            <h1 class="tcolor"><?php the_title() ?></h1>
                            <p>
                                <span class="author wcolor">
                                    <?php $fname =  get_the_author_meta( 'first_name' );
                                    $lname = get_the_author_meta( 'last_name' );
                                    echo $fname . "&nbsp;" . $lname; ?>
                                </span>
                                <span class="date wcolor"><?php echo get_the_date(); ?></span>
                            </p>
                        </div><div class="clearfix"></div>
                    </div>
                </a>
            </div>
        <?php
        endwhile;
        $post = $orig_post;
        wp_reset_query();
    } ?>
    <div class="clearfix"></div>
</section><?php
endwhile;

get_footer(); ?>