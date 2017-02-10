<article id="post-<?php the_ID(); ?>" <?php post_class( 'page-lines' ); ?>>
<?php
global $more;
$more = 0;
?>
    <div class="article-inner">
	   <header>
		  <h2 class="entry-title">
           <a class="text-dark"
              href="<?php the_permalink(); ?>"
              title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
		  <div class="entry-meta">
			<p class="theauthor">
<?php echo get_avatar( get_the_author_meta( 'email' ), 42 ); ?><span> </span>
<?php  echo nl2br( get_the_author_meta( 'nicename' ) ); ?></p>
		  </div>
	   </header>

	   <div class="entry-content">

        <?php if ( is_front_page() && is_home() ) {
        // Default homepage (blog)
        ?>
        <section class="post_content">

            <?php appeal_theme_excerpt_length( '88' ); ?>

        </section><div class="clearfix"></div>
            <footer>

                <?php the_tags('<p class="tags">', ' ', '</p>'); ?>
                <?php get_template_part('part', 'metadata' ); ?>
            </footer>



        <?php } elseif ( is_home()) {
        //Blog page
        ?>
        <section class="post_content">

        <?php the_excerpt(); ?><div class="clearfix"></div>

        </section>
            <footer class="meta-footer">

                <?php get_template_part('part', 'metadata' ); ?>

            </footer>

        <?php } elseif ( is_single() ) { ?>

            <section class="post_content">
            <?php
            // check if the post has a Post Thumbnail assigned to it.
            if ( has_post_thumbnail() ) {
    	       the_post_thumbnail('thumbnail',
                           array( 'class' => 'alignleft' ) );
            }
            ?>

                <?php if ( has_excerpt( $post->ID ) ) { ?>
                <div class="pullquote">
                        <aside>
                            <?php $theme_modA = appeal_teaser_length();
                        esc_html( $theme_modA ); ?>
                        </aside>
                </div>
                <?php } ?>

                    <?php the_content(); ?>

                    <nav class="pagination"><?php // more tag display
                    wp_link_pages();
                    ?></nav>

            </section><div class="clearfix"></div>
                <footer class="meta-footer">

                    <?php get_template_part('part', 'metadata' ); ?>

                </footer>

                    <?php comments_template(); ?>

            <?php } else {
                //everything 4else
                ?>
                <section class="post_content">
                    <div class="inside-content">
                    <?php
                    // check if the post has a Post Thumbnail assigned to it.
                    if ( has_post_thumbnail() ) {
    	                 the_post_thumbnail('thumbnail',
                                     array( 'class' => 'alignleft' ) );
                    }
                    ?>

                            <?php if ( has_excerpt( $post->ID ) ) { ?>
                            <div class="pullquote">
                                <aside>
                                    <?php $theme_modA = appeal_teaser_length();
                                esc_html( $theme_modA ); ?>
                                </aside>
                            </div>
                            <?php } ?>

                            <?php the_content(); ?>

                    </div>
                </section><div class="clearfix"></div>
                    <footer class="meta-footer">

                        <?php get_template_part('part', 'metadata' ); ?>

                    </footer>

                        <?php comments_template(); ?>

<?php } ?>
        </div>
	</div>
</article>
