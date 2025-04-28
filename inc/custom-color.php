<?php
/**
 * Custon color
 */
 // Tạo màu chủ đạo tuỳ chỉnh
  function smartkid_theme_customize_register( $wp_customize ) {
    // sang color
    $wp_customize->add_setting( 'text_color', array(
      'default'   => '',
      'transport' => 'refresh',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'text_color', array(
      'section' => 'colors',
      'label'   => __( 'Màu chữ chủ đạo chế độ sáng', 'smartkid' ),
    ) ) );

    // toi color
    $wp_customize->add_setting( 'link_color', array(
      'default'   => '',
      'transport' => 'refresh',
      'sanitize_callback' => 'sanitize_hex_color',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'link_color', array(
      'section' => 'colors',
      'label'   => __( 'Màu chữ chủ đạo chế độ tối', 'smartkid' ),
    ) ) );
    
    
    
    // Màu nền thanh bar
    $wp_customize->add_setting( 'bar_color', array(
      'default'   => '',
      'transport' => 'refresh',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bar_color', array(
      'section' => 'colors',
      'label'   => __( 'Màu nền thanh bar chế độ sáng', 'smartkid' ),
    ) ) );
	
	// Màu nền thanh bar tối
    $wp_customize->add_setting( 'bar_color_dark', array(
      'default'   => '',
      'transport' => 'refresh',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bar_color_dark', array(
      'section' => 'colors',
      'label'   => __( 'Màu nền thanh bar chế độ tối', 'smartkid' ),
    ) ) );

    // Màu chữ icon bar
    $wp_customize->add_setting( 'bart_color', array(
      'default'   => '',
      'transport' => 'refresh',
      'sanitize_callback' => 'sanitize_hex_color',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bart_color', array(
      'section' => 'colors',
      'label'   => __( 'Màu biểu tượng ở thanh bar', 'smartkid' ),
    ) ) );
	
	// Màu nền thanh menu sáng GB
    $wp_customize->add_setting( 'menu_color', array(
      'default'   => '',
      'transport' => 'refresh',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'menu_color', array(
      'section' => 'colors',
      'label'   => __( 'Màu nền menu GB chế độ sáng', 'smartkid' ),
    ) ) );
	
	// Màu nền thanh menu tối GB
    $wp_customize->add_setting( 'menu_color_dark', array(
      'default'   => '',
      'transport' => 'refresh',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'menu_color_dark', array(
      'section' => 'colors',
      'label'   => __( 'Màu nền menu GB chế độ tối', 'smartkid' ),
    ) ) );
	
	// Màu nền chữ menu GB
    $wp_customize->add_setting( 'menu_color_text', array(
      'default'   => '',
      'transport' => 'refresh',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'menu_color_text', array(
      'section' => 'colors',
      'label'   => __( 'Màu chữ menu GB', 'smartkid' ),
    ) ) );
	
	// Màu nền chữ menu top
    $wp_customize->add_setting( 'menu_color_top', array(
      'default'   => '',
      'transport' => 'refresh',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'menu_color_top', array(
      'section' => 'colors',
      'label'   => __( 'Màu chữ menu top', 'smartkid' ),
    ) ) );
	
	
	// Màu nền thanh custom menu top
    $wp_customize->add_setting( 'menu_custom_color', array(
      'default'   => '',
      'transport' => 'refresh',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'menu_custom_color', array(
      'section' => 'colors',
      'label'   => __( 'Màu nền custom menu top', 'smartkid' ),
    ) ) );
	
	// Màu chữ cusotm menu top
    $wp_customize->add_setting( 'menu_custom_color_top', array(
      'default'   => '',
      'transport' => 'refresh',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'menu_custom_color_top', array(
      'section' => 'colors',
      'label'   => __( 'Màu chữ custom menu top', 'smartkid' ),
    ) ) );
	
  }
  add_action( 'customize_register', 'smartkid_theme_customize_register' );
  
