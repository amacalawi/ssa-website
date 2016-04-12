<?php
/**
 * Template Name: About Page Template
 */
 ?>

<?php get_header() ?>
    <div class="overlay-pattern0"></div>

    <div class="<?php echo $post->post_name ?>-banner-holder">
        <div class="col-sm-8 white-bg"></div>
        <div class="clearfix"></div>

        <div class="container">
            <div class="row">
                <div class="col-sm-8">
                    <h3><em><strong><?php the_title() ?></strong></em></h3>
                    <h1><strong><em><span class="tcolor">SSA</span> Consulting Group</em></strong></h1>
                    <p class="col-sm-offset-3 col-sm-8">
                        SSA Consulting Group (SSA) is an umbrella corporation providing professional services, for nearly three decades, in the areas of training, management consulting, public accounting, estate planning.

                    </p>
                    <p class="col-sm-offset-3 col-sm-8">
                        SSA has been consistently ranked among the top 1,000 SMEs in Singapore (2011-2014). To date, we have consulted for more than 200 companies, business enterprises and non-profit organisations and trained more than 100,000 members of Singapore's workforce.
                    </p>
                </div><div class="clearfix"></div>
            </div>
        </div>
    </div>
    <div class="bottom_left_slanted"></div>
</section><!-- End Header Section Banner -->

<?php
$children = get_posts(array(
    'post_type' => 'page',
    'order' => 'ASC',
    'orderby' => 'menu_order',
    'post_parent' => get_the_ID(),
    'posts_per_page' => -1,
    'taxonomy' => 'category',
    'field' => 'slug',
    'term' => 'key-executives',
));
foreach ($children as $post) {
    setup_postdata($post); ?>
    <section class="<?php echo $post->post_name ?>" id="<?php echo $post->post_name ?>">
        <div class="col-sm-5">
            <h1 class="text-right"><em><strong><?php the_title() ?></strong></em></h1>
            <?php the_content(); ?>
            <div class="border-right-straight"></div>
        </div>
        <div class="col-sm-7 content-right">
            <?php
            $children = get_posts(array(
                'post_type' => 'page',
                'order' => 'ASC',
                'orderby' => 'menu_order',
                'post_parent' => get_the_ID(),
                'posts_per_page' => -1,
            ));
            foreach ($children as $post) {
                setup_postdata($post); ?>
                <div class="info">
                    <div class="col-sm-offset-1 col-sm-3 text-right">
                        <img src="<?php echo get_the_post_thumbnail_url_raw() ?>" alt="<?php the_title() ?>">
                    </div>
                    <div class="col-sm-8">
                        <h5 class="tcolor"><strong><em><?php the_title() ?></em></strong></h5>
                        <p class="designation"><?php echo do_shortcode($post->post_content) ?></p>
                    </div><div class="clearfix"></div>
                </div>
                <?php
            } ?>
        </div>
        <div class="bottom_left_slanted"></div>
    </section>
<?php
} wp_reset_postdata(); ?>

<?php
$children = get_posts(array(
    'post_type' => 'page',
    'order' => 'ASC',
    'orderby' => 'menu_order',
    'post_parent' => get_the_ID(),
    'posts_per_page' => -1,
    'taxonomy' => 'category',
    'field' => 'slug',
    'term' => 'mission-vision',
));
foreach ($children as $post) {
    setup_postdata($post); ?>
    <section class="<?php echo $post->post_name ?> bg" id="<?php echo $post->post_name ?>" data-bg="<?php echo get_the_post_thumbnail_url_raw() ?>">
        <div class="overlay-pattern0"></div>
        <?php
        $parent_id = get_the_ID();
        $children = get_posts(array(
            'post_type' => 'page',
            'order' => 'ASC',
            'orderby' => 'menu_order',
            'post_parent' => $parent_id,
            'posts_per_page' => 1,
        ));
        foreach ($children as $post) {
            setup_postdata($post); ?>
            <div class="top-content">
                <div class="col-sm-7">

                </div>
                <div class="col-sm-5">
                    <h1 class="tcolor"><strong><em><?php the_title(); ?></em></strong></h1>
                    <p class="col-sm-8 wcolor">
                        <?php echo do_shortcode($post->post_content); ?>
                    </p>
                </div>
            </div>
            <?php
        } wp_reset_postdata(); ?>

        <?php
        $children = get_posts(array(
            'post_type' => 'page',
            'order' => 'ASC',
            'orderby' => 'menu_order',
            'post_parent' => $parent_id,
            'posts_per_page' => 1,
            'offset' => 1,
        ));
        foreach ($children as $post) {
            setup_postdata($post); ?>
            <div class="bottom-content">
                <div class="col-sm-7">
                    <h1 class="tcolor text-right"><strong><em><?php the_title() ?></em></strong></h1>
                    <?php the_content() ?>
                </div>
                <div class="col-sm-5">
                </div>
            </div>
            <?php
        } wp_reset_postdata(); ?>
        <div class="bottom_left_slanted"></div>
    </section>
<?php
} wp_reset_postdata(); ?>

