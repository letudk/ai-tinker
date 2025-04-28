<!-- top face tren cung -->
<?php global $smartkid_options; ?>
<div class="top-face" data-aos="fade-in">
<div class="scrol">
<?php $smartkidpost = new WP_Query(array( 
    'post_type' => 'post',
    'posts_per_page' => 12,
    'orderby' => 'rand',
    'post__not_in' => get_option("sticky_posts"),
    
));
?>
<?php 
if( $smartkidpost->have_posts() ) {
while ($smartkidpost->have_posts()) : $smartkidpost->the_post(); ?>
<div class="iten">
	<div class="iten1">
				<?php if ( has_post_thumbnail()) { ?>
				<a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>"><img width="150" height="150" title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>" class="faceimage lazyload" <?php if(isset($smartkid_options['speed1']) && isset($smartkid_options['speed2'])){echo 'src="'.get_template_directory_uri().'/images/anh-dai-dien.jpg" data-';} ?>src="<?php echo get_the_post_thumbnail_url (get_the_ID()); ?>" /></a>
				<?php }
				// anh dai dien tu dong lay anh dau tien
				else if (!empty(smartkid_anh_dai_dien_nho())){ ?>
				<a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>"><img width="150" height="150" title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>" class="faceimage lazyload" <?php if(isset($smartkid_options['speed1']) && isset($smartkid_options['speed2'])){echo 'src="'.get_template_directory_uri().'/images/anh-dai-dien.jpg" data-';} ?>src="<?php echo smartkid_anh_dai_dien_nho(); ?>"/></a>
				<?php } ?>
	<div class="top-left"><a href="<?php the_permalink();?>"><?php echo wp_trim_words( get_the_title() , 12 ) ?></a></div>
	<div class="bottom-left1"><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>"><img width="30" height="30" alt="'.get_site_url().'" class="lazyload"  <?php if(isset($smartkid_options['speed1']) && isset($smartkid_options['speed2'])){echo 'src="'.get_template_directory_uri().'/images/anh-dai-dien.jpg" data-';} ?>src="<?php echo get_avatar_url( get_the_author_meta( 'ID' ), ['size' => '30']); ?>" /></a></div>
	</div>
</div>
<?php endwhile; } else {echo '<div class="boxnopost"><div class="nopost"><span><i class="fa-regular fa-circle-exclamation"></i> '.__('Không có nội dung', 'smartkid'). '</span></div></div>';} 
wp_reset_query() ;?>
</div>
</div>
