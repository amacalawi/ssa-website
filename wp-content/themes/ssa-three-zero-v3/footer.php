    <footer role="contentinfo">
        <div class="inner">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <h2 class="tcolor"><strong><em>GET IN TOUCH WITH US</em></strong></h2>

                        <?php get_template_part('footer', 'mailchimp'); ?>

                    </div>
                    <div class="col-sm-12 col-md-3">
                        <a class="" href="<?php bloginfo('url') ?>">
                            <h4><strong><em><?php bloginfo('name') ?></em></strong></h4>
                        </a>
                        <p><?php bloginfo('description') ?></p>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="row">
                            <div class="col-xs-6 col-md-3 col-md-offset-1">
                                <?php
                                if ( has_nav_menu( 'company_links' ) ) {
                                    $menu_name = 'company_links';
                                    $locations = get_nav_menu_locations();
                                    $menu_id = $locations[ $menu_name ] ;
                                    $company_links = wp_get_nav_menu_object($menu_id); ?>

                                    <h5><?php echo $company_links->name ?></h5>
                                    <?php wp_company_links();
                                } ?>
                            </div>
                            <div class="col-xs-6 col-md-3">
                                <?php
                                if ( has_nav_menu( 'internal_links' ) ) {
                                    $menu_name = 'internal_links';
                                    $locations = get_nav_menu_locations();
                                    $menu_id = $locations[ $menu_name ] ;
                                    $internal_links = wp_get_nav_menu_object($menu_id); ?>
                                    <h5><?php echo $internal_links->name ?></h5>
                                    <?php wp_internal_links();
                                } ?>
                            </div>
                            <div class="col-xs-6 col-md-3 col-md-offset-1">
                                <?php
                                if ( has_nav_menu( 'social_links' ) ) {
                                    $menu_name = 'social_links';
                                    $locations = get_nav_menu_locations();
                                    $menu_id = $locations[ $menu_name ] ;
                                    $social_links = wp_get_nav_menu_object($menu_id); ?>
                                    <h5><?php echo $social_links->name ?></h5><?php
                                    wp_social_links();
                                } ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <?php
                        if ( has_nav_menu( 'contact_links' ) ) {
                            $menu_name = 'contact_links';
                            $locations = get_nav_menu_locations();
                            $menu_id = $locations[ $menu_name ] ;
                            $contact_links = wp_get_nav_menu_object($menu_id); ?>
                            <h5><?php echo $contact_links->name ?></h5><?php
                            wp_contact_links();
                        } ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="outer">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <p class="wcolor"><?php the_copyright('1986') ?> | <?php the_developer('SSA Manila'); ?></p>
                    </div>
                    <div class="col-sm-6">
                       <?php wp_bootstrap_footer_links(); // Adjust using Menus in Wordpress Admin ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- <div id="widget-footer" class="row">
            <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer1') ) : ?>
            <?php endif; ?>
            <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer2') ) : ?>
            <?php endif; ?>
            <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer3') ) : ?>
            <?php endif; ?>
        </div> -->
        <a href="#banner" class="btn waves-effect" title="back to top" id="back-to-top">
            <i class="zmdi zmdi-chevron-up"></i>
        </a>
    </footer>

	<?php wp_footer(); // js scripts are inserted using this function ?>
</body>
</html>