<?php
/**
 * The template for displaying Comments
 *
 * The area of the page that contains both current comments
 * and the comment form. The actual display of comments is
 * handled by a callback to twentytwelve_comment() which is
 * located in the functions.php file.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */

if ( post_password_required() )
    return;
        ?><ol class="commentlist"><?php
            wp_list_comments( array(
				'style'      => 'ol',
				'short_ping' => true,
				'avatar_size'=> 34,
			) );
        ?></ol>

<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
	<ul id="comment-nav-below" class="navigation comment-navigation">
		<ul class="pager">
			<li class="previous"><?php previous_comments_link(
                    __("&laquo; Older Comments", "appeal") ); ?></li>
			<li class="next"><?php next_comments_link(
                    __("Newer Comments &raquo;", "appeal") ); ?></li>
		</ul>
	</ul>
	<?php endif; ?>

 <?php $comment_args = array(
        // Change the title of send button
        'label_submit' => __( 'Send', 'appeal' ),

        // Change the title of the reply section
        'title_reply' => __( 'Write a Reply or Comment', 'appeal' ),

        // Remove "Text or HTML to be displayed after the set of comment fields".
        'comment_notes_after' => '<p class="form-allowed-tags">'
                                 . sprintf( __( 'You may use these
                                 <abbr title="HyperText Markup Language">HTML</abbr>
                                 tags and attributes: %s', 'appeal' ), ' <code>'
                                 . allowed_tags() . '</code>' ) . '</p>',

        // Redefine default textarea (the comment body).
        'comment_field' => '<p class="comment-form-comment">
                            <label for="comment">'
                            . __( 'Respond', 'appeal' )
                            . '<span class="screen-reader-text">'
                            . __( 'Comment textarea box', 'appeal' ) . '</label>
                            <br /><textarea id="comment" name="comment" aria-required="true">
                            </textarea></p>',

        //logged in check
        'must_log_in' => '<p class="must-log-in">' .
        sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.',
                 'appeal' ),
                 wp_login_url( apply_filters( 'the_permalink', get_permalink() ) )
               ) . '</p>',


        'comment_notes_before' => '<p class="comment-notes">' .
                                   __( 'Your email address will not be published.', 'appeal' ) . '</p>',

);
                comment_form( $comment_args ); ?>
