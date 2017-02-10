<?php

// Declaration of theme supported features
function appeal_theme_support() {
    add_theme_support( 'html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));

    add_theme_support( 'title-tag' );
    add_theme_support('automatic-feed-links'); // rss feederz
    add_theme_support('post-thumbnails');      // wp thumbnails (sizes handled below)

    set_post_thumbnail_size(180, 180, true);   // default thumb size


    // main nav in header (not sticky)
    register_nav_menus(
        array(
            'primary' => __('Main Menu Top', 'appeal')
        )
    );

    load_theme_textdomain( 'appeal', get_template_directory_uri() . '/languages' );
}
add_action('after_setup_theme','appeal_theme_support');


/**
 * custom excerpt length
 * @return excerpt_length
 * integer value
*/
function appeal_theme_excerpt_length( $length )
{
   $content = wp_strip_all_tags(get_the_content() , true );
    echo wp_trim_words( $content, $length );
}
add_filter( 'excerpt_length', 'appeal_theme_excerpt_length', 999 );


/**
 * page excerpt support
 * @init
 * add_post__support
 */
function appeal_theme_excerpt_support()
{
    add_post_type_support( 'page', 'excerpt' );
}
add_action( 'init', 'appeal_theme_excerpt_support' );



//include (enqueue) scripts and stylesheets
function appeal_theme_scripts() {

    wp_register_style( 'appeal-google-fonts',
                       'http://fonts.googleapis.com/css?family=Raleway',
                       false );

    // For use of child themes
    wp_register_style( 'appeal-style',
                        get_stylesheet_directory_uri() . '/style.css',
                        array(),
                        null,
                        'all' );

    wp_enqueue_style( 'appeal-google-fonts');
    wp_enqueue_style( 'appeal-style' );
    wp_enqueue_script( 'bootstrap-script',
                        get_template_directory_uri() . '/assets/bootstrap.js',
                        array ( 'jquery' ),
                        '3.3.7',
                        true);

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'appeal_theme_scripts' );

/**
 * Implementation of the Custom Header feature.
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 *  @uses appeal_header_style()
 */
function appeal_custom_header_setup()
{
    add_theme_support( 'custom-header',
        apply_filters( 'appeal_custom_header_args', array(
            'default-image'          => get_template_directory_uri()
                                        . '/assets/default-header-img.jpg',
            'default-text-color'    => '0000a0',
            'width'                => 1000,
            'height'              => 250,
            'flex-height'        => true,
            'flex-width'        => true,
            'wp-head-callback' => 'appeal_theme_header_style',
        ) ) );
}
add_action( 'after_setup_theme', 'appeal_custom_header_setup' );

if ( ! function_exists( 'appeal_theme_header_style' ) ) :
function appeal_theme_header_style()
{
    $header_text_color = get_header_textcolor();
    $header_image = get_header_image();

    if ( $header_image )
    { ?>
        <style type="text/css">
            .site-head {
                position: relative;
                background-image: url( <?php echo esc_url( $header_image ); ?>);
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
                content: "";
                display: block;
                height: 220px;
                left: 0;
                top: 0;
                width: auto;
                z-index: -1;
            }
        </style>
    <?php
    }

    /*
     * If no custom options for text are set, let's bail.
     * get_header_textcolor() options: Any hex value, 'blank' to hide text.
     */
    $header_text_color = get_header_textcolor();

    echo '<style type="text/css">';

        if ( ! display_header_text() )
        {
        echo '
        .site-title,
        .site-description {
            position: absolute;
            clip: rect(1px, 1px, 1px, 1px);';
        }
            else
            {
            echo '
            .site-title a,
            .site-description {
            color: '; ?> #<?php echo esc_attr( $header_text_color ); ?>;
            <?php
            }
     echo '</style>';
}
endif;


// Set unknown media content width
$GLOBALS['content_width'] = 750;

// Sidebar and Footer declarations
function appeal_register_sidebars() {
    register_sidebar(array(
        'id' => 'sidebar-right',
        'name' => __('Right Sidebar', 'appeal'),
        'description' => __('Used on every page.', 'appeal'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="widgettitle">',
        'after_title' => '</h4>',
    ));
    register_sidebar(array(
    	'id' => 'sidebar-left',
    	'name' => __('Left Sidebar', 'appeal'),
    	'description' => __('Used on every page.', 'appeal'),
    	'before_widget' => '<div id="%1$s" class="widget %2$s">',
    	'after_widget' => '</div>',
    	'before_title' => '<h4 class="widgettitle">',
    	'after_title' => '</h4>',
    ));

    register_sidebar(array(
      'id' => 'footer-left',
      'name' => __('Footer Left', 'appeal'),
      'before_widget' => '<div id="%1$s" class="widget %2$s">',
      'after_widget' => '</div>',
      'before_title' => '<h4 class="widgettitle">',
      'after_title' => '</h4>',
    ));

    register_sidebar(array(
      'id' => 'footer-middle',
      'name' => __('Footer Middle', 'appeal'),
      'before_widget' => '<div id="%1$s" class="widget %2$s">',
      'after_widget' => '</div>',
      'before_title' => '<h4 class="widgettitle">',
      'after_title' => '</h4>',
    ));

    register_sidebar(array(
      'id' => 'footer-right',
      'name' => __('Footer Right', 'appeal'),
      'before_widget' => '<div id="%1$s" class="widget %2$s">',
      'after_widget' => '</div>',
      'before_title' => '<h4 class="widgettitle">',
      'after_title' => '</h4>',
    ));

}
add_action( 'widgets_init', 'appeal_register_sidebars' );


/**
 * Header for singular articles
 * Add pingback url auto-discovery header for singular articles.
 */
function appeal_pingback_header() {

	if ( is_singular() && pings_open() ) {

		printf( '<link rel="pingback" href="%s">'
                 . "\n", get_bloginfo( 'pingback_url' ) );
	}
}
add_action( 'wp_head', 'appeal_pingback_header' );


// Register Custom Navigation Walker
require_once get_template_directory() . '/assets/wp_bootstrap_navwalker.php';

//Register Customizer assets
require_once get_template_directory() . '/customize.php';
?>
