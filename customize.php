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

    /* (1)
     * WP_Customize_ /add_setting for header background color
    */
	$wp_customize->add_setting(	'appeal_header_background_color_setting', array(
            'type'              => 'theme_mod',
            'default'           => 'f7f7f7',
			'sanitize_callback'	=> 'sanitize_hex_color',
			'transport'			=> 'refresh'
		)
	);

    /* (2)
     * WP_Customize_ /add_setting for content background color
    */
	$wp_customize->add_setting(	'appeal_page_background_color_setting', array(
            'type'              => 'theme_mod',
            'default'           => 'ffffff',
			'sanitize_callback'	=> 'sanitize_hex_color',
			'transport'			=> 'refresh'
		)
	);

    /* (3)
     * WP_Customize_ /add_setting for anchor link color
    */
	$wp_customize->add_setting(	'appeal_anchor_links_color_setting', array(
            'type'              => 'theme_mod',
            'default'           => '33679d',
			'sanitize_callback'	=> 'sanitize_hex_color',
			'transport'			=> 'refresh'
		)
	);

    /* (4)
     * WP_Customize_ /add_setting for pullquote teaser words
    */
	$wp_customize->add_setting(	'appeal_custom_teaser_length_setting', array(
            'type'              => 'theme_mod',
            'default'           => 22,
			'sanitize_callback'	=> 'appeal_sanitize_number_absint',
			'transport'			=> 'refresh'
		)
	);

    /* (5)
     * WP_Customize_ /add_setting for pullquote teaser width
    */
	$wp_customize->add_setting(	'appeal_custom_teaser_width_setting', array(
            'type'              => 'theme_mod',
            'default'           => 220,
			'sanitize_callback'	=> 'appeal_sanitize_number_absint',
			'transport'			=> 'refresh'
		)
	);

    /* (6)
     * WP_Customize_ /add_setting for post excerpt words
    */
	$wp_customize->add_setting(	'appeal_posts_excerpt_length_setting', array(
            'type'              => 'theme_mod',
            'default'           => 58,
			'sanitize_callback'	=> 'appeal_sanitize_number_absint',
			'transport'			=> 'refresh'
		)
	);

    /* (7)
     * WP_Customize_ /add_setting for title visibility
    */
	$wp_customize->add_setting(	'appeal_title_visible_setting', array(
            'type'              => 'theme_mod',
            'default'           => 'atvt1',
			'sanitize_callback'	=> 'sanitize_text_field',
			'transport'			=> 'refresh'
		)
	);

    /* (8)
     * WP_Customize_ /add_setting for post header link
    */
	$wp_customize->add_setting(	'appeal_titlelink_color_setting', array(
            'type'              => 'theme_mod',
            'default'           => 'linkico-gray',
			'sanitize_callback'	=> 'sanitize_text_field',
			'transport'			=> 'refresh'
		)
	);

    /* (9)
     * WP_Customize_ /add_setting for theme instructions
    */
	$wp_customize->add_setting(	'appeal_theme_instructions_setting', array(
            'type'              => 'option',
            'default'           => '',
			'sanitize_callback'	=> 'sanitize_text_field'
		)
	);