<?php
$children = get_posts(array(
    'post_type' => 'page',
    'order' => 'ASC',
    'orderby' => 'menu_order',
    'post_parent' => get_the_ID(),
    'posts_per_page' => -1,
    'taxonomy' => 'category',
    'field' => 'slug',
    'term' => 'values',
));
foreach($children as $post) {
    setup_postdata($post); ?>
    <section class="<?php echo $post->post_name ?> bg" id="<?php echo $post->post_name ?>" data-bg="<?php echo get_the_post_thumbnail_url_raw(); ?>">
        <div class="col-sm-5">
            <h1 class="text-right"><em><strong><?php the_title() ?></strong></em></h1>
            <div class="border-right-straight"></div>
            <?php
            $children = get_posts(array(
                'post_type' => 'page',
                'order' => 'ASC',
                'orderby' => 'menu_order',
                'post_parent' => get_the_ID(),
                'posts_per_page' => -1,
            )); $active=1; ?>
            <div class="drives">
                <ul>
                    <?php
                    foreach ($children as $post) {
                        setup_postdata($post); ?>
                        <li class="<?php echo $active ? 'active' : ''; $active=0; ?>">
                            <a href="#drives_<?php echo $post->post_name ?>">
                                <em class="fadeInRight animated"><?php echo substr(get_the_title(), 0, 1); ?></em>
                                <span class="fadeInRight animated"><?php echo substr(get_the_title(), 1); ?></span>
                            </a>
                        </li>
                        <?php
                    } ?>
                </ul>
            </div>
        </div>

        <div class="col-sm-7 content-right">
            <div class="info">
                <div class="col-sm-offset-1 col-sm-5">
                    <?php foreach($children as $post) {
                        ?>
                        <p class="drives-content" id="drives_<?php echo $post->post_name ?>">
                            <?php echo do_shortcode($post->post_content) ?>
                        </p>
                        <?php
                    } ?>
                </div>
                <div class="clearfix"></div>
            </div>


        </div><!--col-sm-7-->
        <div class="bottom_left_slanted"></div>
    </section>
<?php
} wp_reset_postdata(); ?>

