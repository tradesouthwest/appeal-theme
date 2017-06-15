<?php
/*
Template Name: Two Part Content
Appeal page-twopart
use more tag to split content "&gt;!--more-->"
*/
?>
<?php get_header(); ?>

<div id="content" class="row">

	<div id="main" class="col-md-9" role="main">
	  		<?php if (have_posts()) : ?>
		<?php while (have_posts()) : the_post(); ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class( 'page-lines' ); ?>>
            <h2 class="entry-title">
             <a class="text-dark"
                href="<?php the_permalink(); ?>"
                title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
            <section class="post_content">
	    <?php 

            $content = appeal_split_content();
            // output first content section in column1
	    echo '<div class="col-sm-6">', array_shift($content), '</div>';

	    // output remaining content sections in column2
	    echo '<div id="column2" class="col-sm-6">', implode($content), '</div>';
	   
            ?>
            
            </section>
                <footer class="meta-footer">

                    <?php get_template_part('part', 'metadata' ); ?>

                </footer><div class="clearfix"></div>

        </article>
            
            <?php endwhile; ?>
		<?php else : ?>

		  <?php get_template_part( 'nothing' ); ?>

		<?php endif; ?>

	</div>
	<div class="hidden-xs col-sm-12 col-md-3 col-lg-3">

            <?php get_sidebar( 'right' ); ?>

        </div>

</div>

<?php get_footer(); ?>
