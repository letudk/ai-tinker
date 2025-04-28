<?php
// ramdam bài viết ở top face
function smartkid_randomize_posts( $sql_query, $query ) {
    $rand = (int) $query->get( '_randomize_posts_count' );
    if( $rand ) {
        $found_rows = '';
        if( stripos( $sql_query, 'SQL_CALC_FOUND_ROWS' ) !== FALSE ) {
            $found_rows = 'SQL_CALC_FOUND_ROWS';
            $sql_query = str_replace( 'SQL_CALC_FOUND_ROWS ', '', $sql_query );
        }
        $sql_query = sprintf( 'SELECT %s wp_posts.* from ( %s ) wp_posts ORDER BY rand() LIMIT %d', $found_rows, $sql_query, $rand );
    }
    return $sql_query;
}
add_filter( 'posts_request', 'smartkid_randomize_posts', 10, 2 );
// ảnh đại diện bài viết nhỏ
function smartkid_anh_dai_dien_nho() {
    echo "<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 160 90' fill='none' stroke='black' stroke-width='1'>
  <rect x='1.5' y='1.5' width='157' height='87' rx='10' stroke='black' fill='white'/>
  <path d='M25 70l30-40 20 25 20-20 30 35' stroke='black' fill='none' stroke-linecap='round' stroke-linejoin='round'/>
  <circle cx='20' cy='25' r='6' fill='white' stroke='black'/>
</svg>
";
}
// thoi gian tinh theo ngay thang nam
function smartkid_time($from, $to = '') { 
    if (empty($to))
        $to = time();
    $diff = (int) abs($to - $from);
    if ($diff < HOUR_IN_SECONDS) {
        $mins = round($diff / MINUTE_IN_SECONDS);
        if ($mins <= 1)
            $mins = 1;
        /* translators: min=minute */
        $since = sprintf(_n(__('%s phút', 'smartkid'), __('%s phút', 'smartkid'), $mins), $mins);
    } elseif ($diff < DAY_IN_SECONDS && $diff >= HOUR_IN_SECONDS) {
        $hours = round($diff / HOUR_IN_SECONDS);
        if ($hours <= 1)
            $hours = 1;
        $since = sprintf(_n(__('%s giờ', 'smartkid'), __('%s giờ', 'smartkid'), $hours), $hours);
    } elseif ($diff < WEEK_IN_SECONDS && $diff >= DAY_IN_SECONDS) {
        $days = round($diff / DAY_IN_SECONDS);
        if ($days <= 1)
            $days = 1;
        $since = sprintf(_n(__('%s ngày', 'smartkid'), __('%s ngày', 'smartkid'), $days), $days);
    } elseif ($diff < 30 * DAY_IN_SECONDS && $diff >= WEEK_IN_SECONDS) {
        $weeks = round($diff / WEEK_IN_SECONDS);
        if ($weeks <= 1)
            $weeks = 1;
        $since = sprintf(_n(__('%s tuần', 'smartkid'), __('%s tuần', 'smartkid'), $weeks), $weeks);
    } elseif ($diff < YEAR_IN_SECONDS && $diff >= 30 * DAY_IN_SECONDS) {
        $months = round($diff / (30 * DAY_IN_SECONDS));
        if ($months <= 1) $months = 1; $since = sprintf(_n(__('%s tháng', 'smartkid'), __('%s tháng', 'smartkid'), $months), $months); } elseif ($diff >= YEAR_IN_SECONDS) {
        $years = round($diff / YEAR_IN_SECONDS);
        if ($years <= 1)
            $years = 1;
        $since = sprintf(_n(__('%s năm', 'smartkid'), __('%s năm', 'smartkid'), $years), $years);
    }
    return $since;

}
// get code setting
$smartkid_options = get_option('smartkid_settings');
if (function_exists('smartkid_admin_view_script_v1') && smartkid_admin_view_script_v1() == 'full'){
$scurity_options = get_option('scurity_settings');
$media_options = get_option('media_settings');
$addcode_options = get_option('addcode_settings');
$adsense_options = get_option('adsense_settings');
$notify_options = get_option('notify_settings');
$comment_options = get_option('comment_settings');
$onchat_options = get_option('onchat_settings');  
$login_options = get_option('login_settings');
$error_options = get_option('error_settings');
}
// loai page ra khoi tim kiem
function smartkid_remove_searchpage($query) {
if ( is_admin() || ! $query->is_main_query() )
return;
if ($query->is_search) {
$query->set('post_type', 'post');
}
return $query;
}
add_filter('pre_get_posts','smartkid_remove_searchpage');

