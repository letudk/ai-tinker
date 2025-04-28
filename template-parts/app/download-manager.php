<?php
	function smartkid_download_showvip(){
	global $post, $smartkid_options;
		ob_start();
        if (!empty(get_post_meta( $post->ID, 'download_link1', true )) || !empty(get_post_meta( $post->ID, 'download_link2', true )) ){ ?>
		<div class="download-box"><div class="download-manager-title"><i class="fa-regular fa-link" style="margin-right:7px;"></i> <?php _e('Chia sẻ tập tin', 'smartkid'); ?></div>
        <div class="download-manager">
        <?php // link tai mã hóa
		if (!empty(get_post_meta( $post->ID, 'download_link1', true ))){
            $download_link1 = get_post_meta($post->ID, 'download_link1', true);
			$download_link1 = explode(',', $download_link1);
			$download_link11 = get_post_meta($post->ID, 'download_link11', true);
			$download_link11 = explode(',', $download_link11);
			$download_link_all1 = array_combine($download_link1, $download_link11);
            foreach($download_link_all1 as $text => $text2){
			if(!empty($text)){ ?>
			<button id="download" onclick="window.open('<?php echo esc_url( home_url( '/' ) ); ?>/link?url=<?php echo bin2hex($text); ?>')" ><i class="fa-solid fa-arrow-down-to-square" style="margin-right:7px;"></i> <?php if(!empty($text2)){echo $text2;} else {_e('Tải về', 'smartkid');} ?></button>
			<?php } }
		}
		// download nhảy giây
		if (!empty(get_post_meta( $post->ID, 'download_link2', true ))){
		    $download_link2 = get_post_meta($post->ID, 'download_link2', true);
		    $download_link2 = explode(',', $download_link2);
		    $download_link21 = get_post_meta($post->ID, 'download_link21', true);
		    $download_link21 = explode(',', $download_link21);
		    $download_link_all2 = array_combine($download_link2, $download_link21);
			$i = 0;
            foreach($download_link_all2 as $text => $text2){
			$i++;
		    if(!empty($text)){
			?>
			<button id="dow-n<?php echo $i; ?>"><i class="fa-solid fa-arrow-down-to-square" style="margin-right:7px;"></i> <?php if(!empty($text2)){echo $text2;} else {_e('Tải về', 'smartkid');} ?> <b id="box-n<?php echo $i; ?>"> <span id="giay-n<?php echo $i; ?>"></span></b></button>
			<script <?php if(isset($smartkid_options['speed1']) && isset($smartkid_options['speed3']) && !is_user_logged_in()){ ?>type="rocketlazyloadscript" defer<?php } ?>>
			jQuery(document).ready(function(o) {
			function d(giayId, boxId, get) {
				var n = <?php if(!empty($smartkid_options['set71'])){echo $smartkid_options['set71'];} else {echo '10';} ?>; // Giá trị ban đầu của n
				o(giayId).text(n);
				o(boxId).show();

				var e = setInterval(function() {
					// check on browser
					if (!document.hidden) {
						n -= 1;
					} else {
						n -= 0;
					}
					o(giayId).text(n);
					if (n == 0) {
						clearInterval(e);
						window.location = get;
						o(boxId).hide();
					}
				}, 1000);

				o(boxId).click(function() {
					clearInterval(e);
					window.location = get;
				});
			}
				var content = "<?php echo $text; ?>"; 
				var id = "<?php echo $i; ?>";
				var giayId = "#giay-n" + id;
				var boxId = "#box-n" + id;
				var get = content.replace(/\/file\/d\/(.+)\/(.+)/, "/uc?export=download&id=$1");
				o("#dow-n" + id).click(function() {
					d(giayId, boxId, get);
				});
			});
		    </script>
        <?php  } }
		} ?>
		</div></div>
		<?php } 
	return ob_get_clean();
	}
		global $login_options;
		// lay url bai viet
        $get_back = base64_encode(get_permalink());
		// tim kiem thoi gian vip
    	$current_user = wp_get_current_user(); 
        $ngaysosanh = get_the_author_meta( 'vipend', $current_user->ID ); 
        $ngaysosanh = str_replace('/', '-', $ngaysosanh);
        $ngayhomnay = date("d-m-Y");
        // tim id post trong data user
        $all_postid = nl2br(get_the_author_meta('post', $current_user->ID));
		
	    $post_check = $post->ID;
		// check bai viet khoa vip hay login
        if (get_post_meta( $post->ID, 'download_link3', true ) == 'Login'){
    	    if(is_user_logged_in() || !isset($login_options['enable3'])){
				echo smartkid_download_showvip();
    	    }
    	    else {
			if (!empty($login_options['notelogin'])){ $login_lock =  $login_options['notelogin']; } else { $login_lock = __('Bạn cần đăng nhập tài khoản mới có thể xem được', 'smartkid'); }
                echo '<div class="locked-post" style="margin:0px;margin-top:10px;border-radius:10px;"><div class="khoa-img"><span><i class="fa-solid fa-lock"></i> '.__(' NỘI DUNG ĐÃ BỊ KHÓA', 'smartkid').'</span></div><div class="khoa-content"><a class="get-back" href="'. home_url('/').'login?url='. $get_back .'">'. __('Đăng nhập ngay', 'smartkid') .'</a><br>'.$login_lock.'</div></div>';
			}
    	}
		else if (get_post_meta( $post->ID, 'download_link3', true ) == 'Pass'){
				$lock_error 	= __('Mật khẩu bạn nhập không đúng','smartkid');
				$lock_form = get_post_meta( $post->ID, 'download_link31', true );
				$doi = strlen($lock_form);	
				$doila = bin2hex(md5($lock_form));
				$doila2 = substr($doila, -4);
				if (!empty($login_options['notepass'])){ $pass_lock =  $login_options['notepass']; } else { $pass_lock = __('Bạn cần nhập mật khẩu để mở khóa', 'smartkid'); }
				ob_start(); ?>
				<div class="locked-post" style="margin:0px;margin-top:10px;border-radius:10px;"><div class="khoa-img" style="font-weight:600;"><span><i class="fa-solid fa-lock"></i><?php _e(' NỘI DUNG ĐÃ BỊ KHÓA', 'smartkid'); ?></span></div>
				<div class="khoa-note" style="font-size: 14px; font-style: italic;"><?php echo $pass_lock; ?></div>
				<div class="khoa-content">
				<form action="#3lock<?php echo $doila2 . $doi ?>" method="post" id="3lock<?php echo $doila2 . $doi ?>">
				<div class="locked-post-input">
				<input id="khoa-lock1" type="password" name="lock_input" placeholder="<?php _e('MẬT KHẨU','smartkid'); ?>">
				<input id="khoa-lock2" type="submit" name="lock_submit<?php echo $doila2 . $doi ?>" value="<?php _e('TẢI SÁCH','smartkid'); ?>">
				</div>
				<?php $form = ob_get_clean();
				if (isset($_POST['lock_submit'. $doila2 . $doi .''])) {
					if ($_POST['lock_input'] == $lock_form AND $lock_form != '') {
						echo '<div id="3lock'. $doila2 . $doi .'">'. smartkid_download_showvip() .'</div>';
					} else {
						echo $form.'<div class="locked-post-eror">'.$lock_error.'</div></form></div></div>';
					}
				} else {
					echo $form .'</form></div></div>';
				}
			
		}
        else {
			    echo smartkid_download_showvip();
        }

		
		
		