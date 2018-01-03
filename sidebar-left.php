<div id="sidebar-left" role="complementary">
    <div class="vertical-nav block">
    
    <?php if (is_active_sidebar('sidebar-left')) { ?>
    
        <?php dynamic_sidebar( 'sidebar-left' ); ?>
        
    <?php } else { the_widget('WP_Widget_Archives'); } ?>    
    
    </div>
</div>
