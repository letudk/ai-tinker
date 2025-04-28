<?php
global $smartkid_options;
// toi uu toc do nang cao cho smartkidtheme

# luu cache lien ket vao browser
if(isset($smartkid_options['speed1']) && isset($smartkid_options['speed5'])){ 
function smartkid_browser_cache() {
    $url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
    $page_content = ob_get_contents();
    $files = array();
    $pattern = '/href\s*=\s*["\']([^"\']+)/i';
    preg_match_all($pattern, $page_content, $matches);
    foreach ($matches[1] as $file) {
        if (strpos($file, 'http') !== 0) {
            $path = $_SERVER['DOCUMENT_ROOT'] . $file;
            if (file_exists($path)) {
                $files[] = $path;
            }
        }
    }
    header("Cache-Control: public, max-age=3600");
    header("Expires: " . gmdate('D, d M Y H:i:s', time() + 3600) . " GMT");
    header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
    foreach ($files as $file) {
        header("Cache-Control: public, max-age=3600");
        header("Expires: " . gmdate('D, d M Y H:i:s', time() + 3600) . " GMT");
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s', filemtime($file)) . ' GMT');
        header('Content-Type: ' . mime_content_type($file));
        readfile($file);
    }
    echo $page_content;
}
add_action('get_header', 'smartkid_browser_cache');
}
# thu vien instant-page.js tai truoc link khi di chuot
if(isset($smartkid_options['speed1']) && isset($smartkid_options['speed6'])){
function smartkid_instantpage_scripts() {
  wp_enqueue_script( 'instantpage', get_template_directory_uri() . '/inc/js/instantpage.js', array(), true );
}
add_action( 'wp_enqueue_scripts', 'smartkid_instantpage_scripts' );
function smartkid_instantpage_loader_tag( $tag, $handle ) {
  if ( 'instantpage' === $handle ) {
    if ( strpos( $tag, 'text/javascript' ) !== false ) {
      $tag = str_replace( 'text/javascript', 'module', $tag );
    }
    else {
      $tag = str_replace( '<script ', "<script type='module' ", $tag );
    }
  }
  return $tag;
}
add_filter( 'script_loader_tag', 'smartkid_instantpage_loader_tag', 10, 2 );
}
# tao file style.min.css tu style.css
function smartkid_generate_minified_css() {
    $theme_dir = get_template_directory();
    $style_file = $theme_dir . '/style.css';
    $minified_file = $theme_dir . '/style.min.css';

    if ( ! file_exists( $minified_file ) ) {
		require_once(get_template_directory() . '/inc/minify-css.php');
        $css = file_get_contents( $style_file );
        $minified_css = Minify_CSS::minify( $css );
        file_put_contents( $minified_file, $minified_css );
    }
}
add_action( 'wp_enqueue_scripts', 'smartkid_generate_minified_css' );
# Minify css 
if(isset($smartkid_options['speed1']) && isset($smartkid_options['speed7'])){
function smartkid_minify_file_css(){
  if (!is_admin()){
    add_filter('style_loader_src', function($href) {
	  $filename = basename($href);
	  $filename = preg_replace('/\?.*/', '', $filename);
	  $filename = urlencode($filename);
	  if (in_array($filename, ['style.css', 'style.min.css'])) {
            return $href;
	  }
      if (strpos($href, 'wp-includes') === false && strpos($href, 'smartkid') !== false) {
        $minified_css = get_template_directory() . '/minify/' . $filename;
        if (file_exists($minified_css)) {
          return str_replace(get_template_directory(), get_template_directory_uri(), $minified_css);
        } else {
		  require_once(get_template_directory() . '/inc/minify-css.php');
          $buffer = file_get_contents($href);
          $minified = Minify_CSS::minify($buffer);
          file_put_contents($minified_css, $minified);
          return str_replace(get_template_directory(), get_template_directory_uri(), $minified_css);
        }
        }
      return $href;
    });
  }
}
add_action('wp_enqueue_scripts', 'smartkid_minify_file_css');
# Minify js
function smartkid_minify_file_js() {
  if (!is_admin()){
    add_filter('script_loader_src', function($src) {
      $filename = basename($src);
      $filename = preg_replace('/\?.*/', '', $filename);
      $filename = urlencode($filename);
      if (in_array($filename, ['smartkidcode.js'])) {
            return $src;
	  }
    if (strpos($src, 'wp-includes') === false && strpos($src, 'smartkid') !== false) {
        $minified_js = get_template_directory() . '/minify/' . $filename;
        if (file_exists($minified_js)) {
            return str_replace(get_template_directory(), get_template_directory_uri(), $minified_js);
        } else {
            require_once(get_template_directory() . '/inc/minify-js.php');
            $buffer = file_get_contents($src);
            $minified = \JShrink\Minifier::minify($buffer);
            file_put_contents($minified_js, $minified);
            return str_replace(get_template_directory(), get_template_directory_uri(), $minified_js);
        }
		}
    return $src;
	});
  }
}
add_action('wp_enqueue_scripts', 'smartkid_minify_file_js');
} else {
	$dir = get_template_directory() . '/minify/';
	$files = glob($dir . '*'); 
	foreach($files as $file){ 
	if(is_file($file)) {
    unlink($file); 
	}
	}
}
#####################################################################################
# Remove jquery-migrate
if(isset($smartkid_options['speedoff'])){
function remove_jquery_migrate( $scripts ) {
   if ( ! is_admin() && isset( $scripts->registered['jquery'] ) ) {
        $script = $scripts->registered['jquery'];
   if ( $script->deps ) { 
        $script->deps = array_diff( $script->deps, array( 'jquery-migrate' ) );
 }
 }
 }
add_action( 'wp_default_scripts', 'remove_jquery_migrate' );
}
# tắt Gutenberg CSS o home
if(isset($smartkid_options['speedoff1'])){
function smartkid_remove_wp_block_library_css() {
    if ( is_front_page() ) {
        wp_dequeue_style( 'wp-block-library' );
        wp_dequeue_style( 'wp-block-library-theme' );
        wp_dequeue_style( 'wc-blocks-style' );
    }
}
add_action( 'wp_enqueue_scripts', 'smartkid_remove_wp_block_library_css', 100 );
}

