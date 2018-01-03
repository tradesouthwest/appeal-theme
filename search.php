<?php get_header(); ?>

    <div id="content" class="row">

	    <div id="main" class="col-xs-12 col-sm-12 col-md-8 col-lg-8" role="main">

		<?php if (have_posts()) : ?>
        <h2><?php esc_html_e( 'Search Results for: ', 'appeal' ); echo esc_html( get_search_query() ); ?></h2>
             
            <?php  while ( have_posts() ) : the_post(); ?>
        
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <h4 class="entry-title"><a href="<?php the_permalink() ?>"
                                           rel="bookmark"><?php the_title(); ?></a></h4>
                <div class="entry-content">

                    <?php the_excerpt(); ?>
                        
                </div><!-- ends entry-content -->
                    <footer class="meta-footer">
                      <a href="<?php echo esc_url( get_permalink() ); ?>" 
                            title="<?php the_title_attribute(); ?>"> 
                      <?php esc_attr_e( 'View Article...', 'appeal' ); ?></a>
                      <time class="alignright" 
                            datetime="<?php the_time( get_option( 'date_format' )); ?>"
                            itemprop="datePublished" pubdate 
                            class="thedate"><em><?php echo esc_attr( 
                            the_date( ) ); ?></em>
                      </time> 
                        <div class="clearfix"></div>      
                    </footer>
            </article><!-- #post -->

        <?php endwhile; // end of the loop ?>

		<?php else : ?>

		       <?php get_template_part( 'nothing' ); ?>

		<?php endif; ?>

                    <?php get_template_part( 'nav', 'content' ); ?>

            <aside class="post_content">
            <h4><?php esc_html_e( 'Search Results End', 'appeal' ); ?></h4>
				    

			</aside>
	    </div>
	    
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">

            <?php get_sidebar( 'right' ); ?>

        </div>


    </div><!-- ends #content .row -->

<?php get_footer(); ?>
