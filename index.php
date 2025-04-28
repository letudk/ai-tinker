<?php
/**
 *  index
 */
get_header();
global $smartkid_options; ?> 
<!--  top -->
<?php if (isset($smartkid_options['other1']) && is_active_sidebar('sidebar-7') && is_home() && !is_paged()) { ?>
<div class="full-top ">
<?php dynamic_sidebar( 'sidebar-7' ); ?>
</div>
<?php } ?>
<div class="container" style="text-align: center;">
	<h1 style="margin: 20px 0px;" >AI TINKER</h1>
	<p>Explore the Power of AI — One Tool at a Time.</p> 
</div>

<div class="container stick-post">
	<?php
	 $args = array(
		'meta_query' => array(
			array(
				'key'     => '_stick_post',
				'value'   => '1',
				'compare' => '='
			)
		),
		'ignore_sticky_posts' => 1,
		'posts_per_page' => 1,
		'post_status' => 'publish'
	);
	$the_query = new WP_Query( $args );
	if ( $the_query->have_posts() ) {
		while ( $the_query->have_posts() ) {
			$the_query->the_post();
			?>
<div class="stick-post-item">
        <div class="stick-post-img">
            <?php if (has_post_thumbnail()) : ?>
                <a href="<?php the_permalink(); ?>">
                    <?php the_post_thumbnail('medium'); ?>
                </a>
            <?php endif; ?>
        </div>
        
        <div class="stick-post-content">
            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            <ol class="print-steps">
                <li><strong>Bước 1:</strong> Click vào hình ảnh trong bài viết</li>
                <li><strong>Bước 2:</strong> Tại đây popup hiện ra, phụ huynh có thể cho bé tô màu online hoặc bấm vào nút in hình trắng đen</li>
                <li><strong>Bước 3:</strong> Đợi 5s chọn máy in -> định dạng lại khổ giấy</li>
                <li><strong>Bước 4:</strong> In hình</li>
            </ol>
        </div>
    </div>
			<?php
		}
		wp_reset_postdata();
	} else {
		echo '<div class="box-card" style="grid-column:1;">
				<div class="box-content" style="text-align: center !important;">
					'. __('Hình ảnh đang được cập nhật, Chúng tôi sẽ cố gắng bổ sung sớm nhất có thể...', 'smartkid') .'
				</div>
			</div>';
	}
	?>
</div>
<main class="aos-all">
<!-- widget midel top -->
<?php if ( is_active_sidebar('sidebar-5') && is_home() && !is_paged()) { ?>
<div class="sidebar-img">
<?php dynamic_sidebar( 'sidebar-5' ); ?>
</div>
<?php } ?>
<div class="homepage" style="float:none;width:100%">
	<!-- widget midel page -->
	<?php if ( is_active_sidebar('sidebar-3') && is_home() && !is_paged()) { ?>
	<div class="sidebar-img">
	<?php dynamic_sidebar( 'sidebar-3' ); ?>
	</div>
	<?php } 
	global $adsense_options;
	if(isset($adsense_options['enable'])) {
	echo smartkid_add_adsense_widget_center();  
	}
	// hiden/show post in homepage
	if(!isset($smartkid_options['index1'])){
	?>
	<div id="main" class="main-bai"> 
			<?php
			if ( have_posts() ) : if ( is_home() && ! is_front_page() ) : ?>
				<header>
						<h1 class="card-titile"><?php single_post_title(); ?></h1>
				</header>
				<?php endif; 
				while ( have_posts() ) : the_post();
					get_template_part( 'setcard', get_post_type() );
				endwhile;
				// chuyen trang dạng số
                if((isset($smartkid_options['next']) && $smartkid_options['next'] == 'Page') || !isset($smartkid_options['next'])) :
				$nav = get_the_posts_pagination( array(
					'prev_text'          => '&#10094;',
					'next_text'          => '&#10095;',
					'screen_reader_text' => '1'
					));
    			$nav = str_replace('<h2 class="screen-reader-text">1</h2>', '', $nav);
    			echo $nav;
                endif;
                // chuyen trang dạng số
			else : ?> 
				<div class="box-card" style="grid-column:1 / span 4;">
				<div class="box-content" style="text-align: center !important;">
					<?php _e('Hình ảnh đang được cập nhật, Chúng tôi sẽ cố gắng bổ sung sớm nhất có thể...', 'smartkid'); ?>
				</div>
			</div>
			 <?php
			endif; ?>
			<?php 
			global $wp_query;
            if ($wp_query->max_num_pages > 1 && (isset($smartkid_options['next']) && $smartkid_options['next'] == 'More')) {echo '<span  class="smartkid-loadmore"><span  class="smartkid-loadmore2"><i class="fa-regular fa-circle-arrow-down"></i> '. __('Tải thêm', 'smartkid') .'</span></span>'; } 
			?>
	</div>
	<?php } ?>
	<!-- widget bottom -->
	<?php if ( is_active_sidebar('sidebar-6') && is_home() && !is_paged() ) { ?>
	<div style="margin-top:20px;" class="sidebar-img">
	<?php dynamic_sidebar( 'sidebar-6' ); ?>
	</div>
	<?php } ?>
	
</div> 
</main>
<!-- full bottom -->
<?php if (isset($smartkid_options['other1']) && is_active_sidebar('sidebar-8') && is_home() && !is_paged()) { ?>
<div class="full-bottom ">
<?php dynamic_sidebar( 'sidebar-8' ); ?>
</div>
<?php }  
get_footer();
