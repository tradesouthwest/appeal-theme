<?php
/** 
 * Functions for theme Appeal
 * @since 1.0.2
 * Sets up theme defaults and registers support for various WordPress features.
 */
/**
 *  Setup function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function appeal_theme_setup() {
/**
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
/**
 * Let WordPress manage the document title.
 * By adding theme support, we declare that this theme does not use a
 * hard-coded <title> tag in the document head, and expect WordPress to
 * provide it for us.
 */
    add_theme_support( 'title-tag' );
    add_theme_support( 'automatic-feed-links' ); // rss feederz
/**
 * Enable support for Post Thumbnails on posts and pages.
 * wp thumbnails (sizes handled below)
 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
 */
    add_theme_support( 'post-thumbnails' );

    set_post_thumbnail_size( 400, 300, true );   // new default thumb size
    
    // new featured image name. width, height, and crop 
    add_image_size( 'appeal-featured', 400, 300, false);  // 4:3 ratio 

    add_theme_support( 'post-formats', array( 'image', 'gallery' ) );

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

    add_editor_style('editor-style.css');    
    // main nav in header - also nav menu in footer and modal are same
    register_nav_menus(
        array(
            'primary'      => __('Main Menu Top', 'appeal'),
            'above_footer' => __('Footer Links ~ 1 level ONLY', 'appeal')
        )
    );

    load_theme_textdomain( 'appeal', get_template_directory_uri() . '/languages' );
/**
 * Implementation of the Custom Header feature.
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 *  @uses appeal_header_style()
 */
     add_theme_support( 'custom-header',
        apply_filters( 'appeal_custom_header_args', array(
            'default-image'          => get_template_directory_uri()
                                        . '/assets/appeal-default-header-img.png',
            'default-text-color'    => '0000a0',
            'width'                => 1000,
            'height'              => 250,
            'flex-height'        => true,
            'flex-width'        => true,
            'wp-head-callback' => 'appeal_theme_header_style',
        ) ) );     
/**
 * Register Default Headers 
 * @since 1.1.1
 * https://codex.wordpress.org/Function_Reference/register_default_headers
 * https://generatewp.com/snippet/OvG9wDA/ updated
 * Left @string $parenturl to adjust for child theme
 */
    $parenturl         = get_template_directory_uri();
    $suggested_imgs     =  array( 
        'appeal_tokyo'   => array( 
            'description' => __( 'Tokyo', 'appeal' ),
            'url'          => $parenturl . '/assets/appeal-default-header-img.png',
            'thumbnail_url' => $parenturl . '/assets/appeal-default-header-img-small.png',
            ), 
        );
        register_default_headers( $suggested_imgs );
    //woocommerce filters below setup
    add_theme_support( 'woocommerce' );
}
add_action('after_setup_theme','appeal_theme_setup');

/**
 * only enable js if the visitor is browsing either a page or a post    
 * or if comments are open for the entry, or threaded comments are enabled
 */
function appeal_theme_queue_js(){
    if ( (!is_admin()) && is_singular() && comments_open() && get_option('thread_comments') )
        wp_enqueue_script( 'comment-reply' );
}
add_action('wp_print_scripts', 'appeal_theme_queue_js');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function appeal_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'appeal_content_width', 740 );
}
add_action( 'after_setup_theme', 'appeal_content_width', 0 );

// Register the custom image size for use in Add Media library.
add_filter( 'image_size_names_choose', 'appeal_custom_thumb_sizes' );
function appeal_custom_thumb_sizes( $sizes ) {

    return array_merge( $sizes, array(
        'appeal-featured' => __( 'Four by Three Ratio Thumb', 'appeal' ),
    ) );
}

/**
 * Enqueue scripts and styles.
 */
function appeal_theme_scripts() {

    // For use of child themes
    wp_enqueue_style( 'appeal-style', get_stylesheet_uri() );
    wp_enqueue_script( 'bootstrap',
                        get_template_directory_uri() . '/assets/bootstrap.js',
                        array ( 'jquery' ),
                        '3.3.7',
                        true);
    wp_enqueue_script( 'appeal',
                        get_template_directory_uri() . '/assets/appeal.js',
                        array ( 'jquery' ),
                        '',
                        true);

    //enqueue (sane and include) scripts into WP
    wp_enqueue_style( 'appeal-google-fonts');
}
add_action( 'wp_enqueue_scripts', 'appeal_theme_scripts' );

/**
 * Apply theme's stylesheet to the visual editor.
 *
 * @uses add_editor_style() Links a stylesheet to visual editor
 * @uses get_stylesheet_uri() Returns URI of theme stylesheet
*/
// Add Google Scripts for use with the editor
if ( ! function_exists( 'appeal_mce_google_fonts_styles' ) ) {
	function appeal_mce_google_fonts_styles() {
	   $font_url = 'https://fonts.googleapis.com/css?family=Raleway';
           add_editor_style( str_replace( ',', '%2C', esc_url( $font_url ) ) );
	}
}
add_action( 'init', 'appeal_mce_google_fonts_styles' );

/*
 * Translators: If there are characters in your language that are not
 * supported by Raleway, translate this to 'off'. Do not translate
 * into your own language.
 */
