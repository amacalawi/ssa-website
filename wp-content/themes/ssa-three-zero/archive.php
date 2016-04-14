<?php get_header(); ?>
	<div class="overlay-pattern"></div>
	<div class="container">
		<div class="col-sm-6">
	        <div class="row">
	            <div class="col-sm-12">
	                <div class="row">
	                <h1 class="tcolor title">
	            	<?php if (is_category()) { ?>
						<span><?php _e("Posts Categorized:", "wpbootstrap"); ?></span> <?php single_cat_title(); ?>
					<?php } elseif (is_tag()) { ?>
						<span><?php _e("Posts Tagged:", "wpbootstrap"); ?></span> <?php single_tag_title(); ?>
					<?php } elseif (is_author()) { ?>
						<span><?php _e("Posts By:", "wpbootstrap"); ?></span> <?php get_the_author_meta('display_name'); ?>
					<?php } elseif (is_day()) { ?>
						<span><?php _e("Daily Archives:", "wpbootstrap"); ?></span> <?php the_time('l, F j, Y'); ?>
					<?php } elseif (is_month()) { ?>
				    	<span><?php _e("Monthly Archives:", "wpbootstrap"); ?></span> <?php the_time('F Y'); ?>
					<?php } elseif (is_year()) { ?>
				    	<span><?php _e("Yearly Archives:", "wpbootstrap"); ?></span> <?php the_time('Y'); ?>
					<?php } ?>
	                </h1>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
</section>
<section class="content">
    <div class="container">
        <div class="col-sm-12">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">
					<header>
						<h3 class="h2"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
						<small class="meta"><?php _e("Posted", "wpbootstrap"); ?> <time datetime="<?php echo the_time('Y-m-j'); ?>" pubdate><?php the_time(); ?></time> <?php _e("by", "wpbootstrap"); ?> <?php the_author_posts_link(); ?> <span class="amp">&</span> <?php _e("filed under", "wpbootstrap"); ?> <?php the_category(', '); ?>.</small>
					</header> <!-- end article header -->

					<div class="row">
						<div class="col-sm-2">
							<?php the_post_thumbnail(); ?>
						</div>
						<div class="col-sm-10">
							<?php the_excerpt(); ?>
						</div>
					</div> <!-- end article section -->
				</article> <!-- end article -->

			<?php endwhile; ?>

			<?php if (function_exists('wp_bootstrap_page_navi')) { // if expirimental feature is active ?>

				<?php wp_bootstrap_page_navi(); // use the page navi function ?>

			<?php } else { // if it is disabled, display regular wp prev & next links ?>
				<nav class="wp-prev-next">
					<ul class="pager">
						<li class="previous"><?php next_posts_link(_e('&laquo; Older Entries', "wpbootstrap")) ?></li>
						<li class="next"><?php previous_posts_link(_e('Newer Entries &raquo;', "wpbootstrap")) ?></li>
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

        </div>
    </div>
</section>
<?php get_sidebar(); // sidebar 1 ?>
<?php get_footer(); ?>