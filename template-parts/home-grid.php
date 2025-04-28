<?php
/**
*  Card bài viết ở Home grid
**/
global $smartkid_options;
$image_thumb ="<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 160 90' fill='none' stroke='black' role='img stroke-width='1'>
  <rect x='1.5' y='1.5' width='157' height='87' rx='10' stroke='black' fill='white'/>
  <path d='M25 70l30-40 20 25 20-20 30 35' stroke='black' fill='none' stroke-linecap='round' stroke-linejoin='round'/>
  <circle cx='20' cy='25' r='6' fill='white' stroke='black'/>
</svg>";
?>
<article class="grid-card <?php if(is_sticky()){echo 'post-sticky';} ?>" data-aos="fade-in">
	<div class="card-content"> 
		<div> 
			<?php if ( has_post_thumbnail()) { ?>
			<div class="grid-image">
			<a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>"><img title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>" width="600" height="400" class="lazyload" <?php if(isset($smartkid_options['speed1']) && isset($smartkid_options['speed2'])){echo 'src="'.get_template_directory_uri().'/images/anh-dai-dien.jpg" data-';} ?>src="<?php echo get_the_post_thumbnail_url (get_the_ID()); ?>" /></a>
			</div>
			<?php } else { ?>
			<div class="grid-image">
				<a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>" aria-label="<?php echo wp_trim_words( get_the_title() , 18 ) ?>">
					<img title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>" width="600" height="400" class="lazyload" <?php  echo 'src="'.get_template_directory_uri().'/images/anh-dai-dien.jpg" data-'; ?> />
				</a>
			</div>
			<?php } ?> 
			<div style="padding:15px;" class="grid-sela">
				<?php if ( 'post' === get_post_type() ) : $category = get_the_category(); $category = reset( $category ); ?>
				<div class="grid-cm">
					<a  href="<?php echo esc_url( get_category_link( $category ) ); ?>">
						<i class="fa-thin fa-folder-open"></i> Tranh tô màu
					</a>
					<span class="download" style="float:right;">
					<i class="fa-thin fa-cloud-arrow-down"></i>
				 	<?php echo getPostViews(get_the_ID()); ?></span> 
				</div><?php endif; ?> 
				<h2 style="font-size:15px;line-height: 1.3;margin:0px; font-weight: 500;"><a href="<?php the_permalink();?>" aria-label="<?php echo wp_trim_words( get_the_title() , 18 ) ?>"><?php echo wp_trim_words( get_the_title() , 18 ) ?></a></h2>
		
			</div> 
		</div>
	</div>
</article> 