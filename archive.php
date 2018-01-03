<?php get_header(); ?>

    <div id="content" class="row">

	    <div id="main" class="col-xs-12 col-sm-12 col-md-8 col-lg-8" role="main">

		  <?php if (have_posts()) : ?>

			<header id="archive-header">

				<h1 class="page-title">
					<?php if ( is_category() ) : ?>
						<?php the_archive_title( '', false ); ?>

					<?php elseif ( is_author() ) : ?>
						<?php esc_html_e( 'Author Archive for ', 'appeal' ); ?>
						<span class="text-note"> 
                            <?php printf( esc_attr( get_the_author_meta( 
                                      'display_name', get_query_var( 'author' ) ) ) 
                                    ); ?></span>

					<?php elseif ( is_tag() ) : ?>
						<?php echo esc_html_e( 'Tag Archive for ', 'appeal' ); ?>
						<span class="text-note"> 
                        <?php the_archive_title( ); ?></span>

					<?php elseif ( is_day() ) : ?>
						<?php echo esc_html_e( 'Dated Archives: ', 'appeal' ); ?>
						<span class="text-note"> 
                            <?php printf( esc_attr( get_the_date() ) ); ?></span>

					<?php elseif ( is_month() ) : ?>
						<?php echo esc_html_e( 'Monthly Archives: ', 'appeal' ); ?>
						<span class="text-note"> 
                            <?php printf( esc_attr( get_the_date( 'F Y' ) ) ); ?></span>

					<?php elseif ( is_year() ) : ?>
						<?php echo esc_html_e( 'Yearly Archives: ', 'appeal' ); ?>
						<span class="text-note"> 
                            <?php printf( esc_attr( get_the_date( 'Y' ) ) ); ?></span>

    					<?php else : ?>
    						<?php the_archive_title(); ?>
    						<?php the_archive_description(); ?>

    				<?php endif; ?>
				</h1><!-- .page-title -->
				
				<?php
				$category_description = the_archive_description();
				if ( $category_description != '' ) : ?> 
				
				    <div class="archive-meta">
				        <p><?php the_archive_description(); ?></p>
				    </div>
				
				<?php endif; ?>

    		</header><!-- #archive-header -->
            <?php
            while ( have_posts() ) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <h1 class="entry-title"><?php the_archive_title(); ?> 
                <a href="<?php the_permalink() ?>" rel="bookmark" 
                   title="<?php the_archive_title(); ?>" >
                   <?php the_title(); ?></a></h1>
                <div class="entry-content">

                    <?php the_excerpt(); ?>
                    
                         <a href="<?php echo esc_url( get_permalink() ); ?>" 
                            title="<?php the_title_attribute(); ?>"> 
                      <?php esc_attr_e( 'View Article...', 'appeal' ); ?></a>
                </div><!-- ends entry-content -->   
                    <footer class="meta-footer archive-footer">

                    <?php $time_format = get_the_date( get_option('date_format') ); ?>
                     
                    <span class="alignright mb1" 
                      itemprop="datePublished"><?php echo esc_html( $time_format ); ?></span> 
                      
                    </footer>
            </article><!-- #post -->

        <?php endwhile; // end of the loop ?>

		<?php else : ?>

		       <?php get_template_part( 'nothing' ); ?>

		<?php endif; ?>

                    <?php get_template_part( 'nav', 'content' ); ?>

	    </div>
	    
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">

            <?php get_sidebar( 'right' ); ?>

        </div>


    </div><!-- ends #content .row -->

<?php get_footer(); ?>
