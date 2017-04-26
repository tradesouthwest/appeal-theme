<?php
/**
 * Template part for metadata
 * Used to generate the metadata for post.
*/ ?>
    <ul class="meta list-inline">
      <li><a href="<?php the_permalink() ?>"
             title="<?php the_title(); ?>"
             class="thedate"><?php the_date(); ?></a></li>
      <li><a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID')));?>"
             title="<?php the_author(); ?>"
             class="theauthor"><?php the_author(); ?></a></li>
      <li><?php edit_post_link(__( 'Edit', "appeal"), ' '); ?></li>

          <?php if ( ! post_password_required() && (
                   comments_open() || get_comments_number() ) )
                { ?>
      <li><?php
            $dsp = '<span class="comment-icon"></span> ';
            comments_popup_link(
            $dsp . __( 'Leave a comment', "appeal"),
            $dsp . __( '1 Comment', "appeal"),
            $dsp . __( '% Comments', "appeal")); ?></li>
        <?php } ?>

      </ul>
