<?php
// attachment page for theme Appeal
get_header(); ?>

    <div id="content" class="row">
	    <div id="main" class="col-xs-12 col-sm-8 col-md-9 col-lg-9" role="main">
            <?php
            if ( have_posts() ) : while ( have_posts() ) : the_post();
            ?>
            <h1><?php the_title(); ?></h1>
                <div class="entry-attachment">
                    <?php if ( wp_attachment_is_image( $post->id ) ) :
                        $att_image = wp_get_attachment_image_src( $post->id, "full"); ?>

                    <p class="attachment">
                       <a href="<?php echo esc_attr( wp_get_attachment_url( $post->id ) ); ?>"
                       title="<?php the_title_attribute(); ?>"
                       rel="attachment"><img src="<?php echo esc_attr($att_image[0]);?>"
                       width="<?php echo esc_attr($att_image[1]);?>"
                       height="<?php echo esc_attr($att_image[2]);?>"
                       class="img-responsive"
                       alt="<?php the_title_attribute(); ?>" /></a>
                    </p>

                        <?php else : ?>

                        <a href="<?php echo esc_url(wp_get_attachment_url($post->ID)) ?>"
                           title="<?php echo esc_attr(get_the_title($post->ID), 1 ) ?>"
                           rel="attachment"><?php printf( esc_url( basename($post->guid) ) ); ?></a>

                    <?php endif; ?>
                    <hr>

                    <?php the_excerpt(); ?>

                </div>

		            <footer class="meta-footer">

                        <?php get_template_part('part', 'metadata' ); ?>

                    </footer>

                    <?php comments_template(); ?>

		<?php endwhile; ?>

		<?php else : ?>

		  <?php get_template_part( 'nothing' ); ?>

		<?php endif; ?>

    <?php get_template_part( 'nav', 'content' ); ?>

    </div>
        <div class="col-xs-12 col-sm-4 col-md-3 col-lg-3">

            <?php get_sidebar( 'right' ); ?>

        </div>


    </div><!-- ends #content .row -->

<?php get_footer(); ?>
