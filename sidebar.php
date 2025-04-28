<?php
/*
 * thanh bên
 */
?> 
<?php if ( is_active_sidebar('sidebar-4') && !is_single() && !is_page()) { ?>
<div>
<?php dynamic_sidebar( 'sidebar-4' ); ?>
</div>
<?php } ?>
<?php
global $adsense_options;
if(isset($adsense_options['enable'])) {
echo smartkid_add_adsense_widget_right();
}
?> 
<?php if (is_active_sidebar( 'sidebar-1' )) { ?>
<div>
<?php dynamic_sidebar( 'sidebar-1' ); ?>
</div>
<?php } ?>

