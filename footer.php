
            </div><!-- ends from tag #page-content (below nav/header) -->
        </div><!-- .container -->


            <?php if( is_active_sidebar( 'sidebar-bottom' ) ) : ?>
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 bottombox">
    
                        <?php get_sidebar( 'bottom' ); ?>
    
                    </div>
                </div>
            </div>
            <?php endif; ?>

    </div><!-- .content-wrapper -->
        <footer class="footer-footer container-fluid">
            <?php if ( has_nav_menu( 'above_footer' ) ) : ?>
            
           
            <div id="socialContainer">
            <nav class="social-footer">
                    <?php
                    wp_nav_menu( array(
                    'theme_location' => 'above_footer',
                    'container'     => 'ul',
                    'depth'        => 1,
                    'fallback_cb' => '__return_false',
                    'menu_class' => 'nav navbar-nav'));
                    ?>
            </nav>
            </div>
            
            <?php endif; ?>
                <div id="inner-footer">

                    <div class="row">
                        <div class="col-sx-12 col-md-4 col-lg-4">
                        <?php if ( is_active_sidebar( 'footer-middle' ) ) { ?>

                        <div class="block">
	                        <?php dynamic_sidebar( 'footer-left' ); ?>
                        </div>

                        <?php } ?>

    		            </div>

    			        <div class="col-sx-12 col-md-4 col-lg-4">

		                <?php if ( is_active_sidebar( 'footer-middle' ) ) { ?>

                        <div class="block">
                    	    <?php dynamic_sidebar( 'footer-middle' ); ?>
                        </div>

                        <?php } ?>

    		            </div>

    			        <div class="col-sx-12 col-md-4 col-lg-4 end">

		                <?php if ( is_active_sidebar( 'footer-right' ) ) { ?>

                        <div class="block">

                            <?php dynamic_sidebar( 'footer-right' ); ?>
                        </div>

                        <?php } ?>

		                </div><div class="clearfix"></div>

                        <nav class="text-center copyright">

                            <div class="col-sx-12 col-md-4">
                                <p><?php esc_html_e('Design by ', 'appeal' ); ?>
                                <a href="http://tradesouthwest.com"
                                   title="Tradesouthwest"> TSW=|=</a></p>
                            </div>

                            <div class="col-sx-12 col-md-4">
                            <?php  if ( get_theme_mods() ) { 
                            $appeal_copyright = get_theme_mod( 'appeal_copyright_text_setting' );
                            if( $appeal_copyright != '' ) { ?><p><?php 
                            echo esc_html( $appeal_copyright ); ?></p>
                            <?php } else { ?>
                                <p class="text-muted"><?php
                                $year  = date_i18n(__( 'Y', 'appeal' ));
                                esc_html_e( 'Copyright ', 'appeal' ); 
                                echo esc_attr( ' ' . $year . ' ' );
                                printf( esc_attr( bloginfo( 'name' ) ) ); ?></p>
                            <?php } } ?>    
                            </div>

                            <div class="col-sx-12 col-md-4">
                                <p><a href="#"
                                      title="^"
                                      class="btn btn-default">
                                      <?php esc_attr_e("Top/Pg.", "appeal"); ?></a></p>
                            </div>

                        </nav>
                    </div>

                </div>
            </footer>

    <?php wp_footer(); ?>


</body>
</html>
