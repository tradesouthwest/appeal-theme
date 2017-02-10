<?php
    /**
     * customizer assets - Appeal
	 * Header Background Color setting.
	 *
	 * - Setting: Header Background Color
	 * - Control: WP_Customize_Color_Control
	 * - Sanitization: esc_attr
	 *
	 * Uses a color wheel to configure the Header Background Color setting.
	 *
	 * https://developer.wordpress.org/reference/classes/wp_customize_manager/add_setting/
*/

function appeal_register_theme_customizer($wp_customize)
{
    // (1) using default colors section

    // (2)
    $wp_customize->add_section( 'appeal_custom_teaser_length_section', array(
            'title'             => __( 'Pullquote Teaser', 'appeal' ),
            'capability'        => 'edit_themes_options',
            'priority'          => 30
        ) );

    /* (1)
     * WP_Customize_Manager/add_setting for header background color
    */
	$wp_customize->add_setting(	'appeal_header_background_color_setting', array(
            'type'              => 'theme_mod',
            'default'           => 'ffffff',
			'sanitize_callback'	=> 'esc_attr',
			'transport'			=> 'postMessage'
		)
	);

    /* (2)
     * WP_Customize_Manager/add_setting for pullquote teaser words
    */
	$wp_customize->add_setting(	'appeal_custom_teaser_length_setting', array(
            'type'              => 'theme_mod',
            'default'           => 22,
			'sanitize_callback'	=> 'appeal_sanitize_number_absint',
			'transport'			=> 'postMessage'
		)
	);

    // (1)
    $wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'header_background_color', array(
				'settings'		=> 'appeal_header_background_color_setting',
				'section'		=> 'colors',
				'label'			=> __( 'Header Background Color', 'appeal' ),
				'description'	=> __(
                    'Select the background color of the header area.
                    Header Image should be Off.', 'appeal' ),
			)
		)
    );

    // (2)
    $wp_customize->add_control(
        'appeal_custom_theme_teaser_length', array(
            'type'              => 'range',
            'section'           => 'appeal_custom_teaser_length_section',
            'label'             => __( 'Set Number of Words' ),
            'description'       => __( 'Set how many words display on the pullquote.' ),
            'input_attrs' => array(
                'min' => 0,
                'max' => 100,
                'step' => 1,
            ),
        )
    );

}
add_action('customize_register', 'appeal_register_theme_customizer');


//sanitizer
function appeal_sanitize_number_absint( $number, $setting ) {
  // Ensure $number is an absolute integer (whole number, zero or greater).
  $number = absint( $number );

  // If the input is an absolute integer, return it; otherwise, return the default
  return ( $number ? $number : $setting->default );
}


/**
 * Writes the Header Background related controls' values outputed to the 'head' of the document
 * by reading the value(s) from the theme mod value in the options table.
 */
function appeal_customizer_css() {
    if ( get_theme_mods() )
    {
    echo '<style type="text/css">';

        if ( get_theme_mod( 'appeal_header_background_color_setting' ) ) :
             $appealheader = get_theme_mod( 'appeal_header_background_color_setting');
             echo '.site-head {background: ' . $appealheader . ';}';
        endif;

    echo '</style>';
    }
}
add_action( 'wp_head', 'appeal_customizer_css');


/**
 * Registers the Theme Customizer Preview JavaScript with WordPress.
 *
 * @package    tmx

function appeal_customizer_live_preview() {
	wp_enqueue_script(
		'appeal-theme-customizer',
		get_template_directory_uri().'/assets/customizer-javascript.js',
		array( 'customize-preview' ),
		'',
		true
	);
}
add_action( 'customize_preview_init', 'appeal_customizer_live_preview' );
 */
