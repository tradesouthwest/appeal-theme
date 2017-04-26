<?php get_header(); ?>

    <div id="content" class="row">

	    <div id="main" class="col-xs-12 col-sm-6 col-md-7 col-lg-7" role="main">


		<?php if (have_posts()) : ?>
		<?php while (have_posts()) : the_post(); ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class( 'page-lines' ); ?>>
            <h2 class="entry-title">
             <a class="text-dark"
                href="<?php the_permalink(); ?>"
                title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
            <section class="post_content">

            <?php
            $length          = appeal_custom_posts_excerpt_length();
            $appealmore      = appeal_custom_excerpt_more();
            $content         = get_the_content();
            $trimmed_content = wp_trim_words( $content, $length, $appealmore );

            echo '<p>'.$trimmed_content.'</p>'; ?>


                    <nav class="pagination"><?php // more tag display
                    wp_link_pages();
                    ?></nav>

            </section>
                <footer class="meta-footer">

                    <?php get_template_part('part', 'metadata' ); ?>

                </footer><div class="clearfix"></div>

        </article>
		<?php endwhile; ?>

		<?php else : ?>

		       <?php get_template_part( 'nothing' ); ?>

		<?php endif; ?>

                    <?php get_template_part( 'nav', 'content' ); ?>

	    </div>
        <div class="col-xs-12 col-sm-6 col-md-2 col-lg-2">

            <?php get_sidebar( 'left'); ?>

        </div>
        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">

            <?php get_sidebar( 'right' ); ?>

        </div>


    </div><!-- ends #content .row -->

<?php get_footer(); ?>