<section class="milestones">
    <div class="overlay-pattern0"></div>

    <div class="milestone-content">
        <div class="item milestone-1986">
            <ul class="timeline">
                <li>
                    <spans class="badges"></spans>
                    <span class="tcolor">SSA Cosulting Group (SSA) </span> established
                </li>
            </ul>
        </div>
        <div class="item milestone-1992">
            <ul class="timeline">
                <li>
                    <spans class="badges"></spans>
                    Developed and launched <span class="tcolor">Programme for the Revitalisation of Mature Employees (PRIME)</span>
                </li>
            </ul>
        </div>
        <div class="item milestone-1995">
            <ul class="timeline">
                <li>
                    <spans class="badges"></spans>
                    Developed and launched <span class="tcolor">Developing Resourcefulness in Valued Employee (DRIVE)</span>
                </li>
            </ul>
        </div>
        <div class="item milestone-2001">
            <ul class="timeline">
                <li>
                    <spans class="badges"></spans>
                    <span class="tcolor">SME Partner</span>
                    Award
                </li>
            </ul>
        </div>
        <div class="item milestone-2003">
            <ul class="timeline">
                <li>
                    <spans class="badges"></spans>
                    Developed and launched <span class="tcolor">Skills Certificate in Small Business </span>
                    in collaboration with Temasek Polytechnic
                </li>
            </ul>
        </div>
        <div class="item milestone-2005">
            <ul class="timeline">
                <li>
                    <spans class="badges"></spans>
                    Developed and launched <span class="tcolor"> Certificate in Management of Non-Profit Organisation </span>
                    in collaboration with Ngee Ann Polytechnic &amp; SSTI
                </li>
            </ul>
        </div>
        <div class="item milestone-2008">
            <ul class="timeline">
                <li>
                    <spans class="badges"></spans>
                    Appointed as one of the pioneer CET Centres in <span class="tcolor"> Employability Skills System (ESS) </span>
                </li>
            </ul>
        </div>
        <div class="item milestone-2009">
            <ul class="timeline">
                <li>
                    <spans class="badges"></spans>
                    Appointed as Programme Partner for <span class="tcolor"> Generic Manufacturing SKills (WSQ) </span>
                </li>
                <li class="invert">
                    <spans class="badges"></spans>
                    Approved Training Organisation for <span class="tcolor"> Service Excellence </span>
                </li>
                <li>
                    <spans class="badges"></spans>
                    Appointed CET Centre for <span class="tcolor"> CSP programme </span>
                </li>
            </ul>
        </div>
        <div class="item milestone-2010">
            <ul class="timeline">
                <li>
                    <spans class="badges"></spans>
                    Appointed as Approved Programme Provider for the <span class="tcolor"> ACCA Continuing Professional Development (CPD) </span>
                </li>
                <li class="invert">
                    <spans class="badges"></spans>
                    Reappointed as a CET Centre for <span class="tcolor"> Workplace Literacy &amp; Numeracy (WPLN) </span>
                </li>
                <li>
                    <spans class="badges"></spans>
                    Accredited <span class="tcolor"> ICDL Test Centre </span>
                </li>
            </ul>
        </div>
        <div class="item milestone-2011">
            <ul class="timeline">
                <li>
                    <spans class="badges"></spans>
                    Reappoited as CET Centre for <span class="tcolor"> Workplace Skills (WPS) </span>
                </li>
                <li class="invert">
                    <spans class="badges"></spans>
                    Appointed as CET Centre for <span class="tcolor"> Executive Development &amp; Growth for Excellence (EDGE) </span>
                </li>
                <li>
                    <spans class="badges"></spans>
                    Listed in <span class="tcolor"> SME 1000 2011 </span> by DP Information Group
                </li>
            </ul>
        </div>
        <div class="item milestone-2012">
            <ul class="timeline">
                <li>
                    <spans class="badges"></spans>
                    Listed in <span class="tcolor">SME 1000 2012</span>
                </li>
                <li class="invert">
                    <spans class="badges"></spans>
                    Apointed CET Centre in <span class="tcolor">Genereic Manufacturing Skills (GMS)</span>
                </li>
                <li>
                    <spans class="badges"></spans>
                    Appointed as <span class="tcolor">Programme Provider for ICPAS</span>
                </li>
                <li class="invert">
                    <spans class="badges"></spans>
                    Award for <span class="tcolor">ICDL Operational Excellence</span>
                </li>
                <li>
                    <spans class="badges"></spans>
                    ICV Accredited <span class="tcolor">by Spring Singapore</span>
                </li>
            </ul>
        </div>
        <div class="item milestone-2013">
            <ul class="timeline">
                <li>
                    <spans class="badges"></spans>
                    Listed in <span class="tcolor">SME 1000 2013</span>
                </li>
                <li class="invert">
                    <spans class="badges"></spans>
                    Reappointed as <span class="tcolor">CET Centre for WPLN</span>
                </li>
                <li>
                    <spans class="badges"></spans>
                    Appointed as <span class="tcolor">ATO Chartered Accountant (Singapore) </span> under the Singapore Qualifications Programme
                </li>
            </ul>
        </div>
        <div class="item milestone-2014">
            <ul class="timeline">
                <li>
                    <spans class="badges"></spans>
                    Listed in <span class="tcolor">SME 1000 2014</span>
                </li>
                <li class="invert">
                    <spans class="badges"></spans>
                    Promising <span class="tcolor"> SME 500 2014</span>
                </li>
                <li>
                    <spans class="badges"></spans>
                    Established office in <span class="tcolor">Manila, Philippines </span>
                </li>
                <li class="invert">
                    <spans class="badges"></spans>
                    <span class="tcolor"> ICDL Operational Excellence </span> Award
                </li>
            </ul>
        </div>
        <div class="item milestone-2015">
            <ul class="timeline">
                <li>
                    <spans class="badges"></spans>
                    Listed in <span class="tcolor">SME 1000 2015</span>
                </li>
                <li class="invert">
                    <spans class="badges"></spans>
                    <span class="tcolor"> ICDL Operational Excellence</span> Award
                </li>
                <li>
                    <spans class="badges"></spans>
                    <span class="tcolor">2015 APAC Insider Business Awards </span>  for Best Management &amp; Training Consultancy Firm - Singapore
                </li>
            </ul>
        </div>
        <div class="item milestone-2016" style="">
            <ul class="timeline">
                <li>
                    <spans class="badges"></spans>
                    <span class="tcolor">Promising SME 500 Industry Star Award </span> (Training &amp; Consultancy)
                </li>
                <li class="invert">
                    <spans class="badges"></spans>
                    Promising <span class="tcolor"> SME 500 2016</span>
                </li>
                <li>
                    <spans class="badges"></spans>
                    Listen in <span class="tcolor">SME 1000 2016</span>
                </li>
            </ul>
        </div>

    </div>
    <div class="milestone-year">
        <div class="item">
            <h4>1986</h4>
        </div>
        <div class="item">
            <h4>1992</h4>
        </div>
        <div class="item">
            <h4>1995</h4>
        </div>
        <div class="item">
            <h4>2001</h4>
        </div>
        <div class="item">
            <h4>2003</h4>
        </div>
        <div class="item">
            <h4>2005</h4>
        </div>
        <div class="item">
            <h4>2008</h4>
        </div>
        <div class="item">
            <h4>2009</h4>
        </div>
        <div class="item">
            <h4>2010</h4>
        </div>
        <div class="item">
            <h4>2011</h4>
        </div>
        <div class="item">
            <h4>2012</h4>
        </div>
        <div class="item">
            <h4>2013</h4>
        </div>
        <div class="item">
            <h4>2014</h4>
        </div>
        <div class="item">
            <h4>2015</h4>
        </div>
        <div class="item">
            <h4>2016</h4>
        </div>
    </div>
</section>

<?php get_footer(); ?>