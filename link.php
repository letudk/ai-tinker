<?php
/*
 Template Name: Link
 */
$redirect_to = !empty($_GET['url'])
? trim(strip_tags(stripslashes($_GET['url'])))
: '';
$wait_time    = 10000; // thời gian tự động chuyển hướng (tính bằng millisecond - ở đây là 30000 ml = 30s).
$wait_seconds = $wait_time / 1000;
add_action('wp_head', 'redirect_to_no_index', 99);
function redirect_to_no_index()
{ ?>
<!-- tắt index trang này -->
<meta name="robots" content="noindex, follow">
<?php
}
 
add_action('wp_head', 'redirect_to_external_link');

function redirect_to_external_link()
{
    global $redirect_to, $wait_seconds, $wait_time, $kiemurl, $chuyenluon;
    if (empty($redirect_to) || empty($wait_time)) {
    return;
    }
// kiem tra ma hoa
$kiemurl = substr($redirect_to, 0, 4);
if ($kiemurl == 'http'){
$chuyenluon = $redirect_to;
} 
else {
$chuyenluon = hex2bin($redirect_to);
}
 ?>
    <script>
	var redirect = window.setTimeout(function(){
	window.location.href='<?php echo $chuyenluon; ?>';
	document.getElementById('chuyenngay').style.display = 'inline-block';
	document.getElementById('chuyenngay').href = '<?php echo $chuyenluon; ?>';
	},
	<?php echo $wait_time; ?>
	);
	</script>
    <noscript><meta http-equiv="refresh" content="<?php echo $wait_seconds; ?>;url=<?php esc_attr_e($redirect_to); ?>"></noscript>
	<?php } get_header(); ?>
<main>
<div class="fix-menu" style="padding:0px;">
<div class="timkiem"  style="text-align:center;font-size:18px;padding:20px;">
        <div style="width:100%">
        <?php if (!empty($redirect_to)) {
        echo '<p style="font-size: 95%;margin: 8px !important;font-weight:bold">'. __('VUI LÒNG ĐỢI TRONG GIÂY LÁT', 'smartkid') .'</p>';
		echo '<div style="font-size:17px;margin-bottom:30px;color:var(--texta)">'. __('Đang kiểm tra và giải mã liên kết đã được mã hoá', 'smartkid') .'</div>';
        ?>
		<div id="myProgress"><div id="myBar">10%</div></div>
		<div class="dieukhoanlk">
		<?php the_content(); ?>
		</div>
		<div style="margin-top:20px">
        <a id="chuyenngay" style="display:none"  href=""><?php _e('ĐI ĐẾN', 'smartkid'); ?> <i class="fas fa-arrow-right"></i></a>
        <a id="dongchuyen"  onclick="self.close()"><i class="fas fa-times"></i></a> <br />
		</div>
        <?php } else { _e('Liên kết này bị lỗi hoặc không tồn tại!', 'smartkid'); } ?>
        </div>
</div>
</div>
</main>
<script>
var i = 0;
  if (i == 0) {
    i = 1;
    var elem = document.getElementById("myBar");
    var width = 0;
    var id = setInterval(frame, <?php echo $wait_seconds * 9.6;?>);
    function frame() {
      if (width >= 100) {
        clearInterval(id);
        i = 0;
      } else {
        width++;
        elem.style.width = width + "%";
        elem.innerHTML = width  + "%";
      }
    }
  }
</script>
<?php get_footer(); ?>
