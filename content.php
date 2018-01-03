<?php
/**
 * All content types handled fron this file
 * @uses is_page()....
 *
 * Attachment and thumbnail use custom 400x300px but adjust
 * display size according to orientation, down to 180x180
 * @4x3 standard computer media ratio - (not 16:9)
 * @180x180px thumbnail squared = `appeal-thumbnail`
 * @since 1.0.7 Modal section moved to bottom.
 *
 */
/**
 * Start Article Content case
 * ************************************************************ */
$alts = esc_attr( get_the_title( $post->ID  ) );
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> 
         itemscope itemtype="http://schema.org/Article">
    <div class="article-inner">
        <div class="entry-content">



<?php if ( is_front_page() && is_home() ) {
// Default if-homepage is blog. Has thumb in excerpt
?>

            <div class="post_content appeal_blog">

                <?php get_template_part('content', 'header' ); ?>

                <div class="row">
                    <div class="after-content-header">

                    <?php if( has_post_thumbnail() ) : ?>
                        <div class="col-xs-3 col-sm-3 col-lg-4">

                        <?php // Check which Post Thumbnail is assigned to post.
                        if ( has_post_thumbnail( 'appeal-thumbnail' ) ) { ?>
                        <?php printf( '<a class="appeal-imglink"
                              href="' . esc_url( get_permalink( $post->ID  ) ) . '"
                              title ="' . esc_attr( get_the_title( $post->ID ) ) . '">' 
                              ); ?>
                        <?php the_post_thumbnail( 'appeal-featured', array( 
                              'itemprop' => 'image', 
                              'class' => 'img-responsive appeal-thumbnail',
                              'alt' => $alts  ) ); ?></a>
                        <?php } else {
                            // ends if has custom thumb size
                            ?>
                            <?php printf( '<a class="appeal-imglink"
                                  href="' . esc_url( get_permalink( $post->ID ) ) . '"
                                  title ="' . esc_attr( get_the_title( $post->ID ) ) . '">' 
                                  ); ?>
                            <?php the_post_thumbnail('thumbnail', array( 
                                  'itemprop' => 'image', 
                                  'class' => 'img-responsive appeal-thumbnail',
                                  'alt' => $alts ) ); ?></a>
                            <?php }
                            //ends if has wp_thumbnail
                        ?>
                    </div>
                        <div class="col-xs-9 col-sm-9 col-lg-8">

                        <?php else : ?>

                        <div class="col-xs-12 col-sm-12 col-lg-12">

                    <?php endif;
                    // ends if has thumbnail
                    ?>

                        <div class="inner_content">
                        
                            <?php the_excerpt() ?> 
                            
                        </div>

                    </div>

                </div>
             </div>

        </div>

            <footer class="metafoot">

                <?php get_template_part('part', 'metadata' ); ?>

            </footer> 



<?php } elseif ( is_home() ) {
//Blog page if theme homepage is static. No thumb.
?>
        <section class="post_content">

           <?php get_template_part('content', 'header' ); ?>

            <?php the_excerpt(); ?> 

        </section><div class="clearfix"></div>
            <footer class="meta-footer">

                <?php get_template_part('part', 'metadata' ); ?>

            </footer> 

<?php } elseif ( is_single()  )  {
/**
 * Single post page will give attachment a link to Attachment template
 */
?>

        <section id="appeal-content" class="post_content">

		    <?php get_template_part('content', 'header' ); ?>

            <div class="row">
                <div class="after-content-header">

                <?php if( has_post_thumbnail() ) :
                ?>
                    <?php 
                        //set caption var for titles and caption
                        $get_description = get_post( 
                        get_post_thumbnail_id())->post_excerpt;
                        
                    // check which Post Thumbnail is assigned to page.
                    if ( has_post_thumbnail( 'appeal-thumbnail' ) ) { 
                    //SHOW APPEAL THUMB
                    ?>

                        <div class="col-xs-6 col-sm-6 col-lg-7">
                        <a class="appeal-imglinks"
                           href="<?php echo esc_url( get_attachment_link( 
                           get_post_thumbnail_id() ) ); ?>" 
                           <?php if( !empty ( $get_description ) ) { ?>
                           title="<?php echo esc_attr( $get_description ); ?>"<?php } ?>>
                        <?php the_post_thumbnail( 'appeal-featured', array( 
                                                  'itemprop' => 'image', 
                                                  'class' => 'img-responsive appeal-thumbnail',
                                                  'alt' => $alts ) ); ?></a>
                          <?php if( !empty( $get_description ) ) 
                          {
                            //If description-caption is not empty show the div
                          ?>
                            <div class="featured_caption" 
                                 title="<?php echo esc_attr( $get_description ); ?>">
                                 <?php echo esc_html( $get_description ); ?>
                            </div>
                          <?php 
                          } ?>          
    
                        </div>

                    <?php 
                    } else { 
                    //SHOW WP ATTACHMENT THUMB
                    ?>

                        <div class="col-xs-6 col-sm-6 col-lg-7">
                        <a class="appeal-imglinks"
                           href="<?php echo esc_url( get_attachment_link( 
                           get_post_thumbnail_id() ) ); ?>" 
                           <?php if( !empty ( $get_description ) ) { ?>
                           title="<?php echo esc_attr( $get_description ); ?>"<?php } ?>>
                        <?php the_post_thumbnail('thumbnail', array( 
                                                'itemprop' => 'image', 
                                                'class' => 'img-responsive appeal-thumbnail',
                                                'alt' => $alts ) ); ?></a>
                        <?php if(!empty($get_description)){
                              //If description-caption is not empty show the div
                        ?>
                        <div class="featured_caption">
                        <?php echo esc_html( $get_description ); ?>
                        </div>
                        <?php } ?>
                        </div>
                    <?php 
                    //ends wp thumb
                    } ?>

                <?php else : 
                echo '<div class="no-thumb"></div>';

                endif; 
                //end of check for thumbnail
                ?>
                    <?php 
                    // Check if theme mod Pullquote uusage is activated.
                    $theme_modEx = get_theme_mod( 
                    'appeal_custom_teaser_usage_setting', 'none' ); 
                    if( $theme_modEx == "block" ) 
                    : 
                    ?>
                        <?php if ( has_excerpt( $post->ID ) ) 
                        { ?>
                        <div class="col-xs-6 col-sm-6 col-lg-5">
                            <div class="pullquote">
                                <aside>
                                <?php the_excerpt() ?>
                                </aside>
                            </div>
                        </div><div class="clearfix"></div>
                        
                    <?php 
                        }  
                    endif;
                    //ends .after-content-header .row
                    ?>

                </div>
                    <div class="<?php echo esc_attr( appeal_post_formats() ); ?>">
                        <div class="inner_content">

                            <?php the_content(''); ?>

                        </div>
                    </div>
                        <div class="pagination">

		      <?php wp_link_pages( array(
                                     'before' => '<p class="nextpage-pagination">'
                                    . __( 'Pages : ', 'appeal' ),
                                    'after' => '</p>',
                                    'link_before' => '<span class="space">',
                                    'link_after' => '<span class="space">',
                                    'next_or_number' => 'number',
                                    'separator' => ' &nbsp; ',
                                    'pagelink' => '%',
                                    'echo' => 1
                                    )
                                ); ?>

		                </div>
                    
            </section><div class="clearfix"></div>
                <footer class="meta-footer">

                    <?php get_template_part('part', 'metadata' ); ?>

                </footer>

                    <?php comments_template(); ?>

                    <div class="row"><hr class="short"></div>
                    
                    

