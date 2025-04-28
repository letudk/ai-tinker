<div class="chan">
<?php if ( is_active_sidebar('sidebar-2') ) { ?>
<?php dynamic_sidebar( 'sidebar-2' ); ?>
<?php } ?>

<div class="smartkid">
<footer style="background-color: #f9f9f9; padding: 20px 0; border-top: 1px solid #e6e6e6;">
  <div style="max-width: 1200px; margin: auto; display: flex; justify-content: center; align-items: center; flex-wrap: wrap; color: #333;">
    <!-- Logo and Links -->
    <div style="flex: 1; min-width: 280px; margin-bottom: 20px;">
      <?php if (has_custom_logo()) {
        $logo_id = get_theme_mod('custom_logo'); // Lấy ID logo
        $logo = wp_get_attachment_image_src($logo_id, 'full'); // Lấy đường dẫn và kích thước

        if ($logo) {
            $logo_url = esc_url($logo[0]);
            $logo_width = esc_attr($logo[1]);
            $logo_height = esc_attr($logo[2]);

            echo '<a href="' . esc_url(home_url('/')) . '" class="custom-logo-link">';
            echo '<img title="Tải Tranh Tô Màu Cho Bé Miễn Phí" src="' . $logo_url . '" width="300" height="auto" alt="' . get_bloginfo('name') . '">';
            echo '</a>';
        }
} ?>
      <?php
				wp_nav_menu(
					array(
						'theme_location' => 'menu-2',
						'menu_id'        => 'wp-menu2',
						'menu_class'	=> 'wp-menu2',
					)
				);
?>
    </div>

</footer>

</div>
</div>