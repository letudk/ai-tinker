<?php
// kiểm tra
function smartkid_options_page() {
    global $smartkid_options;

	$theme = wp_get_theme();
	define('THEME_VERSION', $theme->Version); 
	ob_start(); ?> 
	<div class="wrap admin-main">
	    <div class="admin-menutop">
		<h2 class="admin-h2 admin-h2-img" style="color:#fff;">CÀI ĐẶT SMARTKIDS </h2>
		<div class="admin-menutab">
		<button class="ranktab rank-admin rank-ac" title="<?php _e('TỐI ƯU', 'smartkid'); ?>" onclick="openrank(event, 'rankone')"><i class="fa-regular fa-gauge-max"></i> <?php _e('TỐI ƯU', 'smartkid'); ?></button>
		<button class="ranktab rank-admin" title="<?php _e('CHỨC NĂNG', 'smartkid'); ?>" onclick="openrank(event, 'rankthere')"><i class="fa-regular fa-gear"></i> <?php _e('CHỨC NĂNG', 'smartkid'); ?></button>
		<button class="ranktab rank-admin" title="<?php _e('HIỂN THỊ', 'smartkid'); ?>" onclick="openrank(event, 'rankfour')"><i class="fa-regular fa-brush"></i> <?php _e('HIỂN THỊ', 'smartkid'); ?></button>
		<button class="ranktab rank-admin" title="<?php _e('NỘI DUNG', 'smartkid'); ?>" onclick="openrank(event, 'rankfive')"><i class="fa-regular fa-kerning"></i> <?php _e('NỘI DUNG', 'smartkid'); ?></button>
		
		</div>
		</div>
		<?php if( isset($_GET['settings-updated']) ) { ?>
		<div id="message" class="admin-updated">
			<p><strong><?php _e('Đã lưu cài đặt.', 'smartkid') ?></strong></p>
		</div>
		<?php } ?>
		<form method="post" action="options.php">
			<?php settings_fields('smartkid_settings_group'); ?>
			
			<div class="rank-box rank" id="rankone">
			<!-- FORM TỐI ƯU -->
			<h4 class="admin-h4" id="admin1"><i class="fa-regular fa-gauge-max"></i> <?php _e('Cài đặt tối ưu hoá', 'smartkid'); ?></h4>
		    <div class="admin-card">
                <div> 
    		        <div class="admin-cm"><i class="fa-regular fa-gauge-high"></i> <?php _e('Tối ưu hoá điểm (90 > 100) PageSpeed', 'smartkid'); ?></div>
					<p class="admin-on">
					<label class="toggle-switch">
    		        <input type="checkbox" name="smartkid_settings[speed1]" value="1" <?php if (isset($smartkid_options['speed1']) && 1 == $smartkid_options['speed1']) echo 'checked="checked"'; ?> />
					<span class="slider"></span></label>
                    <label><?php _e('Bật tính năng tối ưu hoá smartkid theme (Beta)', 'smartkid'); ?></label>
					</p>
                    <div> </div>
                    <p class="admin-pr-note" ><i class="fa-regular fa-triangle-exclamation"></i>
                    <?php _e('Nếu bạn muốn sử dụng các plugin tối ưu website vui lòng tắt chức năng này đi để tránh xung đột lỗi Website.', 'smartkid'); ?> 
                    </p>
                    <div class="admin-cum">
						<label class="toggle-switch">
                        <input type="checkbox" name="smartkid_settings[speed2]" value="1" <?php if ( isset($smartkid_options['speed2']) && 1 == $smartkid_options['speed2'] ) echo 'checked="checked"'; ?> />
						<span class="slider"></span></label>
                        <label class="admin-label-right"><?php _e('Bật tải ảnh lười biếng', 'smartkid'); ?></label>
                        <p class="admin-pg-note"><i class="fa-regular fa-lightbulb-on"></i> <?php _e('Tải ảnh lười biếng sẽ giúp tối ưu hoá tốc độ tải trang cho website.', 'smartkid'); ?></p>
						<label class="toggle-switch">
                        <input type="checkbox" name="smartkid_settings[speed3]" value="1" <?php if ( isset($smartkid_options['speed3']) && 1 == $smartkid_options['speed3'] ) echo 'checked="checked"'; ?> />
						<span class="slider"></span></label>
                        <label class="admin-label-right"><?php _e('Bật tải chậm các file js', 'smartkid'); ?></label>
                        <p class="admin-pg-note"><i class="fa-regular fa-lightbulb-on"></i> <?php _e('Các file js là tài nguyên chặn hiển thị khiến cho trình duyệt phân tích trang web lâu hơn.', 'smartkid'); ?></p>
						<label class="toggle-switch">
                        <input type="checkbox" name="smartkid_settings[speed4]" value="1" <?php if ( isset($smartkid_options['speed4']) && 1 == $smartkid_options['speed4'] ) echo 'checked="checked"'; ?> />
						<span class="slider"></span></label>
                        <label class="admin-label-right"><?php _e('Bật tải Font Awesome lười biếng', 'smartkid'); ?></label>
                        <p class="admin-pg-note"><i class="fa-regular fa-lightbulb-on"></i> <?php _e('Tải Font Awesome lười biếng sẽ giúp tối ưu hoá tốc độ tải trang cho website <span style="color:#ff4444">(chức năng này chỉ hoạt động khi bạn bật chức năng tải chậm file js)</span>.', 'smartkid'); ?></p>
                    </div>
					<div class="admin-cm"><?php _e('Tùy chọn nâng cao', 'smartkid'); ?></div>
					<div class="admin-cum">
						<label class="toggle-switch">
                        <input type="checkbox" name="smartkid_settings[speed5]" value="1" <?php if ( isset($smartkid_options['speed5']) && 1 == $smartkid_options['speed5'] ) echo 'checked="checked"'; ?> />
						<span class="slider"></span></label>
                        <label class="admin-label-right"><?php _e('Tạo lưu trữ cache trên trình duyệt', 'smartkid'); ?></label>
                        <p class="admin-pg-note"><i class="fa-regular fa-lightbulb-on"></i> <?php _e('Trình duyệt sẽ lưu trữ các file tĩnh từ trang web của bạn, và tái sử dụng ở những lần truy cập sau.', 'smartkid'); ?></p>
						
						<label class="toggle-switch">
                        <input type="checkbox" name="smartkid_settings[speed6]" value="1" <?php if ( isset($smartkid_options['speed6']) && 1 == $smartkid_options['speed6'] ) echo 'checked="checked"'; ?> />
						<span class="slider"></span></label>
                        <label class="admin-label-right"><?php _e('Chức năng instant click', 'smartkid'); ?></label>
                        <p class="admin-pg-note"><i class="fa-regular fa-lightbulb-on"></i> <?php _e('Đây là một thư viện hữu ích giúp cho tải trước nội dung khi đưa chuột lướt qua liên kết.', 'smartkid'); ?></p>
						
						<label class="toggle-switch">
                        <input type="checkbox" name="smartkid_settings[speed7]" value="1" <?php if ( isset($smartkid_options['speed7']) && 1 == $smartkid_options['speed7'] ) echo 'checked="checked"'; ?> />
						<span class="slider"></span></label>
                        <label class="admin-label-right"><?php _e('Minify nén CSS & JS', 'smartkid'); ?></label>
                        <p class="admin-pg-note"><i class="fa-regular fa-lightbulb-on"></i> <?php _e('Bật chức năng này nếu bạn muốn tất cả các file CSS & JS sẽ được nén lại theo chuẩn minify và được đặt trong thư mục minify của smartkidtheme', 'smartkid'); ?><br>
						<i style="color:#ff4444"><?php _e('Chú ý: Thư mục minify trong thư mục theme phải được cấp quyền đọc ghi nếu không nó sẽ lỗi.', 'smartkid'); ?></i>
						</p>

                    </div>
				
					
					<div class="admin-cm"><i class="fa-regular fa-file-zipper"></i> <?php _e('Nén HTML khi hiển thị', 'smartkid'); ?></div>
						<p class="admin-on">
						<label class="toggle-switch">
						<input type="checkbox" name="smartkid_settings[speedzip1]" value="1" <?php if ( isset($smartkid_options['speedzip1']) && 1 == $smartkid_options['speedzip1'] ) echo 'checked="checked"'; ?> />
						<span class="slider"></span></label>
						<label class="admin-label-right"><?php _e('Nén code HTML thành 1 dòng', 'smartkid'); ?></label>
						</p>
						<p class="admin-pg-note"><i class="fa-regular fa-lightbulb-on"></i>
						<?php _e('Với chức năng này HTML khi hiển thị sẽ được nén thành 1 dòng, loại bỏ các ký tự và khoảng trống không cần thiết tăng tốc độ tải trang.', 'smartkid'); ?><br>
						<i style="color:#ff4444"><?php _e('Chú ý: Chú ý chức năng này sẽ làm tăng RAM và CPU của sever mỗi lần hoạt động.', 'smartkid'); ?></i>
						</p>
					
					
					<div class="admin-cm"><i class="fa-regular fa-trash"></i> <?php _e('Tắt những thứ không cần', 'smartkid'); ?></div>
						<p class="admin-on">
						<label class="toggle-switch">
						<input type="checkbox" name="smartkid_settings[speedoff]" value="1" <?php if ( isset($smartkid_options['speedoff']) && 1 == $smartkid_options['speedoff'] ) echo 'checked="checked"'; ?> />
						<span class="slider"></span></label>
						
						<label class="admin-label-right"><?php _e('Tắt jQuery Migrate', 'smartkid'); ?></label>
						</p>
						<p class="admin-pg-note"><i class="fa-regular fa-lightbulb-on"></i>
						<?php _e('jQuery Migrate là một thư viện dùng để duy trì hoạt động của một số theme, plugin đang sử dụng các mã cũ, nếu website của bạn không còn sử dụng đến thư viện này thì bạn có thể tắt đi.', 'smartkid'); ?>
						</p>
						
						<p class="admin-on">
						<label class="toggle-switch">
						<input type="checkbox" name="smartkid_settings[speedoff1]" value="1" <?php if ( isset($smartkid_options['speedoff1']) && 1 == $smartkid_options['speedoff1'] ) echo 'checked="checked"'; ?> />
						<span class="slider"></span></label>
						<label class="admin-label-right"><?php _e('Tắt Gutenberg CSS trang chủ', 'smartkid'); ?></label>
						</p>
						<p class="admin-pg-note"><i class="fa-regular fa-lightbulb-on"></i>
						<?php _e('Nếu bạn không sử dụng đến có thể Gutenberg CSS trang chủ đi.', 'smartkid'); ?><br>
						<i style="color:#ff4444"><?php _e('Chú ý: Tắt đi có thể dẫn tới lỗi giao diện hiển thị khi bạn có sử dụng CSS từ nó.', 'smartkid'); ?></i>
						</p>
						
						<p class="admin-on">
						<label class="toggle-switch">
						<input type="checkbox" name="smartkid_settings[speedoff2]" value="1" <?php if ( isset($smartkid_options['speedoff2']) && 1 == $smartkid_options['speedoff2'] ) echo 'checked="checked"'; ?> />
						<span class="slider"></span></label>
						<label class="admin-label-right"><?php _e('Tắt Classic CSS trang chủ', 'smartkid'); ?></label>
						</p>
						<p class="admin-pg-note"><i class="fa-regular fa-lightbulb-on"></i>
						<?php _e('Nếu bạn không sử dụng đến có thể Classic CSS trang chủ đi.', 'smartkid'); ?><br>
						<i style="color:#ff4444"><?php _e('Chú ý: Tắt đi có thể dẫn tới lỗi giao diện hiển thị khi bạn có sử dụng CSS từ nó.', 'smartkid'); ?></i>
						</p>
						
						<p class="admin-on">
						<label class="toggle-switch">
						<input type="checkbox" name="smartkid_settings[speedoff3]" value="1" <?php if ( isset($smartkid_options['speedoff3']) && 1 == $smartkid_options['speedoff3'] ) echo 'checked="checked"'; ?> />
						<span class="slider"></span></label>
						<label class="admin-label-right"><?php _e('Tắt Emoji', 'smartkid'); ?></label>
						</p>
						<p class="admin-pg-note"><i class="fa-regular fa-lightbulb-on"></i>
						<?php _e('Nếu bạn không sử dụng đến có thể Emoji đi.', 'smartkid'); ?><br>
						<i style="color:#ff4444"><?php _e('Chú ý: Tắt Emoji đi có thể dẫn tới lỗi giao diện hiển thị.', 'smartkid'); ?></i>
						</p>
						
						<div class="admin-cm"><i class="fa-regular fa-database"></i> <?php _e('Tối ưu lưu bài viết vào CSDL', 'smartkid'); ?></div>
						<p class="admin-on">
						<label class="toggle-switch">
						<input type="checkbox" name="smartkid_settings[speedcsdl1]" value="1" <?php if ( isset($smartkid_options['speedcsdl1']) && 1 == $smartkid_options['speedcsdl1'] ) echo 'checked="checked"'; ?> />
						<span class="slider"></span></label>
						<label class="admin-label-right"><?php _e('Bật giới hạn bản lưu', 'smartkid'); ?></label>
						</p>
						<p>
						<input id="admin-input-size" placeholder="3" name="smartkid_settings[speedcsdl11]" type="number" value="<?php if(!empty($smartkid_options['speedcsdl11'])){echo $smartkid_options['speedcsdl11'];} ?>"/>
    		            <label class="admin-label-right"><?php _e('Nhập số bản lưu', 'smartkid'); ?></label>
						</p>
						<p class="admin-pg-note"><i class="fa-regular fa-lightbulb-on"></i>
						<?php _e('Nếu bạn bật chức năng này và đặt giới hạn số bản lưu tự động của bài viết hoặc trang sẽ làm giảm được dự liệu được lưu vào CSDL.', 'smartkid'); ?>
						</p>
						
						<div class="admin-cm"><i class="fa-regular fa-trash"></i> <?php _e('Xóa để tối ưu CSDL', 'smartkid'); ?></div>
						<a class="delete-post-csdl" href="#" id="delete-revisions"><i class="fa-regular fa-trash"></i> <?php _e('Xóa bản lưu', 'smartkid'); ?></a>
						<a class="delete-post-csdl" href="#" id="delete-auto-drafts"><i class="fa-regular fa-trash"></i> <?php _e('Xóa lưu tự động', 'smartkid'); ?></a>
						<a class="delete-post-csdl" href="#" id="delete-all-trashed-posts"><i class="fa-regular fa-trash"></i> <?php _e('Xóa thùng rác', 'smartkid'); ?></a>
						<div id="del-result"></div>
						<script>
							jQuery(document).ready(function($) {
								// xoa revisions
								$('#delete-revisions').click(function(event) {
									event.preventDefault();
									$.ajax({
										url: '<?php echo admin_url('admin-ajax.php');?>',
										type: 'POST',
										data: {
											action: 'delete_revisions'
										},
										success: function(response) {
											$('#del-result').html('<span><?php _e('Đã xóa tất cả bản lưu', 'smartkid'); ?></span>');
										},
										error: function(response) {
											$('#del-result').html('<span><?php _e('Lỗi! Không thể xóa', 'smartkid'); ?></span>');
										}
									});
								});
								// xoa auto-drafts
								$('#delete-auto-drafts').click(function(event) {
									event.preventDefault();
									$.ajax({
										url: '<?php echo admin_url('admin-ajax.php');?>',
										type: 'POST',
										data: {
											action: 'delete_auto_drafts'
										},
										success: function(response) {
											$('#del-result').html('<span><?php _e('Đã xóa tất cả lưu tự động', 'smartkid'); ?></span>');
										},
										error: function(response) {
											$('#del-result').html('<span><?php _e('Lỗi! Không thể xóa', 'smartkid'); ?></span>');
										}
									});
								});
								// xoa tat ca trong thung rac
								$('#delete-all-trashed-posts').click(function(event) {
									event.preventDefault();
									$.ajax({
										url: '<?php echo admin_url('admin-ajax.php');?>',
										type: 'POST',
										data: {
											action: 'delete_all_trashed_posts'
										},
										success: function(response) {
											$('#del-result').html('<span><?php _e('Đã xóa tất cả trong thùng rác', 'smartkid'); ?></span>');
										},
										error: function(response) {
											$('#del-result').html('<span><?php _e('Lỗi! Không thể xóa', 'smartkid'); ?></span>');
										}
									});
								});
							});
						</script>
               </div>
            </div>
			</div>
			 
			
			<div class="rank-box rank" id="rankthere" style="display:none">
			<!-- FORM CHỨC NĂNG -->
			<h4 class="admin-h4" id="admin3"><i class="fa-regular fa-gear"></i> <?php _e(' Chức năng', 'smartkid'); ?></h4>
		    <div class="admin-card">
					<div class="admin-cm"><i class="fa-regular fa-bars"></i> <?php _e('Chức năng bổ sung cho website', 'smartkid'); ?></div>
					<label class="toggle-switch">
                    <input type="checkbox" name="smartkid_settings[web1]" value="1" <?php if ( isset($smartkid_options['web1']) && 1 == $smartkid_options['web1'] ) echo 'checked="checked"'; ?> />
                    <span class="slider"></span></label>
					 
					
					<label class="toggle-switch">
					<input type="checkbox" name="smartkid_settings[web2]" value="1" <?php if ( isset($smartkid_options['web2']) && 1 == $smartkid_options['web2'] ) echo 'checked="checked"'; ?> />
                    <span class="slider"></span></label>
					<label class="admin-label-right"><?php _e('Bật thông báo Cookie', 'smartkid'); ?></label>
                    <p class="admin-pb-note"><i class="fa-regular fa-lightbulb-on"></i> <?php _e('Thông báo Cookie giúp cho website của bạn tuân thủ đầy đủ các quy tắc của Google khi hoạt động trên môi trường tìm kiếm số.', 'smartkid'); ?></p>
					
					<label class="toggle-switch">
					<input type="checkbox" name="smartkid_settings[web3]" value="1" <?php if ( isset($smartkid_options['web3']) && 1 == $smartkid_options['web3'] ) echo 'checked="checked"'; ?> />
                    <span class="slider"></span></label>
					<label class="admin-label-right"><?php _e('Bật thanh báo cuộn trang', 'smartkid'); ?></label>
                    <p class="admin-pb-note"><i class="fa-regular fa-lightbulb-on"></i> <?php _e('Sẽ có một thanh ở trên cùng cho bạn biết vị trí cuộn trang của trang web.', 'smartkid'); ?></p>
					
					<label class="toggle-switch">
					<input type="checkbox" name="smartkid_settings[web4]" value="1" <?php if ( isset($smartkid_options['web4']) && 1 == $smartkid_options['web4'] ) echo 'checked="checked"'; ?> />
                    <span class="slider"></span></label>
					<label class="admin-label-right"><?php _e('Cấm Copy nội dung trên trang', 'smartkid'); ?></label>
                    <p class="admin-pb-note"><i class="fa-regular fa-lightbulb-on"></i> <?php _e('Bật chức năng này nếu bạn muốn người dùng không thể copy nội dung trang web của bạn.', 'smartkid'); ?></p>
					
					
					<label class="toggle-switch">
					<input type="checkbox" name="smartkid_settings[web5]" value="1" <?php if ( isset($smartkid_options['web5']) && 1 == $smartkid_options['web5'] ) echo 'checked="checked"'; ?> />
                    <span class="slider"></span></label>
					<label class="admin-label-right"><?php _e('Hiển thị popup bài viết ngẫu nhiên', 'smartkid'); ?></label>
					<div class="admin-cum">
					 
                 
					<p class="admin-pb-note"><i class="fa-regular fa-lightbulb-on"></i> <?php _e('Chọn vị trí hiển thị popup', 'smartkid'); ?></p>
					
					<label class="toggle-switch">
					<input type="checkbox" name="smartkid_settings[web6]" value="1" <?php if ( isset($smartkid_options['web6']) && 1 == $smartkid_options['web6'] ) echo 'checked="checked"'; ?> />
                    <span class="slider"></span></label>
					<label class="admin-label-right"><?php _e('Bài viết cập nhật sẽ được hiển thị trên cùng', 'smartkid'); ?></label>
                    <p class="admin-pb-note"><i class="fa-regular fa-lightbulb-on"></i> <?php _e('Bật chức năng sẽ giúp những bài viết sau khi được cập nhật sẽ được hiển thị trên cùng trong vòng lập chính.', 'smartkid'); ?></p>
					
					</div>
			</div>
			<div class="admin-card">
                    <div class="admin-cm"><i class="fa-regular fa-note-sticky"></i> <?php _e('Chức năng trong bài viết', 'smartkid'); ?></div>
                    <label class="toggle-switch">
					<input type="checkbox" name="smartkid_settings[set1]" value="1" <?php if ( isset($smartkid_options['set1']) && 1 == $smartkid_options['set1'] ) echo 'checked="checked"'; ?> />
                    <span class="slider"></span></label>
					<label class="admin-label-right"><?php _e('Bật hình đại diện trong bài viết', 'smartkid'); ?></label>
                    <p class="admin-pb-note"><i class="fa-regular fa-lightbulb-on"></i> <?php _e('Nếu bạn kích chọn chức năng này, ở trong bài viết sẽ xuất hiện thêm hình đại diện.', 'smartkid'); ?></p>
					<label class="toggle-switch">
                    <input type="checkbox" name="smartkid_settings[set2]" value="1" <?php if ( isset($smartkid_options['set2']) && 1 == $smartkid_options['set2'] ) echo 'checked="checked"'; ?> />
                    <span class="slider"></span></label>
					<label class="admin-label-right"><?php _e('Bật zoom hình ảnh và văn bản', 'smartkid'); ?></label>
                    <p class="admin-pb-note"><i class="fa-regular fa-lightbulb-on"></i> <?php _e('Nếu bạn muốn có thêm chức năng zoom hình ảnh và văn bản trong bài viết hãy bật chức năng này.', 'smartkid'); ?></p>
                    <label class="toggle-switch">
					<input type="checkbox" name="smartkid_settings[set3]" value="1" <?php if ( isset($smartkid_options['set3']) && 1 == $smartkid_options['set3'] ) echo 'checked="checked"'; ?> />
                    <span class="slider"></span></label>
					<label class="admin-label-right"><?php _e('Bật mục lục cho bài viết', 'smartkid'); ?></label>
					<div class="admin-cum">
					<p>
				 
                    <p class="admin-pb-note"><i class="fa-regular fa-lightbulb-on"></i> <?php _e('Đây là chức năng tạo mục lục cho bài viết, khi bạn sử dụng các thẻ h trong bài.', 'smartkid'); ?></p>
					</div>
					<label class="toggle-switch">
                    <input type="checkbox" name="smartkid_settings[set4]" value="1" <?php if ( isset($smartkid_options['set4']) && 1 == $smartkid_options['set4'] ) echo 'checked="checked"'; ?> />
                    <span class="slider"></span></label>
					<label class="admin-label-right"><?php _e('Bật code màu nổi bật', 'smartkid'); ?></label>
					<div class="admin-cum"> 
                    <p class="admin-pb-note"><i class="fa-regular fa-lightbulb-on"></i> <?php _e('Khi bạn chia sẻ code PHP, HTML, CSS trong bài viết, chức năng này sẽ làm code nổi bật nhờ vào việc thêm màu sắc cho code.', 'smartkid'); ?></p>
					</div>
                    <label class="toggle-switch">
					<input type="checkbox" name="smartkid_settings[set5]" value="1" <?php if ( isset($smartkid_options['set5']) && 1 == $smartkid_options['set5'] ) echo 'checked="checked"'; ?> />
                    <span class="slider"></span></label>
					 
					<label class="toggle-switch">
                    <input type="checkbox" name="smartkid_settings[set6]" value="1" <?php if ( isset($smartkid_options['set6']) && 1 == $smartkid_options['set6'] ) echo 'checked="checked"'; ?> />
                    <span class="slider"></span></label>
					<label class="admin-label-right"><?php _e('Bật trình soạn thảo cổ điển trong bài viết', 'smartkid'); ?></label>
                    <p class="admin-pb-note"><i class="fa-regular fa-lightbulb-on"></i> <?php _e('Nếu bạn kích chọn chức năng này, Trình soạn thảo sẽ được thay bằng Editor Classic.', 'smartkid'); ?></p>
                    <label class="toggle-switch">
					<input type="checkbox" name="smartkid_settings[set7]" value="1" <?php if ( isset($smartkid_options['set7']) && 1 == $smartkid_options['set7'] ) echo 'checked="checked"'; ?> />
                    <span class="slider"></span></label>
					<label class="admin-label-right"><?php _e('Bật tính năng thêm download trong bài viết', 'smartkid'); ?></label>
					<div class="admin-cum">
					<p>
					<input placeholder="<?php _e('Nhập số giây', 'smartkid'); ?>" style="width:140px;height:40px" name="smartkid_settings[set71]" type="number" value="<?php if(!empty($smartkid_options['set71'])){echo $smartkid_options['set71'];} ?>"/>
					</p>
                    <p class="admin-pb-note"><i class="fa-regular fa-lightbulb-on"></i> <?php _e('Nếu bạn kích chọn chức năng này, ở trong trình soạn thảo bài viết sẽ có thêm box nhập link download và có thể sử dụng shortcode download', 'smartkid'); ?></p>
					 
					</div>
					
					 
                    <p class="admin-pb-note"><i class="fa-regular fa-lightbulb-on"></i> <?php _e('Chọn kiểu hiển thị của thẻ H trong bài viết.', 'smartkid'); ?></p>
					
					<label class="toggle-switch">
					<input type="checkbox" name="smartkid_settings[set9]" value="1" <?php if ( isset($smartkid_options['set9']) && 1 == $smartkid_options['set9'] ) echo 'checked="checked"'; ?> />
                    <span class="slider"></span></label>
					<label class="admin-label-right"><?php _e('Thay đổi khoảng cách dòng hiển thị ở bài viết', 'smartkid'); ?></label>
					<div class="admin-cum">
					<p>
					<input step="0.1" placeholder="<?php _e('Khoảng cách', 'smartkid'); ?>" style="width:140px;height:40px" name="smartkid_settings[set91]" type="number" value="<?php if(!empty($smartkid_options['set91'])){echo $smartkid_options['set91'];} ?>"/>
					</p>
					<p class="admin-pb-note"><i class="fa-regular fa-lightbulb-on"></i> <?php _e('Nhập khoảng cách dòng bạn muốn hiển thị ở bài viết khi đọc (dòng càng lớn càng dễ đọc, kích thước khuyến nghị từ 2 đến 3).', 'smartkid'); ?></p>
					</div>
			</div>
			
			<div class="admin-card">
                    <div class="admin-cm"><i class="fa-regular fa-gear"></i> <?php _e('Chức năng thêm', 'smartkid'); ?></div>
                    <label class="toggle-switch">
					<input type="checkbox" name="smartkid_settings[other1]" value="1" <?php if ( isset($smartkid_options['other1']) && 1 == $smartkid_options['other1'] ) echo 'checked="checked"'; ?> />
					<span class="slider"></span></label>
                    <label class="admin-label-right"><?php _e('Bật vị trí widget bổ sung', 'smartkid'); ?></label>
                    <p class="admin-pb-note"><i class="fa-regular fa-lightbulb-on"></i> <?php _e('Thêm vị trí widget để buid giao thêm diện.', 'smartkid'); ?></p>
					
                    <label class="toggle-switch">
					<input type="checkbox" name="smartkid_settings[other2]" value="1" <?php if ( isset($smartkid_options['other2']) && 1 == $smartkid_options['other2'] ) echo 'checked="checked"'; ?> />
					<span class="slider"></span></label>
                    <label class="admin-label-right"><?php _e('Bật hiển thị bộ widget bổ sung', 'smartkid'); ?></label>
                    <p class="admin-pb-note"><i class="fa-regular fa-lightbulb-on"></i> <?php _e('Thêm bộ widget bổ sung với nhiều tính năng hữu ích.', 'smartkid'); ?></p>
					
					<label class="toggle-switch">
					<input type="checkbox" name="smartkid_settings[other3]" value="1" <?php if ( isset($smartkid_options['other3']) && 1 == $smartkid_options['other3'] ) echo 'checked="checked"'; ?> />
					<span class="slider"></span></label>
                    <label class="admin-label-right"><?php _e('Bật hiển thị bổ sung menu top', 'smartkid'); ?></label>
                    <p class="admin-pb-note"><i class="fa-regular fa-lightbulb-on"></i> <?php _e('Nếu bạn muốn thêm một menu ở trên cùng thì hãy bật chức năng này.', 'smartkid'); ?></p>
			</div>
			

			</div>
			
			<div class="rank-box rank" id="rankfour" style="display:none">
			<!-- FORM HIỂN THỊ -->
            <h4 class="admin-h4" id="admin4"><i class="fa-regular fa-brush"></i> <?php _e(' Cài đặt hiển thị', 'smartkid'); ?></h4>
		    <div class="admin-card">
			
			    <div class="admin-nd">     
                    <div class="admin-cm"><i class="fa-regular fa-house"></i> <?php _e('Cài đặt trang chủ', 'smartkid'); ?></div>
					<label class="toggle-switch">
					<input type="checkbox" name="smartkid_settings[index1]" value="1" <?php if ( isset($smartkid_options['index1']) && 1 == $smartkid_options['index1'] ) echo 'checked="checked"'; ?> />
					<span class="slider"></span></label>
                    <label class="admin-label-right"><?php _e('Ẩn bài viết khỏi trang chủ', 'smartkid'); ?></label>
					<p class="admin-pb-note"><i class="fa-regular fa-lightbulb-on"></i> <?php _e('Nếu bạn tích chọn chức năng này, bài viết chính hiển thị ở trang chủ sẽ không hiển thị.', 'smartkid'); ?></p>
				</div> 
                
                <div class="admin-nd">     
                    <div class="admin-cm"><i class="fa-regular fa-text-size"></i> <?php _e('Tùy chọn font chữ', 'smartkid'); ?></div>    
                    <?php $styles = array('BeVietnamPro', 'Arial', 'BeVietnamPro'); ?>
                    <select name="smartkid_settings[font]" id="smartkid_settings[font]"> 
                    <?php foreach($styles as $style) { ?> 
                    <?php if($smartkid_options['font'] == $style) { $selected = 'selected="selected"'; } else { $selected = ''; } ?>
                    <option value="<?php echo $style; ?>" <?php echo $selected; ?>><?php echo $style; ?></option> 
                    <?php } ?> 
                    </select>
					<div id="admin-font-demo">This is a font demo</div>
                    <p class="admin-pb-note"><i class="fa-regular fa-lightbulb-on"></i> <?php _e('Chọn kiểu font chữ cho trang web của bạn.', 'smartkid'); ?></p>
               </div>
               <div class="admin-nd">     
                    
					<div class="admin-cm"><i class="fa-solid fa-pen-swirl"></i> <?php _e('Kích thước hiển thị', 'smartkid'); ?></div>
					
                    <input id="admin-input-size" placeholder="1300" name="smartkid_settings[size]" type="number" value="<?php if(!empty($smartkid_options['size'])){echo $smartkid_options['size'];} ?>"/>
    		        <label class="admin-label-right"><?php _e('Kích thước hiển thị', 'smartkid'); ?></label>
                    <p class="admin-pb-note"><i class="fa-regular fa-lightbulb-on"></i> <?php _e('Nhập kích thước hiển thị chiều rộng của trang web (mặc định 1300px).<br>
                    <b>Chú ý:</b> nhập kích thước phải lớn hơn 800px và nhỏ hơn 2300px nếu kích thước của bạn không đạt chỉ tiêu này thì kích thước sẽ tự động về lại 1300px.', 'smartkid'); ?>
                    </p>
                </div>
				
				 
				<div class="admin-nd">     
                    <div class="admin-cm"><i class="fa-regular fa-table-rows"></i> <?php _e('Tắt sidebar', 'smartkid'); ?></div>
					<label class="toggle-switch">
					<input type="checkbox" name="smartkid_settings[side1]" value="1" <?php if ( isset($smartkid_options['side1']) && 1 == $smartkid_options['side1'] ) echo 'checked="checked"'; ?> />
					<span class="slider"></span></label>
                    <label class="admin-label-right"><?php _e('Tắt sidebar ở trang chủ', 'smartkid'); ?></label>
					<p class="admin-pb-note"><i class="fa-regular fa-lightbulb-on"></i> <?php _e('Nếu bạn không muốn hiển thị sidebar ở trang chủ, chuyên mục, tìm kiếm, lưu trữ... có thể tích chọn để tắt đi.', 'smartkid'); ?></p>
				
					<label class="toggle-switch">
					<input type="checkbox" name="smartkid_settings[side2]" value="1" <?php if ( isset($smartkid_options['side2']) && 1 == $smartkid_options['side2'] ) echo 'checked="checked"'; ?> />
					<span class="slider"></span></label>
                    <label class="admin-label-right"><?php _e('Tắt sidebar ở bài viết', 'smartkid'); ?></label>
					<p class="admin-pb-note"><i class="fa-regular fa-lightbulb-on"></i> <?php _e('Nếu bạn không muốn hiển thị sidebar ở bài viết, sản phẩm... có thể tích chọn để tắt đi.', 'smartkid'); ?></p>
					
					<label class="toggle-switch">
					<input type="checkbox" name="smartkid_settings[side3]" value="1" <?php if ( isset($smartkid_options['side3']) && 1 == $smartkid_options['side3'] ) echo 'checked="checked"'; ?> />
					<span class="slider"></span></label>
					<label class="admin-label-right"><?php _e('Tắt sidebar ở trang', 'smartkid'); ?></label>
					<p class="admin-pb-note"><i class="fa-regular fa-lightbulb-on"></i> <?php _e('Nếu bạn không muốn hiển thị sidebar ở trang, có thể tích chọn để tắt đi.', 'smartkid'); ?></p>
                </div>
				
				<div class="admin-nd">     
                    <div class="admin-cm"><i class="fa-regular fa-wand-magic-sparkles"></i> <?php _e('Hiệu ứng khối ở trang chủ', 'smartkid'); ?></div>
					<label class="toggle-switch">
					<input type="checkbox" name="smartkid_settings[aos1]" value="1" <?php if ( isset($smartkid_options['aos1']) && 1 == $smartkid_options['aos1'] ) echo 'checked="checked"'; ?> />
					<span class="slider"></span></label>
					<label class="admin-label-right"><?php _e('Bật hiệu ứng khối', 'smartkid'); ?></label>
                    <p class="admin-pb-note"><i class="fa-regular fa-lightbulb-on"></i> <?php _e('Kích hoạt chức năng này, các khối ở trang chủ khi kéo xuống sẽ có hiệu ứng đẹp mắt.', 'smartkid'); ?></p>
				</div>	
				
				<div class="admin-nd">     
                    <div class="admin-cm"><i class="fa-solid fa-snowflakes"></i> <?php _e('Hiệu ứng đẹp mắt thêm vào website', 'smartkid'); ?></div>
					<?php $styles = array('None', 'Snow1', 'Snow2', 'Snow3', 'Lunar1', 'Lunar2', 'Flower1', 'Leaves1', 'Fun1', 'Click1'); ?>
                    <select name="smartkid_settings[hover]"> 
                    <?php foreach($styles as $style) { ?> 
                    <?php if($smartkid_options['hover'] == $style) { $selected = 'selected="selected"'; } else { $selected = ''; } ?>
                    <option value="<?php echo $style; ?>" <?php echo $selected; ?>><?php echo $style; ?></option> 
                    <?php } ?> 
                    </select>
                    <p class="admin-pb-note"><i class="fa-regular fa-lightbulb-on"></i> <?php _e('Chọn hiệu ứng thêm vào trang web của bạn vào những dịp lể kỹ niệm đặc biệt (ví dụ: Noel).', 'smartkid'); ?></p>
				</div>
				
				
               </div>
			   </div>
			   
			   <div class="rank-box rank" id="rankfive" style="display:none">
			   <!-- FORM NỘI DUNG -->
               <h4 class="admin-h4" id="admin5"><i class="fa-regular fa-kerning"></i> <?php _e('Thêm nội dung', 'smartkid'); ?></h4>
    		   <div class="admin-card">
               <div class="admin-nd"> 
                   <div class="admin-cm"><i class="fa-regular fa-share-nodes"></i> <?php _e('Biểu tượng mạng xã hội ở menu', 'smartkid'); ?></div>
                   <div class="admin-grid-input">
                   <input placeholder="ID Facebook" name="smartkid_settings[mxh1]" type="text" value="<?php if(!empty($smartkid_options['mxh1'])){echo $smartkid_options['mxh1'];} ?>"/>
                   <input placeholder="ID Twitter" name="smartkid_settings[mxh2]" type="text" value="<?php if(!empty($smartkid_options['mxh2'])){echo $smartkid_options['mxh2'];} ?>"/>
                   <input placeholder="ID Pinterest" name="smartkid_settings[mxh3]" type="text" value="<?php if(!empty($smartkid_options['mxh3'])){echo $smartkid_options['mxh3'];} ?>"/>
                   <input placeholder="ID Youtube" name="smartkid_settings[mxh4]" type="text" value="<?php if(!empty($smartkid_options['mxh4'])){echo $smartkid_options['mxh4'];} ?>"/>
                   <input placeholder="ID Tiktok" name="smartkid_settings[mxh5]" type="text" value="<?php if(!empty($smartkid_options['mxh5'])){echo $smartkid_options['mxh5'];} ?>"/>
                   <input placeholder="ID Instagram" name="smartkid_settings[mxh6]" type="text" value="<?php if(!empty($smartkid_options['mxh6'])){echo $smartkid_options['mxh6'];} ?>"/>
                   </div>
                   <div class="admin-div-note">
                   https://facebook.com/<span style="color:#ff4444">ID</span>    ID -> <?php _e('là id Facebook của bạn', 'smartkid'); ?><br>
                   https://twitter.com/<span style="color:#ff4444">ID</span>  ID -> <?php _e('là id Twitter của bạn', 'smartkid'); ?><br>
                   https://pinterest.com/<span style="color:#ff4444">ID</span>   ID -> <?php _e('là id Pinterest của bạn', 'smartkid'); ?><br>
                   https://youtube.com/<span style="color:#ff4444">ID</span>   ID -> <?php _e('là id Youtube của bạn', 'smartkid'); ?><br>
                   https://tiktok.com/@<span style="color:#ff4444">ID</span>   ID -> <?php _e('là id Tiktok của bạn', 'smartkid'); ?><br>
                   https://instagram.com/<span style="color:#ff4444">ID</span>   ID -> <?php _e('là id  Instagram', 'smartkid'); ?><br>
                   </div>
                   <p class="admin-pb-note"><i class="fa-regular fa-lightbulb-on"></i> <?php _e('Thêm liên kết của bạn vào biểu tượng mạng xã hội ở menu.', 'smartkid'); ?></p>
                   
                   <div class="admin-nd"> 
                   <div class="admin-cm"><i class="fa-regular fa-objects-align-top"></i> <?php _e('Nội dung thẻ H1 ở trang chủ', 'smartkid'); ?></div>
                   <input   placeholder="<?php _e('Nhập H1 của bạn vào', 'smartkid'); ?>" id="smartkid_settings[theh1]" name="smartkid_settings[theh1]" type="text" value="<?php if(!empty($smartkid_options['theh1'])){echo $smartkid_options['theh1'];} ?>"/>
                   <p class="admin-pb-note"><i class="fa-regular fa-lightbulb-on"></i> <?php _e('Tính năng này giúp website của bạn có thẻ H1 ở trang chủ rất tốt cho Seo.', 'smartkid'); ?></p>
                    
                   <div class="admin-cm"><i class="fa-regular fa-check-double"></i> <?php _e('Bản quyền dưới chân trang', 'smartkid'); ?></div>
                   <textarea class="admin-textarea" name="smartkid_settings[banquyen]" cols="30" rows="10" placeholder="Designed by smartkid..."><?php if(!empty($smartkid_options['banquyen'])){echo $smartkid_options['banquyen'];} ?></textarea>
                   <p class="admin-pb-note"><i class="fa-regular fa-lightbulb-on"></i> <?php _e('Dòng chữ bản quyền phía dưới cùng của trang web.', 'smartkid'); ?></p>
                   </div>
		      </div>
		    </div>
			</div> 
		   <div class="submit"><button id="admin-save" type="submit" class="button-primary"><i class="fa-regular fa-floppy-disk"></i> <?php _e('LƯU NỘI DUNG ALL', 'smartkid'); ?></button></div>
		   <button title="<?php _e('LƯU NỘI DUNG CONTETN', 'smartkid'); ?>" id="admin-save-fast" type="submit"><i class="fa-regular fa-floppy-disk"></i></button>
		</form>
		<button title="<?php _e('XEM', 'smartkid'); ?>" onclick="share(event, 'smartkid-viewhome');frameSrc();" id="admin-view-fast"><i class="fa-solid fa-desktop"></i></button>
		
	<div class="admin-ver"><b>Smartkidtheme - <?php echo THEME_VERSION;?></b> | LAN: <b><?php echo $lang=get_bloginfo("language"); ?></b>
	| PHP: <b><?php echo phpversion(); ?></b>
	<br><?php echo $_SERVER['SERVER_SOFTWARE']; ?>
	<br>WordPress: <?php echo get_bloginfo('version'); ?> 
	</div>
	</div>
	<!-- View home -->
	<div id="smartkid-viewhome" class="smartkid-viewhome" style="display:none">
	<div class="smartkid-viewhome-tit">
	<button onclick="share(event, 'smartkid-viewhome')"><i class="fa-solid fa-xmark"></i></button>
	<button onclick="frameSrc()" style="background:#333"><i class="fa-solid fa-house"></i></button> 
	<button class="scroll-button" style="background:#333" data-state="up"><i class="fa-solid fa-up"></i></button>
	<button class="scroll-button" style="background:#333" data-state="down"><i class="fa-solid fa-down"></i></button>
	<button style="background:#0c0" onclick="viewhomewidth()" id="btn-viewhomewidth"><i class="fa-regular fa-mobile"></i></button>
	</div>
	<iframe id="iframe-viewhome" src="" style="width:100%;height:100%"></iframe>
	</div>
	<script>
	function frameSrc() {
	var myIframe = document.getElementById("iframe-viewhome");
	var randomNum = Math.random().toString(36).substr(2, 9);
	myIframe.setAttribute("src", "<?php echo get_home_url(); ?>?v=" + randomNum);
	}
	// cuon len xuong viewhome
	var scrollUpInterval; 
	var scrollDownInterval; 
	function viewhomelen() {
	  var myIframe = document.getElementById("iframe-viewhome");
	  myIframe.contentWindow.scrollBy(0, -200);
	}
	function viewhomexuong() {
	  var myIframe = document.getElementById("iframe-viewhome");
	  myIframe.contentWindow.scrollBy(0, 200);
	}

	function startScrollUp() {
	  viewhomelen();
	  scrollUpInterval = setInterval(function() {
		viewhomelen();
	  }, 100); 
	}
	function startScrollDown() {
	  viewhomexuong();
	  scrollDownInterval = setInterval(function() {
		viewhomexuong();
	  }, 100); 
	}
	function stopScroll() {
	  clearInterval(scrollUpInterval);
	  clearInterval(scrollDownInterval);
	}
	function handleButtonClick(button) {
	  if (button.dataset.state === 'up') {
		startScrollUp();
	  } else if (button.dataset.state === 'down') {
		startScrollDown();
	  }
	}
	function handleButtonRelease(button) {
	  stopScroll();
	}
	var buttons = document.querySelectorAll('.scroll-button');
	buttons.forEach(function(button) {
	  button.addEventListener('mousedown', function() {
		handleButtonClick(button);
	  });
	  button.addEventListener('mouseup', function() {
		handleButtonRelease(button);
	  });
	  button.addEventListener('touchstart', function(event) {
		event.preventDefault();
		handleButtonClick(button);
	  });
	  button.addEventListener('touchend', function(event) {
		event.preventDefault();
		handleButtonRelease(button);
	  });
	});
	// view home mobile
	function viewhomewidth() {
	var viewhome = document.querySelector('.smartkid-viewhome');
	viewhome.style.maxWidth = '500px';
	var icon = document.querySelector('#btn-viewhomewidth i');
	icon.classList.remove('fa-mobile-alt'); 
	icon.classList.add('fa-tablet-alt');
	var button = document.getElementById('btn-viewhomewidth');
    button.onclick = viewhomewidth2;
	}
	function viewhomewidth2() {
	var viewhome = document.querySelector('.smartkid-viewhome');
	viewhome.style.maxWidth = '';
	var icon = document.querySelector('#btn-viewhomewidth i');
	icon.classList.remove('fa-tablet-alt');
	icon.classList.add('fa-mobile-alt'); 
	var button = document.getElementById('btn-viewhomewidth');
	button.onclick = viewhomewidth;
	}
	 
	</script>
	<?php
    }
// add muc luc menu admin
function smartkid_add_options_link() {
    $icon = '';
	add_menu_page('smartkidtheme', 'Smartkidtheme', 'manage_options', 'smartkid-options', 'smartkid_options_page', $icon, 1);
}
add_action('admin_menu', 'smartkid_add_options_link');
// add thong tin vao database
function smartkid_register_settings() {
register_setting('smartkid_settings_group', 'smartkid_settings');
}
add_action('admin_init', 'smartkid_register_settings');
// load css admin
function smartkid_loading_scripts_wrong() { 
wp_enqueue_style('admincss', get_template_directory_uri() . '/admin/css/style.css');
wp_enqueue_script('adminjs', get_template_directory_uri() . '/admin/js/custom.js');
}
add_action('admin_head', 'smartkid_loading_scripts_wrong');
// load css custon theme
function smartkid_custom_customize_enqueue() {
wp_enqueue_style( 'customizer-css', get_stylesheet_directory_uri() . '/admin/css/customizer.css' ); 
}
add_action( 'customize_controls_enqueue_scripts', 'smartkid_custom_customize_enqueue' );
// add codemirror them mau vao soan thao code
function smartkid_codemirror_enqueue_scripts() {
  $cm_settings['codeEditor'] = wp_enqueue_code_editor(array('type' => 'text/css'));
  wp_localize_script('jquery', 'cm_settings', $cm_settings);
  wp_enqueue_style('wp-codemirror');
}
add_action('admin_enqueue_scripts', 'smartkid_codemirror_enqueue_scripts');
// Add css setcard and set kich thuoc
function smartkid_add_cssjs_adminset(){ 
global $smartkid_options;
    if(isset($smartkid_options['theme']) && ($smartkid_options['theme'] == 'Blog' || $smartkid_options['theme'] == 'smartkid' || $smartkid_options['theme'] == 'Story' || $smartkid_options['theme'] == 'Color' || $smartkid_options['theme'] == 'Mix' || $smartkid_options['theme'] == 'Comic' || $smartkid_options['theme'] == 'Book' || $smartkid_options['theme'] == 'Land' || $smartkid_options['theme'] == 'Shop' || $smartkid_options['theme'] == 'Codex' || $smartkid_options['theme'] == 'Youtube' || $smartkid_options['theme'] == 'Coloring' || $smartkid_options['theme'] == 'Movie' || $smartkid_options['theme'] == 'Oto')) { ?>
    <style>
    .main-content {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
        grid-column-gap: 20px;
        grid-row-gap: 20px;
    }
    .smartkid-loadmore, nav.navigation.pagination {grid-column: 1 / span 3;}
    @media (max-width: 1050px) {
    .main-content{grid-template-columns: 1fr 1fr;} 
    .smartkid-loadmore, nav.navigation.pagination {grid-column: 1 / span 2;}
    }
    @media (max-width: 500px) {
    .main-content{grid-template-columns: auto;} 
    .smartkid-loadmore, nav.navigation.pagination {grid-column: 1 / span 1;}
    }
    </style>
    <?php } 
    if(isset($smartkid_options['theme']) && ($smartkid_options['theme'] == 'Images' || $smartkid_options['theme'] == 'Some')){ ?>
    <style>
    .main-content {
        display: grid;
        grid-template-columns: 1fr 1fr;
        grid-column-gap: 20px;
        grid-row-gap: 20px;
    }
    .smartkid-loadmore, nav.navigation.pagination {grid-column: 1 / span 2;}
    @media (max-width: 500px) {
    .main-content{grid-template-columns: auto;} 
    .smartkid-loadmore, nav.navigation.pagination {grid-column: 1 / span 1;}
    }
    </style>
    <?php }
    if(!empty($smartkid_options['size']) && $smartkid_options['size'] > '800' && $smartkid_options['size'] < '2300'){ echo '<style>main, .menu-gb, .fix-menu, .channd-2, .fix-menu2, .fix-menu4{max-width:'.$smartkid_options['size'].'px !important;}</style>';}
	if(isset($smartkid_options['speed1']) && isset($smartkid_options['speed2'])){ ?>
	<style>
	.lazyload {
	opacity: 0;
	}
	.lazyloaded {
	-webkit-transition: opacity .3s ease-in;
	-moz-transition: opacity .3s ease-in;
	transition: opacity .3s ease-in;
	opacity: 1;
	}
	</style>
	<?php
	}
	
	// tuy cimage the h trong bai viet
	if (is_single() || is_page()){
	if(isset($smartkid_options['set8']) && $smartkid_options['set8'] == "Style2"){ ?>
	<style>
	.danhmucbaiviet h1, .danhmucbaiviet h2, .danhmucbaiviet h3, .danhmucbaiviet h4, .danhmucbaiviet h5, .danhmucbaiviet h6, .danhmucbaiviet h7 {
    border:none;
    padding-left: 0px;
    padding-bottom: 10px;
    border-bottom: 2px dashed var(--texta);
	margin-top:20px;
    }
	</style>
	<?php
	}
	if(isset($smartkid_options['set8']) && $smartkid_options['set8'] == "Style3"){ ?>
	<style>
	danhmucbaiviet h1, .danhmucbaiviet h2, .danhmucbaiviet h3, .danhmucbaiviet h4, .danhmucbaiviet h5, .danhmucbaiviet h6, .danhmucbaiviet h7 {
    border:none;
    padding-left: 0px;
	padding: 10px 15px;
    border-top: 2px solid var(--texta);
	border-bottom: 2px solid var(--texta);
	color:var(--texta);
	background:var(--menu);
	margin-top:20px;
    }
	</style>
	<?php
	}
	if(isset($smartkid_options['set8']) && $smartkid_options['set8'] == "Style4"){ ?>
	<style>
	.danhmucbaiviet h1, .danhmucbaiviet h2, .danhmucbaiviet h3 {
    border:none;
    padding-left: 0px;
    padding: 10px 15px;
	background-color: #f9c5c829;
    border: 2px solid #f9c5c8;
	border-radius:5px;
	color:#000;
	margin-top:20px;
    }
	</style>
	<?php
	}
	if(isset($smartkid_options['set8']) && $smartkid_options['set8'] == "Style5"){ ?>
	<style>
	.danhmucbaiviet h1, .danhmucbaiviet h2, .danhmucbaiviet h3, .danhmucbaiviet h4, .danhmucbaiviet h5, .danhmucbaiviet h6, .danhmucbaiviet h7 {
    border:none;
    padding-left: 0px;
    padding: 10px 15px;
	border-radius:5px;
	color:var(--texta);
	border:2px solid var(--texta);
	margin-top:20px;
    }
	</style>
	<?php
	}
	if(isset($smartkid_options['set8']) && $smartkid_options['set8'] == "Style6"){ ?>
	<style>
	.danhmucbaiviet h1, .danhmucbaiviet h2, .danhmucbaiviet h3, .danhmucbaiviet h4, .danhmucbaiviet h5, .danhmucbaiviet h6, .danhmucbaiviet h7 {
    border:none;
    padding-left: 0px;
    padding: 10px 15px;
	color:var(--texta);
	background:var(--body);
	border-bottom:2px solid var(--texta);
	margin-top:20px;
    }
	</style>
	<?php
	}
	if(isset($smartkid_options['set8']) && $smartkid_options['set8'] == "Style7"){ ?>
	<style>
	.danhmucbaiviet h1, .danhmucbaiviet h2, .danhmucbaiviet h3, .danhmucbaiviet h4, .danhmucbaiviet h5, .danhmucbaiviet h6, .danhmucbaiviet h7 {
    border:none;
    padding: 10px 15px;
	color:var(--texta);
	background:var(--body);
	border-left:4px solid var(--texta);
	margin-top:20px;
    }
	</style>
	<?php
	}
	if(isset($smartkid_options['set8']) && $smartkid_options['set8'] == "Style8"){ ?>
	<style>
	.danhmucbaiviet h1, .danhmucbaiviet h2, .danhmucbaiviet h3, .danhmucbaiviet h4, .danhmucbaiviet h5, .danhmucbaiviet h6, .danhmucbaiviet h7 {
    border:none;
    padding: 10px 15px;
	color:var(--texta);
	background:var(--body);
	position: relative;
	margin-bottom:30px;
	margin-top:20px;
    }
	.danhmucbaiviet h1:after, .danhmucbaiviet h2:after, .danhmucbaiviet h3:after, .danhmucbaiviet h4:after, .danhmucbaiviet h5:after, .danhmucbaiviet h6:after, .danhmucbaiviet h7:after {
    position: absolute;
	content: '';
	top: 100%;
	left: 30px;
	border: 15px solid transparent;
	border-top: 15px solid var(--body);
	width: 0;
	height: 0;
    }
	</style>
	<?php
	}
	if(isset($smartkid_options['set8']) && $smartkid_options['set8'] == "Style9"){ ?>
	<style>
	.danhmucbaiviet h1, .danhmucbaiviet h2, .danhmucbaiviet h3, .danhmucbaiviet h4, .danhmucbaiviet h5, .danhmucbaiviet h6, .danhmucbaiviet h7 {
    border:none;
    padding: 10px 15px;
	color:var(--texta);
	background:var(--body);
	position: relative;
	margin-bottom:30px;
	margin-top:20px;
    }
	.danhmucbaiviet h1:after, .danhmucbaiviet h2:after, .danhmucbaiviet h3:after, .danhmucbaiviet h4:after, .danhmucbaiviet h5:after, .danhmucbaiviet h6:after, .danhmucbaiviet h7:after {
    position: absolute;
    content: '';
    top: 100%;
    left: 0;
    border: none;
    border-bottom: solid 15px transparent;
    border-right: solid 20px var(--texta);
    }
	</style>
	<?php
	}
	if(isset($smartkid_options['set8']) && $smartkid_options['set8'] == "Style10"){ ?>
	<style>
	.danhmucbaiviet h1, .danhmucbaiviet h2, .danhmucbaiviet h3, .danhmucbaiviet h4, .danhmucbaiviet h5, .danhmucbaiviet h6, .danhmucbaiviet h7 {
    border:none;
	padding:0px;
	color:var(--texta);
    background-color: #dbedf9;
    border: 2px solid #c3e5f8;
	margin-top:20px;
    }
	</style>
	<?php
	}
	if(isset($smartkid_options['set8']) && $smartkid_options['set8'] == "Style11"){ ?>
	<style>
	.danhmucbaiviet h1, .danhmucbaiviet h2, .danhmucbaiviet h3, .danhmucbaiviet h4, .danhmucbaiviet h5, .danhmucbaiviet h6, .danhmucbaiviet h7 {
    border:none;
	padding:0px;
	padding-bottom:7px;
	border-bottom: double 5px #FFC778;
	margin-top:20px;
    }
	</style>
	<?php
	}
	if(isset($smartkid_options['set8']) && $smartkid_options['set8'] == "Style12"){ ?>
	<style>
	.danhmucbaiviet h1, .danhmucbaiviet h2, .danhmucbaiviet h3, .danhmucbaiviet h4, .danhmucbaiviet h5, .danhmucbaiviet h6, .danhmucbaiviet h7 {
    border:none;
	padding:0px;
    padding-bottom:15px;
	position: relative;
	margin-top:10px;
    }
	.danhmucbaiviet h1:after, .danhmucbaiviet h2:after, .danhmucbaiviet h3:after, .danhmucbaiviet h4:after, .danhmucbaiviet h5:after, .danhmucbaiviet h6:after, .danhmucbaiviet h7:after {
    position: absolute;
    content: '';
    left: 0;
    bottom: 0;
    width: 100%;
    height: 7px;
    background: -webkit-repeating-linear-gradient(-45deg, var(--texta), var(--texta) 2px, #fff 2px, #fff0 4px);
    background: repeating-linear-gradient(-45deg, var(--texta), var(--texta) 2px, #fff0 2px, #fff0 4px);
    }
	</style>
	<?php
	}
	if(isset($smartkid_options['set8']) && $smartkid_options['set8'] == "Style13"){ ?>
	<style>
	.danhmucbaiviet h1, .danhmucbaiviet h2, .danhmucbaiviet h3, .danhmucbaiviet h4, .danhmucbaiviet h5, .danhmucbaiviet h6, .danhmucbaiviet h7 { 
	padding:10px;
	position: relative;
	background-color: #dbedf9;
    border: 2px solid #c3e5f8;
    border-radius: 7px;
	color:#333;
	margin-bottom:10px;
	margin-top:10px;
    }
	.danhmucbaiviet h1:after, .danhmucbaiviet h2:after, .danhmucbaiviet h3:after, .danhmucbaiviet h4:after, .danhmucbaiviet h5:after, .danhmucbaiviet h6:after, .danhmucbaiviet h7:after {
    position: absolute;
    content: '';
    top: 100%;
    left: 30px;
    border: 15px solid transparent;
    border-top: 15px solid #ffebbe;
    width: 0;
    height: 0;
    }
	</style>
	<?php
	}
	if(isset($smartkid_options['set8']) && $smartkid_options['set8'] == "Style14"){ ?>
	<style>
	.danhmucbaiviet h1, .danhmucbaiviet h2, .danhmucbaiviet h3, .danhmucbaiviet h4, .danhmucbaiviet h5, .danhmucbaiviet h6, .danhmucbaiviet h7 {
    border:none;
	padding:0px;
	padding-bottom:10px;
	position: relative;
	border-bottom: solid 3px skyblue;
	margin-top:10px;
    }
	.danhmucbaiviet h1:after, .danhmucbaiviet h2:after, .danhmucbaiviet h3:after, .danhmucbaiviet h4:after, .danhmucbaiviet h5:after, .danhmucbaiviet h6:after, .danhmucbaiviet h7:after {
    position: absolute;
    content: " ";
    display: block;
    border-bottom: solid 3px #ffc778;
    bottom: -3px;
    width: 30%;
    }
	</style>
	<?php
	}
	}
}
add_action('wp_head', 'smartkid_add_cssjs_adminset');
// dark ligt mode web
function smartkid_darkmode_lightmode(){ 
global $smartkid_options;
if (isset($smartkid_options['darkmode1'])){ 
ob_start(); ?>
<script>
if(document.getElementById("icontheme") != null){
document.addEventListener('DOMContentLoaded', function () {
const toggleSwitch = document.querySelector('.theme-switch input[type="checkbox"]');
const currentTheme = localStorage.getItem('theme');
var icondark = '<i class="fa-regular fa-moon"></i>';
var iconlight = '<i class="fa-regular fa-brightness"></i>';
if (currentTheme) {
    document.documentElement.setAttribute('data-theme', currentTheme);
    if (currentTheme === 'dark') {
        toggleSwitch.checked = true;
		document.getElementById("icontheme").innerHTML = iconlight;
    } else {
		document.getElementById("icontheme").innerHTML = icondark;
	}
}
function switchTheme(e) {
    if (e.target.checked) {
        document.documentElement.setAttribute('data-theme', 'dark');
        localStorage.setItem('theme', 'dark');
		document.getElementById("icontheme").innerHTML = iconlight;
    } else {
        document.documentElement.setAttribute('data-theme', 'light');
        localStorage.setItem('theme', 'light');
		document.getElementById("icontheme").innerHTML = icondark;
    }
}
toggleSwitch.addEventListener('change', switchTheme, false);
});
}
</script>
<?php 
echo ob_get_clean(); 
}
}
add_action('wp_footer', 'smartkid_darkmode_lightmode');
// dark ligt mode web head
function smartkid_darkmode_lightmode_head(){ 
global $smartkid_options;
if (isset($smartkid_options['darkmode1'])){
ob_start(); ?>
<script>
<?php if (isset($smartkid_options['darkmode3']) && isset($smartkid_options['darkmode2']) && $smartkid_options['darkmode2'] == 'None'){ ?>
document.documentElement.setAttribute('data-theme', 'dark'); 
<?php }  
if (isset($smartkid_options['darkmode2']) && $smartkid_options['darkmode2'] == 'Browser'){ ?>
if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
	document.documentElement.setAttribute('data-theme', 'dark'); 
}
<?php }  
if (isset($smartkid_options['darkmode2']) && $smartkid_options['darkmode2'] == 'Time'){ ?>
var currentTime = new Date();
var currentHour = currentTime.getHours();
if ((currentHour >= 18 && currentHour <= 23) || (currentHour >= 0 && currentHour < 3)) {
    document.documentElement.setAttribute('data-theme', 'dark'); 
}
<?php } ?>
</script>	
<?php 
echo ob_get_clean(); 
}
}
add_action('wp_head', 'smartkid_darkmode_lightmode_head');

