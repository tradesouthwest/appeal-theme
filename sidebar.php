<div id="sidebar-right" role="complementary">
    <div class="vertical-nav block">
    
    <?php if (is_active_sidebar('sidebar-right')) { ?>
        <?php dynamic_sidebar( 'sidebar-right' ); ?>
    <?php } else { the_widget( 'WP_Widget_Recent_Posts' ); } ?>    
    
    </div>
    <p><a href="#" title="^" class="btn btn-default align-xs-auto">
    <?php esc_attr_e("Top/Pg.", "appeal"); ?></a></p>
</div>