// them id cho the h1 h2 o bai viet
function smartkid_add_headings( $content ) {
        $heading_count = 0;
        $content = preg_replace_callback( '/(\<h[1-6](.*?))\>(.*)(<\/h[1-6]>)/i', function( $matches ) use ( &$heading_count ) {
            if ( ! stripos( $matches[0], 'id=' ) ) {
                $heading_count++;
                $matches[0] = $matches[1] . $matches[2] . ' id="tocbot-' . $heading_count . '">' . $matches[3] . $matches[4];
            }
            return $matches[0];
        }, $content );
        return $content;
    
}
add_filter( 'the_content', 'smartkid_add_headings' );
// kiem tra the h trong bai viet de check tocbot
function smartkid_has_heading($content) {
    $pattern = '/<h[1-6][^>]*>.*<\/h[1-6]>/i'; 
    if (preg_match($pattern, $content)) {
        return true;
    }
    return false;
}
// add js css 
function smartkid_enqueue_assets(){
global $smartkid_options;
$smartkid_options = get_option('smartkid_settings', array());

// chuc nang
if(isset($smartkid_options['speed1']) && isset($smartkid_options['speed2'])){
wp_enqueue_script( 'img-lazy', get_template_directory_uri() . '/inc/js/lazysizes.min.js', array('jquery'), '', true);
}

wp_enqueue_script( 'chucnang', get_template_directory_uri() . '/inc/js/chucnang.js', array('jquery'), '', true);
 
// js tối ưu hoá
if(isset($smartkid_options['speed1']) && isset($smartkid_options['speed3']) && !is_user_logged_in()) {
wp_enqueue_script( 'lazyload', get_template_directory_uri() . '/js/lazyload.min.js', array('jquery'), '', true);
}
if( is_single() ) {
wp_enqueue_script( 'tocbotjs', get_template_directory_uri() . '/inc/js/tocbot.min.js');
wp_enqueue_style('tocbotcss', get_template_directory_uri() . '/inc/css/tocbot.css');
if(isset($smartkid_options['set2'])) {
wp_enqueue_script( 'fancybox', get_template_directory_uri() . '/inc/js/fancybox.js');
wp_enqueue_style('fancybox', get_template_directory_uri() . '/inc/css/fancybox.css');
}
}
}
add_action('wp_enqueue_scripts', 'smartkid_enqueue_assets');
 
// load fonts 
function smartkid_add_font() {
    global $smartkid_options;
    
    $font = isset($smartkid_options['font']) ? $smartkid_options['font'] : 'Default';

    // Danh sách font
    $fontFamilies = [
        'Default' => 'BeVietnamPro, sans-serif',
        'Arial' => 'Arial, Helvetica, sans-serif', 
        'BeVietnamPro' => 'BeVietnamPro, sans-serif', 
    ];

    // Nếu dùng BeVietnamPro, load file CSS chứa font-face
    if ($font === 'BeVietnamPro') {
        wp_enqueue_style('smartkid-local-fonts', get_template_directory_uri() . '/fonts/local-fonts.css', [], null);
    }

    // Lấy font-family để chèn inline CSS
    $fontFamily = isset($fontFamilies[$font]) ? $fontFamilies[$font] : '';

    // Nếu không phải Default, chèn CSS inline
    if ($font !== 'Default' && !empty($fontFamily)) {
        $custom_css = "
            body, button, input, textarea, select, html {
                font-family: {$fontFamily} !important;
            }";
        wp_add_inline_style('smartkid-local-fonts', $custom_css);
    }
}
add_action('wp_enqueue_scripts', 'smartkid_add_font');

// Khởi chạy chức năng tối ưu hoá cho website----------------------------------------------------------------------------------------------
global $smartkid_options;
$smartkid_options = get_option('smartkid_settings', array());

