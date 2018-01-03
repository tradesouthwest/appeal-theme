<?php get_header(); ?>

<div id="content" class="row">

	<div id="main" class="col-sm-8" role="main">
<h2 class="textcenter"><?php esc_html_e( 'Looks like the content you were looking for does not exists at this time.', 'appeal' ); ?></h2>
		<div id="post-not-found" class="block">

		<section>
            <div class="post_content">
			
				<?php get_template_part( 'nothing' ); ?>
		    
		    </div>	
		    <div class="clearfix"></div>
			
    <h3><?php esc_html_e( 'You may have landed on this page because of: ', 'appeal' ); ?></h3>
    <ul>
    <li><?php esc_html_e( 'An out-of-date bookmark/favourite', 'appeal' ); ?></li>
    <li><?php esc_html_e( 'A search engine that has an out-of-date listing for this site', 'appeal' ); ?></li>
    <li><?php esc_html_e( 'A mistyped address', 'appeal' ); ?></li>
    <li><?php esc_html_e( 'You have no access to this page', 'appeal' ); ?></li>
    <li><?php esc_html_e( 'The requested resource was not found', 'appeal' ); ?></li>
    <li><?php esc_html_e( 'An error has occurred while processing your request', 'appeal' ); ?></li>
    </ul>
    <h1><a href="<?php echo esc_url( home_url( '/' ) ); ?>"
           title="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"
           class="btn btn-default">
           <?php esc_html_e( 'Return to Home Page', 'appeal' ); ?></a></h1>
		</section>

		</div>

	</div>
	
    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">

        <?php the_widget( 'WP_Widget_Pages' ); ?> 
        <?php the_widget( 'WP_Widget_Meta' ); ?> 
         
    </div>

</div>

<?php get_footer(); ?>
