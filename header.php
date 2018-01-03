<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<a class="skip-link screen-reader-text" href="#content">
<?php esc_attr_e( 'Skip to content', 'appeal' ); ?></a>
<div id="content-wrapper">
    <div class="site-head">

        <div class="hgroup">

            <?php if( has_custom_logo() ) : ?>
            <a title="<?php bloginfo('description'); ?>"
               href="<?php echo esc_url(home_url('/')); ?>">
            <?php echo wp_kses_post( force_balance_tags( 
            appeal_theme_custom_logo() ) ); ?></a>
            <?php endif; ?>
        
            <p class="list-inline">
            <span class="site-title">
               <a title="<?php bloginfo('description'); ?>"
                  href="<?php echo esc_url(home_url('/')); ?>">
                  <?php bloginfo('name') ?></a></span>
            <span class="site-description"><em> | </em></span>
            <span class="site-description"><?php bloginfo('description') ?></span></p>
        </div>

    </div>

		<header>
			<nav class="navbar navbar-default navbar-static-top semi-fixed"
			 itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement">
				<div class="container">
					<div class="navbar-header">
					
						<?php if (has_nav_menu("primary")): ?>
					
						<button type="button" class="navbar-toggle collapsed"
                                data-toggle="collapse"
                                data-target="#navbar-responsive-collapse">
		    				<span class="sr-only"><?php esc_html_e('Navigation', 'appeal'); ?></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
					
						<?php endif ?>
						
					</div>

					<div id="navbar-responsive-collapse" class="collapse navbar-collapse">

	    <?php wp_nav_menu( array(
                'theme_location'  => 'primary',
                'depth'          => 8,
                'container_id'  => 'navbar-collapse-top',
                'menu_class'   => 'nav navbar-nav',
                'fallback_cb' => 'wp_nav_menus',
                'walker'     =>  new appeal_bootstrap_navwalker()
            )); ?>

					</div>
				</div>
			</nav>

		</header>

   <div class="clearfix"></div>
   <?php if( is_page() || is_home() ){ ?>
    
                <?php get_sidebar( 'top' ); ?>

      <?php } ?>
		<div id="page-content"><!-- ends in footer -->
			<div class="container"><!-- ends in footer -->
