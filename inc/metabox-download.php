<?php
function smartkid_meta_download()
{
 add_meta_box( 'download-1', __('Tạo liên kết tải về', 'smartkid'), 'smartkid_thongtin_download',  array('post', 'coloring'));
}
add_action( 'add_meta_boxes', 'smartkid_meta_download' );
function smartkid_thongtin_download( $post ) {
	   $download_link1 = get_post_meta($post->ID, 'download_link1', true);
	   $download_link1 = explode(',', $download_link1);
	   $download_link11 = get_post_meta($post->ID, 'download_link11', true);
	   $download_link11 = explode(',', $download_link11);
	   $download_link_all1 = array_combine($download_link1, $download_link11);
   
	   // download link s
	   $download_link2 = get_post_meta($post->ID, 'download_link2', true);
	   $download_link2 = explode(',', $download_link2);
	   $download_link21 = get_post_meta($post->ID, 'download_link21', true);
	   $download_link21 = explode(',', $download_link21);
	   $download_link_all2 = array_combine($download_link2, $download_link21);
	   
	   // lock login and vip and pass
	   $download_link3 = get_post_meta($post->ID, 'download_link3', true);
	   $download_link31 = get_post_meta($post->ID, 'download_link31', true);
   wp_nonce_field( 'save_thongtin', 'thongtin_nonce' ); ?>
    <div class="post-main">
	<!-- Download get link thông thường -->
    <div class="post-muc"><i class="fa-regular fa-download"></i> <?php _e('Liên kết mã hóa', 'smartkid'); ?></div>
    <div class="bang-link1">
        <?php
        if(isset($download_link_all1) && is_array($download_link_all1)) {
            $i = 1;
            $output = '';
            foreach($download_link_all1 as $key => $name){
                $output = '<div style="display:flex;margin-top:10px">
                <input placeholder="'. __('Nhập link', 'smartkid') .'" type="text" id="post-input" name="download_link1[]" value="' . $key . '">
                <input placeholder="'. __('Nhập tên', 'smartkid') .'" type="text" id="post-input" name="download_link11[]" value="' . $name . '">';
                if( $i !== 1 && $i > 1 ) $output .= '<a href="#" class="remove-download1 post-download-del">X</a></div>';
                else $output .= '</div>';
                echo $output;
                $i++;
            }
        } else {
        echo '<div style="display:flex;margin-top:10px">
        <input placeholder="'. __('Nhập link', 'smartkid') .'" id="post-input" type="text" name="download_link1[]">
        <input placeholder="'. __('Nhập tên', 'smartkid') .'" id="post-input" type="text" name="download_link11[]"></div>';
        }
    ?>
    </div>
    <p><a class="them-link1 post-download"><i class="fa-regular fa-link"></i> <?php _e('Thêm link', 'smartkid'); ?></a></p>
	<!-- Download get link thảy giây -->
	<div class="post-muc"><i class="fa-regular fa-clock"></i> <?php _e('Liên kết nhảy giây', 'smartkid'); ?></div>
    <div class="bang-link2">
        <?php
        if(isset($download_link_all2) && is_array($download_link_all2)) {
            $i = 1;
            $output = '';
            foreach($download_link_all2 as $key => $name){
                $output = '<div style="display:flex;margin-top:10px">
                <input placeholder="'. __('Nhập link', 'smartkid') .'" type="text" id="post-input" name="download_link2[]" value="' . $key . '">
                <input placeholder="'. __('Nhập tên', 'smartkid') .'" type="text" id="post-input" name="download_link21[]" value="' . $name . '">';
                if( $i !== 1 && $i > 1 ) $output .= '<a href="#" class="remove-download2 post-download-del">X</a></div>';
                else $output .= '</div>';
                echo $output;
                $i++;
            }
        } else {
        echo '<div style="display:flex;margin-top:10px">
        <input placeholder="'. __('Nhập link', 'smartkid') .'" id="post-input" type="text" name="download_link2[]">
        <input placeholder="'. __('Nhập tên', 'smartkid') .'" id="post-input" type="text" name="download_link21[]"></div>';
        }
    ?>
    </div>
    <p><a class="them-link2 post-download"><i class="fa-regular fa-link"></i> <?php _e('Thêm link', 'smartkid'); ?></a></p>
	
	<div class="post-muc"><i class="fa-regular fa-lock"></i> <?php _e('Khóa tải về', 'smartkid'); ?></div>
	<div class="post-main">
	<select style="width:150px" class="post-sel" name="download_link3">
        <option value="">No login</option>
        <option value="Login" <?php selected($download_link3, 'Login'); ?>>Login</option>
        <option value="Vip" <?php selected($download_link3, 'Vip'); ?>>Vip</option>
		<option value="Pass" <?php selected($download_link3, 'Pass'); ?>>Pass</option>
    </select>
	<p><input style="width:150px" placeholder="<?php _e('Mật khẩu', 'smartkid'); ?>" id="post-input" type="text" name="download_link31" value="<?php echo esc_attr( $download_link31 ); ?>"></p>
    <p class="post-note"><i class="fa-regular fa-lightbulb-on"></i> <?php _e('Sử dụng chức năng này để khóa phần nội dung tải về', 'smartkid'); ?>
	<br><i><?php _e('Chú ý: Nếu bạn chọn kiểu khóa là Pass thì cần nhập mật khẩu vào ô bên dưới để có thể hoạt động', 'smartkid'); ?></i>
	</p>
	</div>
	</div>
<?php }
function smartkid_enqueue_scripts_download() {
    wp_enqueue_script( 'download-script', get_template_directory_uri() . '/inc/js/link-download.js', array( 'jquery' ), true);
}
add_action('admin_enqueue_scripts', 'smartkid_enqueue_scripts_download');

function smartkid_thongtin_save_download( $post_id )
{
if(isset($_POST['thongtin_nonce'])){	
$thongtin_nonce = $_POST['thongtin_nonce'];
}
 if(!isset( $thongtin_nonce )) return;
 if( !wp_verify_nonce( $thongtin_nonce, 'save_thongtin' ) ) return;	
 if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
 
 if(isset($_POST['download_link1'])){
 $type1 =  implode(',', str_replace(',', '', $_POST['download_link1']));
 $type11 =  implode(',', str_replace(',', '', $_POST['download_link11']));
 update_post_meta( $post_id, 'download_link1', sanitize_text_field($type1));
 update_post_meta( $post_id, 'download_link11', sanitize_text_field($type11));
 }
 
 if(isset($_POST['download_link2'])){
 $type2 =  implode(',', str_replace(',', '', $_POST['download_link2']));
 $type21 =  implode(',', str_replace(',', '', $_POST['download_link21']));
 update_post_meta( $post_id, 'download_link2', sanitize_text_field($type2));
 update_post_meta( $post_id, 'download_link21', sanitize_text_field($type21));
 }
 if(isset($_POST['download_link3'])){
 update_post_meta( $post_id, 'download_link3', sanitize_text_field($_POST['download_link3']));
 }
 if(isset($_POST['download_link31'])){
 update_post_meta( $post_id, 'download_link31', sanitize_text_field($_POST['download_link31']));
 }
 
}
add_action( 'save_post', 'smartkid_thongtin_save_download' );
// add js xem co xem trinh duyet
function smartkid_checkon_browser(){
if(is_single()){
wp_enqueue_script( 'checkon', get_template_directory_uri() . '/inc/js/checkon.js');
}
}
add_action('wp_enqueue_scripts', 'smartkid_checkon_browser');

