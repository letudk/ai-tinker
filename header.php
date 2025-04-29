<?php
/**
 * Header Card
 **/
$current_user = wp_get_current_user(); $user_id = get_current_user_id(); global $smartkid_options; 
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta name="viewport" content="width=device-width">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	 
	<?php wp_head();?>   
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<?php  if( is_home() && !empty($smartkid_options['theh1'])) { ?><h1 style="display:none"><?php echo $smartkid_options['theh1']; ?></h1><?php } ?>
<?php do_action( 'smartkid_notify' ); // notify ?>
<header>
<nav class="menu-top">
<div class="fix-menu">
	<div class="logo"><?php  
    if (has_custom_logo()) {
        $logo_id = get_theme_mod('custom_logo'); // Lấy ID logo
        $logo = wp_get_attachment_image_src($logo_id, 'full'); // Lấy đường dẫn và kích thước

        if ($logo) {
            $logo_url = esc_url($logo[0]);
            $logo_width = esc_attr($logo[1]);
            $logo_height = esc_attr($logo[2]);

            echo '<a href="' . esc_url(home_url('/')) . '" class="custom-logo-link">';
            echo '<img title="Tải Tranh Tô Màu Cho Bé Miễn Phí" src="' . $logo_url . '" width="' . $logo_width . '" height="' . $logo_height . '" alt="' . get_bloginfo('name') . '">';
            echo '</a>';
        }
}
 ?>
		<?php get_template_part( 'template-parts/menu/top-menu');   ?>
	</div> 
	<div class="iconmenu iconmenu-top">
		<button title="Menu" id="buttoniconhi" onclick="share(event, 'top-menu-mobile')">
			<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
				<path d="M3 6h18M3 12h18M3 18h18" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
			</svg>
		</button>
	</div>
	<div class="iconlogin">
	<!-- tim kiem -->
	<form method="get" action="<?php bloginfo('url'); ?>" autocomplete="off">
		<div class="search-mau" style="display:flex">
			<div class="searchbg input-wrapper">
				<input id="searchbox" placeholder="<?php _e('Nhập từ khoá tìm kiếm', 'smartkid'); ?>" type="text" name="s"  onkeyup="smartkidsearch()">
				<label for="stuff" class="fas fa-search input-land-icon"></label>
			</div>
				<span id="close-search" title="<?php _e('Đóng tìm kiếm', 'smartkid'); ?>" type="submit" onclick="share(event, 'searchtop')"><i class="fa-solid fa-xmark"></i></span>
		</div>
	</form> 
</div>
</nav> 

<?php  get_template_part( 'template-parts/menu/top-menu-mobile'); ?>	
</header>

