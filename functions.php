<?php
// functions for theme Appeal
// @since 1.0.2


/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function appeal_theme_setup() {
    /*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
    add_theme_support( 'html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));
    /*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
    add_theme_support( 'title-tag' );
    add_theme_support( 'automatic-feed-links' ); // rss feederz
/*
	 * Enable support for Post Thumbnails on posts and pages.
	 * wp thumbnails (sizes handled below)
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
    add_theme_support( 'post-thumbnails' );

    set_post_thumbnail_size( 180, 180, true );   // default thumb size

    //page background image and color support
    $defaults = array(
	   'default-color'      => '#fcfcfc',
	   'default-image'       => '',
	   'wp-head-callback'     => '_custom_background_cb',
	   'admin-head-callback'   => '',
	   'admin-preview-callback' => ''
    );
    add_theme_support( 'custom-background', $defaults );
    add_theme_support( 'custom-logo' );

    // main nav in header (not sticky) also nav menu in footer and modal are same
    register_nav_menus(
        array(
            'primary' => __('Main Menu Top', 'appeal'),
            'author_modal' => __('Footer and Author Links', 'appeal')
        )
    );

    load_theme_textdomain( 'appeal', get_template_directory_uri() . '/languages' );


    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action('after_setup_theme','appeal_theme_setup');

   /**
    * Enqueue scripts and styles.
    */
    function appeal_theme_scripts() {

    // For use of child themes
    wp_register_style( 'appeal-style',
                        get_stylesheet_directory_uri() . '/style.css',
                        array(),
                        null,
                        'all' );
    wp_register_script( 'bootstrap-script',
                        get_template_directory_uri() . '/assets/bootstrap.js',
                        array ( 'jquery' ),
                        '3.3.7',
                        true);
    //enqueue (sane and include) scripts into WP
    wp_enqueue_style( 'appeal-google-fonts');
    wp_enqueue_style( 'appeal-style' );
    wp_enqueue_script( 'bootstrap-script' );
    }
    add_action( 'wp_enqueue_scripts', 'appeal_theme_scripts' );

function appeal_fonts_url() {
    $fonts_url = '';
	/*
	 * Translators: If there are characters in your language that are not
	 * supported by Raleway, translate this to 'off'. Do not translate
	 * into your own language.
	 */
    $Raleway = _x( 'on', 'Raleway font: on or off', 'appeal' );
	if ( 'off' !== $Raleway  ) {
		$font_families = array();
		if ( 'off' !== $Raleway ) {
			$font_families[] = rawurlencode( 'Raleway' );
		}
		$protocol = is_ssl() ? 'https' : 'http';
		$query_args = array(
			'family' => implode( '|', $font_families ),
			'subset' => rawurlencode( 'latin,latin-ext' ),
		);
		$fonts_url = add_query_arg( $query_args, "$protocol://fonts.googleapis.com/css" );
	}
	return $fonts_url;
}
/**
 * Loads custom font CSS file.
 *
 * To disable in a child theme, use wp_dequeue_style()
 * function mytheme_dequeue_fonts() {
 *     wp_dequeue_style( 'appeal-fonts' );
 * }
 * add_action( 'wp_enqueue_scripts', 'mytheme_dequeue_fonts', 11 );
 *
 * @return void
 */
function appeal_fonts() {
	$fonts_url = appeal_fonts_url();
	if ( ! empty( $fonts_url ) ) {
        wp_enqueue_style( 'appeal-fonts', esc_url_raw( $fonts_url ), array(), null );
	}
}
add_action( 'wp_enqueue_scripts', 'appeal_fonts' );


/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function appeal_content_width() {
$GLOBALS['content_width'] = 750;
}
add_action( 'after_setup_theme', 'appeal_content_width', 0 );

/**
 * page excerpt support
 * @init
 * @add_post_type_support
 */
function appeal_theme_excerpt_support()
{
    add_post_type_support( 'page', 'excerpt' );
}
add_action( 'init', 'appeal_theme_excerpt_support' );

/**
 * support for logo upload, output
 */
function appeal_theme_custom_logo() {

    // Try to retrieve the Custom Logo
    $output = '';
    if (function_exists('get_custom_logo'))
        $output = '<div class="header-logo">';
        $output .= get_custom_logo();
        $output .= '</div>';

    // If Custom Logo is not supported, or there is no selected logo
    // In both cases we display the site's name
    if (empty($output))
        $output = '';

    echo $output;
}

/** Custom usage of more_tag to split content in two.
 * @only works on template Two Part Content
 * @uses more tag to split content "<!--more-->"
 * @only works for two columns
  */
function appeal_split_content() {
if( is_page()) {
    global $more;
    $more = true;
    $content = preg_split('/<span id="more-\d+"><\/span>/i', get_the_content('more'));
    for($c = 0, $csize = count($content); $c < $csize; $c++) {
        $content[$c] = apply_filters('the_content', $content[$c]);
    }
    return $content;
    }
}

//modify the read more tag
function appeal_theme_modify_read_more_link() {
    return '<a class="more-link" href="' . get_permalink() . '">[ + ]</a>';
}
add_filter( 'the_content_more_link', 'appeal_theme_modify_read_more_link' );

//remove ellipsis
function appeal_custom_excerpt_more() {

    $post = get_post();
        return ' <a class="more-link" href="'. get_permalink($post->ID)
                . '">'. __('Read Article', 'appeal') .'</a>';

}
add_filter('excerpt_more', 'appeal_custom_excerpt_more');

//check keyboard for compatibility
remove_filter( 'the_content', 'wptexturize' );

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

//create header styles
if ( ! function_exists( 'appeal_theme_header_style' ) ) :
function appeal_theme_header_style()
{
    $header_text_color = get_header_textcolor();
    $header_image = get_header_image();

    if ( $header_image )
    { ?>
        <style type="text/css">.site-head {position: relative;background-image: url( <?php echo esc_url( $header_image ); ?>);background-position: center;background-repeat: no-repeat;background-size: cover;content: "";display: block;height: 220px;left: 0;top: 0;   width: auto;z-index: -1;}</style>
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
        echo '.site-title,.site-description{position: absolute;clip: rect(1px, 1px, 1px, 1px);';
        } else {
        echo '#inner-footer h4,.site-title a,.site-description{color:'; ?> #<?php echo esc_attr( $header_text_color ); ?>;}
            <?php
            }
     echo '</style>';
}
endif;


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

    register_sidebar(array(
      'id' => 'sidebar-top',
      'name' => __('Top Above Content', 'appeal'),
      'before_widget' => '<div id="%1$s" class="widget %2$s">',
      'after_widget' => '</div>',
      'before_title' => '<h4 class="widgettitle">',
      'after_title' => '</h4>',
    ));

    register_sidebar(array(
      'id' => 'sidebar-bottom',
      'name' => __('Bottom Below Content', 'appeal'),
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
if( ! function_exists( 'appeal_pingback_header' )) :
function appeal_pingback_header() {

	if ( is_singular() && pings_open() ) {

		printf( '<link rel="pingback" href="%s">'
                 . "\n", get_bloginfo( 'pingback_url' ) );
	}
}
add_action( 'wp_head', 'appeal_pingback_header' );
endif;

/**woo weady
 * Removes woo wrappers and replace with this theme's content
 * wrappers so that woo content fits in this theme.
 * @https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
*/
add_action( 'after_setup_theme', 'appeal_woocommerce_support' );
function appeal_woocommerce_support() {
    add_theme_support( 'woocommerce' );
}
remove_action( 'woocommerce_before_main_content',
               'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content',
               'woocommerce_output_content_wrapper_end', 10);
add_action(    'woocommerce_before_main_content',
               'appeal_theme_wrapper_start', 10);
add_action(    'woocommerce_after_main_content',
               'appeal_theme_wrapper_end', 10);

function appeal_theme_wrapper_start() {
    echo '<div id="content-woo">';
}

function appeal_theme_wrapper_end() {
    echo '</div>';
}

// Register Custom Navigation Walker
require_once get_template_directory() . '/assets/wp_bootstrap_navwalker.php';

//Register Customizer assets
require_once get_template_directory() . '/customize.php';
?>
