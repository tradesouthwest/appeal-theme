<?php
    /**
     * customizer assets - Appeal
	 * Header Background Color setting
	 *
	 * Uses a color wheel to configure the Header Background Color setting.
	 *
	 * https://developer.wordpress.org/reference/classes/wp_customize_manager/add_setting/
     *
     * Excerpt Length for Pullquote (page excerpt enabled in functions.php)
     * Uses 'appeal_teaser_length()' to callback on page output
*/

function appeal_register_theme_customizer($wp_customize)
{

    $wp_customize->add_section('appeal_custom_teaser_length_section', array(
            'title'             => __( 'Appeal Theme Controls', 'appeal' ),
            'priority'          => 45
        ));
    $wp_customize->add_setting(
		// $id
		'appeal_header_background_image_repeat_setting',
		// $args
		array(
			'default'			=> false,
			'sanitize_callback'	=> 'appeal_sanitize_checkbox',
			'transport'			=> 'refresh'
		)
    );
    $wp_customize->add_setting(
		// $id
		'appeal_header_background_image_size_setting',
		// $args
		array(
			'default'			=> true,
			'sanitize_callback'	=> 'appeal_sanitize_checkbox',
			'transport'			=> 'refresh'
		)
);
    /** (1)
     * WP_Customize_ /add_setting for header background color
    */
	$wp_customize->add_setting(	'appeal_header_background_color_setting', array(
            'type'              => 'theme_mod',
            'default'           => '#f7f7f7',
			'sanitize_callback'	=> 'sanitize_hex_color',
			'transport'			=> 'refresh'
		)
	);

    /** (2)
     * WP_Customize_ /add_setting for content background color
    */
	$wp_customize->add_setting(	'appeal_page_background_color_setting', array(
            'type'              => 'theme_mod',
            'default'           => '#ffffff',
			'sanitize_callback'	=> 'sanitize_hex_color',
			'transport'			=> 'refresh'
		)
	);

    /** (3)anchor links color
     * WP_Customize_ /add_setting for anchor link color
    */
	$wp_customize->add_setting(	'appeal_anchor_links_color_setting', array(
            'type'              => 'theme_mod',
            'default'           => '#33679d',
			'sanitize_callback'	=> 'sanitize_hex_color',
			'transport'			=> 'refresh'
		)
	);

	/** (3A)appeal_pullquote_text_color
     * WP_Customize_ /add_setting for anchor link color
    */
    $wp_customize->add_setting( 'appeal_pullquote_text_color_setting', array(
            'type'              => 'theme_mod',
            'default'           => '#356767',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'refresh'
        )
    );

    /** (4)
     * WP_Customize_ /add_setting for pullquote teaser usage
    */
	$wp_customize->add_setting(	'appeal_custom_teaser_usage_setting', array(
            'type'              => 'theme_mod',
            'default'           => 'none',
			'sanitize_callback'	=> 'sanitize_text_field',
			'transport'			=> 'refresh'
		)
	);

    /** (5)
     * WP_Customize_ /add_setting for pullquote teaser width
    */
	$wp_customize->add_setting(	'appeal_custom_teaser_width_setting', array(
            'type'              => 'theme_mod',
            'default'           => 220,
			'sanitize_callback'	=> 'appeal_sanitize_number_absint',
			'transport'			=> 'refresh'
		)
	);

    /** (6)
     * WP_Customize_ /add_setting for post excerpt words
    */
	$wp_customize->add_setting(	'appeal_posts_excerpt_length_setting', array(
            'type'              => 'theme_mod',
            'default'           => 58,
			'sanitize_callback'	=> 'appeal_sanitize_number_absint',
			'transport'			=> 'refresh'
		)
	);

    /** (7)
     * WP_Customize_ /add_setting for title visibility
    */
	$wp_customize->add_setting(	'appeal_title_visible_setting', array(
            'type'              => 'theme_mod',
            'default'           => 'atvt1',
			'sanitize_callback'	=> 'sanitize_text_field',
			'transport'			=> 'refresh'
		)
	);

    /** (8)
     * WP_Customize_ /add_setting for post header link
    */
	$wp_customize->add_setting(	'appeal_titlelink_color_setting', array(
            'type'              => 'theme_mod',
            'default'           => 'linkico-gray',
			'sanitize_callback'	=> 'sanitize_text_field',
			'transport'			=> 'refresh'
		)
	);

    /** (9)
     * WP_Customize_ /add_setting for sidebar-top image
     * Raw image to output on advert box.
     * @since 1.0.7
    */
    $wp_customize->add_setting( 'appeal_topbox_image_setting', array(
            'type'              => 'theme_mod',
            'default'           => '',
            'capability'        => 'manage_options',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    /** (10)
     * WP_Customize_ /add_setting for border around sidebars
     * @since 1.0.7
    */
	$wp_customize->add_setting(	'appeal_sidebar_border_setting', array(
            'type'              => 'theme_mod',
            'default'           => 'none',
			'sanitize_callback'	=> 'sanitize_text_field',
			'transport'			=> 'refresh'
		)
	);
	
	/** (11)
     * WP_Customize_ /add_setting for offscreen sidebar button text
     * @since 1.0.7
    */
	$wp_customize->add_setting(	'appeal_sidebar_text_setting', array(
            'type'              => 'theme_mod',
            'default'           => ' + ',
			'sanitize_callback'	=> 'sanitize_text_field'
		)
	);
	
    /** (12)
     * WP_Customize_ /add_setting for readon text
     * @since 1.1.8
    */
	$wp_customize->add_setting(	'appeal_readon_text_setting', array(
            'type'              => 'theme_mod',
            'default'           => __( 'Read Article', 'appeal' ),
			'sanitize_callback'	=> 'sanitize_text_field'
		)
	);

	/** (13)
     * WP_Customize_ /add_setting for copyright text
     * @since 1.1.9
    */
	$wp_customize->add_setting(	'appeal_copyright_text_setting', array(
            'type'              => 'theme_mod',
            'default'           => '',
			'sanitize_callback'	=> 'sanitize_text_field'
		)
	);
	
	/** (14)
     * WP_Customize_ /add_setting for use mobile nav or not
     * @since 1.1.0
    */
	$wp_customize->add_setting(	'appeal_nav_walker_mobi_setting', array(
            'type'              => 'theme_mod',
            'default'           => '0',
			'sanitize_callback'	=> 'appeal_sanitize_number_absint',
			'transport'			=> 'refresh'
		)
	);
	
    /** (15)
     * WP_Customize_ /add_setting for theme instructions
    */
	$wp_customize->add_setting(	'appeal_theme_instructions_setting', array(
            'type'              => 'option',
            'default'           => '',
			'sanitize_callback'	=> 'sanitize_text_field'
		)
	);

//-----------------Controls-----------------------------------
    $wp_customize->add_control(
		// $id
		'appeal_header_background_image_repeat',
		// $args
		array(
			'settings'		=> 'appeal_header_background_image_repeat_setting',
			'section'		=> 'header_image',
			'type'			=> 'checkbox',
			'label'			=> __( 'Background Repeat', 'appeal' ),
			'description'	=> __( 'Should the header background image repeat?', 'appeal' ),
		)
	);

    $wp_customize->add_control(
		// $id
		'appeal_header_background_image_size',
		// $args
		array(
			'settings'		=> 'appeal_header_background_image_size_setting',
			'section'		=> 'header_image',
			'type'			=> 'checkbox',
			'label'			=> __( 'Background Stretch', 'appeal' ),
			'description'	=> __( 'Should the header background image stretch in full?', 
			                       'appeal' ),
		)
	);

    // (1) Header and Footer background color
    $wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'appeal_header_background_color', array(
				'settings'		=> 'appeal_header_background_color_setting',
				'section'		=> 'colors',
                'priority'          => 1,
				'label'			=> __( 'Header, Footer and Sidebars Background', 'appeal' ),
				'description'	=> __(
                    'Select the background color of the header area,
                    the footer and sidebars', 'appeal' ),
			)
		)
    );

    // (2) WP page background color
    $wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'appeal_page_background_color', array(
				'settings'		=> 'appeal_page_background_color_setting',
				'section'		=> 'colors',
				'label'			=> __( 'Content Background Color', 'appeal' ),
				'description'	=> __(
                    'Sets background color of Post and Page content', 'appeal' ),
			)
		)
    );

    // (3) Anchor links color
    $wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'appeal_anchor_links_color', array(
				'settings'		=> 'appeal_anchor_links_color_setting',
				'section'		=> 'colors',
                'priority'          => 1,
				'label'			=> __( 'Links Color', 'appeal' ),
				'description'	=> __(
                    'Select the color for hyperlinks. May not effect everything.', 'appeal' ),
			)
		)
    );

    // (3A) Pullquote word color
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'appeal_pullquote_text_color', array(
                'settings'      => 'appeal_pullquote_text_color_setting',
                'section'       => 'colors',
                'priority'          => 1,
                'label'         => __( 'PullQuote Text Color', 'appeal' ),
                'description'   => __(
                    'Select the color for pullquote excerpt on articles.', 'appeal' ),
            )
        )
    );

    /** (4) Teaser use or not use
     * @since 1.0.7 
     */
    $wp_customize->add_control(
        'appeal_custom_teaser_usage', array(
            'settings'          => 'appeal_custom_teaser_usage_setting',
            'section'           => 'appeal_custom_teaser_length_section',
            'label'             => __( 'PullQuote Replaces Excerpt', 'appeal' ),
            'type'              => 'select',
            'choices'   => array(
                'block' => __( 'Use Excerpt as Pullquote', 'appeal' ),
                'none'  => __( 'Use default excerpt', 'appeal' ),
            ),
        )
    );

    // (5) width of teaser
    $wp_customize->add_control(
        'appeal_custom_teaser_width', array(
            'settings'          => 'appeal_custom_teaser_width_setting',
            'type'              => 'number',
            'section'           => 'appeal_custom_teaser_length_section',
            'label'             => __( 'Set Pullquote Width', 'appeal' ),
            'description'       => __( 'This sets how wide the Teaser will be.', 'appeal' ),
            'input_attrs' => array(
                'min' => 0,
                'max' => 540,
            ),
        )
    );
    
    // (6) posts excerpt length control
    $wp_customize->add_control(
        'appeal_posts_excerpt_length', array(
            'settings'          => 'appeal_posts_excerpt_length_setting',
            'type'              => 'number',
            'section'           => 'appeal_custom_teaser_length_section',
            'label'             => __( 'Set POSTS ONLY Excerpt Length', 'appeal' ),
            'input_attrs' => array(
                'min' => 0,
                'max' => 385,
            ),
        )
    );

    // (7)
    $wp_customize->add_control(
        'appeal_title_visible_toposts', array(
        'settings'  => 'appeal_title_visible_setting',
        'label'     => __( 'Title Visible only on: ', 'appeal' ),
        'section'   => 'appeal_custom_teaser_length_section',
        'type'      => 'select',
        'choices'   => array(
            'atvt1' => __( 'Posts and Pages', 'appeal' ),
            'atvt2' => __( 'Posts Only - Not Pages', 'appeal' ),
        ),
    ));

    // (8)
    $wp_customize->add_control(
        'appeal_titlelink_color', array(
        'settings' => 'appeal_titlelink_color_setting',
        'label'    => __( 'Choose color for link icon: ', 'appeal' ),
        'section'  => 'appeal_custom_teaser_length_section',
        'type'     => 'select',
        'choices'   => array(
            'linkico' => __( 'Black Link Icon', 'appeal' ),
            'linkico-red'   => __( 'Red Link Icon', 'appeal' ),
            'linkico-blu'  => __( 'Blue Link Icon', 'appeal' ),
            'linkico-grn' => __( 'Green Link Icon', 'appeal' ),
            'linkico-gray'  => __( 'Gray Link Icon', 'appeal' ),
        ),
    ));

    // (9)
    $wp_customize->add_control(
    new WP_Customize_Image_Control(
    $wp_customize,
    'appeal_topbox_image', array(
            'settings'          => 'appeal_topbox_image_setting',
            'section'           => 'appeal_custom_teaser_length_section',
            'label'             => __( 'Upload Image to Top Advert Box', 'appeal' ),
            'description'       => __( 'Upload will override any widgets.', 'appeal' ),
        )
    ));

    // (10)
    $wp_customize->add_control(
        'appeal_sidebar_border', array(
        'settings' => 'appeal_sidebar_border_setting',
        'label'    => __( 'Choose border style on sidebars.', 'appeal' ),
        'section'  => 'appeal_custom_teaser_length_section',
        'type'     => 'select',
        'choices'  => array(
            'none' => __( 'No borders', 'appeal' ),
            'thin solid rgba( 240, 240, 240, .9)'   => __( 'Show borders', 'appeal' ),
            'thin solid rgba( 240, 240, 240, .9); box-shadow: 4px 2px 3px -2px rgba(0, 0, 0, .22)'
             => __('Show borders and Box-Shadow', 'appeal' ), 
        ),
    ));
    
    // (11)
    $wp_customize->add_control(
        'appeal_sidebar_text', array(
            'settings'          => 'appeal_sidebar_text_setting',
            'type'              => 'text',
            'section'           => 'appeal_custom_teaser_length_section',
            'label'       => __( 'Wording for View Sidebar button', 'appeal' ),
        )
    );
    
    // (12)
    $wp_customize->add_control(
        'appeal_readon_text', array(
            'settings'          => 'appeal_readon_text_setting',
            'type'              => 'text',
            'section'           => 'appeal_custom_teaser_length_section',
            'label'       => __( 'Wording for Read More button', 'appeal' ),
        )
    );
    
    // (12)
    $wp_customize->add_control(
        'appeal_copyright_text', array(
            'settings'          => 'appeal_copyright_text_setting',
            'type'              => 'text',
            'section'           => 'appeal_custom_teaser_length_section',
            'label'       => __( 'Replace Footer Copyright with Text', 'appeal' ),
        )
    );
    
    /** (13) Mobile Nav @use or not use
     * @since 1.0.7 
     */
    $wp_customize->add_control(
        'appeal_nav_walker_mobi', array(
            'settings'          => 'appeal_nav_walker_mobi_setting',
            'section'           => 'appeal_custom_teaser_length_section',
            'label'             => __( 'Mobile Navigation Preference', 'appeal' ),
            'type'              => 'select',
            'choices'   => array(
                '0' => __( 'Leave Top Menu Item Selectable', 'appeal' ),
                '1'  => __( 'Use Mobile Nav (top tap only)', 'appeal' ),
            ),
        )
    );
    
    // (14)
    $wp_customize->add_control(
        'appeal_theme_instructions', array(
            'settings'          => 'appeal_theme_instructions_setting',
            'type'              => 'hidden',
            'section'           => 'appeal_custom_teaser_length_section',
            'description'       => __( 'Instructions: <b>Appearance > Theme Options</b>', 'appeal' ),
        )
    );

}
add_action( 'customize_register', 'appeal_register_theme_customizer' );


