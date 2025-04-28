<?php
global $media_options ;
$media_options= get_option('media_settings', array());
 
# han che tai len file 
if (isset($media_options['setting_limited_image_upload']) && !empty($media_options['size'])){ 
function smartkid_change_upload_size(){
global $media_options;
if(!empty($media_options['setting_limited_image_upload1'])){
$mlimit = $media_options['setting_limited_image_upload1'];
} else {
$mlimit = 100000;	
}
return 1000 * $mlimit;
}
add_filter( 'upload_size_limit', 'smartkid_change_upload_size' );
}
# Xóa bài viết sẽ xóa luôn hình ảnh đính kèm trong post story land
if (isset($media_options['setting_rm_image_post'])){
function smartkid_delete_all_attached_media( $post_id ) {
if(get_post_type($post_id) == "post" || get_post_type($post_id) == "tips" || get_post_type($post_id) == "shop") {

// xoa anh dai dien
$thumbnail_id = get_post_thumbnail_id($post_id);
if ($thumbnail_id) {
wp_delete_attachment($thumbnail_id, true);
}	

// xoa anh dinh kem	
$attachments = get_attached_media( '', $post_id );
foreach ($attachments as $attachment) {
wp_delete_attachment( $attachment->ID, 'true' );
}

// xoa anh trong metabox photo
$photo1 = get_post_meta($post_id, 'photo1', true);  
$photo1 = explode(',', $photo1);
foreach ($photo1 as $id) {
wp_delete_attachment( $id, 'true' );
}

}
}
add_action( 'before_delete_post', 'smartkid_delete_all_attached_media' );
}
# images center
if(isset($media_options['setting_center_image'])){
function smartkid_images_center_footer(){
if (is_single()){
ob_start();	?>
<style>.danhmucbaiviet img{margin: auto auto 10px auto !important;display: block !important;}</style>
<?php }
echo ob_get_clean();
}
add_action('wp_footer', 'smartkid_images_center_footer');
} 
# Hàm thêm watermark cho image anh tai len
if(isset($media_options['setting_watermark'])){
function smartkid_add_watermark($attachment_id) {
	global $media_options;
	if(!empty($media_options['setting_watermark1'])){$logo = $media_options['setting_watermark1'];}else{$logo = "";}
    $watermark_path = $logo; 
    $attachment = get_post($attachment_id);
    $file = get_attached_file($attachment_id);
    $mime_type = get_post_mime_type($attachment);
    
    if (strpos($mime_type, 'image') !== false) { 
	
		if (strpos($mime_type, 'image/svg') !== false || strpos($mime_type, 'image/gif') !== false || strpos($mime_type, 'image/webp') !== false) {
            return;
        }
		
        if ($mime_type == 'image/jpeg') {
            $image = imagecreatefromjpeg($file);
        } elseif ($mime_type == 'image/png') {
            $image = imagecreatefrompng($file);
        }
        $watermark = imagecreatefrompng($watermark_path);
        
        // Lấy kích thước hình ảnh và watermark
        $image_width = imagesx($image);
        $image_height = imagesy($image);
        $watermark_width = imagesx($watermark);
        $watermark_height = imagesy($watermark);
        
      
		if(isset($media_options['setting_watermark2']) && $media_options['setting_watermark2'] == 'Center'){
		// cimage giua khung hình
		$watermark_pos_x = ($image_width - $watermark_width) / 2;
		$watermark_pos_y = ($image_height - $watermark_height) / 2;
		}
		elseif (isset($media_options['setting_watermark2']) && $media_options['setting_watermark2'] == 'Top Left'){
		// goc tren trai
		$watermark_pos_x = 10;
		$watermark_pos_y = 10;
		}
		elseif (isset($media_options['setting_watermark2']) && $media_options['setting_watermark2'] == 'Top Right'){
		// goc tren phai
		$watermark_pos_x = $image_width - $watermark_width - 10; 
		$watermark_pos_y = 10; 
		}
		elseif (isset($media_options['setting_watermark2']) && $media_options['setting_watermark2'] == 'Bottom Left'){
		// goc duoi trai
		$watermark_pos_x = 10; 
		$watermark_pos_y = $image_height - $watermark_height - 10; 
		}
		elseif (isset($media_options['setting_watermark2']) && $media_options['setting_watermark2'] == 'Bottom Right'){
		// goc duoi phai
		$watermark_pos_x = $image_width - $watermark_width - 10; 
		$watermark_pos_y = $image_height - $watermark_height - 10; 
		} 
		else {
		// cimage giua khung hình
		$watermark_pos_x = ($image_width - $watermark_width) / 2;
		$watermark_pos_y = ($image_height - $watermark_height) / 2;	
		}
        // Thêm watermark vào hình ảnh
        imagecopy($image, $watermark, $watermark_pos_x, $watermark_pos_y, 0, 0, $watermark_width, $watermark_height);
        
        // Lưu hình ảnh mới đã thêm watermark
        if ($mime_type == 'image/jpeg') {
            imagejpeg($image, $file);
        } elseif ($mime_type == 'image/png') {
            imagepng($image, $file);
        }
    }
}
add_action('add_attachment', 'smartkid_add_watermark');
} 
function smartkid_add_cache_clear_button( $wp_admin_bar ) {
    $args = array(
        'id' => 'cache-clear',
        'title' => __('Cập nhật', 'smartkid'),
        'href' => wp_nonce_url( admin_url('admin-post.php?action=clear_cache'), 'clear_cache' ),
    );
    $wp_admin_bar->add_node( $args );
}
add_action( 'admin_bar_menu', 'smartkid_add_cache_clear_button', 999 );
function smartkid_handle_cache_clear() {
    if ( ! current_user_can( 'manage_options' ) ) {
        wp_die( __('Bạn không có quyền xóa cache', 'smartkid') );
    } 
    wp_safe_redirect( $_SERVER['HTTP_REFERER'] );
    exit();
}
add_action( 'admin_post_clear_cache', 'smartkid_handle_cache_clear' );

