<!-- bai viet theo chuyen muc -->
<?php global $smartkid_options; ?>
<div class="widget-post" style="margin-bottom:20px;padding:0px;" data-aos="fade-in">
<div class="rank-title">
<button class="ranktab rank-ac" title="<?php _e('Mới nhất', 'smartkid'); ?>" onclick="openrank(event, 'rankone')"><i class="fa-regular fa-clock"></i> <?php _e('MỚI', 'smartkid'); ?></button>
<button class="ranktab" title="<?php _e('Thịnh hành', 'smartkid'); ?>" onclick="openrank(event, 'ranktue')"><i class="fa-regular fa-fire"></i> <?php _e('XEM', 'smartkid'); ?></button>
<button style="opacity:0.9" class="ranktab" title="<?php _e('Nhiều lượt xem', 'smartkid'); ?>" onclick="openrank(event, 'rankthere')"><i class="fa-regular fa-bolt-lightning"></i> <?php _e('NỔI', 'smartkid'); ?></button>
</div>
<div class="rank-box rank" id="rankone">
    <?php
    $smartkidpost = new WP_Query(array(
    'post_type'=>'post',
    'post_status'=>'publish',
    'order'      => 'DESC',
    'posts_per_page'=> 8,
    ));
	if( $smartkidpost->have_posts() ) {
    while ($smartkidpost->have_posts()) : $smartkidpost->the_post(); ?>
    <div class="rank-widget-post">
	<div class="wg-imageav-view">
				<?php if ( has_post_thumbnail()) { ?>
				<a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>"><img width="150" height="150" title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>" class="lazyload" <?php if(isset($smartkid_options['speed1']) && isset($smartkid_options['speed2'])){echo 'src="'.get_template_directory_uri().'/images/anh-dai-dien.jpg" data-';} ?>src="<?php echo get_the_post_thumbnail_url (get_the_ID()); ?>" /></a>
				<?php }
				// anh dai dien tu dong lay anh dau tien
				else if (!empty(smartkid_anh_dai_dien_nho())){ ?>
				<a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>"><img width="150" height="150" title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>" class="lazyload" <?php if(isset($smartkid_options['speed1']) && isset($smartkid_options['speed2'])){echo 'src="'.get_template_directory_uri().'/images/anh-dai-dien.jpg" data-';} ?>src="<?php echo smartkid_anh_dai_dien_nho(); ?>"/></a>
				<?php } ?>
	</div>
	<div>
    <h3 class="rank-tenbai"><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"> <?php echo wp_trim_words( get_the_title() , 23 ) ?></a></h3>
	<?php
	$categories = get_the_category(); $genres = array();
	echo '<div class="rank-cm">';
	foreach( $categories as $category ) {
		$genres[] = ' <a href="'.esc_url( get_category_link( $category->term_id ) ).'" title="'.esc_html( $category->name ).'">'.esc_html( $category->name ).'</a>';
		};
		echo implode(' ', $genres );
	echo '</div>';
	?>
	</div>
    </div>
    <?php
    endwhile; } else {echo '<div class="nopost"><span><i class="fa-regular fa-circle-exclamation"></i> '.__('Không có nội dung', 'smartkid'). '</span></div>';} 
	wp_reset_query();?>
