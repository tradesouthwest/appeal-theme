<?php
/**
 * Template Name: Top Advert Template
 * @theme Appeal
 */

    if (have_posts()) : ?>

		<?php while (have_posts()) : the_post(); ?>

		    <?php the_content(); ?>xxxx

		<?php endwhile; ?><?php endif; ?>