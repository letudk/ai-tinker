<div class="fix-menu-gb">
<div class="top-menu-mobile" id="top-menu-mobile">
<div  id="top-menu" class="fix-menu2">
	<?php
				wp_nav_menu(
					array(
						'theme_location' => 'menu-1',
						'menu_id'        => 'wptop-menu',
						'menu_class'	=> 'wptop-menu',
					)
				);
	?>
<?php global $smartkid_options; if (!empty($smartkid_options['mxh1']) || !empty($smartkid_options['mxh2']) || !empty($smartkid_options['mxh3']) || !empty($smartkid_options['mxh4']) || !empty($smartkid_options['mxh5']) || !empty($smartkid_options['mxh6'])){ ?>
<ul class="menu-mxh">
 <?php if (!empty($smartkid_options['mxh1'])) { ?><li><a target="_blank" rel="nofollow" class="mxh-fb" title="Facebook" href="https://facebook.com/<?php echo $smartkid_options['mxh1']; ?>"><i class="fa-brands fa-facebook"></i></a></li><?php } ?>
 <?php if (!empty($smartkid_options['mxh2'])) { ?><li><a target="_blank" rel="nofollow" class="mxh-tw" title="Twitter" href="https://twitter.com/<?php echo $smartkid_options['mxh2']; ?>"><i class="fa-brands fa-x-twitter"></i></a></li><?php } ?>
 <?php if (!empty($smartkid_options['mxh3'])) { ?><li><a target="_blank" rel="nofollow" class="mxh-pr" title="Pinterest" href="https://pinterest.com/<?php echo $smartkid_options['mxh3']; ?>"><i class="fa-brands fa-pinterest"></i></a></li><?php } ?>
 <?php if (!empty($smartkid_options['mxh4'])) { ?><li><a target="_blank" rel="nofollow" class="mxh-yt" title="Youtube" href="https://youtube.com/<?php echo $smartkid_options['mxh4']; ?>"><i class="fa-brands fa-youtube"></i></a></li><?php } ?>
 <?php if (!empty($smartkid_options['mxh5'])) { ?><li><a target="_blank" rel="nofollow" class="mxh-tt" title="Tiktok" href="https://tiktok.com/@<?php echo $smartkid_options['mxh5']; ?>"><i class="fa-brands fa-tiktok"></i></a></li><?php } ?>
 <?php if (!empty($smartkid_options['mxh6'])) { ?><li><a target="_blank" rel="nofollow" class="mxh-it" title="Instagram" href="https://instagram.com/<?php echo $smartkid_options['mxh6']; ?>"><i class="fa-brands fa-instagram"></i></a></li><?php } ?>
</ul>
<?php } ?>
<div style="clear: both;"></div>
</div>
</div>
</div>