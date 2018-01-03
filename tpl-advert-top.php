<?php
/**
 * Template Name: Top Advert Template
 * @theme Appeal
 */
get_header(); ?>

    <div id="content" class="row">

        <div id="main" class="col-xs-12 col-sm-12 col-md-9 col-lg-9" role="main">

        <?php if (have_posts()) : ?>

        <?php while (have_posts()) : the_post(); ?>

            <?php get_template_part( 'content' ); ?>

        <?php endwhile; ?>

        <?php else : ?>

                <?php get_template_part( 'nothing' ); ?>

        <?php endif; ?>

            <?php get_template_part( 'nav', 'content' ); ?>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">

            <?php get_sidebar( 'right' ); ?>

        </div>


    </div><!-- ends #content .row -->

<?php get_footer(); ?>
