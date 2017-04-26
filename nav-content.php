
    <?php if (get_next_posts_link() || get_previous_posts_link()) { ?>
    <div class="postlink">
        <nav class="block">
            <ul class="list-inline">
                <li class="btn btn-paging notblank previous">
                    <?php next_posts_link("&laquo; "
                          . __('Older posts', "appeal")); ?></li>
                <li></li>
                <li class="btn btn-paging notblank"> &laquo; &nbsp; &raquo; </li>
                <li></li>
                <li class="btn btn-paging notblank next">
                    <?php previous_posts_link(
                          __('Newer posts', "appeal") . " &raquo;"); ?></li>
            </ul>
        </nav>
    </div>
    <?php } ?>


<?php if( is_page() || is_single() ) {
?>
<div class="pagination">
<?php
the_post_navigation( array(
	'prev_text' => '<span class="screen-reader-text">'
    . __( 'Previous Post', 'appeal' )
    . '</span><span aria-hidden="true" class="nav-subtitle">'
    . __( '&laquo; Previous: ', 'appeal' ) . '</span>
    <span class="nav-pills">%title</span><br>',

    'next_text' => '<span class="screen-reader-text">'
    . __( 'Next Post', 'appeal' ) . '</span>
    <span aria-hidden="true" class="nav-subtitle">'
    . __( 'Next: ', 'appeal' ) . '</span>
    <span class="nav-pills">%title</span><span class="nav-subtitle"> &raquo;</span>',
	) );
?>
</div>
<?php
}
?> 