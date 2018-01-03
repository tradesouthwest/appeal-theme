<?php get_header(); ?>

    <div id="content" class="row">

    <?php //use 9 by 3 if gallery or image post type
    if( has_post_format( 'gallery' ) || has_post_format( 'image' ) ) { ?>

        <div id="main" class="col-xs-12">

            <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>

                <?php get_template_part( 'content' ); ?>

            <?php endwhile; ?>
                <?php else : ?>

                    <?php get_template_part( 'nothing' ); ?>

            <?php endif; ?>

            <?php get_template_part( 'nav', 'content' ); ?>

        </div>

        <?php } //ends gallery wider width page
        else { ?>


	    <div id="main" class="col-xs-12 col-sm-6 col-md-7 col-lg-7" role="main">

		<?php if (have_posts()) : ?>
		<?php while (have_posts()) : the_post(); ?>

		    <?php get_template_part( 'content' ); ?>

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
<?php } // ends display three columns if not gallery
?>

    </div><!-- ends #content .row -->

<?php get_footer(); ?>
