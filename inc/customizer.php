<?php
/**
 * DevWP Theme Customizer
 *
 * @package DevWP
 */

 if(!defined('ABSPATH')){
	exit;
 }

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */

if(!function_exists("devwp_customize_register")):
	function devwp_customize_register( $wp_customize ) {
		$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
		$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
		$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

		if ( isset( $wp_customize->selective_refresh ) ) {
			$wp_customize->selective_refresh->add_partial(
				'blogname',
				array(
					'selector'        => '.site-title a',
					'render_callback' => 'devwp_customize_partial_blogname',
				)
			);
			$wp_customize->selective_refresh->add_partial(
				'blogdescription',
				array(
					'selector'        => '.site-description',
					'render_callback' => 'devwp_customize_partial_blogdescription',
				)
			);
		}

		$wp_customize->get_section('header_image')->panel = 'devwp_header_panel';
		$wp_customize->get_section('header_image')->active_callback = 'is_front_page';


		//Remove Sections
		$wp_customize->remove_section('custom_css');
		$wp_customize->remove_section('background_image');
		$wp_customize->remove_section('colors');

		$wp_customize->add_section(
			'devwp_theme_options',
			array(
				'title' => esc_html__('Theme Options', 'devwp'),
				'description' => esc_html__('Just a few options to use.', 'devwp'),
				'priority' => 15,
				'capability' => 'edit_theme_options'

			)
		);

		$wp_customize->add_setting(
			'devwp_navbar_type',
			array(
				
				'type' => 'theme_mod',
				'capability' => 'edit_theme_options',
				'default' => 'offcanvas',
				'sanitize_callback' => 'devwp_sanitize_select',

			)
		);

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'devwp_navbar_type',
				array(
					'label'  => esc_html__('Navbar Type', 'devwp'),
					'description' => esc_html__('Choose between a Standard Navbar and Offcanvas', 'devwp'),
					'section' => 'devwp_theme_options',
					'settings' => 'devwp_navbar_type',
					'type' => 'select',
					'choices' => array(
						'collapse' => esc_html__('Collapse', 'devwp'),
						'offcanvas' => esc_html__('Off Canvas Navbar', 'devwp'),
					),
					'priority' => 20
				)
			)
		);

		$wp_customize->add_setting(
			'exc_length',
			array(

				'type' => 'theme_mod',
				'capability' => 'edit_theme_options',
				'default' => '40',
				'sanitize_callback' => 'absint',

			)
		);

		$wp_customize->add_control(
			'exc_length',
			array(
				'label' => esc_html__('Excerpt Length', 'devwp'),
				'description' => esc_html__('Set a Custom Excerpt Length. Min 10 &amp; Max 200', 'devwp'),
				'section' => 'devwp_theme_options',
				'type' => 'number',
				'input_attrs' => array(
					'min' => 10,
					'max' => 200,
					'step' => 5
				),
				'priority' => 40
			)
		);

		$wp_customize->add_setting(
			'enable_gut',
			array(

				'type' => 'theme_mod',
				'capability' => 'edit_theme_options',
				'default' => 'yes',
				'sanitize_callback' => 'devwp_sanitize_select',

			)
		);

		$wp_customize->add_control(
			'enable_gut',
			array(
				'label' => esc_html__('Enable Gutenberg', 'devwp'),
				'description' => esc_html__('Enable Gutenberg Block Editor Functionality and Features', 'devwp'),
				'section' => 'devwp_theme_options',
				'type' => 'select',
				'choices' => array(
					'no' => esc_html__('No', 'devwp'),
					'yes' => esc_html__('Yes', 'devwp'),
				),
				'priority' => 50
			)
		);

		$wp_customize->add_setting(
			'enable_emojis',
			array(

				'type' => 'theme_mod',
				'capability' => 'edit_theme_options',
				'default' => 'yes',
				'sanitize_callback' => 'devwp_sanitize_select',

			)
		);

		$wp_customize->add_control(
			'enable_emojis',
			array(
				'label' => esc_html__('Enable Wordpres Emojis', 'devwp'),
				'description' => esc_html__('Enable Wordpres Emojis ', 'devwp'),
				'section' => 'devwp_theme_options',
				'type' => 'select',
				'choices' => array(
					'no' => esc_html__('No', 'devwp'),
					'yes' => esc_html__('Yes', 'devwp'),
				),
				'priority' => 60
			)
		);

		$wp_customize->add_setting(
			'enable_jquery_migrate',
			array(

				'type' => 'theme_mod',
				'capability' => 'edit_theme_options',
				'default' => 'yes',
				'sanitize_callback' => 'devwp_sanitize_select',

			)
		);

		$wp_customize->add_control(
			'enable_jquery_migrate',
			array(
				'label' => esc_html__('Enable lQuery Migrate', 'devwp'),
				'description' => esc_html__('Enable lQuery Migrate ', 'devwp'),
				'section' => 'devwp_theme_options',
				'type' => 'select',
				'choices' => array(
					'no' => esc_html__('No', 'devwp'),
					'yes' => esc_html__('Yes', 'devwp'),
				),
				'priority' => 70
			)
		);

		$wp_customize->add_panel(
			'devwp_header_panel',
			array(
				'title' => esc_html__('Header Area','devwp'),
				'capability' => 'edit_theme_options',
				'priority' => 20,
				'active_callback' => 'devwp_home_front',
			)
		);

		$wp_customize->add_setting(
			'home_header_img',
			array(
				'capability' => 'edit_theme_options',
				'default' => '',
				'sanitize_callback' => 'devwp_sanitize_file',

			)
		);

		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'home_header_img',
				array(
					'label' => esc_html__('Blog Roll Page Header Image', 'devwp'),
					'description' => esc_html__('Add a header image for your Blog ROll Page', 'devwp'),
					'section' => 'header_image',
					'settings' => 'home_header_img',
					'type' => 'image',
					'priority' => 10,
					'active_callback' => 'is_home',
				)
			)
		);

		//Header Text
		$wp_customize->add_section(
			'devwp_header_text',
			array(
				'title' => esc_html__('Header Text', 'devwp'),
				'panel' => 'devwp_header_panel',
				'priority' => 60,
				'capability' => 'edit_theme_options'

			)
		);

		$wp_customize->add_setting(
			'fp_header_toptext',
			array(

				'type' => 'theme_mod',
				'capability' => 'edit_theme_options',
				'default' => '',
				'transport' => 'postMessage',
				'sanitize_callback' => 'sanitize_text_feild',

			)
		);

		$wp_customize->add_control(
			'fp_header_toptext',
			array(
				'label' => esc_html__('FP: Top Text', 'devwp'),
				'description' => esc_html__('Smaller Header Text ', 'devwp'),
				'section' => 'devwp_header_text',
				'type' => 'text',
				'priority' => 10,
				'active_callback' => 'is_front_page'
			)
		);

		$wp_customize->add_setting(
			'fp_header_btmtext',
			array(

				'type' => 'theme_mod',
				'capability' => 'edit_theme_options',
				'default' => '',
				'transport' => 'postMessage',
				'sanitize_callback' => 'sanitize_text_feild',

			)
		);

		$wp_customize->add_control(
			'fp_header_btmtext',
			array(
				'label' => esc_html__('FP: Bottom Text', 'devwp'),
				'description' => esc_html__('Larger Header Text ', 'devwp'),
				'section' => 'devwp_header_text',
				'type' => 'text',
				'priority' => 20,
				'active_callback' => 'is_front_page'
			)
		);

		$wp_customize->add_setting(
			'fp_header_button_url',
			array(

				'type' => 'theme_mod',
				'capability' => 'edit_theme_options',
				'default' => '',
				'transport' => 'refresh',
				'sanitize_callback' => 'esc_url_raw',

			)
		);

		$wp_customize->add_control(
			'fp_header_button_url',
			array(
				'label' => esc_html__('FP: Bottun URL', 'devwp'),
				'description' => esc_html__('Destination URL ', 'devwp'),
				'section' => 'devwp_header_text',
				'type' => 'text',
				'priority' => 30,
				'active_callback' => 'is_front_page'
			)
		);

		$wp_customize->add_setting(
			'fp_header_button',
			array(

				'type' => 'theme_mod',
				'capability' => 'edit_theme_options',
				'default' => '',
				'transport' => 'postMessage',
				'sanitize_callback' => 'sanitize_text_field',

			)
		);

		$wp_customize->add_control(
			'fp_header_button',
			array(
				'label' => esc_html__('FP: Button Text', 'devwp'),
				'description' => esc_html__('Button Call to Action Text ', 'devwp'),
				'section' => 'devwp_header_text',
				'type' => 'text',
				'priority' => 40,
				'active_callback' => 'is_front_page'
			)
		);

		//Blog Page
		$wp_customize->add_setting(
			'bp_header_toptext',
			array(

				'type' => 'theme_mod',
				'capability' => 'edit_theme_options',
				'default' => '',
				'transport' => 'postMessage',
				'sanitize_callback' => 'sanitize_text_feild',

			)
		);

		$wp_customize->add_control(
			'bp_header_toptext',
			array(
				'label' => esc_html__('BP: Top Text', 'devwp'),
				'description' => esc_html__('Smaller Header Text ', 'devwp'),
				'section' => 'devwp_header_text',
				'type' => 'text',
				'priority' => 50,
				'active_callback' => 'is_home'
			)
		);

		$wp_customize->add_setting(
			'bp_header_btmtext',
			array(

				'type' => 'theme_mod',
				'capability' => 'edit_theme_options',
				'default' => '',
				'transport' => 'postMessage',
				'sanitize_callback' => 'sanitize_text_feild',

			)
		);

		$wp_customize->add_control(
			'bp_header_btmtext',
			array(
				'label' => esc_html__('BP: Bottom Text', 'devwp'),
				'description' => esc_html__('Larger Header Text ', 'devwp'),
				'section' => 'devwp_header_text',
				'type' => 'text',
				'priority' => 60,
				'active_callback' => 'is_home'
			)
		);

		$wp_customize->add_setting(
			'bp_header_button_url',
			array(

				'type' => 'theme_mod',
				'capability' => 'edit_theme_options',
				'default' => '',
				'transport' => 'refresh',
				'sanitize_callback' => 'esc_url_raw',

			)
		);

		$wp_customize->add_control(
			'bp_header_button_url',
			array(
				'label' => esc_html__('BP: Bottun URL', 'devwp'),
				'description' => esc_html__('Destination URL ', 'devwp'),
				'section' => 'devwp_header_text',
				'type' => 'text',
				'priority' => 70,
				'active_callback' => 'is_home'
			)
		);

		$wp_customize->add_setting(
			'bp_header_button',
			array(

				'type' => 'theme_mod',
				'capability' => 'edit_theme_options',
				'default' => '',
				'transport' => 'postMessage',
				'sanitize_callback' => 'sanitize_text_field',

			)
		);

		$wp_customize->add_control(
			'bp_header_button',
			array(
				'label' => esc_html__('BP: Button Text', 'devwp'),
				'description' => esc_html__('Button Call to Action Text ', 'devwp'),
				'section' => 'devwp_header_text',
				'type' => 'text',
				'priority' => 80,
				'active_callback' => 'is_home'
			)
		);
	}
	add_action( 'customize_register', 'devwp_customize_register' );