<?php } elseif ( is_page() )  { 
/**
 * Page template page default
 */
?>



    <section id="appeal-content" class="post_content">

    	<?php get_template_part('content', 'header' ); ?>

        <div class="row">
            <div class="after-content-header">
    <?php 
    // Check if theme mod Pullquote uusage is activated.
    $theme_modEx = get_theme_mod( 'appeal_custom_teaser_usage_setting', 'none' ); 
        if( $theme_modEx == "block" ) 
        { 
        ?>
                    
            <?php if( has_post_thumbnail() ) :
            // Check for thumbnail
            ?>
                <?php 
                // Check which Post Thumbnail is assigned to page.
                if ( has_post_thumbnail( 'appeal-thumbnail' ) ) 
                { 
                ?>

                <div class="col-xs-6 col-sm-6 col-lg-7">
                <a class="appeal-imglinks"
                   href="<?php echo esc_url( get_attachment_link( 
                   get_post_thumbnail_id() ) ); ?>">
                <?php the_post_thumbnail( 'appeal-featured', array( 
                                          'itemprop' => 'image', 
                                          'class' => 'img-responsive appeal-thumbnail',
                                          'alt' => $alts ) ); ?></a>
                </div>

                <?php 
                } else 
                    { ?>

                    <div class="col-xs-6 col-sm-6 col-lg-7">
                    <a class="appeal-imglinks"
                       href="<?php echo esc_url( get_attachment_link( 
                       get_post_thumbnail_id() ) ); ?>">
                    <?php the_post_thumbnail( 'thumbnail', array( 
                                              'itemprop' => 'image', 
                                              'class' => 'img-responsive appeal-thumbnail',
                                              'alt' => $alts ) ); ?></a>
                    </div>
                    <?php 
                    } // ends thumbnail choices
                    ?>

                    <?php else : echo '<div class="no-thumb"></div>';
                //ends thumbnail found
                endif; ?>
 
                <div class="col-xs-6 col-sm-6 col-lg-5">
                <?php if ( has_excerpt( $post->ID ) ) { ?> 
                    <div class="pullquote">
                        <aside>
                        <?php  
                         $page = get_post();
                         $the_excerpt = $page->post_excerpt;          
                         echo esc_html( $the_excerpt );  
                        ?> 
                        </aside>
                    </div>
                <?php } else { ?><div class="no-excerpt"></div><?php } ?>
                </div>
                
                        
    <?php 
    } else 
        {  
    //now do this if excerpt is NOT used as Pullquote
    ?>
        <?php if( has_post_thumbnail() ) : 
        // Run again but without Pulquote
        ?>
            <?php 
            // check which Post Thumbnail is assigned to page.
            if ( has_post_thumbnail( 'appeal-thumbnail' ) ) 
            { 
            ?>
                        
            <div class="col-sm-12">
                <a class="appeal-imglinks"
                   href="<?php echo esc_url( get_attachment_link( 
                   get_post_thumbnail_id() ) ); ?>">
                <?php the_post_thumbnail( 'appeal-featured', array( 
                                          'itemprop' => 'image', 
                                          'class' => 'img-responsive appeal-thumbnail',
                                          'alt' => $alts ) ); ?></a>
            </div>

            <?php 
            } else 
                { ?>

                <div class="col-sm-12">
                <a class="appeal-imglinks"
                   href="<?php echo esc_url( get_attachment_link( 
                   get_post_thumbnail_id() ) ); ?>">
                <?php the_post_thumbnail( 'thumbnail', array( 
                                          'itemprop' => 'image', 
                                          'class' => 'img-responsive appeal-thumbnail',
                                          'alt' => $alts ) ); ?></a>
                </div>
                <?php 
                } 
                //ends thumbnail choices
                ?>
                <?php else : echo '<div class="no-thumb"></div>';

            endif; ?>
                    
             
        <?php 
        }
        //ends .after-content-header .row and Pullquote not used choice
        ?>
                </div><!-- ends content-after-header -->
                    <div class="inner_content">

                            <?php the_content(''); ?>
                            
                    </div><div class="clearfix"></div>
                    <div class="pagination">

		            <?php wp_link_pages( array(
                                    'before' => '<p class="nextpage-pagination">'
                                    . __( 'Pages : ', 'appeal' ),
                                    'after' => '</p>',
                                    'link_before' => '<span class="space">',
                                    'link_after' => '<span class="space">',
                                    'next_or_number' => 'number',
                                    'separator' => ' &nbsp; ',
                                    'pagelink' => '%',
                                    'echo' => 1
                                    )
                                ); ?>

		            </div>
        </div>
    </section><div class="clearfix"></div> 
                <footer class="meta-footer">
                    <ul class="metas list-inline">
                        <li><?php edit_post_link(__( 'Edit', "appeal"), ' '); ?></li>
                    </ul>
                </footer>

                    <?php comments_template(); ?>
                    
                    <div class="row"><hr class="short"></div>
                    