//-----------------Controls-----------------------------------

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

    // (2)
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

    // (3) Header and Footer background color
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

    // (4) Teaser word count length
    $wp_customize->add_control(
        'appeal_custom_teaser_length', array(
            'settings'          => 'appeal_custom_teaser_length_setting',
            'type'              => 'number',
            'section'           => 'appeal_custom_teaser_length_section',
            'label'             => __( 'PullQuote Number of Words', 'appeal' ),
            'description'       => __( 'Set how many words display on the pullquote.',
                                       'appeal' ),
            'input_attrs' => array(
                'min' => 0,
                'max' => 55,
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
            'description'       => __( 'This sets how wide the Teaser will be.
                                        Height is automatic.', 'appeal' ),
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
            'label'             => __( 'Set Posts Excerpt Length', 'appeal' ),
            'description'       => __( 'This sets excertps for POSTS ONLY.',
                                       'appeal' ),
            'input_attrs' => array(
                'min' => 0,
                'max' => 385,
            ),
        )
    );

    // (7)
    $wp_customize->add_control(
        'appeal_title_visible_toposts', array(
        'settings' => 'appeal_title_visible_setting',
        'label'   => __( 'Title Visible only on: ', 'appeal' ),
        'description' => __( 'does not apply to archives etc', 'appeal' ),
        'section' => 'appeal_custom_teaser_length_section',
        'type'    => 'select',
        'choices'    => array(
            'atvt1' => __( 'Posts and Pages', 'appeal' ),
            'atvt2' => __( 'Posts Only', 'appeal' ),
            'atvt3' => __( 'Pages Only', 'appeal' ),
            'atvt4' => __( 'Only HomePage Blog &amp; Single Posts', 'appeal' ),
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
        'appeal_theme_instructions', array(
            'settings'          => 'appeal_theme_instructions_setting',
            'type'              => 'hidden',
            'section'           => 'appeal_custom_teaser_length_section',
            'label'             => __( 'Further Theme Instructions', 'appeal' ),
            'description'       => _x( '<p style="background:azure"> By hiding titles of posts/pages, your titles can be added from your <b>Editor</b> to give better SEO URLs and puts title where you want it in the article. (Use h1, h2, h3. h3 is pre styled [best choice].) <b>The Editor Title box will be the page name.</b> This is required.</p><hr><p style="background:seashell">To set up social or company media links in the page footer---and the popup---use the Menu settings <b>Appearance > Menus</b>. Then create your links using the <u>Custom Links</u> panel to left of Menu Structure panel. Save accordingly.</p><hr><b>Other notes: </b><p style="background:honeydew">Author Links are taken from the User Profile. Be creative by replacing user profile website field with a social link.<br>To fashion the advert boxes you can use the editor to create a post and then copy the code from that post into a text-widget. (Remember to make post private) TSW=|=</p>', 'appeal' ),
        )
    );

}
add_action('customize_register', 'appeal_register_theme_customizer');



//sanitizer for integer
function appeal_sanitize_number_absint( $number, $setting ) {
  // Ensure $number is an absolute integer (whole number, zero or greater).
  $number = absint( $number );

  // If the input is an absolute integer, return it; otherwise, return the default
  return ( $number ? $number : $setting->default );
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
             echo '.site-head, .footer-footer, #sidebar-right, #sidebar-left{
                    background: ' . $appealheader . ';} .commentlist, article.sticky .content-header{border-color: ' . $appealheader . ';}';
        endif;

        if ( get_theme_mod( 'appeal_page_background_color_setting' ) ) :
             $appealpage = get_theme_mod( 'appeal_page_background_color_setting');
             echo '#content {background: ' . $appealpage . ';}';
        endif;

        if ( get_theme_mod( 'appeal_anchor_links_color_setting' ) ) :
             $appeallink = get_theme_mod( 'appeal_anchor_links_color_setting');
             echo 'a, a:link, #inner-footer a {color: ' . $appeallink . ';}';
        endif;

        if ( get_theme_mod( 'appeal_custom_teaser_width_setting' ) ) :
             $appealwidth = get_theme_mod( 'appeal_custom_teaser_width_setting');
             echo '.pullquote {width: ' . $appealwidth . 'px;}';
        endif;

    echo '</style>';
    endif;
}
add_action( 'wp_head', 'appeal_customizer_css');


/** (4)
 * Writes the teaser_length to the_excerpt
 * by reading the value(s) from the theme mod value in the options table.
 */
function appeal_teaser_length()
{
    if ( get_theme_mods( ) ) {
        $page = get_post();
        $the_excerpt = $page->post_excerpt;
        $length = get_theme_mod( 'appeal_custom_teaser_length_setting', '12' );
        $content = wp_strip_all_tags( $the_excerpt , true );
            return wp_trim_words( $content, $length );
    }
}
add_filter( 'the_excerpt', 'appeal_teaser_length' );


/** (6)
 * post excerpt length
 * @return excerpt_length
 * integer value
*/
function appeal_custom_posts_excerpt_length()
{
    if ( get_theme_mods( ) ) {
        $length = get_theme_mod( 'appeal_posts_excerpt_length_setting', 60 );
        return $length;
    }
}

function appeal_title_visible()
{
    if ( get_theme_mods( ) ) {
        $hgroup = get_theme_mod( 'appeal_title_visible_setting', 'atvt1' );
        return $hgroup;
    }
}
?>