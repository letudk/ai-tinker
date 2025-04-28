<div class="custom-menu-top">
<div class="fix-menu2 custom-menu-top-main">
	<?php
	 $menuParameters = array(
	 'theme_location' => 'menu-3',
	 'container'       => false,
	 'echo'            => false,
	 'items_wrap'      => '%3$s',
	 'depth'           => 0,
	 );
	 echo strip_tags(wp_nav_menu( $menuParameters ), '<a><i>' );
?>
</div>
</div>