# tắt Classic CSS o home
if(isset($smartkid_options['speedoff2'])){
function smartkid_classic_styles_off() {
	if ( is_front_page()) {
    wp_dequeue_style( 'classic-theme-styles' );
	}
}
add_action( 'wp_enqueue_scripts', 'smartkid_classic_styles_off', 20 );
}

# tắt emoji 
if(isset($smartkid_options['speedoff3'])){
function smartkid_disable_emojis() {
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );	
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );	
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
}
add_action( 'init', 'smartkid_disable_emojis' );
}
# gioi han so ban ghi trong csdl 
if(isset($smartkid_options['speedcsdl1'])){
function smartkid_limit_post_revisions($num, $post) {
	global $smartkid_options;
	if(!empty($smartkid_options['speedcsdl11'])){
    $limit = $smartkid_options['speedcsdl11'];
	} else {
	$limit = 3;	
	}
    return $limit;
}
add_filter('wp_revisions_to_keep', 'smartkid_limit_post_revisions', 10, 2);	
}

# nhan nut xoa ban luu tu dong trong csdl
function smartkid_delete_auto_drafts() {
    global $wpdb;
    $sql = "DELETE FROM {$wpdb->posts} WHERE `post_status` = 'auto-draft'";
    
    try {
        $wpdb->query($sql);
        return true;
    } catch (Exception $e) {
        return 'Lỗi! ' . $wpdb->last_error;
    }
}
add_action('wp_ajax_delete_auto_drafts', 'smartkid_delete_auto_drafts');
add_action('wp_ajax_nopriv_delete_auto_drafts', 'smartkid_delete_auto_drafts');
# nhan nut xoa het ban ghi tam trong csdl làm sach csdl
function smartkid_delete_post_revisions() {
    global $wpdb;
    $sql = 'DELETE FROM `' . $wpdb->prefix . 'posts` WHERE `post_type` = %s;';
    try {
        $wpdb->query($wpdb->prepare($sql, array('revision')));
		return true;
    } catch (Exception $e) {
        return 'Error! ' . $wpdb->last_error;
    }
}
add_action('wp_ajax_delete_revisions', 'smartkid_delete_post_revisions');
add_action('wp_ajax_nopriv_delete_revisions', 'smartkid_delete_post_revisions');
# xoa tat ca bai trong thung rac
function smartkid_delete_all_trashed_posts() {
    global $wpdb;
    $sql = "DELETE FROM {$wpdb->posts} WHERE `post_status` = 'trash'";
    try {
        $wpdb->query($sql);
        return true;
    } catch (Exception $e) {
        return 'Lỗi! ' . $wpdb->last_error;
    }
}
add_action('wp_ajax_delete_all_trashed_posts', 'smartkid_delete_all_trashed_posts');
add_action('wp_ajax_nopriv_delete_all_trashed_posts', 'smartkid_delete_all_trashed_posts');


