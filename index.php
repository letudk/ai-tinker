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

<div class="container" style="margin-bottom:20px;">
<?php
	get_template_part( 'template-parts/feature-post'); 
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
                endif;  ?>  
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
