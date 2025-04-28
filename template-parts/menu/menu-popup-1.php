<div id="menu-popup-1" class="menu-popup-1">
<div class="list-menu-popup-1">
<button title="Menu" id="button-menu-popup-1" onclick="share(event, 'menu-popup-1')"><i class="fa-solid fa-xmark"></i> <?php _e('Đóng', 'smartkid'); ?></button>
	<?php
				wp_nav_menu(
					array(
						'theme_location' => 'menu-1',
						'menu_id'        => 'wp-menu-popup1',
						'menu_class'	=> 'wp-menu-popup1',
					)
				);
	?>
</div>
</div>
