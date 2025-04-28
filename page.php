<?php
/**
 * trang tạp bài viết
 */
get_header();
global $smartkid_options;
?>
<main>
<div class="homepage2"  style="float:none;width:100%" >
		<?php
		while ( have_posts() ) :
			the_post();
			get_template_part( 'template-parts/content', 'page' );
		endwhile; ?>
</div>
		 
</main>
<?php get_footer();

