    <header class="content-header">

    <?php if ( get_theme_mods( ) ) :
    $titlelink = get_theme_mod( 'appeal_titlelink_color_setting',
                                'linkico-gray' );
        $hgroup = get_theme_mod( 'appeal_title_visible_setting', 'atvt1' );
    endif;

    if( $hgroup == "atvt1" ) {
    ?>

    <h2 class="entry-title">
       <a class="text-link"
          href="<?php the_permalink(); ?>"
          title="<?php the_title_attribute(); ?>">
       <span class="genico">
        <img src="<?php echo esc_url(
                        get_template_directory_uri() . '/assets/'
                        . $titlelink .'.png'); ?>"
             alt="link" /></span> <?php the_title(); ?></a></h2>

    <?php }
    elseif( $hgroup == "atvt2" && is_home() ) {
    ?>

    <h2 class="entry-title">
       <a class="text-link"
          href="<?php the_permalink(); ?>"
          title="<?php the_title_attribute(); ?>">
       <span class="genico">
        <img src="<?php echo esc_url(
                        get_template_directory_uri() . '/assets/'
                        . $titlelink .'.png'); ?>"
             alt="link" /></span> <?php the_title(); ?></a></h2>
    <?php }
    elseif( $hgroup == "atvt3" && is_page() || is_single() ) {
    ?>

    <h2 class="entry-title">
       <a class="text-link"
          href="<?php the_permalink(); ?>"
          title="<?php the_title_attribute(); ?>">
       <span class="genico">
        <img src="<?php echo esc_url(
                        get_template_directory_uri() . '/assets/'
                        . $titlelink .'.png'); ?>"
             alt="link" /></span> <?php the_title(); ?></a></h2>

    <?php }
    elseif ( $hgroup == "atvt4" && is_home() && is_front_page() ) { ?>

    <h2 class="entry-title" style="<?php echo $visonly; ?>">
       <a class="text-link"
          href="<?php the_permalink(); ?>"
          title="<?php the_title_attribute(); ?>">
       <span class="genico">
        <img src="<?php echo esc_url(
                        get_template_directory_uri() . '/assets/'
                        . $titlelink .'.png'); ?>"
             alt="link" /></span> <?php the_title(); ?></a></h2>

    <?php } else { ?>

    <div class="hidden"></div>

    <?php } ?>

		  <div class="entry-meta">
			<p class="theauthor"><span class="screen-reader-text">
            <?php esc_html_e(
                'Author Gravatar is shown here. More info below.',
                'appeal' ); ?></span>
            <?php $alt = __( 'Author Gravatar', 'appeal' );
             echo get_avatar( get_the_author_meta( 'email' ), 42, '', $alt); ?>
            <span> </span> <a data-toggle="modal"
                              data-target="#theAuthor"
                              href="#"
                              title="<?php echo esc_attr(
                                    get_the_author_meta( 'nicename' ) ); ?>">
            <em><?php esc_html_e( 'Article by ', 'appeal' );
                     echo nl2br( get_the_author( ) ); ?></em>
            <span class="screen-reader-text">
            <?php esc_html_e( 'Authors link to author website or other works.',
                              'appeal' ); ?>
            <?php echo esc_attr( get_the_author_meta( 'nicename' ) ); ?></span> </a></p>
		  </div>
	   </header>