# Code tự động lưu ảnh vào lưu trữ của bạn
if (isset($media_options['setting_save_image_another'])) {
    class smartkid_save_images_hots {
        function __construct() {
            add_filter('content_save_pre', array($this, 'smartkid_post_save_images'));
        }

        function smartkid_post_save_images($content) {
            global $post;
            if ($post && isset($post->ID)) {
                $post_id = $post->ID;
                $post_status = get_post_status($post_id);

                if ($post_status == 'publish' || $post_status == 'draft' || $post_status == 'pending') {
                    set_time_limit(240);
                    $preg = preg_match_all('/<img.*?src="(.*?)"/', stripslashes($content), $matches);

                    if ($preg) {
                        foreach ($matches[1] as $image_url) {
                            if (empty($image_url)) continue;
                            $pos = strpos($image_url, $_SERVER['HTTP_HOST']);

                            if ($pos === false) {
                                $res = $this->smartkid_fill_save_images($image_url, $post_id);
                                $replace = $res['url'];
                                $content = str_replace($image_url, $replace, $content);
                            }
                        }
                    }
                }
            }

            remove_filter('content_save_pre', array($this, 'smartkid_post_save_images'));
            return $content;
        }

        function smartkid_fill_save_images($image_url, $post_id) {
            $file = file_get_contents($image_url);
            $post = get_post($post_id);

            if ($post) {
                $posttitle = $post->post_title;
                $postname = sanitize_title($posttitle);
                $im_name = "$postname-$post_id.jpg";
                $res = wp_upload_bits($im_name, '', $file);
                $this->smartkid_insert_attachment($res['file'], $post_id);
                return $res;
            }

            // Xử lý khi không có giá trị $post
            return null;
        }

        function smartkid_insert_attachment($file, $id) {
            $dirs = wp_upload_dir();
            $filetype = wp_check_filetype($file);
            $attachment = array(
                'guid' => $dirs['baseurl'] . '/' . _wp_relative_upload_path($file),
                'post_mime_type' => $filetype['type'],
                'post_title' => preg_replace('/\.[^.]+$/', '', basename($file)),
                'post_content' => '',
                'post_status' => 'inherit'
            );

            $attach_id = wp_insert_attachment($attachment, $file, $id);
            $attach_data = wp_generate_attachment_metadata($attach_id, $file);
            wp_update_attachment_metadata($attach_id, $attach_data);
            return $attach_id;
        }
    }

    new smartkid_save_images_hots();
}

// Cho phép tải lên file SVG / webp
 if (isset($media_options['setting_svg_upload'])) {

    function smartkid_allow_svg_upload( $mimes ) {
        $mimes['svg'] = 'image/svg+xml'; 
        return $mimes;
    }
    add_filter( 'upload_mimes', 'smartkid_allow_svg_upload' );

    function smartkid_fix_svg_thumb_display() {
        echo '
            <style type="text/css">
                td.media-icon img[src$=".svg"], img[src$=".svg"].attachment-post-thumbnail {
                    width: 100% !important;
                    height: auto !important;
                }
            </style>
        ';
    }
    add_action( 'admin_head', 'smartkid_fix_svg_thumb_display' );
 }



function disable_post_image_crop($sizes) { 
    return  array(); ;
}
add_filter('intermediate_image_sizes_advanced', 'disable_post_image_crop');

// thay đổi thư mục hình ảnh trong bài viết
function custom_upload_dir($uploads) {
    // Lấy tiêu đề bài viết hiện tại
    if (isset($_POST['post_id'])) {
        $post_id = $_POST['post_id'];
        $post = get_post($post_id);
        if ($post) {
            $post_name = sanitize_title($post->post_title); // Chuyển tiêu đề thành slug
        } else {
            $post_name = 'uncategorized';
        }
    } else {
        $post_name = 'uncategorized';
    }

    // Thiết lập đường dẫn thư mục upload
    $custom_dir = WP_CONTENT_DIR . '/uploads/tranhtomau/' . $post_name;
    $custom_url = WP_CONTENT_URL . '/uploads/tranhtomau/' . $post_name;

    // Tạo thư mục nếu chưa tồn tại
    if (!file_exists($custom_dir)) {
        wp_mkdir_p($custom_dir);
    }

    // Cập nhật đường dẫn upload
    $uploads['path'] = $custom_dir;
    $uploads['url'] = $custom_url;
    $uploads['subdir'] = '/tranhtomau/' . $post_name;

    return $uploads;
}
add_filter('upload_dir', 'custom_upload_dir');
