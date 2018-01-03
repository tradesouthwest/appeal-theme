<?php
/**
 * Template part for metadata
 * Used to generate the metadata for post.
 * @uses is_home() to check if meta footer should display all
*/ 
?>

    <ul class="metas list-inline">

    <?php if ( is_front_page() && is_home() || is_home() ) 
    { ?>
        <li class="show-comment-nmbr"><small>
        <?php get_template_part( 'comments', 'count' );
        ?></small></li></ul><?php 
    }   // Stop here (don't need tags and edit on home blog)
        elseif ( is_single() )
        { ?> 
        <li><?php edit_post_link(__( 'Edit', "appeal"), ' '); ?></li>
    </ul>
        <ul class="list-unstyled">
          <li class="tagcats"><?php the_tags('<p class="tags">', ' ', '</p>'); ?></li>
          <li class="cat-links-post"><?php the_category( ' &bull; ' ); ?></li>
        </ul>
        
            <?php if ( ! post_password_required() && (
            comments_open() || get_comments_number() ) )
            { ?>
            <ul class="list-unstyled">
            <li><?php
            $dsp = '<span class="comment-icon"> &#9776; </span> ';
            comments_popup_link(
            $dsp . __( 'Leave a comment', "appeal"),
            $dsp . __( '1 Comment', "appeal"),
            $dsp . __( '% Comments', "appeal")); ?></li>
            </ul>
            <?php 
            } ?>

        <?php 
        //ends if single
        }   elseif ( is_page() ) 
            {
        ?>
        <li><?php edit_post_link(__( 'Edit', "appeal"), ' '); ?></li></ul>
            <?php 
            // everything else (attachments etc)
            } else {
            ?>
     <li><?php edit_post_link(__( 'Edit', "appeal"), ' '); ?></li></ul>
    


    <?php } 
    //ends only show tags and edit if not front page blog
    ?>
    <div class="row nomarg"></div><div class="clearfix"></div>
