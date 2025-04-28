<?php
/**
 * Funciton
 */

//  global $smartkid_options;

global $smartkid_options, $story_options, $login_options, $land_options, $scurity_options;
if ( ! defined( '_S_VERSION' ) ) {
	define( '_S_VERSION', '1.0.0' );

// trinh soan thao co dien
add_filter('use_block_editor_for_post', '__return_false');}

function smartkid_support_setup() {
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	register_nav_menus(
		array(
			'menu-1' => __( 'Trên', 'smartkid' ),
			'menu-2' => __( 'Dưới', 'smartkid' ),
			'menu-3' => __( 'Cao nhất', 'smartkid' ),
		)
	);
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	add_theme_support( 'customize-selective-refresh-widgets' );
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 64,
			'width'       => 300,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'smartkid_support_setup' );
 
function smartkid_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'smartkid_content_width', 640 );
}
add_action( 'after_setup_theme', 'smartkid_content_width', 0 );

// sidebar thanh bên
function smartkid_widgets_init() {
	
	require_once(realpath(dirname(__FILE__)).'/widget/widget.php');
    register_widget('smartkid_post'); 
	register_widget('smartkid_post_slide');
	register_widget('smartkid_categories'); 
	register_widget('smartkid_search');
	register_widget('smartkid_post_views');
	register_widget('smartkid_post_rank');
	register_widget('smartkid_post_banner');
	register_widget('smartkid_post_pro');
	register_widget('smartkid_top_post');
	register_widget('smartkid_post_page'); 
	register_widget('smartkid_post_gradient'); 
	register_widget('smartkid_post_hat'); 
	register_widget('smartkid_categories_img'); 
	register_widget('Smartkid_Post_Box');
	register_widget('smartkid_post_box_recent');
  
	// widget thanh bên
	// if(function_exists('smartkid_mycuz_very') && smartkid_mycuz_very() == 'story'){
	register_sidebar(
		array(
			'name'          => __( 'Thanh bên', 'smartkid' ),
			'id'            => 'sidebar-1',
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	// widget chân trang
	register_sidebar(
		array(
			'name'          => __( 'Chân trang', 'smartkid' ),
			'id'            => 'sidebar-2',
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	// widget giữa trang
	register_sidebar(
		array(
			'name'          => __( 'Giữa trang', 'smartkid' ),
			'id'            => 'sidebar-3',
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	); 
	// widget giua top
	register_sidebar(
		array(
			'name'          => __( 'Giữa top', 'smartkid' ),
			'id'            => 'sidebar-5',
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	// widget duoi cung
	register_sidebar(
		array(
			'name'          => __( 'Dưới cùng', 'smartkid' ),
			'id'            => 'sidebar-6',
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	}
	if (isset($smartkid_options['other1'])){
	// widget duoi cung
	register_sidebar(
		array(
			'name'          => __( 'Rộng top', 'smartkid' ),
			'id'            => 'sidebar-7',
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	// widget duoi cung
	register_sidebar(
		array(
			'name'          => __( 'Rộng bottom', 'smartkid' ),
			'id'            => 'sidebar-8',
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	}
// }
add_action( 'widgets_init', 'smartkid_widgets_init' );


require get_template_directory() . '/inc/custom-color.php';
require get_template_directory() . '/inc/template-functions.php';
require get_template_directory() . '/inc/customizer.php'; 
require get_template_directory() . '/inc/chucnang.php'; 
require get_template_directory() . '/inc/media.php'; 
require get_template_directory() . '/inc/speed.php';
 
// download
if (isset($smartkid_options['set7'])){
	require get_template_directory() . '/inc/metabox-download.php';
}  
// Scurity
if (isset($scurity_options['enable'])){
require get_template_directory() . '/inc/scurity.php';
}
// quan ly admin smartkid theme
include_once (get_template_directory() . '/admin/admin-seting.php');  
include_once (get_template_directory() . '/admin/smartkid-scurity.php');
include_once (get_template_directory() . '/admin/smartkid-media.php'); 

// trinh soan thao co dien
add_filter('use_block_editor_for_post', '__return_false');
// khai bao tai trang bằng ajax
 function smartkid_load_more_scripts()
{
    global $wp_query ;
    ?>
	<script>
	var loadbut = <?php echo json_encode('<img width="55px" src="'.get_template_directory_uri().'/images/loading.gif" />'); ?>;
	var nuttaibut = <?php echo json_encode('<span  class="smartkid-loadmore"><span  class="smartkid-loadmore2"><i class="fa-regular fa-circle-arrow-down"></i> '. __('Tải thêm', 'smartkid') .'</span>'); ?>;
	</script>
    <?php	
    wp_enqueue_script('jquery');
    if( is_home() ) {
        
    	wp_enqueue_script( 'ajax-pagination-script', get_template_directory_uri() . '/js/ajax-pagination.js', array( 'jquery' ) );
	
        
    }
    wp_localize_script( 'ajax-pagination-script', 'smartkid_loadmore_params', array(
        'ajaxurl' => site_url() . '/wp-admin/admin-ajax.php', 
        'posts' => json_encode($wp_query->query_vars), 
        'current_page' => get_query_var('paged') ? get_query_var('paged') : 1,
        'max_page' => $wp_query->max_num_pages
    ));
 	wp_enqueue_script('myloadmore');
}
add_action('wp_enqueue_scripts', 'smartkid_load_more_scripts');
// thực thi tải trang ajax 
function smartkid_loadmore_ajax_handler()
{
    $args = json_decode(stripslashes($_POST['query'] ), true);
    $args['paged'] = $_POST['page'] + 1; 
    $args['post_status'] = 'publish';
    query_posts( $args );
 
    if(have_posts()) :
        while(have_posts()): the_post();
			get_template_part( '/setcard', get_post_type() );
        endwhile;
    endif;
    die;
}
add_action('wp_ajax_loadmore', 'smartkid_loadmore_ajax_handler'); 
add_action('wp_ajax_nopriv_loadmore', 'smartkid_loadmore_ajax_handler'); 

// dat lien ket cố định 
function reset_permalinks() {
    global $wp_rewrite;
    $wp_rewrite->set_permalink_structure( '/%postname%/' );
}
add_action( 'init', 'reset_permalinks' );

// xoa srcset image anh content
function smartkid_wp_responsive_images() {
	return 1;
}
add_filter('max_srcset_image_width', 'smartkid_wp_responsive_images');
if(isset($smartkid_options['speed1']) && isset($smartkid_options['speed2'])){
// thêm class lazyload cho hình ảnh the content
function smartkid_img_content($content) {
   global $post;
   $imglazy = 'src="'.get_template_directory_uri().'/images/anh-dai-dien.jpg" data-';
   $search ="/<img(.*?)class=\"(.*?)\"(.*?)\s(.*?)>/i";
   $rum = '<img$1class="$2 lazyload" '.$imglazy.'$4>';
   $content = preg_replace($search, $rum, $content);
   return $content;
}
add_filter('the_content', 'smartkid_img_content');
}
// Goi ajax cho search
function smartkid_get_ajax_search() {
?>
<script type="text/javascript">
function smartkidsearch(){

    jQuery.ajax({
        url: '<?php echo admin_url('admin-ajax.php'); ?>',
        type: 'post',
        data: { action: 'smartkid_data_ajax_search', keyword: jQuery('#searchbox').val() },
        success: function(data) {
            jQuery('#smartkid-ajax-get').html( data );
        }
    });

}
</script>
<?php
}
add_action( 'wp_footer', 'smartkid_get_ajax_search' );
// Form tim kiem smartkid ajax search
function smartkid_data_ajax_search(){
    $the_query = new WP_Query( array( 'posts_per_page' => 5, 's' => esc_attr( $_POST['keyword'] ), 'post_type' => 'post' ) );
    if( $the_query->have_posts() ) :
        echo '<div id="smartkid-ajax-box">';
        while( $the_query->have_posts() ): $the_query->the_post(); ?>

            <div class="lq-widget-post">
			<div class="wg-image">
				<?php if ( has_post_thumbnail()) { ?>
				<a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>"><img width="200" height="113" title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>" class="lazyload" <?php if(isset($smartkid_options['speed1']) && isset($smartkid_options['speed2'])){echo 'src="'.get_template_directory_uri().'/images/anh-dai-dien.jpg" data-';} ?>src="<?php echo get_the_post_thumbnail_url (get_the_ID()); ?>" /></a>
				<?php }
				// anh dai dien tu dong lay anh dau tien
				else if (!empty(smartkid_anh_dai_dien_nho())){ ?>
				<a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>"><img width="200" height="113" title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>" class="lazyload" <?php if(isset($smartkid_options['speed1']) && isset($smartkid_options['speed2'])){echo 'src="'.get_template_directory_uri().'/images/anh-dai-dien.jpg" data-';} ?>src="<?php echo smartkid_anh_dai_dien_nho(); ?>"/></a>
				<?php } ?>
				</div>
				<div>
				<h3 class="title-post"><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php echo wp_trim_words( get_the_title() , 23 ) ?></a></h3>
				<span class="title-post-time"><i class="fa-regular fa-clock"></i> <?php $timeago = smartkid_time(get_the_time('U'), current_time('timestamp')); if ($timeago == false) { the_time('d/m/Y'); } else { echo $timeago . ' '. __('trước', 'smartkid'); } ?></span>
			</div>
		</div>

        <?php endwhile;
        echo '</div>';
        wp_reset_postdata();  
    endif;
    die();
}
add_action('wp_ajax_smartkid_data_ajax_search' , 'smartkid_data_ajax_search');
add_action('wp_ajax_nopriv_smartkid_data_ajax_search','smartkid_data_ajax_search');
// Thay doi qua widget classic
add_filter( 'gutenberg_use_widgets_block_editor', '__return_false' );
add_filter( 'use_widgets_block_editor', '__return_false' );

function auto_assign_attachment_category($post_id) {
    if (wp_is_post_autosave($post_id) || wp_is_post_revision($post_id)) {
        return;
    }

    $categories = wp_get_post_categories($post_id);
    if (!empty($categories)) {
        $attachments = get_attached_media('', $post_id);
        foreach ($attachments as $attachment) {
            wp_set_post_categories($attachment->ID, $categories);
        }
    }
}
add_action('save_post', 'auto_assign_attachment_category');

// Thêm meta box vào bài viết
function add_stick_post_meta_box() {
    add_meta_box(
        'stick_post_meta_box', // ID của meta box
        'Stick Post', // Tiêu đề
        'stick_post_meta_box_callback', // Hàm callback
        'post', // Loại post (bài viết)
        'side', // Vị trí hiển thị
        'high' // Độ ưu tiên
    );
}
add_action('add_meta_boxes', 'add_stick_post_meta_box');

// Hiển thị checkbox trong meta box
function stick_post_meta_box_callback($post) {
    $value = get_post_meta($post->ID, '_stick_post', true);
    ?>
    <label>
        <input type="checkbox" name="stick_post" value="1" <?php checked($value, '1'); ?> />
        Ghim bài viết
    </label>
    <?php
}

// Lưu dữ liệu khi lưu bài viết
function save_stick_post_meta($post_id) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!isset($_POST['stick_post']) || !wp_verify_nonce($_POST['_wpnonce'], 'update-post_' . $post_id)) return;

    $value = isset($_POST['stick_post']) ? '1' : '0';
    update_post_meta($post_id, '_stick_post', $value);
}
add_action('save_post', 'save_stick_post_meta');

function enable_webp_uploads($mime_types) {
    $mime_types['webp'] = 'image/webp'; 
    return $mime_types;
}
add_filter('upload_mimes', 'enable_webp_uploads');


function dequeue_plugin_scripts() {
    if (!is_single()) { // Không phải trang bài viết thì xóa script
        wp_dequeue_script('svg-coloring'); 
        wp_dequeue_script('kk-star-ratings'); 
    }
}
add_action('wp_enqueue_scripts', 'dequeue_plugin_scripts', 20);


function auto_set_image_meta_on_upload($attachment_ID) {
    $attachment = get_post($attachment_ID);
    if (!$attachment || $attachment->post_type !== 'attachment') {
        return;
    }

    // Lấy bài viết chứa ảnh (nếu có)
    $parent_post_ID = $attachment->post_parent;
    $title = get_the_title($parent_post_ID); // Tiêu đề bài viết

    // Nếu không có bài viết, dùng tên file ảnh làm tiêu đề
    if (!$title) {
        $title = pathinfo($attachment->post_name, PATHINFO_FILENAME);
    }

    // Cập nhật Alt text, Caption và Description
    update_post_meta($attachment_ID, '_wp_attachment_image_alt', $title);
    wp_update_post(array(
        'ID'           => $attachment_ID,
        'post_title'   => $title,  // Đặt tiêu đề ảnh 
        'post_content' => $title   // Description
    ));
} 
add_action('add_attachment', 'auto_set_image_meta_on_upload');

add_filter('wp_handle_upload', 'convert_image_to_webp_except_png_and_webp');

function convert_image_to_webp_except_png_and_webp($upload) {
    $file_path = $upload['file'];
    $file_type = wp_check_filetype($file_path);
    $mime_type = $file_type['type'];

    // Bỏ qua PNG và WEBP
    if (in_array($mime_type, ['image/png', 'image/webp', 'image/gif'])) {
        return $upload;
    }

    // Kiểm tra nếu là ảnh JPEG
    if ($mime_type === 'image/jpeg') {
        $image = imagecreatefromjpeg($file_path);

        if ($image !== false) {
            $webp_path = preg_replace('/\.(jpe?g)$/i', '.webp', $file_path);
            imagewebp($image, $webp_path, 95); // 95 = chất lượng WebP

            imagedestroy($image);

            // Xóa file gốc JPEG
            unlink($file_path);

            // Đổi lại đường dẫn trong mảng kết quả
            $upload['file'] = $webp_path;
            $upload['url'] = preg_replace('/\.(jpe?g)$/i', '.webp', $upload['url']);
            $upload['type'] = 'image/webp';
        }
    }

    return $upload;
}

