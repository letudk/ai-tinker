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
	<meta name="google-adsense-account" content="ca-pub-6880247157533572">

	<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6880247157533572" crossorigin="anonymous"></script>
	
	<?php wp_head();?> 
		  <!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-DP5Z5GGQRN"></script>
	
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-DP5Z5GGQRN');
</script>
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
		<button title="<?php _e('Tìm kiếm', 'smartkid'); ?>" onclick="share(event, 'searchtop')">
			<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
				<path d="M10 2a8 8 0 1 1-5.29 14.1l-4.18 4.19a1 1 0 0 1-1.42-1.42l4.19-4.18A8 8 0 0 1 10 2Zm0 2a6 6 0 1 0 3.88 10.69 1 1 0 0 1 .23-.23A6 6 0 0 0 10 4Z"/>
			</svg>
	</button>
	</div>
</div>
</nav>

<div id="searchtop"  class="search-bg"  style="display:none">
		<div class="fix-menu" style="padding:0px">
			<!-- tim kiem -->
			<div class="smartkid-ajax-search">
			<form method="get" action="<?php bloginfo('url'); ?>" autocomplete="off">
			<div class="search-mau" style="display:flex">
			<div class="searchbg input-wrapper">
			<input id="searchbox" placeholder="<?php _e('Nhập từ khoá tìm kiếm', 'smartkid'); ?>" type="text" name="s"  onkeyup="smartkidsearch()">
			<label for="stuff" class="fas fa-search input-land-icon"></label>
			</div>
			 <span id="close-search" title="<?php _e('Đóng tìm kiếm', 'smartkid'); ?>" type="submit" onclick="share(event, 'searchtop')"><i class="fa-solid fa-xmark"></i></span>
			</div>
			</form>
			<div style="display:none" id="smartkid-ajax-get">
			</div>
			</div>
		</div>
	</div>

<?php  get_template_part( 'template-parts/menu/top-menu-mobile'); ?>	
</header>