//sanitizer for integer
function appeal_sanitize_number_absint( $number, $setting ) {
  // Ensure $number is an absolute integer (whole number, zero or greater).
  $number = absint( $number );

  // If the input is an absolute integer, return it; otherwise, return the default
  return ( $number ? $number : $setting->default );
}
//sanitize for checkbox
function appeal_sanitize_checkbox( $checked ) {
	// Boolean check.
	return ( ( isset( $checked ) && true == $checked ) ? true : false );
}


/** (1), (2), (3), (5), (8 called from template directly)
 * Writes the Header Background Anchor Links and Width of Teaser related controls'
 * values outputed to the 'head' of the document
 * by reading the value(s) from the theme mod value in the options table.
 */
function appeal_customizer_css() {
    if ( get_theme_mods() )
    :
    echo '<style type="text/css">';
        
        if ( get_theme_mod( 'appeal_header_background_color_setting' ) ) :
             $appealheader = get_theme_mod( 'appeal_header_background_color_setting');
             echo '.site-head, .footer-footer, #sidebar-right, #sidebar-left{background: ' . esc_attr( $appealheader ) . ';} .commentlist, article.sticky .content-header{border-color: ' . esc_attr( $appealheader ) . ';}';
        endif;
				     
        if ( get_theme_mod( 'appeal_page_background_color_setting' ) ) :
             $appealpage = get_theme_mod( 'appeal_page_background_color_setting');
             echo '#content {background: ' . esc_attr( $appealpage ) . ';}';
        endif;
        
        if ( get_theme_mod( 'appeal_anchor_links_color_setting' ) ) :
             $appeallink = get_theme_mod( 'appeal_anchor_links_color_setting');
             echo 'a, a:link, #inner-footer a {color: ' . esc_attr( $appeallink ) . ';}';
        endif;

        if ( get_theme_mod( 'appeal_pullquote_text_color_setting' ) ) :
             $appealquote = get_theme_mod( 'appeal_pullquote_text_color_setting');
             echo '.pullquote aside {color: ' . esc_attr( $appealquote ) . ';}';
        endif;

        if ( get_theme_mod( 'appeal_custom_teaser_width_setting' ) ) :
             $appealwidth = get_theme_mod( 'appeal_custom_teaser_width_setting');
             echo '.pullquote {width: ' . esc_attr( $appealwidth ).'px;}';
        endif;

        if ( get_theme_mod( 'appeal_topbox_image_setting' ) ) :
             $appealtopbox = get_theme_mod( 'appeal_topbox_image_setting');
             echo '#topbox-banner { background: url( ' . esc_attr($appealtopbox) . ' ); }';
        endif;
        
        if ( get_theme_mod( 'appeal_sidebar_border_setting' ) ) :
             $appealsidebrd = get_theme_mod( 'appeal_sidebar_border_setting', 'none');
             echo '#sidebar-left, #sidebar-right { border: ' . esc_attr( $appealsidebrd ) .'; }';
        endif; 
    
    echo '</style>';
    endif;
}
add_action( 'wp_head', 'appeal_customizer_css');


/** (6)
 * post excerpt length
 * @return excerpt_length
 * integer value
*/
function appeal_custom_posts_excerpt_length()
{ 
    if( !is_admin()) : 
    if ( get_theme_mods( ) ) {
        $length = get_theme_mod( 'appeal_posts_excerpt_length_setting', 60 );
        return esc_attr( $length );
    }
    endif;
}
add_filter( 'excerpt_length', 'appeal_custom_posts_excerpt_length' );

?>