</div>
<div class="rank-box rank" id="ranktue" style="display:none">
    <?php
    $smartkidpost = new WP_Query(array(
    'post_type'=>'post',
    'post_status'=>'publish',
    'meta_key'  => 'post_views_count', // set custom meta key
    'orderby'    => 'meta_value_num',
    'order'      => 'DESC',
    'posts_per_page'=> 8,
    ));
	if( $smartkidpost->have_posts() ) {
    while ($smartkidpost->have_posts()) : $smartkidpost->the_post(); ?>
    <div class="rank-widget-post">
	<div class="wg-imageav-view">
				<?php if ( has_post_thumbnail()) { ?>
				<a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>"><img width="150" height="150" title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>" class="lazyload" <?php if(isset($smartkid_options['speed1']) && isset($smartkid_options['speed2'])){echo 'src="'.get_template_directory_uri().'/images/anh-dai-dien.jpg" data-';} ?>src="<?php echo get_the_post_thumbnail_url (get_the_ID()); ?>" /></a>
				<?php }
				// anh dai dien tu dong lay anh dau tien
				else if (!empty(smartkid_anh_dai_dien_nho())){ ?>
				<a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>"><img width="150" height="150" title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>" class="lazyload" <?php if(isset($smartkid_options['speed1']) && isset($smartkid_options['speed2'])){echo 'src="'.get_template_directory_uri().'/images/anh-dai-dien.jpg" data-';} ?>src="<?php echo smartkid_anh_dai_dien_nho(); ?>"/></a>
				<?php } ?>
	</div>
	<div>
    <h3 class="rank-tenbai"><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"> <?php echo wp_trim_words( get_the_title() , 23 ) ?></a></h3>
	<?php
	$categories = get_the_category(); $genres = array();
	echo '<div class="rank-cm">';
	foreach( $categories as $category ) {
		$genres[] = ' <a href="'.esc_url( get_category_link( $category->term_id ) ).'" title="'.esc_html( $category->name ).'">'.esc_html( $category->name ).'</a>';
		};
		echo implode(' ', $genres );
	echo '</div>';
	?>
	</div>
    </div>
    <?php
    endwhile; } else {echo '<div class="nopost"><span><i class="fa-regular fa-circle-exclamation"></i> '.__('Không có nội dung', 'smartkid'). '</span></div>';}
	wp_reset_query();?>
</div>
<div class="rank-box rank" id="rankthere" style="display:none">
    <?php
    $smartkidpost = new WP_Query(array(
    'post_type' => 'post',
    'orderby' => 'rand',
    'posts_per_page'=> 8,
    ));
	if( $smartkidpost->have_posts() ) {
    while ($smartkidpost->have_posts()) : $smartkidpost->the_post(); ?>
    <div class="rank-widget-post">
	<div class="wg-imageav-view">
				<?php if ( has_post_thumbnail()) { ?>
				<a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>"><img width="150" height="150" title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>" class="lazyload" <?php if(isset($smartkid_options['speed1']) && isset($smartkid_options['speed2'])){echo 'src="'.get_template_directory_uri().'/images/anh-dai-dien.jpg" data-';} ?>src="<?php echo get_the_post_thumbnail_url (get_the_ID()); ?>" /></a>
				<?php }
				// anh dai dien tu dong lay anh dau tien
				else if (!empty(smartkid_anh_dai_dien_nho())){ ?>
				<a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>"><img width="150" height="150" title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>" class="lazyload" <?php if(isset($smartkid_options['speed1']) && isset($smartkid_options['speed2'])){echo 'src="'.get_template_directory_uri().'/images/anh-dai-dien.jpg" data-';} ?>src="<?php echo smartkid_anh_dai_dien_nho(); ?>"/></a>
				<?php } ?>
	</div>
	<div>
    <h3 class="rank-tenbai"><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"> <?php echo wp_trim_words( get_the_title() , 23 ) ?></a></h3>
	<?php
	$categories = get_the_category(); $genres = array();
	echo '<div class="rank-cm">';
	foreach( $categories as $category ) {
		$genres[] = ' <a href="'.esc_url( get_category_link( $category->term_id ) ).'" title="'.esc_html( $category->name ).'">'.esc_html( $category->name ).'</a>';
		};
		echo implode(' ', $genres );
	echo '</div>';
	?>
	</div>
    </div>
    <?php
    endwhile; } else {echo '<div class="nopost"><span><i class="fa-regular fa-circle-exclamation"></i> '.__('Không có nội dung', 'smartkid'). '</span></div>';}
	wp_reset_query();?>
</div>
</div>