function appeal_fonts_url() {
    $fonts_url = '';

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
	return esc_url( $fonts_url );
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
 * support for logo upload, output.
 * Output sanitized in header to assure all html displays.
 * @since 1.1.8 
 */
function appeal_theme_custom_logo() {
    $output = '';
    if ( function_exists( 'the_custom_logo' ) ) {
        $custom_logo_id = get_theme_mod( 'custom_logo' );
        $logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
        if ( has_custom_logo() ) {
            $output = '<div class="header-logo"><img src="'. esc_url( $logo[0] ) .'" 
            alt="'. get_bloginfo( 'name' ) .'"></div>'; 
            } 
            else 
                { $output = '<h1>'. get_bloginfo( 'name' ) .'</h1>'; }
    }
    return $output;
}

/**
 * Create header styles
 * You can over ride height by adding CSS
 * `max-height: x!important;` where x = less than 250px
 */
function appeal_theme_header_style()
{
    $moda = ''; $modb = '';
    $header_text_color = get_header_textcolor();
    $header_image = get_header_image();

    if ( $header_image )
    { 
     if( true === get_theme_mod( 'appeal_header_background_image_repeat_setting' ) ) : 
         $modrepeat = "background-repeat: repeat"; 
         else : 
         $modrepeat = "background-repeat: no-repeat";  
    endif;
    
    if ( true === get_theme_mod( 'appeal_header_background_image_size_setting' ) ) : 
	    $modsize = "background-size: 100% 100%;";
    	else : 
    	$modsize = "";
	endif;
    ?>
<style type="text/css">.site-head {background-image: url( <?php echo esc_url( $header_image ); ?>);<?php echo esc_attr( $modrepeat ); ?>;<?php echo esc_attr( $modsize ); ?>}</style>
    <?php
    } else { 
/*
 * If no custom options for text are set, let's bail.
 * get_header_textcolor() options: Any hex value, 'blank' to hide text.
 */
    echo '<style type="text/css">';

        if ( ! display_header_text() )
        {
        echo '.site-title,.site-description{position: absolute;clip: rect(1px, 1px, 1px, 1px);';
        } else {
        echo '#inner-footer h4,.site-title a,.site-description{color:'; ?> #<?php echo esc_attr( $header_text_color ); ?>;}
            <?php
            }
     echo '</style>'; 
     } //ends else
}

//https://themefoundation.com/wordpress-theme-customizer/
function appeal_sanitize_text( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}

/** 
 * Custom usage of more_tag to split content in two.
 * @only works on template Two Part Content
 * @uses more tag to split content "<!--more-->"
 * @only works for two columns
  */
function appeal_split_content() {
if( is_page()) {
    //global $more;
    //$more = true;
    $content = preg_split('/<span id="more-\d+"><\/span>/i', 
               get_the_content('more'));
    for($c = 0, $csize = count($content); $c < $csize; $c++) {
        $content[$c] = apply_filters('the_content', $content[$c]);
    }
    return $content;
    }
}

/**
 * Remove ellipsis and set read more text.
 * Dev note: Title attribute is not attribute realted, 
 * it is text from the theme_mod only. Only `get_the_title` would work
 * if you want the actual title of the post.
 */
function appeal_custom_excerpt_more($link) {
    //make sure admin tables not effected
    if ( is_admin() ) {
		return $link;
	}
    $post = get_post();
    if( get_theme_mods() ) {
    $title = get_theme_mod( 'appeal_readon_text_setting' );
    }
        $link = ' <a class="more-link" href="'. esc_url( get_permalink($post->ID) ) 
                . '" title="' . esc_attr( $title ) . '">' 
                . esc_html( $title ) .'</a>';
        return appeal_sanitize_text( $link );
}
add_filter('excerpt_more', 'appeal_custom_excerpt_more');

/**
 * Conditional post format 
 * @since 1.0.7
 * @uses has_post_format()
 */
if( ! function_exists( 'appeal_post_formats' ) ) :  
function appeal_post_formats() {

    if ( has_post_format( 'image' ) ) { 
    $appealpost = 'format-image-post'; }
        elseif( has_post_format( 'gallery' ) ) { 
        $appealpost = 'format-gallery-post'; }
            else { $appealpost = 'format-standard-post'; } 
    return sanitize_html_class( $appealpost );
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
      'id' => 'sidebar-top',
      'name' => __('Top Above Content', 'appeal'),
      'description' => __( 'Only works on Top Advert and Page templates', 'appeal' ),
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
                 . "\n", esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'appeal_pingback_header' );

/**woo weady
 * Removes woo wrappers and replace with this theme's content
 * wrappers so that woo content fits in this theme.
 * @https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
*/
if ( class_exists( 'WooCommerce' ) ) : 
function appeal_woocommerce_support() {
   
remove_action( 'woocommerce_before_main_content',
               'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content',
               'woocommerce_output_content_wrapper_end', 10);
add_action(    'woocommerce_before_main_content',
               'appeal_theme_wrapper_start', 10);
add_action(    'woocommerce_after_main_content',
               'appeal_theme_wrapper_end', 10);
}
function appeal_theme_wrapper_start() {
    echo '<div id="content-woo">';
}

function appeal_theme_wrapper_end() {
    echo '</div>';
}
endif;

/**
 * @example for path if using a child theme
 * require_once ( get_stylesheet_directory() . '/theme-options.php' );
 * @usage You would use the above method for any file you move to child dir
 */
// Register Custom Navigation Walker
require_once get_template_directory() . '/assets/appeal_bootstrap_navwalker.php';

//Register Customizer assets
require_once get_template_directory() . '/customize.php';

//Register Theme Page assets
require_once get_template_directory() . '/theme-options.php';
?>
