<!-- menutocbot -->
<?php
global $smartkid_options;
// kiem tra bai viet co the h khong
if (smartkid_has_heading(get_the_content())) { 
if(isset($smartkid_options['set3']) && (isset($smartkid_options['set31']) && $smartkid_options['set31'] == 'Post')){
	$classtoc = 'post-tocbot';
	$titletoc = '<div class="flex-tocbot"><div class="title-tocbot"><i class="fa-regular fa-table-list" style="margin-right:7px;"></i> '. __('DANH MỤC BÀI VIẾT', 'smartkid') .'</div><div><button title="'. __('Ẩn hiện mục lục', 'smartkid') .'" onclick="share(event, &#39;toc&#39;)"><i class="fa-regular fa-arrows-to-dotted-line"></i></button></div></div>';
	$maintoc = 'main-tocbot';
} else {
	$classtoc = $titletoc = $maintoc = null;
}
?>
<div class="box-card box-cardmobile <?php echo $classtoc;  ?>">
			<div class="nenmodal" id="nenmodal-1">
			<div class="nenmodal2"></div>
			<div class="ndmodal">
			<div class="closemodal"><button onclick="momodal('nenmodal-1')"><i class="fa-solid fa-xmark"></i></button></div>
			<div class="menutocbot main-tocbot">
			<?php echo $titletoc;  ?>
			<aside class="toc" id="toc"></aside>
			</div>
			</div>
			</div>
</div>
<!-- nut tocbot mobile -->
<button id="nuttocbot" title="<?php _e('Tóm tắt', 'smartkid'); ?>" onclick="momodal('nenmodal-1')"><i class="fa-solid fa-bars-staggered"></i></button>
<!-- menutocbot -->
<?php } ?>