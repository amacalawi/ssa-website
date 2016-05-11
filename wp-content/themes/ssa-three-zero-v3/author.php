<?php get_header(); ?>

	<div id="content" class="clearfix row">

		<div id="main" class="col-sm-offset-2 col-sm-8 clearfix" role="main">

			<div class="page-header">
				<h1 class="tcolor title">
					<span><?php _e("Posts By:", "wpbootstrap"); ?></span>
					<?php
						// If google profile field is filled out on author profile, link the author's page to their google+ profile page
						$curauth = (get_query_var('author_name')) ? get_user_by('slug', get_query_var('author_name')) : get_userdata(get_query_var('author'));
						$google_profile = get_the_author_meta( 'google_profile', $curauth->ID );
						if ( $google_profile ) {
							echo '<a href="' . esc_url( $google_profile ) . '" rel="me">' . $curauth->display_name . '</a>';
					?>
					<?php
						} else {
							$fname =  get_the_author_meta( 'first_name' );
	                        $lname = get_the_author_meta( 'last_name' );
	                        $author_fullname = $fname . "&nbsp;" . $lname;
	                        echo $fname . "&nbsp;" . $lname;
						}
					?>
				</h1>
			</div>
		</div> <!-- end #main -->
    </div> <!-- end #content -->
</section>

<section class="<?php echo $post->post_name ?>_banner">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class('container'); ?> role="article">

		<div class="content-holder">
            <div class="col-sm-12">
                <div class="row">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-offset-1 col-sm-10">
                                <div class="col-sm-4 blog-holder bg" data-bg="<?php echo get_the_post_thumbnail_url_raw(); ?>">
                                    <a href="<?php the_permalink(); ?>" title="View this">
                                        <div class="overlay">
                                            <p class="animated">
                                                <i class="zmdi zmdi-search"></i>
                                            </p>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-sm-8">
                                    <h1><strong><?php the_title(); ?></strong></h1>
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

	</article> <!-- end article -->

<?php endwhile; ?>
</section>

<?php if (function_exists('wp_bootstrap_page_navi')) { // if expirimental feature is active ?>

	<?php wp_bootstrap_page_navi(); // use the page navi function ?>

<?php } else { // if it is disabled, display regular wp prev & next links ?>
	<nav class="wp-prev-next">
		<ul class="clearfix">
			<li class="prev-link"><?php next_posts_link(_e('&laquo; Older Entries', "wpbootstrap")) ?></li>
			<li class="next-link"><?php previous_posts_link(_e('Newer Entries &raquo;', "wpbootstrap")) ?></li>
		</ul>
	</nav>
<?php } ?>


<?php else : ?>

<article id="post-not-found">
    <header>
    	<h1><?php _e("No Posts Yet", "wpbootstrap"); ?></h1>
    </header>
    <section class="post_content">
    	<p><?php _e("Sorry, What you were looking for is not here.", "wpbootstrap"); ?></p>
    </section>
    <footer>
    </footer>
</article>

<?php endif; ?>

<?php get_footer(); ?>