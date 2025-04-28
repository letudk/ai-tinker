<div style="width:100%" data-aos="fade-in">
<div class="top-bai">
<?php
global $smartkid_options;
$smartkidpost = new WP_Query(array( 
'post_status'=>'publish',
'orderby' => 'ID',
'order' => 'DESC',
'posts_per_page'=> 5,
'post__not_in' => get_option("sticky_posts"),
));
?>
<?php
if( $smartkidpost->have_posts() ) { 
while ($smartkidpost->have_posts()) : $smartkidpost->the_post(); ?>
<div class="item-bai">
    <div>
				<?php if ( has_post_thumbnail()) { ?>
				<a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>"><img width="150" height="150" title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>" class="lazyload" <?php if(isset($smartkid_options['speed1']) && isset($smartkid_options['speed2'])){echo 'src="'.get_template_directory_uri().'/images/anh-dai-dien.jpg" data-';} ?>src="<?php echo get_the_post_thumbnail_url (get_the_ID()); ?>" /></a>
				<?php }
				// anh dai dien tu dong lay anh dau tien
				else if (!empty(smartkid_anh_dai_dien_nho())){ ?>
				<a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>"><img width="150" height="150" title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>" class="lazyload" <?php if(isset($smartkid_options['speed1']) && isset($smartkid_options['speed2'])){echo 'src="'.get_template_directory_uri().'/images/anh-dai-dien.jpg" data-';} ?>src="<?php echo smartkid_anh_dai_dien_nho(); ?>"/></a>
				<?php } ?>
	</div>
    <div class="content-bai">
     <h2 class="toph2"><a href="<?php the_permalink();?>"><?php echo wp_trim_words( get_the_title() , 20 ) ?></a></h2>
	 <div class="tacgia-bai"><i class="fa-regular fa-clock"></i> <?php $timeago = smartkid_time(get_the_time('U'), current_time('timestamp')); if ($timeago == false) { the_time('d/m/Y'); } else { echo $timeago . ' '. __('trước', 'smartkid'); } ?></div>
    </div>
  </div>
<?php endwhile; } else {echo '<div class="nopost" style="grid-column: 1 / span 6;"><span><i class="fa-regular fa-circle-exclamation"></i> '.__('Không có nội dung', 'smartkid'). '</span></div>';} 
wp_reset_query(); ?>
</div>
</div>
