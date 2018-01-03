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
            <h2 class="entry-title"><?php the_title(); ?></h2>
            <section class="post_content">
            
	    <?php 
	    $content = '';
        $content = appeal_split_content();
        // output first content section in column1
	    echo '<div id="column1" class="col-sm-6">', 
	    wp_kses_post( force_balance_tags( array_shift($content) ) ), '</div>';

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
        
        <?php get_template_part( 'nav', 'content' ); ?>
	
	</div>
	<div class="hidden-xs col-sm-12 col-md-3 col-lg-3">

            <?php get_sidebar( 'right' ); ?>

        </div>

</div>

<?php get_footer(); ?>
