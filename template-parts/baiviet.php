<?php
/**
 * Body bài viết
 */
?>
<div class="box-card">
<?php
global $smartkid_options, $login_options, $error_options, $wpdb;
$l=0;
$postid=get_the_id(); 
if(!empty($row1)){
$l=1;
} 

if(isset($smartkid_options['set1'])){
?>
	<!-- Hình đại diện thay thế -->
	<?php if ( has_post_thumbnail()) { ?>
	<div class="top-image-bai">
	<img title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>" width="600" height="400"  class="lazyload"  <?php if(isset($smartkid_options['speed1']) && isset($smartkid_options['speed2'])){echo 'src="'.get_template_directory_uri().'/images/anh-dai-dien.jpg" data-';} ?>src="<?php echo get_the_post_thumbnail_url (get_the_ID()); ?>" />
	</div>
	<?php } else  if(!empty(smartkid_anh_dai_dien_nho())) { ?>
	<div class="top-image-bai">
	<img title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>" width="600" height="400"  class="lazyload"  <?php if(isset($smartkid_options['speed1']) && isset($smartkid_options['speed2'])){echo 'src="'.get_template_directory_uri().'/images/anh-dai-dien.jpg" data-';} ?>src="<?php echo smartkid_anh_dai_dien_nho();?>"/>
	</div>
	<?php } } ?>
	<!-- Hình đại diện thay thế -->    
	<div class="box-content">
	    <ol id="crumbs" itemscope itemtype="http://schema.org/BreadcrumbList">
            <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemtype="http://schema.org/Thing" itemprop="item" href="<?php echo get_option('home'); ?>"><span itemprop="name">Home</span></a><meta itemprop="position" content="1" /></li>
			<?php if ( 'post' === get_post_type() ) : $category = get_the_category(); $category = reset( $category ); ?>
			<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemtype="http://schema.org/Thing" itemprop="item" href="<?php echo esc_url( get_category_link( $category ) ); ?>"><span itemprop="name"><?php echo esc_html( $category->name ); ?></span></a><meta itemprop="position" content="2" /></li>
			<?php endif; ?>
			<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemtype="http://schema.org/Thing" itemprop="item" href="<?php echo get_the_permalink(); ?>"><span itemprop="name"><?php echo get_the_title(); ?></span></a><meta itemprop="position" content="3" /></li>
         </ol>   
		
		<?php the_title( '<h1 id="title-post" >', '</h1>' ); ?>
		<div class="box-luotxem1">
		<div class="pp-rating">
			<?php if (function_exists('kk_star_ratings')) {
					echo kk_star_ratings();
				} else {
					echo ''; // Hiển thị chuỗi rỗng nếu plugin chưa được cài
				} ?>
		</div>
		<div class="pp-view" style="text-align: end;">
			<?php echo '<i class="fa-solid fa-arrow-trend-up"></i> '. getPostViews(get_the_ID()); ?>
		</div>
	</div>
	<?php
	

	
	
		// tao ham goi du lieu trong bai viet
		function smartkid_check_post(){ 
		global $post, $smartkid_options, $story_options; ob_start(); 

		if ( function_exists('get_post_meta') ) {
			$meta_description = get_post_meta(get_the_ID(), 'rank_math_description', true);
			if (!$meta_description) {
				$meta_description = get_the_excerpt(); // Dùng excerpt nếu không có mô tả Rank Math
			}
			if ($meta_description) {
				?>
				<div class="metades">
					<p style="    font-size: 14px; font-style: italic;"> "<?php echo $meta_description; ?>"</p>
				</div>
				<?php
			}
		}
				echo '<div id="zoomarea" class="danhmucbaiviet">';
				// tocbot

				if(isset($smartkid_options['set3']) && (isset($smartkid_options['set31']) && $smartkid_options['set31'] == 'Post')){ 
				get_template_part( 'template-parts/app/tocbot', get_post_type() );
				}
				$download_link1 = get_post_meta($post->ID, 'download_link1', true);

			if(!empty($download_link1)){
				?>
<div class="down-btn" style='width:100%; text-align:center;'>
<button id="dow-n" style ="border: solid 1px; padding: 5px 20px; border-radius: 20px;  color: #EC1064;">
	<i class="fa-solid fa-arrow-down-to-square" style="margin-right:7px;"></i> TẢI FULL BỘ TRANH TÔ MÀU CHO BÉ 
	<b id="box-n"> <span id="giay-n"></span></b></button>
</div><?php } ?>
			<script>
			jQuery(document).ready(function(o) {
			function d(giayId, boxId, get) {
				var n = 30; // Giá trị ban đầu của n
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
				var giayId = "#giay-n";
				var boxId = "#box-n";
				var get = "#boxdownload";
				o("#dow-n").click(function() {
					d(giayId, boxId, get);
				});
			});
		    </script>			<?php
			   the_content();
			   //add download manager
				if (isset($smartkid_options['set7'])){get_template_part( 'template-parts/app/download-manager', get_post_type());}
				echo '</div>';
				return ob_get_clean();
		}  
			    echo smartkid_check_post(); 

	?>
	</div>
	
	<!-- them nut like cho bai viet -->

	<div class="box-luotxem" >
		<div class="pp-rating">
			<?php if (function_exists('kk_star_ratings')) {
					echo kk_star_ratings();
				} else {
					echo ''; // Hiển thị chuỗi rỗng nếu plugin chưa được cài
				} ?>
		</div>
		<div class="social-sharing">
			<a title="Facebook" class="s-facebook" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" onclick='window.open(this.href,&quot;popupwindow&quot;,&quot;status=0,height=500,width=500,resizable=0,top=50,left=100&quot;);return false;' rel='nofollow' target="_blank">
			<svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="100" height="100" viewBox="0 0 50 50"> <path d="M 25 3 C 12.861562 3 3 12.861562 3 25 C 3 36.019135 11.127533 45.138355 21.712891 46.728516 L 22.861328 46.902344 L 22.861328 29.566406 L 17.664062 29.566406 L 17.664062 26.046875 L 22.861328 26.046875 L 22.861328 21.373047 C 22.861328 18.494965 23.551973 16.599417 24.695312 15.410156 C 25.838652 14.220896 27.528004 13.621094 29.878906 13.621094 C 31.758714 13.621094 32.490022 13.734993 33.185547 13.820312 L 33.185547 16.701172 L 30.738281 16.701172 C 29.349697 16.701172 28.210449 17.475903 27.619141 18.507812 C 27.027832 19.539724 26.84375 20.771816 26.84375 22.027344 L 26.84375 26.044922 L 32.966797 26.044922 L 32.421875 29.564453 L 26.84375 29.564453 L 26.84375 46.929688 L 27.978516 46.775391 C 38.71434 45.319366 47 36.126845 47 25 C 47 12.861562 37.138438 3 25 3 z M 25 5 C 36.057562 5 45 13.942438 45 25 C 45 34.729791 38.035799 42.731796 28.84375 44.533203 L 28.84375 31.564453 L 34.136719 31.564453 L 35.298828 24.044922 L 28.84375 24.044922 L 28.84375 22.027344 C 28.84375 20.989871 29.033574 20.060293 29.353516 19.501953 C 29.673457 18.943614 29.981865 18.701172 30.738281 18.701172 L 35.185547 18.701172 L 35.185547 12.009766 L 34.318359 11.892578 C 33.718567 11.811418 32.349197 11.621094 29.878906 11.621094 C 27.175808 11.621094 24.855567 12.357448 23.253906 14.023438 C 21.652246 15.689426 20.861328 18.170128 20.861328 21.373047 L 20.861328 24.046875 L 15.664062 24.046875 L 15.664062 31.566406 L 20.861328 31.566406 L 20.861328 44.470703 C 11.816995 42.554813 5 34.624447 5 25 C 5 13.942438 13.942438 5 25 5 z"></path> </svg>
			</a> 
			<a title="Twitter" class="s-twitter" href="https://twitter.com/intent/tweet?url=<?php the_permalink(); ?>" onclick='window.open(this.href,&quot;popupwindow&quot;,&quot;status=0,height=500,width=500,resizable=0,top=50,left=100&quot;);return false;' rel='nofollow' target="_blank">
				<svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="100" height="100" viewBox="0 0 50 50">
				<path d="M 11 4 C 7.1456661 4 4 7.1456661 4 11 L 4 39 C 4 42.854334 7.1456661 46 11 46 L 39 46 C 42.854334 46 46 42.854334 46 39 L 46 11 C 46 7.1456661 42.854334 4 39 4 L 11 4 z M 11 6 L 39 6 C 41.773666 6 44 8.2263339 44 11 L 44 39 C 44 41.773666 41.773666 44 39 44 L 11 44 C 8.2263339 44 6 41.773666 6 39 L 6 11 C 6 8.2263339 8.2263339 6 11 6 z M 13.085938 13 L 22.308594 26.103516 L 13 37 L 15.5 37 L 23.4375 27.707031 L 29.976562 37 L 37.914062 37 L 27.789062 22.613281 L 36 13 L 33.5 13 L 26.660156 21.009766 L 21.023438 13 L 13.085938 13 z M 16.914062 15 L 19.978516 15 L 34.085938 35 L 31.021484 35 L 16.914062 15 z"></path>
				</svg>
			</a> 
			<a title="Pinterest" class="s-pinterest" href="https://www.pinterest.com/pin/create/link/?url=<?php the_permalink(); ?>&media=<?php echo the_post_thumbnail_url('large'); ?>&description=<?php echo get_the_title(get_the_ID()); ?>" onclick='window.open(this.href,&quot;popupwindow&quot;,&quot;status=0,height=500,width=500,resizable=0,top=50,left=100&quot;);return false;' rel='nofollow' target="_blank">
			<svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="100" height="100" viewBox="0 0 50 50">
				<path d="M 25 2 C 12.309295 2 2 12.309295 2 25 C 2 37.690705 12.309295 48 25 48 C 37.690705 48 48 37.690705 48 25 C 48 12.309295 37.690705 2 25 2 z M 25 4 C 36.609825 4 46 13.390175 46 25 C 46 36.609825 36.609825 46 25 46 C 22.876355 46 20.82771 45.682142 18.896484 45.097656 C 19.75673 43.659418 20.867347 41.60359 21.308594 39.90625 C 21.570728 38.899887 22.648438 34.794922 22.648438 34.794922 C 23.348841 36.132057 25.395277 37.263672 27.574219 37.263672 C 34.058123 37.263672 38.732422 31.300682 38.732422 23.890625 C 38.732422 16.78653 32.935409 11.472656 25.476562 11.472656 C 16.196831 11.472656 11.271484 17.700825 11.271484 24.482422 C 11.271484 27.636307 12.94892 31.562193 15.634766 32.8125 C 16.041611 33.001865 16.260073 32.919834 16.353516 32.525391 C 16.425459 32.226044 16.788267 30.766792 16.951172 30.087891 C 17.003269 29.871239 16.978043 29.68405 16.802734 29.470703 C 15.913793 28.392399 15.201172 26.4118 15.201172 24.564453 C 15.201172 19.822048 18.791452 15.232422 24.908203 15.232422 C 30.18976 15.232422 33.888672 18.832872 33.888672 23.980469 C 33.888672 29.796219 30.95207 33.826172 27.130859 33.826172 C 25.020554 33.826172 23.440361 32.080359 23.947266 29.939453 C 24.555054 27.38426 25.728516 24.626944 25.728516 22.78125 C 25.728516 21.130713 24.842754 19.753906 23.007812 19.753906 C 20.850369 19.753906 19.117188 21.984457 19.117188 24.974609 C 19.117187 26.877359 19.761719 28.166016 19.761719 28.166016 C 19.761719 28.166016 17.630543 37.176514 17.240234 38.853516 C 16.849091 40.52931 16.953851 42.786365 17.115234 44.466797 C 9.421139 41.352465 4 33.819328 4 25 C 4 13.390175 13.390175 4 25 4 z"></path>
				</svg>
			</a>
			<a title="Telegram" class="s-telegram" href="https://t.me/share/url?url=<?php the_permalink(); ?>" onclick='window.open(this.href,&quot;popupwindow&quot;,&quot;status=0,height=500,width=500,resizable=0,top=50,left=100&quot;);return false;' rel='nofollow' target="_blank">
			<svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="100" height="100" viewBox="0 0 50 50">
			<path d="M 25 2 C 12.309288 2 2 12.309297 2 25 C 2 37.690703 12.309288 48 25 48 C 37.690712 48 48 37.690703 48 25 C 48 12.309297 37.690712 2 25 2 z M 25 4 C 36.609833 4 46 13.390175 46 25 C 46 36.609825 36.609833 46 25 46 C 13.390167 46 4 36.609825 4 25 C 4 13.390175 13.390167 4 25 4 z M 34.087891 14.035156 C 33.403891 14.035156 32.635328 14.193578 31.736328 14.517578 C 30.340328 15.020578 13.920734 21.992156 12.052734 22.785156 C 10.984734 23.239156 8.9960938 24.083656 8.9960938 26.097656 C 8.9960938 27.432656 9.7783594 28.3875 11.318359 28.9375 C 12.146359 29.2325 14.112906 29.828578 15.253906 30.142578 C 15.737906 30.275578 16.25225 30.34375 16.78125 30.34375 C 17.81625 30.34375 18.857828 30.085859 19.673828 29.630859 C 19.666828 29.798859 19.671406 29.968672 19.691406 30.138672 C 19.814406 31.188672 20.461875 32.17625 21.421875 32.78125 C 22.049875 33.17725 27.179312 36.614156 27.945312 37.160156 C 29.021313 37.929156 30.210813 38.335938 31.382812 38.335938 C 33.622813 38.335938 34.374328 36.023109 34.736328 34.912109 C 35.261328 33.299109 37.227219 20.182141 37.449219 17.869141 C 37.600219 16.284141 36.939641 14.978953 35.681641 14.376953 C 35.210641 14.149953 34.672891 14.035156 34.087891 14.035156 z M 34.087891 16.035156 C 34.362891 16.035156 34.608406 16.080641 34.816406 16.181641 C 35.289406 16.408641 35.530031 16.914688 35.457031 17.679688 C 35.215031 20.202687 33.253938 33.008969 32.835938 34.292969 C 32.477938 35.390969 32.100813 36.335938 31.382812 36.335938 C 30.664813 36.335938 29.880422 36.08425 29.107422 35.53125 C 28.334422 34.97925 23.201281 31.536891 22.488281 31.087891 C 21.863281 30.693891 21.201813 29.711719 22.132812 28.761719 C 22.899812 27.979719 28.717844 22.332938 29.214844 21.835938 C 29.584844 21.464938 29.411828 21.017578 29.048828 21.017578 C 28.923828 21.017578 28.774141 21.070266 28.619141 21.197266 C 28.011141 21.694266 19.534781 27.366266 18.800781 27.822266 C 18.314781 28.124266 17.56225 28.341797 16.78125 28.341797 C 16.44825 28.341797 16.111109 28.301891 15.787109 28.212891 C 14.659109 27.901891 12.750187 27.322734 11.992188 27.052734 C 11.263188 26.792734 10.998047 26.543656 10.998047 26.097656 C 10.998047 25.463656 11.892938 25.026 12.835938 24.625 C 13.831938 24.202 31.066062 16.883437 32.414062 16.398438 C 33.038062 16.172438 33.608891 16.035156 34.087891 16.035156 z"></path>
			</svg>
			</a>

		</div>
	</div>
	 <?php if(!empty(get_the_tags())){ ?><div class="content-tag"><?php the_tags( '', '', '<br />' ); ?></div><?php } ?>
</div>  

<!-- bài viet lien quan -->
<div class="widget-post"><div class="widget-post-title"><i class="fa-thin fa-face-smile-wink"></i> <?php _e('Tranh tô màu hấp dẫn khác', 'smartkid'); ?></div>
<?php
$categories = get_the_category($post->ID);
if ($categories) {
$category_ids = array();
foreach($categories as $term_category) $category_ids[] = $term_category->term_id;
$args=array(
'category__in'   => $category_ids,
'post__not_in' => array($post->ID),
'posts_per_page'=>8,
'ignore_sticky_posts'=>1,
);
$smartkidpost = new WP_Query($args);
?> <div class="widget-post-box"  style="display:grid;grid-template-columns: 1fr 1fr;grid-column-gap: 10px;grid-row-gap: 10px;" > <?php
if( $smartkidpost->have_posts() ) {
while ($smartkidpost->have_posts()) : $smartkidpost->the_post(); ?>

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

<?php endwhile; } else {echo '<div class="nopost"><span><i class="fa-regular fa-circle-exclamation"></i> '.__('Hình ảnh ', 'smartkid'). '</span></div>';} 
wp_reset_query(); } ?>
</div>
</div>
<!-- bai viet lien quan -->	

