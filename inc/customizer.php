<?php
/**
 * Customizer
 *
 */
function smartkid_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'smartkid_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'smartkid_customize_partial_blogdescription',
			)
		);
	}
}
add_action( 'customize_register', 'smartkid_customize_register' );

function smartkid_customize_partial_blogname() {
	bloginfo( 'name' );
}


function smartkid_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

function smartkid_customize_preview_js() {
	wp_enqueue_script( 'smartkid-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), _S_VERSION, true );
}
add_action( 'customize_preview_init', 'smartkid_customize_preview_js' );

