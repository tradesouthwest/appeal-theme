<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
/* ------------------------------------------------------------------------ *
 * Setting Registration for theme Appeal
 * ------------------------------------------------------------------------ */

/**
 * Initializes the theme options page by registering the Sections,
 * Fields, and Settings.
 *
 * This function is registered with the 'admin_init' hook.
 */
add_action( 'admin_init', 'appeal_add_theme_settings' );
add_action( 'admin_menu', 'appeal_add_options_page' );
/**
 * Add theme menu
 *
 * @since 1.0.6
 * @uses add_theme_page()
 * $page_title, $menu_title, $capability, $menu_slug, $function
 */

function appeal_add_options_page() {

    add_theme_page(

        __( 'Instructions Etc', 'appeal' ),
         __( 'Theme Options', 'appeal' ),
        'manage_options',
        'appeal_page_elements',
        'appeal_display_options_page'
    );
}

/**
 * Add theme settings and section
 *
 * @since 1.0.6
 * @uses add_settings_section()
 * $id, $title, $callback, $page
 */
function appeal_add_theme_settings() {

        add_settings_section (
            'appeal_page_section',
            __( 'Theme Overview', 'appeal' ),
            'appeal_options_page_callback',
            'appeal_page_elements'
        );
}

function appeal_options_page_callback() {

    echo esc_attr( '<h2>' );
    esc_html_e( 'Appeal Theme Instructions and General Information', 'appeal' );
    echo esc_attr( '</h2>' );
}

/**
 * This function renders the interface elements.
 *
 * It accepts an array of arguments and expects the first element in the array to be the description
 * to be displayed.
 */
function appeal_display_options_page() {

?>

<div class="wrap">
    <h1><div id="icon-info" class="dashicons dashicons-welcome-learn-more"></div>
    <?php esc_html_e( 'Appeal theme page', 'appeal' ); ?></h1>

        <h3>General Overview of Theme Settings</h3>

        <table class="widefat" style="max-width:100%;">

<thead><tr>
<th>Excerpt Instructions</th><th>Two Part Page</th><th>Three Wide Page</th><th>Tips and Information</th>
</tr></thead>
<tbody style="padding: 7px;">
<tr>

<td style="border-right:1px solid #eee;"><?php esc_html_e( 'To utilize the Pullquote excerpt option you will need to enable the Screen Options from the Pages or Posts
Editor page. See first picture below. To add the Pullquote you will use the Excerpt box which should now appear at the bottom of the
Editor box. See picture 2 below.', 'appeal' ); ?></td>

<td style="border-right:1px solid #eee;"><?php esc_html_e( 'Page template that is TwoPart Template can divide the page content by using the', 'appeal' ); ?>
<code style="display:inline-block">&lt;!--more--></code> <?php _e( 'tag.<sup>1</sup> <strong>Place the more-tag at the point where you
want the page content to split in half.</strong> Test your height by viewing and pre-defining your content
with a private page in order to achieve a balanced layout of paragraphs prior to publishing<sup>2</sup>.', 'appeal' ); ?></td>

<td><?php esc_html_e( 'Three Width Page Template is a normal copy of your content and displays the page with small sidebar on the
left and a wider sidebar on the right.', 'appeal' ); ?> <h4><?php esc_html_e( 'Full width Template', 'appeal' ); ?></h4><?php esc_html_e( 'Appeal has an additional template Full Width Page that
can be used for galleries or larger content.', 'appeal' ); ?></td>

<td style="border-left:1px solid #eee;"><h4><?php esc_html_e( 'Customize Theme', 'appeal' ); ?></h4>
<p><?php printf(
    __( 'To set up the Pullquote color, width and length, open Customizer </p><p class="aligncenter"><a href="%s" class="button-primary">customizer</a>', 'appeal' ),
    admin_url( 'customize.php?autofocus[control]=appeal_custom_teaser_length' )
    ); ?></p><hr></td>

</tr>

<tr>

<td><figure style="border:2px dashed gray;margin-bottom:5px;padding:0"><a href="<?php echo get_template_directory_uri() . '/assets/imgs/screenshot-03.png'; ?>">
<img src="<?php echo get_template_directory_uri() . '/assets/imgs/screenshot-03.png'; ?>" alt="not found" width="220"/></a></figure>
<figcaption style="text-align:center;padding: 0"><?php esc_html_e( 'Screen Options pull-down menu', 'appeal' ); ?></figcaption>
<figure style="margin-top:1em; padding:0"><img src="<?php echo get_template_directory_uri() . '/assets/imgs/screenshot-04.png'; ?>" alt="not found" width="220"/></figure>
<figcaption style="text-align:center"><?php esc_html_e( 'Editor Excerpt meta-box for Pullquote', 'appeal' ); ?></figcaption>
</td>

<td style="border-left:1px solid #eee;">
<img style="padding:0" src="<?php echo get_template_directory_uri() . '/assets/imgs/screenshot-twopart.png'; ?>" alt="not found" height="300"/></td>

<td style="border-left:1px solid #eee;">
<figure style="padding:0"><img src="<?php echo get_template_directory_uri() . '/assets/imgs/screenshot-05.png'; ?>" alt="not found" width="220"/></figure>
<figcaption style="text-align:center"><?php esc_html_e( 'Three Wide Template', 'appeal' ); ?></figcaption></td>

<td style="border-left:1px solid #eee;">
<p><?php esc_html_e( 'Tip on using top advert box: When using the new image widget you may have to adjust the image
height if image is a full width banner.', 'appeal' ); ?></p>
<p style="line-height:1"><small><sup>1</sup><?php esc_html_e( 'ref. use more tag in editor:', 'appeal' ); ?> https://codex.wordpress.org/Customizing_the_Read_More</small></p>
<p style="line-height:1"><small><sup>2</sup><?php esc_html_e( 'ref. private page viewing:', 'appeal' ); ?> https://codex.wordpress.org/Content_Visibility</small></p>
<p><a href="http://themes.tradesouthwest.com/wordpress/" target="_blank" title="=|=">Tradesouthwest</a></p></td>
</tr>
</tbody></table>
</div>
<?php

}
?>
