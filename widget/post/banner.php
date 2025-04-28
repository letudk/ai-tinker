<div class="slideshow-container" data-aos="fade-in">
  <?php
	global $smartkid_options; 
    $smartkidpost = new WP_Query(array(
    'post_type'=>'post',
    'post_status'=>'publish',
    'order'      => 'DESC',
    'posts_per_page'=> 4,
    'post__not_in' => get_option("sticky_posts"),
    ));
	if( $smartkidpost->have_posts() ) {
    while ($smartkidpost->have_posts()) : $smartkidpost->the_post(); ?>
  <div class="smartkidslide">
  	<!-- Hình đại diện thay thế -->
	<?php if ( has_post_thumbnail()) { ?>
	<div class="banner-image">
	    <div class="banner-nd">
	    <?php if ( 'post' === get_post_type() ) : ?>
					<?php
					$category = get_the_category();
					$category = reset( $category );
					?>
    	<div class="banner-cm"><a  href="<?php echo esc_url( get_category_link( $category ) ); ?>"><i class="fa-regular fa-bolt"></i> <?php echo esc_html( $category->name ); ?></a></div>
    	<?php endif; ?>
		<div class="banner-tacgia"><a alt="<?php the_author(); ?>" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>"><img width="30" height="30" alt="<?php the_author(); ?>" class="lazyload"  <?php if(isset($smartkid_options['speed1']) && isset($smartkid_options['speed2'])){echo 'src="'.get_template_directory_uri().'/images/anh-dai-dien.jpg" data-';} ?>src="<?php echo get_avatar_url( get_the_author_meta( 'ID' ), ['size' => '30']); ?>" /></a> <span><?php $timeago = smartkid_time(get_the_time('U'), current_time('timestamp')); if ($timeago == false) { the_time('d/m/Y'); } else { echo $timeago . ' '. __('trước', 'smartkid'); } ?></span></div>
	    <h3 class="banner-tenbai"><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php echo wp_trim_words( get_the_title() , 23 ) ?></a></h3>
    	</div>
	<a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>"><img title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>" width="600" height="400" class="lazyload" <?php if(isset($smartkid_options['speed1']) && isset($smartkid_options['speed2'])){echo 'src="'.get_template_directory_uri().'/images/anh-dai-dien.jpg" data-';} ?>src="<?php echo get_the_post_thumbnail_url (get_the_ID()); ?>" /></a>
	</div>
	<?php } else  if(!empty(smartkid_anh_dai_dien_nho())) { ?>
	<div class="banner-image">
	    <div class="banner-nd">
	    <?php if ( 'post' === get_post_type() ) : ?>
					<?php
					$category = get_the_category();
					$category = reset( $category );
					?>
    	<div class="banner-cm"><a  href="<?php echo esc_url( get_category_link( $category ) ); ?>"><i class="fa-regular fa-bolt"></i> <?php echo esc_html( $category->name ); ?></a></div>
    	<?php endif; ?>
		<div class="banner-tacgia"><a alt="<?php the_author(); ?>" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>"><img width="30" height="30" alt="<?php the_author(); ?>" class="lazyload"  <?php if(isset($smartkid_options['speed1']) && isset($smartkid_options['speed2'])){echo 'src="'.get_template_directory_uri().'/images/anh-dai-dien.jpg" data-';} ?>src="<?php echo get_avatar_url( get_the_author_meta( 'ID' ), ['size' => '30']); ?>" /></a> <span><?php $timeago = smartkid_time(get_the_time('U'), current_time('timestamp')); if ($timeago == false) { the_time('d/m/Y'); } else { echo $timeago . ' '. __('trước', 'smartkid'); } ?></span></div>
	    <h3 class="banner-tenbai"><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php echo wp_trim_words( get_the_title() , 23 ) ?></a></h3>
    	</div>
	<a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>"><img title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>" width="600" height="400" class="lazyload" <?php if(isset($smartkid_options['speed1']) && isset($smartkid_options['speed2'])){echo 'src="'.get_template_directory_uri().'/images/anh-dai-dien.jpg" data-';} ?>src="<?php echo smartkid_anh_dai_dien_nho();?>"/></a>
	</div> 
	<?php } ?>
	<!-- Hình đại diện thay thế -->
  </div>
  <?php endwhile; } else {echo '<div class="nopost" style="padding:20px;"><span><i class="fa-regular fa-circle-exclamation"></i> '.__('Không có nội dung', 'smartkid'). '</span></div>';} 
  wp_reset_query();?>
  <span id="neg" class="banner-prev">&#10094;</span>
  <span id="pos" class="banner-next">&#10095;</span>
</div>

<div class="pill-container" style="margin-bottom:20px;">
  <div class="progress"></div>
  <span data-index="0" class="pill"></span>
  <span data-index="1" class="pill"></span>
  <span data-index="2" class="pill"></span>
  <span data-index="3" class="pill"></span>
</div>
<script>let slideTimer,slideIndex=0;const slideDelay=10,slides=document.getElementsByClassName("smartkidslide"),pills=document.getElementsByClassName("pill"),bar=document.getElementsByClassName("progress");for(ShowSlide=e=>{for(slideIndex=e==slides.length?0:e<0?slides.length-1:e,i=0;i<slides.length;i++)slides[i].style.display="none",pills[i].classList.remove("active");SlideReset(),slides[slideIndex].style.display="block",pills[slideIndex].classList.add("active")},SlideReset=()=>{window.clearInterval(slideTimer),bar[0].style.animation=null,setTimeout((function(){bar[0].style.animation="progression linear 9.89s",slideTimer=window.setInterval((function(){ShowSlide(slideIndex+=1)}),1e4)}),10)},i=0;i<pills.length;i++)pills[i].addEventListener("click",(function(){let e=this.getAttribute("data-index");ShowSlide(Number(e))}));neg.addEventListener("click",(function(){ShowSlide(slideIndex-=1)})),pos.addEventListener("click",(function(){ShowSlide(slideIndex+=1)})),ShowSlide(slideIndex);</script>