endif;

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function devwp_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function devwp_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function devwp_customize_preview_js() {
	wp_enqueue_script( 'devwp-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ),DEVWP_VERSION,true );
}
add_action( 'customize_preview_init', 'devwp_customize_preview_js' );


if(!function_exists("devwp_sanitize_select")):
	/**
	 * Sanitize Select Element
	 *
	 * @param string
	 * @param WP_Customize_Setting $wp_customize Theme Customizer object.
	 * 
	 * @return string
	 */
	function devwp_sanitize_select(string $input, WP_Customize_Setting $setting) : string{
		
		$input = sanitize_key($input);

		$choices = $setting->manager->get_control( $setting->id)->choices;

		return (array_key_exists($input, $choices) ? $input : $setting->default);
	}

endif;

if(!function_exists("devwp_sanitize_file")):
	/**
	 * File inputSanitize Select Element
	 *
	 * @param string
	 * @param WP_Customize_Setting $wp_customize Theme Customizer object.
	 * 
	 * @return string
	 */
	function devwp_sanitize_file(string $file, WP_Customize_Setting $setting) : string{
		//allowed file types

		$mimes = array(
			'jpg|jpeg|jpe' => 'image/jpeg',
			'gif'  =>  'image/gif',
			'png' => 'image/png'

		);

		$file_ext = wp_check_filetype($file, $mimes);

		return ( $file_ext['ext'] ? $file : $setting->default );

		
	}

endif;

if(!function_exists("devwp_sanitize_checkbox")):
	/**
	 * Checkbox sanitize
	 *
	 * @param bool
	 * 
	 * @return bool
	 */
	function devwp_sanitize_checkbox(bool $checked) : bool {
		//allowed file types

		return (bool) isset($checked) && true === $checked;

		
	}

endif;

if(!function_exists("devwp_home_front")):
	/**
	 * Checkbox sanitize
	 *
	 * 
	 * @return bool
	 */
	function devwp_home_front() : bool {

		// return ((is_front_page() || is_home()) ? true : false);
		// return is_front_page() || is_home();

		if(is_front_page() || is_home()){
			return true;
		}else{
			return false;
		}



	}

endif;
