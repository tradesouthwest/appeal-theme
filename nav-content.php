
    <?php if (get_next_posts_link() || get_previous_posts_link()) { ?>
    <div class="postlink">
        <nav class="block" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement">
            <ul class="list-inline">
            
            <?php //only show if there are more posts
            if( get_next_posts_link() ) { ?>
            
                <li class="btn btn-paging notblank previous">
            
                    <?php next_posts_link("&laquo; "
                          . __('Older posts', "appeal")); ?></li>
            <?php } ?>
            
                <li></li>
            
                <?php //only show if more pagination of posts
                if( get_previous_posts_link()) { ?>
            
                <li></li>
                <li class="btn btn-paging notblank next">
            
                    <?php previous_posts_link(
                          __('Newer posts', "appeal") . " &raquo;"); ?></li>
                <?php } ?>
            
            </ul>
        </nav>
    </div>
    <?php } ?>


<?php if( is_page() || is_single() ) { 
?>
<div class="pagination" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement">
<?php
the_post_navigation( array(
	'prev_text' => '<span class="screen-reader-text">'
    . __( 'Previous Post', 'appeal' )
    . '</span><span aria-hidden="true" class="nav-subtitle">'
    . __( '&laquo; Previous: ', 'appeal' ) . '</span>
    <span class="nav-pills">%title</span>',

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