// Đưa css ra body
  function smartkid_theme_get_customizer_css() {
    ob_start();

    $text_color = get_theme_mod( 'text_color', '' );
    // màu chữ củ đạo nền sáng
    if ( ! empty( $text_color ) ) { ?>
	  :root{
		--texta: <?php echo $text_color; ?> !important;
		--down-border: 2px solid <?php echo $text_color; ?> !important;
		}
    <?php }

    // màu chữ chủ đạo nền tối
    $link_color = get_theme_mod( 'link_color', '' );
    if ( ! empty( $link_color ) ) { ?>
	  [data-theme="dark"] {
		--texta: <?php echo $link_color; ?> !important;
		--down-border: 2px solid <?php echo $link_color; ?> !important;
		}
    <?php }
    
    // màu nền thanh bar sang
    $bar_color = get_theme_mod( 'bar_color', '' );
    if ( ! empty( $bar_color ) ) { ?>
	  :root{
		--bar: <?php echo $bar_color; ?> !important;
		}
    <?php }
	
	// màu nền thanh bar tối
    $bar_color_dark = get_theme_mod( 'bar_color_dark', '' );
    if ( ! empty( $bar_color ) ) { ?>
	  [data-theme="dark"] {
		--bar: <?php echo $bar_color_dark; ?> !important;
		}
    <?php }
    
    // màu bieu tuong o thanh bar
    $bart_color = get_theme_mod( 'bart_color', '' );
    if ( ! empty( $bart_color ) ) { ?>
	  .menu-top{
		color: <?php echo $bart_color; ?> !important;
		}
    <?php }

	// màu nền menu che do sang GB
    $menu_color = get_theme_mod( 'menu_color', '' );
    if ( ! empty( $menu_color ) ) { ?>
	  :root{
		--menu-duoi: <?php echo $menu_color; ?> !important;
		}
    <?php }
	
	// màu nền menu che do toi GB
    $menu_color_dark = get_theme_mod( 'menu_color_dark', '' );
    if ( ! empty( $menu_color ) ) { ?>
	  [data-theme="dark"] {
		--menu-duoi: <?php echo $menu_color_dark; ?> !important;
		}
    <?php }

	// màu chu menu GB
    $menu_color_text = get_theme_mod( 'menu_color_text', '' );
    if ( ! empty( $menu_color_text ) ) { ?>
	.wp-menu-gb-1 > li > a, .wp-menu-gb-2 > li > a{
		color: <?php echo $menu_color_text; ?> !important;
	}
	.menu-gb .menu-mxh a{
		color: <?php echo $menu_color_text; ?> !important;
	}
    <?php }
	
	// màu chu menu top
    $menu_color_top = get_theme_mod( 'menu_color_top', '' );
    if ( ! empty( $menu_color_top ) ) { ?>
	@media (min-width: 800px){
	.top-menu-color .wptop-menu-1 > li > a, .top-menu-color .wptop-menu-1 > li > a {color: <?php echo $menu_color_top; ?> !important;}
	.top-menu-color .wptop-menu-2 > li > a, .top-menu-color .wptop-menu-2 > li > a {color: <?php echo $menu_color_top; ?> !important;}
	}
	
    <?php }
	
	
	// màu nền custom menu top
    $menu_custom_color = get_theme_mod( 'menu_custom_color', '' );
    if (!empty( $menu_custom_color )) { ?>
	  .custom-menu-top{
	  background: <?php echo $menu_custom_color; ?> !important;
	  border-bottom:1px solid <?php echo $menu_custom_color; ?> !important;
	  }
    <?php }

	// màu chu custom menu top
    $menu_custom_color_top = get_theme_mod( 'menu_custom_color_top', '' );
    if (!empty($menu_custom_color_top )) { ?>
	.custom-menu-top-main a{color: <?php echo $menu_custom_color_top; ?> !important;}
    <?php }
	
	
    $css = ob_get_clean();
    return $css;
  }  
// lay file style
function wp_add_style(){
	global $smartkid_options; 
  return 'style';
} 
// dang ky style va style.min cho theme
function smartkid_theme_enqueue_styles() {
  $theme_dir = get_stylesheet_directory();
  $style_file = '/style.css';
  if (file_exists($theme_dir . $style_file)) { 
      wp_enqueue_style('theme-styles', get_stylesheet_directory_uri() . $style_file); 
  } else {
    wp_enqueue_style( 'theme-styles', get_stylesheet_uri() ); 
  }
  $custom_css = smartkid_theme_get_customizer_css();
  wp_add_inline_style( 'theme-styles', $custom_css );
}
add_action( 'wp_enqueue_scripts', 'smartkid_theme_enqueue_styles' );

