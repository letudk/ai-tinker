<?php
/**
 * trang tạp bài viết
 */
get_header(); 
global $smartkid_options, $comment_options;
?>
	<main>
	<div class="homepage2" <?php if (isset($smartkid_options['side2'])){echo 'style="float:none;width:100%"';} ?>>
		<?php
		while ( have_posts() ) :
		    // hiển thị số lượt xem
			getPostViews(get_the_ID());
			the_post(); 
			get_template_part( 'template-parts/baiviet', get_post_type() );
			// tab binh luan mac dinh hoac facebook
			if(isset($comment_options['enable1']) && isset($comment_options['enable2']) && (comments_open() || get_comments_number())) :
			?>
			<div class="comen-tab">
			<button class="cotabtab cotab-ac" title="<?php _e('Mặc định', 'smartkid'); ?>" onclick="opencomen(event, 'comments')"><i class="fa-solid fa-message-dots"></i> <?php _e('Mặc định', 'smartkid'); ?></button>
			<button class="cotabtab" title="<?php _e('Facebook', 'smartkid'); ?>" onclick="opencomen(event, 'facebook-comment')"><i class="fa-brands fa-facebook"></i> <?php _e('Facebook', 'smartkid'); ?></button>
			</div>
			<?php
			endif;
			// goi binh luan facebook
			if (isset($comment_options['enable2']) && (comments_open() || get_comments_number())):
			smartkid_template_facebook();
			endif;
			// hiển thị from bình luận
			if (isset($comment_options['enable1']) && (comments_open() || get_comments_number()) ) :
			comments_template();
			endif;
		endwhile; ?>
	</div>
	<?php if (!isset($smartkid_options['side2'])){ ?>
	<div class="sidebar2">
	<!-- menutocbot -->
	<?php if(isset($smartkid_options['set3']) && (isset($smartkid_options['set31']) && $smartkid_options['set31'] == 'Sidebar')){ 
	get_template_part( 'template-parts/app/tocbot', get_post_type() );
	}
	get_sidebar(); ?>
	</div>
	<div style="clear: both;"> </div>
	<?php } ?>
	</main>
<!-- menu toc bot danh muc o bai viet -->
<?php if(isset($smartkid_options['set2'])){ ?>
<script <?php if(isset($smartkid_options['speed1']) && isset($smartkid_options['speed3']) && !is_user_logged_in()){ ?>type="rocketlazyloadscript" defer<?php } ?>>
jQuery(document).ready(function(){
                Fancybox.bind(".danhmucbaiviet img", {
                    Image: {
                        zoom: false,
                    },
                });
            })
</script>
<?php } 
get_footer();