<?php } else {
// ---------------- 4-everything else
?>

                <section class="post_content">

					<?php get_template_part('content', 'header' ); ?>

                    <div class="after-content-header">
                    
                    <?php
                        // check if the post has a Post Thumbnail assigned to it.
                        if ( has_post_thumbnail() ) {
    	                     the_post_thumbnail( 'thumbnail', array( 
                                                 'itemprop' => 'image', 
                                                 'class' => 'appeal-thumbnail alignleft',
                                                 'alt' => '' ) );
                        } else {
                    	   echo '<div class="no-thumb"></div>'; }
                        ?>
                        <div class="inner_content">

                            <?php the_content( '', true ); ?>
                            
                                <div class="pagination">
                            
                                    <?php wp_link_pages(); ?>
                            
                                </div>
                        </div>
                        
                </section><div class="clearfix"></div>

                    <footer class="meta-footer">

                        <?php get_template_part('part', 'metadata' ); ?>

                    </footer>
                    <aside="comments-aside">

                        <?php comments_template(); ?>
                    </aside>
                    
                        
    <?php } //ends all content type check
    ?>

    </div>
  </div>
</article><div class="clearfix"></div>




<div id="theAuthor" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">X</button>
        <h2 class="modal-title"><?php echo esc_html( get_the_author_meta(
                                        'first_name' ) ); ?>
          <span class="sepspace"> </span>
          <?php echo esc_attr( nl2br( get_the_author_meta( 'last_name' ) ) ); ?>
          <span class="screen-reader-text">
          <?php esc_attr_e( 'Information about the author you selected',
                            'appeal' ); ?></span>
        </h2>
      </div>
      <div class="modal-body">
        <p><?php esc_html_e( 'Author:  ', 'appeal' );
                 echo esc_attr(get_the_author_meta( 'nicename' )); ?></p>
        <ul class="list-group">

            <li class="list-group-item">
                <?php echo esc_attr(nl2br( the_author_meta('description') )); ?></li>

            <li class="list-group-item">
              <a href="<?php echo esc_url(the_author_meta( 'url' ) ); ?>"
                 title="<?php the_author(); ?>">
              <?php echo esc_url(the_author_meta( 'url' ) ); ?>
              <span class="screen-reader-text">
              <?php esc_html_e( 'link to author', 'appeal' ); ?>
              <?php echo esc_url(the_author_meta( 'url' ) ); ?></span></a></li>

            <li class="list-group-item"><?php
                esc_html_e( 'Author Page and Archives for ',
                            'appeal' ); the_author_posts_link(); ?></li>
            <li class="list-group-item"><b><?php the_author_posts(); ?></b>
              <span class="screen-reader-text">
              <?php esc_html_e( 'Number of articles by this author, ',
                                'appeal'); ?>
              <?php the_author_posts(); ?></span>
            <?php esc_html_e( 'Articles by ', 'appeal' ); ?> <?php the_author(); ?></li>

        </ul>
      </div>
      <div class="modal-footer">
        <nav class="modal-nav">
            <em class="text-muted"><?php esc_html_e( 'E-Mail: ', 'appeal' ); ?>
            <?php echo esc_html( the_author_meta('user_email') ); ?></em>
            <span class="screen-reader-text">
            <?php esc_html_e( 'email link text to author', 'appeal' ); ?></span>
            <button type="button"
                    class="btn btn-default btn-md"
                    data-dismiss="modal"
                    title="<?php esc_attr_e( 'Close', 'appeal' ); ?>">
                           <?php esc_html_e( 'Close', 'appeal' ); ?>
            </button>
        </nav>
      </div>
    </div>

  </div>
</div> 
