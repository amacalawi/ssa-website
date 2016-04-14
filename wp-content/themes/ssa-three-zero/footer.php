    <footer role="contentinfo">
        <div class="inner">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <h2 class="tcolor"><strong><em>
                            GET IN TOUCH WITH US
                        </em></strong></h2>

                        <!-- Begin MailChimp Signup Form -->
                        <form action="//ssagroup.us2.list-manage.com/subscribe/post?u=127beb85a5c7f8f3e42bef741&amp;id=4d7290eab2" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
                            <div id="mc_embed_signup_scroll" class="form-group">
                                <div class="fg-line">
                                    <input type="email" value="" name="EMAIL" class="email form-control input-lg" id="mce-EMAIL" placeholder="ENTER YOUR EMAIL ADDRESS" required>
                                </div>
                            <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                            <div class="form-control hidden" aria-hidden="true">
                                <input type="text" name="b_127beb85a5c7f8f3e42bef741_4d7290eab2" tabindex="-1" value="">
                            </div>
                            <button type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="btn waves-effect">Subscribe Now</button>
                        </form>
                        <!-- End mailChimp -->

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
                                    <h5><?php echo $company_links->name ?></h5><?php
                                    wp_company_links();
                                } ?>
                            </div>
                            <div class="col-xs-6 col-md-3">
                                <?php
                                if ( has_nav_menu( 'internal_links' ) ) {
                                    $menu_name = 'internal_links';
                                    $locations = get_nav_menu_locations();
                                    $menu_id = $locations[ $menu_name ] ;
                                    $internal_links = wp_get_nav_menu_object($menu_id); ?>
                                    <h5><?php echo $internal_links->name ?></h5><?php
                                    wp_internal_links();
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
                        <p class="wcolor"><?php the_copyright('1986') ?> | Designed by
                        <a href="#">SSA Manila</a></p>
                    </div>
                    <div class="col-sm-6">
                       <?php wp_bootstrap_footer_links(); // Adjust using Menus in Wordpress Admin ?>
                    </div>
                </div>
            </div>
        </div>
        <div id="widget-footer" class="clearfix row">
            <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer1') ) : ?>
            <?php endif; ?>
            <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer2') ) : ?>
            <?php endif; ?>
            <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer3') ) : ?>
            <?php endif; ?>
        </div>
        <a href="#banner" class="btn waves-effect" title="back to top" id="back-to-top">
            <i class="zmdi zmdi-chevron-up"></i>
        </a>
    </footer>

	<!--[if lt IE 7 ]>
			<script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
			<script>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
	<![endif]-->

	<?php wp_footer(); // js scripts are inserted using this function ?>
</body>
</html>