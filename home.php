<?php
/**
 * home page if blog/posts set as home page
 * @package: Appeal
 * @filename: page-three-width copy
*/
?>
<?php get_header(); ?>

<div id="content" class="row">
    <div class="side-abtn">
    
        <?php //option for reveal sidebar button 
        $offscreen_text = get_option( 'appeal_sidebar_text_setting', ' + ' ); 
        ?>
    
    <a class="btn btn-default btn-lg" 
       href="#sideA" 
       title="<?php esc_attr_e( 'show sidebars and navaigation options', 'appeal' ); ?>">
       <?php echo esc_html( $offscreen_text ); ?></a>
    </div>
       
	<div id="sideA" class="col-xs-12 col-sm-6 col-md-2 col-lg-2">

            <?php get_sidebar( 'left'); ?>

        </div>
	<div id="main" class="col-sm-6 col-md-7 col-lg-7" role="main">
	<?php if (have_posts()) : ?>
		<?php while (have_posts()) : the_post();

	        // Include the page content template.
			get_template_part( 'content' ); ?>

		<?php endwhile; ?>

            <?php get_template_part( 'nav', 'content' ); ?>

		<?php else : ?>

		  <?php get_template_part( 'nothing' ); ?>

		<?php endif; ?>

	</div>

        <div id="sideB" class="col-xs-12 col-sm-12 col-md-3 col-lg-3 end">

            <?php get_sidebar( 'right' ); ?>

        </div>


</div>

<?php get_footer(); ?>
