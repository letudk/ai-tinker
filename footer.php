<?php
/**
 * footer
 *
 */
	global $adsense_options;
	if(isset($adsense_options['enable'])) {
	echo '<div class="sense1">'.smartkid_add_adsense_widget_sense1().'</div>'; 
	echo '<div class="sense2">'.smartkid_add_adsense_widget_sense2().'</div>'; 
	}
?>
<footer>
<?php 
global $smartkid_options;

get_template_part( 'template-parts/footer-1', get_post_type() );   ?>
<button id="backtop" onclick="scrollBackToTop()" title="<?php _e('Lên đầu trang', 'smartkid'); ?>"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
  <path d="M12 4l-8 8h16z"/>
</svg>
</button>
</footer>
<?php wp_footer(); ?> 
</body>
</html>




