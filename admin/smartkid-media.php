<?php
function smartkid_media_options_page() {
	global $media_options;
	$media_options = get_option('media_settings', array());

	ob_start(); ?>
	<div class="wrap smartkid-admin admin-main">
		<h2 class="admin-h2"><?php _e('SMARTKID MEDIA', 'smartkid'); ?></h2>
		<?php if( isset($_GET['settings-updated']) ) { ?>
		<div id="message" class="admin-updated">
			<p><strong><?php _e('Đã lưu cài đặt.', 'smartkid') ?></strong></p>
		</div>
		<?php } ?>
		<form method="post" action="options.php">
		<?php settings_fields('media_settings_group'); ?>   
		<div class="admin-card">
                <div class="admin-cm"><?php _e('Tùy chọn chức năng media của theme', 'smartkid'); ?></div>
				
				<label class="toggle-switch">
				<input type="checkbox" name="media_settings[setting_crop_image]" value="1" <?php if (isset($media_options['setting_crop_image']) && 1 == $media_options['setting_crop_image']) echo 'checked="checked"'; ?> />
                <span class="slider"></span></label>
				<label class="admin-label-right"><?php _e('Bật chặn cắt hình ảnh khi tải lên', 'smartkid'); ?></label>
				<p class="admin-pb-note"><i class="fa-regular fa-lightbulb-on"></i> <?php _e('smartkid theme chỉ sử dụng một định dạng hình ảnh (góc) để hiển thị, bạn có thể bật chức năng này lên nếu muốn hình ảnh tải lên không bị cắt thành nhiều kích thước thu nhỏ.', 'smartkid'); ?></p>
				
				<label class="toggle-switch">
				<input type="checkbox" name="media_settings[setting_limited_image_upload]" value="1" <?php if (isset($media_options['setting_limited_image_upload']) && 1 == $media_options['setting_limited_image_upload']) echo 'checked="checked"'; ?> />
                <span class="slider"></span></label>
				<label class="admin-label-right"><?php _e('Giới hạn kích thước file tải lên', 'smartkid'); ?></label>
				<br>
				<br>
				<input id="admin-input-size" placeholder="1500" name="media_settings[setting_limited_image_upload1]" type="number" value="<?php if(!empty($media_options['setting_limited_image_upload1'])){echo $media_options['setting_limited_image_upload1'];} ?>"/>
    		    <label class="admin-label-right"><?php _e('KB', 'smartkid'); ?></label>
				<p class="admin-pb-note"><i class="fa-regular fa-lightbulb-on"></i> <?php _e('Bạn có thể giới hạn kích thước file tải lên bằng cách bật và gõ kích thước giới hạn vào ô bên trên.', 'smartkid'); ?></p>
				
				<label class="toggle-switch">
				<input type="checkbox" name="media_settings[setting_rm_image_post]" value="1" <?php if (isset($media_options['setting_rm_image_post']) && 1 == $media_options['setting_rm_image_post']) echo 'checked="checked"'; ?> />
                <span class="slider"></span></label>
				<label class="admin-label-right"><?php _e('Bật xóa bài viết xóa luôn hình ảnh', 'smartkid'); ?></label>
				<p class="admin-pb-note"><i class="fa-regular fa-lightbulb-on"></i> <?php _e('Chức năng này cho phép bạn xóa bài viết thì hình ảnh đính kèm trong bài viết cũng bị xóa luôn (chú ý nếu các bài viết có dùng chung một hình ảnh cũng sẽ bị mất hình khi xóa).', 'smartkid'); ?></p>
				
				<label class="toggle-switch">
				<input type="checkbox" name="media_settings[setting_center_image]" value="1" <?php if (isset($media_options['setting_center_image']) && 1 == $media_options['setting_center_image']) echo 'checked="checked"'; ?> />
                <span class="slider"></span></label>
				<label class="admin-label-right"><?php _e('Căn giữa tất cả hình ảnh trong bài viết', 'smartkid'); ?></label>
				<p class="admin-pb-note"><i class="fa-regular fa-lightbulb-on"></i> <?php _e('Tất cả hình ảnh trong bài viết sẽ được căn giữa.', 'smartkid'); ?></p>
				
				<label class="toggle-switch">
				<input type="checkbox" name="media_settings[setting_watermark]" value="1" <?php if (isset($media_options['setting_watermark']) && 1 == $media_options['setting_watermark']) echo 'checked="checked"'; ?> />
                <span class="slider"></span></label>
				<label class="admin-label-right"><?php _e('Thêm logo vào hình ảnh khi tải lên', 'smartkid'); ?></label>
				<div class="admin-cum">
				<p><input id="admin-out" name="media_settings[setting_watermark1]" type="text" value="<?php if(!empty($media_options['setting_watermark1'])){echo $media_options['setting_watermark1'];} ?>" placeholder="<?php _e('Thêm link logo hình ảnh vào đây', 'smartkid'); ?>" /></p>
				<p>
				<?php $styles = array('Center', 'Top Left', 'Top Right', 'Bottom Left', 'Bottom Right'); ?>
				<select name="media_settings[setting_watermark2]"> 
				<?php foreach($styles as $style) { ?> 
				<?php if($media_options['setting_watermark2'] == $style) { $selected = 'selected="selected"'; } else { $selected = ''; } ?>
				<option value="<?php echo $style; ?>" <?php echo $selected; ?>><?php echo $style; ?></option> 
				<?php } ?> 
				</select>
				</p>
				<p class="admin-pb-note"><i class="fa-regular fa-lightbulb-on"></i> <?php _e('Bật chức năng này nếu bạn muốn đóng dấu hình ảnh của mình bằng logo hình ảnh của bạn', 'smartkid'); ?></p>
				</div>
				
				<label class="toggle-switch">
				<input type="checkbox" name="media_settings[setting_save_image_another]" value="1" <?php if (isset($media_options['setting_save_image_another']) && 1 == $media_options['setting_save_image_another']) echo 'checked="checked"'; ?> />
                <span class="slider"></span></label>
				<label class="admin-label-right"><?php _e('Lưu lại hình ảnh vào media khi copy từ nguồn khác', 'smartkid'); ?></label>
				<p class="admin-pb-note"><i class="fa-regular fa-lightbulb-on"></i> <?php _e('Bật chức năng này nếu bạn muốn hình ảnh ở bài viết khi copy từ nguồn khác sẽ được lưu trữ vào website của bạn', 'smartkid'); ?></p>
				
				
				<label class="toggle-switch">
				<input type="checkbox" name="media_settings[setting_svg_upload]" value="1" <?php if (isset($media_options['setting_svg_upload']) && 1 == $media_options['setting_svg_upload']) echo 'checked="checked"'; ?> />
                <span class="slider"></span></label>
				<label class="admin-label-right"><?php _e('Cho phép tải lên file SVG', 'smartkid'); ?></label>
				<p class="admin-pb-note"><i class="fa-regular fa-lightbulb-on"></i> <?php _e('Bật chức năng này nếu bạn muốn hình ảnh định dạng SVG có thể tải lên media', 'smartkid'); ?></p>
				

					
		</div>
			    
		<div class="submit"><button id="admin-save" type="submit" class="button-primary"><i class="fa-regular fa-floppy-disk"></i> <?php _e('LƯU NỘI DUNG', 'smartkid'); ?></button></div>
		 <button title="<?php _e('LƯU NỘI DUNG', 'smartkid'); ?>" id="admin-save-fast" type="submit"><i class="fa-regular fa-floppy-disk"></i></button>
		</form>
	</div>
	<?php
	echo ob_get_clean();
}
function smartkid_media_add_options_link() {
	add_submenu_page ('smartkid-options', 'Media', '<i class="fa-regular fa-photo-film-music" style="width:20px"></i> Media', 'manage_options', 'media-options', 'smartkid_media_options_page');
}
add_action('admin_menu', 'smartkid_media_add_options_link');
function smartkid_media_register_settings() {
	register_setting('media_settings_group', 'media_settings');
}
add_action('admin_init', 'smartkid_media_register_settings');








