if(isset($smartkid_options['speed1']) && isset($smartkid_options['speed3'])) {
// tai cham js tang toc site
function smartkid_defer_parsing_of_jss( $url ) {
	if ( is_user_logged_in() || strpos( $url, '.js' ) === false ) {
    return $url; 
	}
	if ( strpos( $url, 'lazyload.min.js' ) !== false || strpos( $url, 'lazysizes.min.js' ) !== false 
    || strpos( $url, 'chucnang.js' ) !== false   ){
    return $url;
	}
	return str_replace( ' src', ' type="rocketlazyloadscript" src', $url );
}
add_filter( 'script_loader_tag', 'smartkid_defer_parsing_of_jss', 10 );
}
// Khởi chạy chức năng tối ưu hoá cho website----------------------------------------------------------------------------------------------
// Add tự động trang chuyển hướng liên kết
$link_inc1 = "Link";
$args = array(
    'post_type' => 'page',
	'post_status' => array( 'publish', 'trash' ),
    'posts_per_page' => 1,
    'title' => $link_inc1,
);
$query = new WP_Query( $args );
if ( !$query->have_posts() ) {
$my_post_inc1 = array(
	  'import_id'			  => 3000,
      'post_title'    => $link_inc1,
      'post_status'   => 'publish',
	  'page_template' => 'link.php',
      'post_author'   => 1,
      'post_type'     => 'page',
	  'post_name'     => 'link'
    );
 wp_insert_post( $my_post_inc1 );
}
// remove chuyenmuc: title, lưu trữ, tác gia
add_filter('get_the_archive_title', function ($title) {
    if (is_category()) {
        $title = single_cat_title('', false);
    } elseif (is_tag()) {
        $title = single_tag_title('', false);
    } elseif (is_author()) {
        $title = '<span class="vcard">' . get_the_author() . '</span>';
    } elseif (is_tax()) { 
        $title = sprintf(__('%1$s'), single_term_title('', false));
    } elseif (is_post_type_archive()) {
        $title = post_type_archive_title('', false);
    }
    return $title;
});
// Code Đếm lượt xem bài viết
function getPostViews($postID, $is_single = true){
global $post;
if(!$postID) $postID = $post->ID;
$count_key = 'post_views_count';
$count = get_post_meta($postID, $count_key, true);
if(!$is_single){
return '<span class="svl_show_count_only">'.$count.' '. __('tải về', 'smartkid') .'</span>';
}
$nonce = wp_create_nonce('smartkid_count_post');
if($count == "0" || empty($count) || !isset($count)){
delete_post_meta($postID, $count_key);
add_post_meta($postID, $count_key, '0');
return '<span class="svl_post_view_count" data-id="'.$postID.'" data-nonce="'.$nonce.'">0 '.__('tải về', 'smartkid') .'</span>';
}
return '<span class="svl_post_view_count" data-id="'.$postID.'" data-nonce="'.$nonce.'">'.$count.' '. __('tải về', 'smartkid') .'</span>';
}
function setPostViews($postID) {
$count_key = 'post_views_count';
$count = get_post_meta($postID, $count_key, true);
if($count == "0" || empty($count) || !isset($count)){
add_post_meta($postID, $count_key, 1);
update_post_meta($postID, $count_key, 1);
}else{
$count++;
update_post_meta($postID, $count_key, $count);
}
}
add_action( 'wp_ajax_svl-ajax-counter', 'svl_ajax_callback' );
add_action( 'wp_ajax_nopriv_svl-ajax-counter', 'svl_ajax_callback' );
function svl_ajax_callback() {
if ( !wp_verify_nonce( $_REQUEST['nonce'], "smartkid_count_post")) {
exit();
}
$count = 0;
if ( isset( $_GET['p'] ) ) {
global $post;
$postID = intval($_GET['p']);
$post = get_post( $postID );
if($post && !empty($post) && !is_wp_error($post)){
setPostViews($post->ID);
$count_key = 'post_views_count';
$count = get_post_meta($postID, $count_key, true);
}
}
die($count.' '. __('tải về', 'smartkid'));
}
add_action( 'wp_footer', 'svl_ajax_script', PHP_INT_MAX );
function svl_ajax_script() {
if(!is_single()) return;
?>
<script <?php global $smartkid_options; if(isset($smartkid_options['speed1']) && isset($smartkid_options['speed3']) && !is_user_logged_in()){ ?>type="rocketlazyloadscript" defer<?php } ?>>
(function($){
$(document).ready( function() {
$('.svl_post_view_count').each( function( i ) {
var $id = $(this).data('id');
var $nonce = $(this).data('nonce');
var t = this;
$.get('<?php echo admin_url( 'admin-ajax.php' ); ?>?action=svl-ajax-counter&nonce='+$nonce+'&p='+$id, function( html ) {
$(t).html( html );
});
});
});
})(jQuery);
</script>
<?php
}
//CODE HIEN THI SO LUOT XEM BAI VIET TRONG DASHBOARDH
add_filter('manage_posts_columns', 'posts_column_views');
add_action('manage_posts_custom_column', 'posts_custom_column_views',5,2);
function posts_column_views($defaults){
$defaults['post_views'] = __( 'Tải về' , 'smartkid');
return $defaults;
}
function posts_custom_column_views($column_name, $id){
if( $column_name === 'post_views' ) {
echo getPostViews( get_the_ID(), false);
}
}
// thong bao loi
add_filter('wp_die_handler', 'get_my_custom_die_handler');
function get_my_custom_die_handler() {
    return 'my_custom_die_handler';
}
function my_custom_die_handler($message, $title='', $args=array()) {
 $errorTemplate = get_theme_root().'/'.get_template().'/eror.php';
 if(!is_admin() && file_exists($errorTemplate)) {
    $defaults = array( 'response' => 500 );
    $r = wp_parse_args($args, $defaults);
    $have_gettext = function_exists('__');
    if ( function_exists( 'is_wp_error' ) && is_wp_error( $message ) ) {
        if ( empty( $title ) ) {
            $error_data = $message->get_error_data();
            if ( is_array( $error_data ) && isset( $error_data['title'] ) )
                $title = $error_data['title'];
        }
        $errors = $message->get_error_messages();
        switch ( count( $errors ) ) :
        case 0 :
            $message = '';
            break;
        case 1 :
            $message = "<div>{$errors[0]}</div>";
            break;
        default :
            $message = "<ul>\n\t\t<li>" . join( "</li>\n\t\t<li>", $errors ) . "</li>\n\t</ul>";
            break;
        endswitch;
    } elseif ( is_string( $message ) ) {
        $message = "<p>$message</p>";
    }
    if ( isset( $r['back_link'] ) && $r['back_link'] ) {
        $back_text = $have_gettext? '<i class="fa-solid fa-arrow-left"></i> '. __('Trở lại', 'smartkid')  : '<i class="fa-solid fa-arrow-left"></i> '. __('Trở lại', 'smartkid');
        $message .= "\n<div class='backcomen'><a href='javascript:history.back()'>$back_text</a></div>";
    }
    if ( empty($title) )
        $title = $have_gettext ? 'WordPress &rsaquo; Error' : 'WordPress &rsaquo; Error';
    require_once($errorTemplate);
    die();
 } else {
    _default_wp_die_handler($message, $title, $args);
 }
}
// shortcode ghi chu download ---------------------------------------------------------------------
function taoghichu($args, $content) {
	return "<div class='ghichu'>".$content."</div>";
}
add_shortcode( 'note', 'taoghichu' );
// shortcode dowload adnroid, ios, windows, mac, linux
function create_tai_shortcode($args, $content) {
        return "
<div class='smartkidtai'><a target='_blank' href='/link?url=".bin2hex($content)."' ><i class='fas fa-arrow-circle-down'></i><span>". __(' TẢI NGAY', 'smartkid') ."</span></a></div>
";
}
add_shortcode( 'tai', 'create_tai_shortcode' );
function create_tai1_shortcode($args, $content) {
        return "
<div class='smartkidtai'><a target='_blank' href='/link?url=".bin2hex($content)."' ><i class='fab fa-windows'></i><span>". __(' TẢI NGAY', 'smartkid') ."</span></a></div>
";
}
add_shortcode( 'windows', 'create_tai1_shortcode' );
function create_tai2_shortcode($args, $content) {
        return "
<div class='smartkidtai'><a target='_blank' href='/link?url=".bin2hex($content)."' ><i class='fab fa-apple'></i><span>". __(' TẢI NGAY', 'smartkid') ."</span></a></div>
";
}
add_shortcode( 'macos', 'create_tai2_shortcode' );
function create_tai3_shortcode($args, $content) {
        return "
<div class='smartkidtai'><a target='_blank' href='/link?url=".bin2hex($content)."' ><i class='fab fa-ubuntu'></i><span>". __(' TẢI NGAY', 'smartkid') ."</span></a></div>
";
}
add_shortcode( 'linux', 'create_tai3_shortcode' );
function create_tai4_shortcode($args, $content) {
        return "
<div class='smartkidtai'><a target='_blank' href='/link?url=".bin2hex($content)."' ><i class='fab fa-google-play'></i><span>". __(' TẢI NGAY', 'smartkid') ."</span></a></div>
";
}
add_shortcode( 'android', 'create_tai4_shortcode' );
function create_tai5_shortcode($args, $content) {
        return "
<div class='smartkidtai'><a target='_blank' href='/link?url=".bin2hex($content)."' ><i class='fa-brands fa-app-store-ios'></i><span>". __(' TẢI NGAY', 'smartkid') ."</span></a></div>
";
}
add_shortcode( 'ios', 'create_tai5_shortcode' );
function create_tai6_shortcode($args, $content) {
        return "
<div class='smartkidtai'><a target='_blank' href='/link?url=".bin2hex($content)."' ><i class='fab fa-wordpress'></i><span>". __(' TẢI NGAY', 'smartkid') ."</span></a></div>
";
}
add_shortcode( 'wordpress', 'create_tai6_shortcode' );
// shortcode download nhay giay
static $tai_id = 1;
function create_tai7_shortcode($args, $content) {
global $smartkid_options, $tai_id;
$tai_id++;
ob_start(); ?>
<div class="smartkidtai"><a id="dow-<?php echo $tai_id; ?>"><i class='fas fa-arrow-circle-down'></i><span><?php _e(' TẢI NGAY', 'smartkid'); ?></span> <b style="color:#ff4444;margin-left:10px;" id="box-<?php echo $tai_id; ?>"><span id="giay-<?php echo $tai_id; ?>"></span></b></a></div>
<script <?php global $smartkid_options; if(isset($smartkid_options['speed1']) && isset($smartkid_options['speed3']) && !is_user_logged_in()){ ?>type="rocketlazyloadscript" defer<?php } ?>>
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
    var content = "<?php echo $content; ?>"; 
    var id = "<?php echo $tai_id; ?>";
    var giayId = "#giay-" + id;
    var boxId = "#box-" + id;
    var get = content.replace(/\/file\/d\/(.+)\/(.+)/, "/uc?export=download&id=$1");
    o("#dow-" + id).click(function() {
        d(giayId, boxId, get);
    });
});
</script>
<?php 
$tais = ob_get_clean(); 
return $tais;
}
add_shortcode( 'tais', 'create_tai7_shortcode' ); 
// tạo phân trang cho custom post 
function myPaginateLinks( WP_Query $wp_query, $args = '' ) {
    global $wp_rewrite, $pagez, $onpage;

    // Setting up default values based on the current URL.
    $pagenum_link = html_entity_decode( get_pagenum_link() );
    $url_parts    = explode( '?', $pagenum_link );

    // Get max pages and current page out of the current query, if available.
    $total   = isset( $wp_query->max_num_pages ) ? $wp_query->max_num_pages : 1;
    $current = !empty($_GET['pg'. $pagez]) ? absint($_GET['pg'. $pagez]) : 1;

    // Append the format placeholder to the base URL.
    $pagenum_link = trailingslashit( $url_parts[0] ) . '%_%';

    // URL base depends on permalink settings.
    $format  = $wp_rewrite->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
    $format .= '?pg'.$pagez.'=%#%#onpage'. $onpage;

    $defaults = array(
        'base'               => $pagenum_link, // http://example.com/all_posts.php%_% : %_% is replaced by format (below).
        'format'             => $format, // ?page=%#% : %#% is replaced by the page number.
        'total'              => $total,
        'current'            => $current,
        'aria_current'       => 'page',
        'show_all'           => false,
        'prev_next'          => true,
        'prev_text'          => '&#10094;',
        'next_text'          => '&#10095;',
        'end_size'           => 1,
        'mid_size'           => 2,
        'type'               => 'plain',
        'add_args'           => array(), // Array of query args to add.
        'add_fragment'       => '',
        'before_page_number' => '',
        'after_page_number'  => '',
    );

    $args = wp_parse_args( $args, $defaults );

    if ( ! is_array( $args['add_args'] ) ) {
        $args['add_args'] = array();
    }

    // Merge additional query vars found in the original URL into 'add_args' array.
    if ( isset( $url_parts[1] ) ) {
        // Find the format argument.
        $format       = explode( '?', str_replace( '%_%', $args['format'], $args['base'] ) );
        $format_query = isset( $format[1] ) ? $format[1] : '';
        wp_parse_str( $format_query, $format_args );

        // Find the query args of the requested URL.
        wp_parse_str( $url_parts[1], $url_query_args );

        // Remove the format argument from the array of query arguments, to avoid overwriting custom format.
        foreach ( $format_args as $format_arg => $format_arg_value ) {
            unset( $url_query_args[ $format_arg ] );
        }

        $args['add_args'] = array_merge( $args['add_args'], urlencode_deep( $url_query_args ) );
    }

    // Who knows what else people pass in $args.
    $total = (int) $args['total'];
    if ( $total < 2 ) {
        return;
    }
    $current  = (int) $args['current'];
    $end_size = (int) $args['end_size']; // Out of bounds? Make it the default.
    if ( $end_size < 1 ) {
        $end_size = 1;
    }
    $mid_size = (int) $args['mid_size'];
    if ( $mid_size < 0 ) {
        $mid_size = 2;
    }

    $add_args   = $args['add_args'];
    $r          = '';
    $page_links = array();
    $dots       = false;

    if ( $args['prev_next'] && $current && 1 < $current ) :
        $link = str_replace( '%_%', 2 == $current ? '' : $args['format'], $args['base'] );
        $link = str_replace( '%#%', $current - 1, $link );
        if ( $add_args ) {
            $link = add_query_arg( $add_args, $link );
        }
        $link .= $args['add_fragment'];

        $page_links[] = sprintf(
            '<a class="prev page-numbers" href="%s">%s</a>',
            /**
             * Filters the paginated links for the given archive pages.
             *
             * @since 3.0.0
             *
             * @param string $link The paginated link URL.
             */
            esc_url( apply_filters( 'paginate_links', $link ) ),
            $args['prev_text']
        );
    endif;

    for ( $n = 1; $n <= $total; $n++ ) :
        if ( $n == $current ) :
            $page_links[] = sprintf(
                '<span aria-current="%s" class="page-numbers current">%s</span>',
                esc_attr( $args['aria_current'] ),
                $args['before_page_number'] . number_format_i18n( $n ) . $args['after_page_number']
            );

            $dots = true;
        else :
            if ( $args['show_all'] || ( $n <= $end_size || ( $current && $n >= $current - $mid_size && $n <= $current + $mid_size ) || $n > $total - $end_size ) ) :
                $link = str_replace( '%_%', 1 == $n ? '' : $args['format'], $args['base'] );
                $link = str_replace( '%#%', $n, $link );
                if ( $add_args ) {
                    $link = add_query_arg( $add_args, $link );
                }
                $link .= $args['add_fragment'];

                $page_links[] = sprintf(
                    '<a class="page-numbers" href="%s">%s</a>',
                    /** This filter is documented in wp-includes/general-template.php */
                    esc_url( apply_filters( 'paginate_links', $link ) ),
                    $args['before_page_number'] . number_format_i18n( $n ) . $args['after_page_number']
                );

                $dots = true;
            elseif ( $dots && ! $args['show_all'] ) :
                $page_links[] = '<span class="page-numbers dots">&hellip;</span>';

                $dots = false;
            endif;
        endif;
    endfor;

    if ( $args['prev_next'] && $current && $current < $total ) :
        $link = str_replace( '%_%', $args['format'], $args['base'] );
        $link = str_replace( '%#%', $current + 1, $link );
        if ( $add_args ) {
            $link = add_query_arg( $add_args, $link );
        }
        $link .= $args['add_fragment'];

        $page_links[] = sprintf(
            '<a class="next page-numbers" href="%s">%s</a>',
            /** This filter is documented in wp-includes/general-template.php */
            esc_url( apply_filters( 'paginate_links', $link ) ),
            $args['next_text']
        );
    endif;

    switch ( $args['type'] ) {
        case 'array':
            return $page_links;

        case 'list':
            $r .= "<ul class='page-numbers'>\n\t<li>";
            $r .= implode( "</li>\n\t<li>", $page_links );
            $r .= "</li>\n</ul>\n";
            break;

        default:
            $r = implode( "\n", $page_links );
            break;
    }
    $r = apply_filters( 'paginate_links_output', $r, $args );

    return $r;

}
// popup cookie
if(isset($smartkid_options['web2']) && !is_user_logged_in()){
function smartkid_cookie_popup_footer(){ 
ob_start(); ?>
  <div class="cookiebox" id="cookiebox">
      <div class="cookietitle"><i class="fa-regular fa-cookie-bite"></i> <?php _e('Đồng ý Cookie', 'smartkid'); ?></div>
      <?php _e('Trang web này sử dụng Cookie để nâng cao trải nghiệm duyệt web của bạn và cung cấp các đề xuất được cá nhân hóa. Bằng cách chấp nhận để sử dụng trang web của chúng tôi', 'smartkid'); ?>
      <div class="cookienut">
        <button title="<?php _e('Tôi chấp nhận', 'smartkid'); ?>" class="cookieitem"><?php _e('Tôi chấp nhận', 'smartkid'); ?></button>
      </div>
  </div>
<?php 
echo ob_get_clean();
}
add_action('wp_footer', 'smartkid_cookie_popup_footer');
}
// thanh load trang
if(isset($smartkid_options['web3'])){
function smartkid_line_scroll_footer(){
ob_start();	?>
<div class="line-scroll"><div class="scroll-load"></div></div>
<?php 
echo ob_get_clean();
}
add_action('wp_footer', 'smartkid_line_scroll_footer');
}
// ngan copy va vao f12
if(isset($smartkid_options['web4'])){
function smartkid_block_copy_footer(){ 
ob_start(); ?>
<script>
const disabledKeys = ["c", "C", "x", "J", "u", "I"]; 
  const showAlert = e => {
    e.preventDefault();
    return alert("Sorry, you can't view or copy source codes this way!");
  }
  document.addEventListener("contextmenu", e => {
    showAlert(e); 
  });
  document.addEventListener("keydown", e => {
    if((e.ctrlKey && disabledKeys.includes(e.key)) || e.key === "F12") {
      showAlert(e);
    }
  });
</script>
<?php
echo ob_get_clean(); 
}
add_action('wp_footer', 'smartkid_block_copy_footer');
// Tao trang No javascript
$link_inc2 = "No Javascript";
$args = array(
    'post_type' => 'page',
	'post_status' => array( 'publish', 'trash' ),
    'posts_per_page' => 1,
    'title' => $link_inc2,
);
$query = new WP_Query( $args );
if ( !$query->have_posts() ) {
$my_post_inc2 = array(
	  'import_id'			  => 3001,
      'post_title'    => $link_inc2,
      'post_status'   => 'publish',
	  'page_template' => 'nojavascript.php',
      'post_author'   => 1,
      'post_type'     => 'page',
	  'post_name'     => 'no-javascript'
    );
 wp_insert_post( $my_post_inc2 );
}
} else {
	wp_delete_post(3001);
}
// tao anh dai dien cho taxonomy
class smartkid_add_img_taxonomy{
	private $taxonomies = array('muc', 'type', 'channel', 'color', 'genre', 'loai', 'run', 'category');
    function __construct() {
        foreach ($this->taxonomies as $taxonomy) {
            add_action('admin_footer', array($this, 'add_script_to_admin'));
            add_action(sprintf('%s_add_form_fields', $taxonomy), array($this, 'add_form_fields_meta_fields'));
            add_action(sprintf('%s_edit_form_fields', $taxonomy), array($this, 'edit_form_fields_meta_fields'));
            add_action(sprintf('edited_%s', $taxonomy), array($this, 'save_taxonomy_custom_meta'), 10, 2);
            add_action(sprintf('created_%s', $taxonomy), array($this, 'save_taxonomy_custom_meta'), 10, 2);
            add_filter(sprintf('manage_edit-%s_columns', $taxonomy), array($this, 'add_columns'));
            add_filter(sprintf('manage_%s_custom_column', $taxonomy), array($this, 'add_column_content'), 10, 3);
        }
    }
    function add_script_to_admin(){
        $current_screen = get_current_screen();
        
		$is_edit_screen = false;
		foreach ($this->taxonomies as $taxonomy) {
			if (isset($current_screen->id) && $current_screen->id === 'edit-' . $taxonomy) {
				$is_edit_screen = true;
				break;
			}
		}
		if ((isset($current_screen->base) && !in_array($current_screen->base, array('edit-tags', 'term'))) || !$is_edit_screen) {
			return false;
		}
		
        wp_enqueue_media();
        ?>
        <style>
            .smartkidno_upload_img {
                width: 100%;
                max-width: 800px;
            }
            .smartkidno_upload_img.flex-row {
                align-items: flex-start;
                display: flex;
                flex-flow: row nowrap;
                justify-content: space-between;
                width: 95%;
                height: 100%;
            }
            .smartkidno_upload_img .flex-col {
                max-height: 100%;
            }
            .smartkidno_upload_img .flex-left {
                margin-right: auto;
            }
            .smartkidno_upload_img .flex-right {
                margin-left: auto;
            }
            .smartkidno_upload_img .flex-grow {
                -ms-flex-negative: 1;
                -ms-flex-preferred-size: auto!important;
                flex: 1;
            }
            .smartkidno_upload_img .smartkidno_upload_value {
                margin-bottom: 10px;
            }
            .smartkidno_upload_img .smartkidno_upload_value ~ img {
                width: 100%;
                max-width: 150px;
                height: auto;
            }
            td.thumb.column-thumb img {
                width: 80px;
                height: auto;
            }
            .column-thumb {
                text-align: center;
                width: 80px;
            }
        </style>
        <script>
            jQuery('body').on('click','.smartkidno_upload-btn',function(e){
                e.preventDefault();
                let thisUpload = jQuery(this).parents('.smartkidno_upload_img');
                let meta_image_frame = wp.media.frames.meta_image_frame = wp.media({
                    title: 'Upload Image',
                    button: { text:  'Upload Image' },
                    library: { type: 'image' },
                    multiple: false
                });
                meta_image_frame.on('select', function(){
                    var media_attachment = meta_image_frame.state().get('selection').first().toJSON();
                    if ( media_attachment.url ) {
                        thisUpload.find('.smartkidno_upload_value').val(media_attachment.url);
                        thisUpload.find('img').attr('src', media_attachment.url);
                    }
                });
                meta_image_frame.open();
            });
        </script>
        <?php
    }
    function add_form_fields_meta_fields(){
        ?>
        <div class="form-field term-meta-wrap">
            <label for="term_meta[custom_img]">
                <?php esc_html_e( 'Thêm hình', 'smartkid' ); ?>
            </label>
            <div class="smartkidno_upload_img flex-row">
                <div class="flex-col flex-grow">
                    <input type="text" class="smartkidno_upload_value" name="term_meta[custom_img]" id="term_meta[custom_img]" placeholder="<?php _e( 'Đường dẫn hình ảnh', 'smartkid' )?>" value=""/>
                </div>
                <div class="flex-col"><input type="button" class="smartkidno_upload-btn button" value="<?php _e( 'Chọn Ảnh', 'smartkid' )?>" /></div>
            </div>
        </div>
        <?php
    }
    function edit_form_fields_meta_fields($term){
        $t_id = $term->term_id;
        $term_meta = get_term_meta($t_id,'custom_term_meta', true);
        $custom_img = isset($term_meta['custom_img']) ? esc_attr( $term_meta['custom_img'] ) : '';
        ?>
        <tr class="form-field">
            <th scope="row">
                <label for="term_meta[custom_img]"><?php _e( 'Thêm hình', 'smartkid' ); ?></label>
            </th>
            <td>
                <div class="smartkidno_upload_img flex-row">
                    <div class="flex-col flex-grow">
                        <input type="text" class="smartkidno_upload_value" name="term_meta[custom_img]" id="term_meta[custom_img]" placeholder="<?php _e( 'Đường dẫn hình ảnh', 'smartkid' )?>" value="<?php echo esc_attr(esc_url($custom_img));?>"/>
                        <img src="<?php echo esc_attr(esc_url($custom_img));?>" alt="">
                    </div>
                    <div class="flex-col"><input type="button" class="smartkidno_upload-btn button" value="<?php _e( 'Chọn Ảnh', 'smartkid' )?>" /></div>
                </div>
            </td>
        </tr>
        <?php
    }
    function save_taxonomy_custom_meta($term_id){
        if ( isset( $_POST['term_meta'] ) ) {
            $term_meta = array();
            $cat_keys = array_keys( $_POST['term_meta'] );
            foreach ( $cat_keys as $key ) {
                if ( isset ( $_POST['term_meta'][$key] ) ) {
                    $term_meta[$key] = $_POST['term_meta'][$key];
                }
            }
            update_term_meta($term_id, 'custom_term_meta', $term_meta);
        }
    }
    function add_columns( $columns ) {
        $columns['thumb'] = __('Hình ảnh', 'smartkid');
        return $columns;
    }
    function add_column_content( $content, $column_name, $term_id ) {
        $term_meta = get_term_meta($term_id,'custom_term_meta', true);
        $custom_img = isset($term_meta['custom_img']) ? esc_attr( $term_meta['custom_img'] ) : '';
        switch ( $column_name ) {
            case 'thumb':
                $content = '<img src="'.$custom_img.'" alt="">';
                break;
        }
        return $content;
    }
}
new smartkid_add_img_taxonomy();
// hien thi popup bai viet ngau nhien
if(isset($smartkid_options['web5'])){
function smartkid_popup_post() {
	global $smartkid_options;
    ob_start(); ?>
	<div class="popup-post-box" <?php if(isset($smartkid_options['web53']) && $smartkid_options['web53'] == 'Left') {echo 'style="left:10px;right:auto"';} ?> data-aos="fade-in"><div class="popup-post-tit"><span><i class="fa-regular fa-bolt"></i> <?php _e('Tranh tô màu hấp dẫn khác', 'smartkid'); ?></span> <span><button title="<?php _e('Đóng', 'smartkid'); ?>" onclick="share(event, 'popup-post')"><i class="fa-regular fa-xmark"></i></button></span></div>
	<div class="post-post-card">
	<?php
	if(isset($smartkid_options['web52']) && $smartkid_options['web52'] == 'land') {$post_type_popup = 'land';} 
	
	else {$post_type_popup = 'post';}
	if(!empty($smartkid_options['web51'])){$post_popup_total = $smartkid_options['web51'];} else {$post_popup_total = 10;}
    $smartkidpost = new WP_Query(array(
        'post_type' =>  $post_type_popup,
        'posts_per_page'    =>  $post_popup_total,
		'orderby' => 'rand',
    ));
    if($smartkidpost->have_posts()){ 
        while($smartkidpost->have_posts()): $smartkidpost->the_post(); ?>
        <div class="popup-widget-post">
			<div class="popup-post-img">
				<?php if ( has_post_thumbnail() && empty(get_post_meta( get_the_ID(), 'photo1', true )) && empty(get_post_meta( get_the_ID(), 'youtube1', true ))) { ?>
				<a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>"><img width="150" height="150" title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>" class="lazyload" <?php if(isset($smartkid_options['speed1']) && isset($smartkid_options['speed2'])){echo 'src="'.get_template_directory_uri().'/images/anh-dai-dien.jpg" data-';} ?>src="<?php echo get_the_post_thumbnail_url (get_the_ID()); ?>" /></a>
				<?php }
				// anh dai dien tu dong lay anh dau tien
				else if (!empty(smartkid_anh_dai_dien_nho()) && empty(get_post_meta( get_the_ID(), 'photo1', true )) && empty(get_post_meta( get_the_ID(), 'youtube1', true ))){ ?>
				<a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>"><img width="150" height="150" title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>" class="lazyload" <?php if(isset($smartkid_options['speed1']) && isset($smartkid_options['speed2'])){echo 'src="'.get_template_directory_uri().'/images/anh-dai-dien.jpg" data-';} ?>src="<?php echo smartkid_anh_dai_dien_nho(); ?>"/></a>
				
				<?php // add images slide	
				} else  if(!empty(get_post_meta( get_the_ID(), 'photo1', true ))) {
				$photo1 = get_post_meta(get_the_ID(), 'photo1', true);  
				$photo1 = explode(',', $photo1);
				?>
				<a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>"><img title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>" width="150" height="150" class="lazyload" <?php if(isset($smartkid_options['speed1']) && isset($smartkid_options['speed2'])){echo 'src="'.get_template_directory_uri().'/images/anh-dai-dien.jpg" data-';} ?>src="<?php echo wp_get_attachment_url( $photo1[0] );?>"/></a>
				<!-- video youtube -->
				<?php } else if(!empty(get_post_meta( get_the_ID(), 'youtube1', true ))) { 
				$url = get_post_meta( get_the_ID(), 'youtube1', true );
				parse_str( parse_url( $url, PHP_URL_QUERY ), $link_tube ); $tube = $link_tube['v']; ?>
				<a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>"><img title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>" width="150" height="150" class="lazyload" <?php if(isset($smartkid_options['speed1']) && isset($smartkid_options['speed2'])){echo 'src="'.get_template_directory_uri().'/images/anh-dai-dien.jpg" data-';} ?>src="https://img.youtube.com/vi/<?php echo $tube; ?>/hqdefault.jpg" /></a>
				<?php } ?>
				</div>
				<div>
				<h3 class="title-post"><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php echo wp_trim_words( get_the_title() , 23 ) ?></a></h3>
				<span class="title-post-time"><i class="fa-regular fa-clock"></i> <?php $timeago = smartkid_time(get_the_time('U'), current_time('timestamp')); if ($timeago == false) { the_time('d/m/Y'); } else { echo $timeago . ' '. __('trước', 'smartkid'); } ?></span>
			</div>
		</div>
        <?php endwhile;  }
	wp_reset_query(); ?>
	</div>
	</div>
	<?php
    $result = ob_get_clean(); 
    wp_send_json_success($result); 
    die();
}
add_action( 'wp_ajax_popuppost', 'smartkid_popup_post' );
add_action( 'wp_ajax_nopriv_popuppost', 'smartkid_popup_post' );
// in popup footer hook
function smartkid_popup_post_footer(){
if(is_home() || is_single()){	
ob_start(); ?>
<div id="popup-post" style="display:block" class="popup_post_set"></div>
<script <?php global $smartkid_options; if(isset($smartkid_options['speed1']) && isset($smartkid_options['speed3']) && !is_user_logged_in()){ ?>type="rocketlazyloadscript" defer<?php } ?>>
    (function($){
        $(document).ready(function(){
                $.ajax({
                    type : "post", 
                    dataType : "json", 
                    url : '<?php echo admin_url('admin-ajax.php');?>',
                    data : {
                        action: "popuppost", 
                    },
                    context: this,
                    beforeSend: function(){
                    },
                    success: function(response) {
                        if(response.success) {
                            $('.popup_post_set').html(response.data);
                        }
                        else {
							console.log( 'Unable to randomly load articles');
                        }
                    },
                    error: function( jqXHR, textStatus, errorThrown ){
                            console.log( 'Case: ' + textStatus, errorThrown );
                    }
                })
                return false;
        })
    })(jQuery)
</script>
<?php 
echo ob_get_clean();
}
}
add_action('wp_footer', 'smartkid_popup_post_footer');
}
 