###################################################################################
# tri hoản tai link từ google
function smartkid_sleep_google_link() {
  if (!is_admin()) {
    add_filter('wp_resource_hints', function($hints, $relation_type) {
      if ($relation_type == 'dns-prefetch') {
        foreach ($hints as $key => $hint) {
          if (strpos($hint, 'google-analytics.com') !== false) {
            unset($hints[$key]);
          }
          if (strpos($hint, 'googletagmanager.com') !== false) {
            unset($hints[$key]);
          }
        }
      }
      return $hints;
    }, 10, 2);
  }
}
add_action('wp_enqueue_scripts', 'smartkid_sleep_google_link', 999);
# Nén code thành 1 dòng duy nhất
if(isset($smartkid_options['speedzip1'])){
class WP_HTML_Compression{
    protected $wp_compress_css = true;
    protected $wp_compress_js = true;
    protected $wp_info_comment = true;
    protected $wp_remove_comments = true;
    protected $html;
    public function __construct($html)
    {
        if (!empty($html)) {
            $this->wp_parseHTML($html);
        }
    }
    public function __toString()
    {
        return $this->html;
    }
    protected function wp_bottomComment($raw, $compressed)
    {
        $raw = strlen($raw);
        $compressed = strlen($compressed);
        $savings = ($raw - $compressed) / $raw * 100;
        $savings = round($savings, 2);
        return '<!-- Nén HTML, giảm được ' . $savings . '%. từ ' . $raw . ' bytes, còn lại ' . $compressed . ' bytes. (Ném HTML, CSS, JS với code smartkidtheme) -->';
    }
protected function wp_minifyHTML($html)
{
    $pattern = '/<(?<script>script).*?<\/script\s*>|<(?<style>style).*?<\/style\s*>|<!(?<comment>--).*?-->|<(?<tag>[\/\w.:-]*)(?:".*?"|\'.*?\'|[^\'">]+)*>|(?<text>((<[^!\/\w.:-])?[^<]*)+)|/si';
    preg_match_all($pattern, $html, $matches, PREG_SET_ORDER);
    $overriding = false;
    $raw_tag = false;
    $html = '';
    foreach ($matches as $token) {
        $tag = (isset($token['tag'])) ? strtolower($token['tag']) : null;
        $content = $token[0];
        $strip = true;
        if (is_null($tag)) {
            if (!empty($token['script'])) {
                require_once(get_template_directory() . '/inc/minify-js.php');
                if ($this->wp_compress_js) {
                    $content = \JShrink\Minifier::minify($content);
                }
                $strip = false; // loai bo ham wp_removeWhiteSpace() cho <script>
            } else if (!empty($token['style'])) {
                $strip = $this->wp_compress_css;
            } else if ($content == '<!--wp-html-compression no compression-->') {
                $overriding = !$overriding;
                continue;
            } else if ($this->wp_remove_comments) {
                if (!$overriding && $raw_tag != 'textarea') {
                    $content = preg_replace('/<!--(?!\s*(?:\[if [^\]]+]|<!|>))(?:(?!-->).)*-->/s', '', $content);
                }
            }
        } else {
            if ($tag == 'pre' || $tag == 'textarea') {
                $raw_tag = $tag;
            } else if ($tag == '/pre' || $tag == '/textarea') {
                $raw_tag = false;
            } else {
                if ($raw_tag || $overriding) {
                    $strip = false;
                } else {
                    $strip = true;
                    $content = preg_replace('/(\s+)(\w++(?<!\baction|\balt|\bcontent|\bsrc)="")/', '$1', $content);
                    $content = str_replace(' />', '/>', $content);
                }
            }
        }
        if ($strip) {
            $content = $this->wp_removeWhiteSpace($content);
        }
        $html .= $content;
    }
    return $html;
}

    public function wp_parseHTML($html)
    {
        $this->html = $this->wp_minifyHTML($html);
        if ($this->wp_info_comment) {
            $this->html .= "\n" . $this->wp_bottomComment($html, $this->html);
        }
    }
    protected function wp_removeWhiteSpace($str)
    {
        $str = str_replace("\t", ' ', $str);
        $str = str_replace("\n",  '', $str);
        $str = str_replace("\r",  '', $str);
        $str = str_replace(" This function requires postMessage and CORS (if the site is cross domain).", '', $str);
        while (stristr($str, '  ')) {
            $str = str_replace('  ', ' ', $str);
        }
        return $str;
    }
 }
 function wp_html_compression_finish($html)
 {
    return new WP_HTML_Compression($html);
 }
 function wp_wp_html_compression_start()
 {
    ob_start('wp_html_compression_finish');
 }
 add_action('get_header', 'wp_wp_html_compression_start');
}