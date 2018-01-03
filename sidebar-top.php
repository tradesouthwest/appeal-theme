<?php
/*
 * sidebar used for top banner area
 * only shows on Default Template page template
 * and Three Width Page Template
 */
if ( get_theme_mod( 'appeal_topbox_image_setting' ) != '' || is_active_sidebar( 'sidebar-top' ) ) 
{  
?>
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 topbox">

            <div id="sidebar-top" role="complementary">
                <div class="vertical-nav block">

                    <?php if ( get_theme_mod( 'appeal_topbox_image_setting' ) != '' ) : ?>
                
                    <div id="topbox-banner"></div>
                
                    <?php else : 
                        dynamic_sidebar( 'sidebar-top' ); 
                    ?>
                    <?php 
                    endif; 
                    ?>

                </div>
            </div>

        </div>
    </div>
</div>
<?php } else { ?>
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 topbox tempbox">
            <div class="end"><?php the_widget( 'WP_Widget_Meta' ); ?></div> 
        </div>
    </div>
</div>
<?php } 
?>