// code hien thi tac gia co nhieu binh luan nhat trong thang
function smartkid_get_top_comment_authors($limit = 6) {
    global $wpdb;
    // Lấy danh sách các ID của người dùng có vai trò 'administrator' và 'editor'
    $excluded_users = get_users(array(
        'role__in' => array('administrator', 'editor'),
        'fields' => 'ID'
    ));
    
    if (!empty($excluded_users)) {
        // Chuyển đổi danh sách ID người dùng thành chuỗi
        $excluded_users_str = implode(',', $excluded_users);
        
        $result = $wpdb->get_results(
            $wpdb->prepare("
                SELECT comment_author, COUNT(comment_author) as comments_count, comment_author_email, comment_author_url
                FROM {$wpdb->comments}
                WHERE comment_date >= %s
                AND comment_approved = '1'
                AND user_id NOT IN ($excluded_users_str)
                GROUP BY comment_author
                ORDER BY comments_count DESC
                LIMIT %d
            ", date('Y-m-d', strtotime('-1 week')), $limit)
        );
        return $result;
    } else {
        return array();
    }
}
// cap nhat bai viet moi len dau trang 
if (isset($smartkid_options['web6'])){
function smartkid_orderby_modified_posts( $query ) {
    if( $query->is_main_query() && !is_admin() ) {
	if ( $query->is_home() || $query->is_category() || $query->is_tag() ) {
            $query->set( 'orderby', 'modified' );
            $query->set( 'order', 'desc' );
	}
    }
}
add_action( 'pre_get_posts', 'smartkid_orderby_modified_posts' );
} 
// tinh nam / thang / ngay dua vao số ngày
function smartkid_forday($days) {
  $years = floor($days / 365);
  $months = floor(($days % 365) / 30);
  $remainingDays = $days % 30;

  if ($days < 30) {
    return sprintf(__('%d ngày', 'smartkid'), $days);
  } elseif ($days < 365) {
    if ($remainingDays == 0) {
      return sprintf(__('%d tháng', 'smartkid'), $months);
    } else {
      return sprintf(__('%d tháng, %d ngày', 'smartkid'), $months, $remainingDays);
    }
  } else {
    if ($months == 0 && $remainingDays == 0) {
      return sprintf(__('%d năm', 'smartkid'), $years);
    } elseif ($months == 0 && $remainingDays != 0) {
      return sprintf(__('%d năm, %d ngày', 'smartkid'), $years, $remainingDays);
    } elseif ($months != 0 && $remainingDays == 0) {
      return sprintf(__('%d năm, %d tháng', 'smartkid'), $years, $months);
    } else {
      return sprintf(__('%d năm, %d tháng, %d ngày', 'smartkid'), $years, $months, $remainingDays);
    }
  }
}
// them ver cho file css js
function smartkid_add_ver_jscss( $url ) {
	$theme_data = wp_get_theme();
    $theme_version = $theme_data->Version;
    return add_query_arg( 'ver', $theme_version, $url );
}
add_filter( 'style_loader_src', 'smartkid_add_ver_jscss' );
add_filter( 'script_loader_src', 'smartkid_add_ver_jscss' ); 

