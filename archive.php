<?php
/**
 * trang luu tru & chuyen muc
 */
get_header(); 
global $fox_options;
?>
	<main class="aos-all">
		<?php if ( have_posts() ) : ?>
		<div class="homepage"  style="float:none;width:100%" > 
			<?php 
			do_action('smartkid_archive');
			the_archive_title( '<div class="title-archive"><h1 style="margin:0px;"><i class="fa-regular fa-bolt"></i> ', '</h1></div>' ); 
			the_archive_description( '<div class="description-archive">', '</div>' ); 
			?>
			<div id="main" class="main-bai">
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
		else : get_template_part( 'template-parts/content', 'none' ); endif;
		?>
		</div>
		</div> 
	</main>
<?php get_footer();
