<?php
/**
 * tìm kiếm
 */
get_header(); 
global $smartkid_options;
?>
	<main class="">
		<?php if ( have_posts() ) : ?>
			<div class="homepage" <?php if (isset($smartkid_options['side1'])){echo 'style="float:none;width:100%"';} ?>>
			<!-- form tim kiem -->
			<form method="get" action="<?php bloginfo('url'); ?>">
			<div class="timkiem">
			<input id="otim" placeholder="<?php _e('Nhập nội dung cần tìm kiếm', 'smartkid'); ?>" value="<?php printf( get_search_query()); ?>" type="text" name="s" value="" maxlength="50" required="required" />
			<button type="submit" id="nuttim"><i class="fas fa-search"></i></button>
			</div>
			</form>
			<!-- ket thuc form tim kiem -->
			<div id="main" class="main-content">
			<?php
			while ( have_posts() ) : the_post();
				get_template_part( '/setcard', get_post_type() );
			endwhile;
			$nav = get_the_posts_pagination( array(
					'prev_text'          => '&#10094;',
					'next_text'          => '&#10095;',
					'screen_reader_text' => '1'
					));
			$nav = str_replace('<h2 class="screen-reader-text">1</h2>', '', $nav);
			echo $nav;
		else :
			get_template_part( 'template-parts/content', 'none' );
		endif;
		?>
		</div>
		</div>
		<?php if (!isset($smartkid_options['side1'])){ ?>
		<div class="sidebar">
		<?php get_sidebar(); ?>
		</div>
		<div style="clear: both;"></div>
		<?php } ?>
	</main>
<?php get_footer();
