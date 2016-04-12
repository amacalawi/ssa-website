    <footer role="contentinfo">
        <div class="inner">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <h2 class="tcolor"><strong><em>
                            GET IN TOUCH WITH US
                        </em></strong></h2>
                        <form>
                            <div class="form-group">
                                <div class="fg-line">
                                    <input type="text" class="form-control input-lg" placeholder="ENTER YOUR EMAIL ADDRESS">
                                </div>
                            </div>
                            <button type="button" class="btn waves-effect"> SUBSCRIBE NOW!</button>
                        </form>
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
                                <h5>Company</h5>
                                <ul class="list-unstyled">
                                    <li>
                                        <a title="Executives" href="#">
                                            <span>Executives</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a title="Vision and Mission" href="#">
                                            <span>Vision &amp; Mission</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a title="Values" href="#">
                                            <span>Values</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a title="Milestones" href="#">
                                            <span>Milestones</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-xs-6 col-md-3">
                                <h5>LINKS</h5>
                                <ul class="list-unstyled">
                                    <li>
                                        <a title="Services" href="#">
                                            <span>Services</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a title="Clients" href="#">
                                            <span>Clients</span>
                                        </a></li>
                                    <li>
                                        <a title="Events" href="#">
                                            <span>Events</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a title="Blogs" href="#">
                                           <span>Blogs</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a title="CSR" href="#">
                                            <span>CSR</span>
                                        </a>
                                    </li>
                                </ul>
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
                        <h5>Contact Us</h5>
                            <ul class="list-unstyled">
                                <li>11 Eunos Road 8 Lifelong Learning Institute #06-01 Singapore 408601
                                </li>
                                <li>Tel: +65 6842 2282</li>
                                <li>Fax: +65 6842 2282</li>
                                <li>contact@ssagroup.com</li>
                            </ul>
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