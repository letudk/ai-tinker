<?php
// WEDGET BÀI VIẾT THEO CHUYÊN MỤC
    class smartkid_post extends WP_Widget {
        
		// Thông tin Widget
		function __construct() {
			parent::__construct(
			'smartkid_widget',
			'Smartkid Post',
			array(
			'description' => __('Hiển thị bài viết theo chuyên mục', 'smartkid')
			)
			);
        }
		
		// Form cập nhật các option cho Widget
        function form($instance) {
			$default = array(
			  'title' => '',
			  'id' => '',
			  'total' => '',
			  'grid' => '',
			);
			$instance = wp_parse_args($instance, $default);
			$title = esc_attr($instance['title']);
			$id = esc_attr($instance['id']);
			$total = esc_attr($instance['total']);
			$grid = $instance[ 'grid' ] ? 'true' : 'false';
			echo ('<p><input type="text" class="widefat" placeholder="Tên chuyên mục" name="'.$this->get_field_name('title').'" value="'.$title.'" /></p>');
			// get chuyen muc
			$cats = get_the_category();
                    if( $cats ) {
                    $id = $cats[0]->term_id;
                    }
			wp_dropdown_categories( array(
                    'orderby'    => 'title',
                    'id'         => 'chuyen-muc-sua',
					'hide_empty' => false,
					'name' =>      $this->get_field_name('id'),
                    'class'      => 'form-control',
					'hierarchical' => true,
                    'selected'   => $id,
                    'post__not_in' => get_option("sticky_posts"),
            ) );
			echo '<p>'. __('Số lượng', 'smartkid') .'</p>';
			echo ('<p><input type="number" style="width:80px" class="widefat" name="'.$this->get_field_name('total').'" value="'.$total.'" /></p>');
			?>
			<p><input class="checkbox" type="checkbox" <?php checked( $instance[ 'grid' ], 'on' ); ?> id="<?php echo $this->get_field_id( 'grid' ); ?>" name="<?php echo $this->get_field_name( 'grid' ); ?>" /> 
            <label><?php _e('Lưới', 'smartkid'); ?></label></p>
            <?php
        }
        
        // Hàm cập nhật Widget
        function update($new_instance, $old_instance) {
			$instance = $old_instance;
			$instance['title'] = $new_instance['title'];
			$instance['id'] = $new_instance['id'];
			$instance['total'] = $new_instance['total'];
			$instance['grid'] = $new_instance['grid'];
			return $instance;
			
        }
		
		// Hiển thị nội dung Widget lên website
        function widget($args, $instance) {
			extract($args);
			$instance = !empty($instance) ? $instance : array();
			$post_id = isset($instance['id']) ? $instance['id'] : 0;
			$post_total = isset($instance['total']) ? $instance['total'] : 6;
			?>
				<!-- bai viet theo chuyen muc -->
				<?php
				$smartkidpost = new WP_Query(array(
				'post_type'=>'post',
				'post_status'=>'publish',
				'cat' => $post_id,
				'orderby' => 'ID',
				'order' => 'DESC',
				'posts_per_page'=> $post_total,
				));
				?>
				<div class="widget-post" style="margin-bottom:20px;" data-aos="fade-in">
				<div class="widget-post-title"><h2>
				<?php if(!empty($instance['title'])) {echo $instance['title'];} else { _e('Xem ngay', 'smartkid');} ?></h2></div>
				<div class="widget-post-box" <?php if ('on' == isset($instance['grid'])) { echo 'style="display:grid;grid-template-columns: 1fr 1fr 1fr;grid-column-gap: 10px;grid-row-gap: 10px;"'; } ?> >
				<?php
				global $smartkid_options;
				if( $smartkidpost->have_posts() ) {
				while ($smartkidpost->have_posts()) : $smartkidpost->the_post();
				?>
				<div class="lq-widget-post">
				<div class="wg-image">
				<?php if ( has_post_thumbnail()) { ?>
				<a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>"><img width="200" height="113" title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>" class="lazyload" <?php if(isset($smartkid_options['speed1']) && isset($smartkid_options['speed2'])){echo 'src="'.get_template_directory_uri().'/images/anh-dai-dien.jpg" data-';} ?>src="<?php echo get_the_post_thumbnail_url (get_the_ID()); ?>" /></a>
				<?php }
				// anh dai dien tu dong lay anh dau tien
				else if (!empty(smartkid_anh_dai_dien_nho())){ ?>
				<a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>"><img width="200" height="113" title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>" class="lazyload" <?php if(isset($smartkid_options['speed1']) && isset($smartkid_options['speed2'])){echo 'src="'.get_template_directory_uri().'/images/anh-dai-dien.jpg" data-';} ?>src="<?php echo smartkid_anh_dai_dien_nho(); ?>"/></a>
				<?php } ?>
				</div>
				<div>
				<h3 class="title-post"><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php echo wp_trim_words( get_the_title() , 23 ) ?></a></h3>
				<div class="home_metabox">
					<a class="like">
					<i class="fa-thin fa-cloud-arrow-down"></i>
				 <span class ="small-text-wd"><?php echo getPostViews(get_the_ID()); ?></span></a> 
				</div>
				</div>
				</div>
				<?php endwhile; } else {echo '<div class="nopost"><span><i class="fa-regular fa-circle-exclamation"></i> '.__('Không có nội dung', 'smartkid'). '</span></div>';} 
				wp_reset_query(); ?>
				</div>
				<div class="xemthem"><a href="<?php echo get_category_link( $post_id ); ?>"><?php _e('Khám phá', 'smartkid'); ?> <i class="fa-solid fa-arrow-right"></i></a></div>
				</div>
			<?php
        }
    }
// WEDGET BÌNH LUẬN GẦN ĐÂY
class smartkid_comment extends WP_Widget {
        
		// Thông tin Widget
		function __construct() {
			parent::__construct(
			'smartkid_widget2',
			'Smartkid Comment',
			array(
			'description' => __('Hiển thị bình luận gần đây', 'smartkid')
			)
			);
        }
		
		// Form cập nhật các option cho Widget
        function form($instance) {
			$default = array(
			  'title' => '',
			  'total' => '',
			);
			$instance = wp_parse_args($instance, $default);
			$title = esc_attr($instance['title']);
			$total = esc_attr($instance['total']);
			echo ('<p><input type="text" class="widefat" placeholder="'. __('Tiêu đề nội dung bình luận', 'smartkid') .'" name="'.$this->get_field_name('title').'" value="'.$title.'" /></p>');
			echo '<p>'. __('Số lượng', 'smartkid') .'</p>';
			echo ('<p><input type="number" style="width:80px" class="widefat" name="'.$this->get_field_name('total').'" value="'.$total.'" /></p>');

        }
        
        // Hàm cập nhật Widget
        function update($new_instance, $old_instance) {
			$instance = $old_instance;
			$instance['title'] = $new_instance['title'];
			$instance['total'] = $new_instance['total'];
			return $instance;
			
        }
		
		// Hiển thị nội dung Widget lên website
        function widget($args, $instance) {
			extract($args);
			$instance = !empty($instance) ? $instance : array();
			$post_total = isset($instance['total']) ? $instance['total'] : 8;
				// bình luận gần đây 
				$args = array(
					'status' => 'approve',
					'number'=> $post_total,
				);
				echo '<div class="box-card" style="padding:20px;margin-bottom:20px" data-aos="fade-in">';
				if(!empty($instance['title'])){$comen_tit = $instance['title'];} else {$comen_tit = __('Bình luận gần đây', 'smartkid');}
				echo '<div class="widget-tieu">'.$before_title.'<i class="fa-regular fa-message-lines" style="margin-right:5px;"></i> '.$comen_tit.$after_title.'</div>';
				echo '<div class="binhluan-new">';
				global $smartkid_options;
				$comments_query = new WP_Comment_Query;
				$comments = $comments_query->query( $args );
				if ($comments) {
					foreach ($comments as $comment) {
						$url = '<a href="'. get_comment_link($comment->comment_ID) .'" title="'. $comment->comment_author .' | '.get_the_title($comment->comment_post_ID).'">';
						echo '<div class="td-comment">'. $url . wp_trim_words(get_the_title($comment->comment_post_ID), 10);
						if ($comment->post_parent > 0){echo ' - ' .wp_trim_words(get_the_title($comment->post_parent), 10);}
						echo '</a></div>';
						echo '<div class="tap-comment">';
						if(isset($smartkid_options['speed1']) && isset($smartkid_options['speed2'])){$lazycoment = 'src="'.get_template_directory_uri().'/images/anh-dai-dien.jpg" data-';} else {$lazycoment = null;}
						echo '<div class="comment-av"><a href="'.$comment->comment_author_url.'"><img alt="'.get_site_url().'" width="40" height="40"  class="lazyload" '.$lazycoment.'src="'.get_avatar_url($comment->comment_author_email).'"/></a></div>';  // Get Gravatar 
						$timeago = human_time_diff(strtotime( $comment->comment_date ), current_time('timestamp'));
						echo '<div class="comment-nd"><div style="margin-bottom:5px;"><a href="'.$comment->comment_author_url.'">'.$comment->comment_author.'</a> <span style="font-size:15px;">'. $timeago .' '. __('trước', 'smartkid') . '</span></div>';
						global $search_icon, $replace_icon;
						$loc_comen = str_replace($search_icon, $replace_icon, $comment->comment_content);
						echo '<div>' . $loc_comen . '</div>';
						echo '</div></div>';
					}
				}
				echo '</div></div>';
        }
    }
 
// WIDGET POST SOLID
class smartkid_post_slide extends WP_Widget {
		// Thông tin Widget
		function __construct() {
			parent::__construct(
			'Smartkid_widget4',
			'Smartkid Post slide',
			array(
			'description' => __('Hiển thị bài viết theo slide', 'smartkid')
			)
			);
        }

        // Hiển thị nội dung Widget lên website
        function widget($args, $instance) {
			extract($args);
			get_template_part( 'widget/post/face', get_post_type() );
        }
    }
    

// WIDGET HIỂN THỊ CHUYÊN MỤC TUỲ CHỌN
class smartkid_categories extends WP_Widget {
		// Thông tin Widget
		function __construct() {
			parent::__construct(
			'smartkid_widget5',
			'Smartkid Categories',
			array(
			'description' => __('Hiển list chuyên mục', 'smartkid')
			)
			);
        }
        
        // Form cập nhật các option cho Widget
        function form($instance) {
			$default = array(
			  'title' => '',
			  'id1' => '',
			  'id2' => '',
			  'id3' => '',
			  'id4' => '',
			  'grid' => '',

			);
			$instance = wp_parse_args($instance, $default);
			$id1 = esc_attr($instance['id1']);
			$id2 = esc_attr($instance['id2']);
			$id3 = esc_attr($instance['id3']);
			$id4 = esc_attr($instance['id4']);
			$grid = $instance[ 'grid' ] ? 'true' : 'false'; ?>
			<p><input class="checkbox" type="checkbox" <?php checked( $instance[ 'grid' ], 'on' ); ?> id="<?php echo $this->get_field_id( 'grid' ); ?>" name="<?php echo $this->get_field_name( 'grid' ); ?>" /> 
            <label><?php _e('Lưới', 'smartkid'); ?></label></p>
			<?php
			
			$cats = get_the_category();
                    if( $cats ) {
                    $id1 = $cats[0]->term_id;
                    }
			wp_dropdown_categories( array(
                    'orderby'    => 'title',
					'hide_empty' => false,
					'name' =>      $this->get_field_name('id1'),
					'hierarchical' => true,
                    'selected'   => $id1
            ) ); echo '<br><br>';
            // get chuyen muc ID2
			$cats = get_the_category();
                    if( $cats ) {
                    $id2 = $cats[0]->term_id;
                    }
			wp_dropdown_categories( array(
                    'orderby'    => 'title',
					'hide_empty' => false,
					'name' =>      $this->get_field_name('id2'),
					'hierarchical' => true,
                    'selected'   => $id2
            ) ); echo '<br><br>';
            // get chuyen muc ID3
			$cats = get_the_category();
                    if( $cats ) {
                    $id3 = $cats[0]->term_id;
                    }
			wp_dropdown_categories( array(
                    'orderby'    => 'title',
					'hide_empty' => false,
					'name' =>      $this->get_field_name('id3'),
					'hierarchical' => true,
                    'selected'   => $id3
            ) ); echo '<br><br>';
            // get chuyen muc ID4
			$cats = get_the_category();
                    if( $cats ) {
                    $id4 = $cats[0]->term_id;
                    }
			wp_dropdown_categories( array(
                    'orderby'    => 'title',
					'hide_empty' => false,
					'name' =>      $this->get_field_name('id4'),
					'hierarchical' => true,
                    'selected'   => $id4
            ) ); echo '<br><br>';
			
        } 
        // Hàm cập nhật Widget
        function update($new_instance, $old_instance) {
			$instance = $old_instance;
			$instance['grid'] = $new_instance['grid'];
			$instance['id1'] = $new_instance['id1'];
			$instance['id2'] = $new_instance['id2'];
			$instance['id3'] = $new_instance['id3'];
			$instance['id4'] = $new_instance['id4'];
			return $instance;
        }

        // Hiển thị nội dung Widget lên website
        function widget($args, $instance) {
			extract($args);
			$instance = !empty($instance) ? $instance : array();
			$post_id1 = isset($instance['id1']) ? $instance['id1'] : 0;
			$post_id2 = isset($instance['id2']) ? $instance['id2'] : 0;
			$post_id3 = isset($instance['id3']) ? $instance['id3'] : 0;
			$post_id4 = isset($instance['id4']) ? $instance['id4'] : 0;
			?>
			<div class="post-cm" <?php if ('on' == isset($instance['grid'])) { echo 'style="grid-template-columns: 1fr 1fr;"'; } ?> data-aos="fade-in">
			   <?php
				$category_ids = array($post_id1, $post_id2, $post_id3, $post_id4); 
				foreach ($category_ids as $post_id) {
					$category_link = get_category_link($post_id);
					$category_name = get_cat_name($post_id);
					?>
					<a style="border-left: 5px solid var(--texta);display:flex" href="<?php echo $category_link; ?>">
						<span style="width:100%">
							<i class="fa-regular fa-bolt" style="margin-right:10px;color:var(--texta);"></i>
							<?php echo $category_name; ?>
						</span>
						<span style="width:30px;"><i class="fa-solid fa-circle-chevron-right"></i><span>
					</a>
				<?php } ?>
		    </div>
			<?php
        }
    } 
// WEDGET SEARCH
class smartkid_search extends WP_Widget {
		// Thông tin Widget
		function __construct() {
			parent::__construct(
			'smartkid_widget10',
			'Smartkid Search',
			array(
			'description' => __('Hiển thị box tìm kiếm', 'smartkid')
			)
			);
        }
        // Hiển thị nội dung Widget lên website
        function widget($args, $instance) {
			extract($args);
			?>
			        <!-- tim kiem -->
                	<form method="get" action="<?php bloginfo('url'); ?>" data-aos="fade-in">
                	<div class="timkiem">
                	<input id="otim" placeholder="<?php _e('Nhập nội dung cần tìm kiếm', 'smartkid'); ?>" type="text" name="s" value="" maxlength="50" required="required" />
                	<button title="Search" type="submit" id="nuttim"><i class="fas fa-search"></i></button>
                	</div>
                	</form>
					<div class="widget-search" data-aos="fade-in">
					<?php
					$smartkidpost = new WP_Query(array(
					'post_type'=>'post',
					'post_status'=>'publish',
					'order'      => 'DESC',
					'posts_per_page'=> 3,
					'post__not_in' => get_option("sticky_posts"),
					'orderby' => 'rand',
					));
					if( $smartkidpost->have_posts() ) {
					while ($smartkidpost->have_posts()) : $smartkidpost->the_post(); ?>
					<h3 class="widget-search-tit"><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><i class="fa-regular fa-magnifying-glass"></i> <?php echo wp_trim_words( get_the_title() , 23 ) ?></a></h3>
					<?php
					endwhile; } else {echo '<div class="nopost"><span><i class="fa-regular fa-circle-exclamation"></i> '.__('Không có nội dung', 'smartkid'). '</span></div>';} 
					wp_reset_query();?>
					</div>
			<?php
        }
    }
// WEDGET BÀI VIẾT CÓ NHIỀU LƯỢT XEM
    class smartkid_post_views extends WP_Widget {
        
		// Thông tin Widget
		function __construct() {
			parent::__construct(
			'smartkid_widget11',
			'Smartkid Post views',
			array(
			'description' => __('Hiển thị bài viết có nhiều lượt xem', 'smartkid')
			)
			);
        }
		
		// Form cập nhật các option cho Widget
        function form($instance) {
			$default = array(
			  'total' => '',
			  'grid' => '',
			);
			$instance = wp_parse_args($instance, $default);
			$total = esc_attr($instance['total']);
			$grid = $instance[ 'grid' ] ? 'true' : 'false';
			echo '<p>'. __('Số lượng', 'smartkid') .'</p>';
			echo ('<p><input type="number" style="width:80px" class="widefat" name="'.$this->get_field_name('total').'" value="'.$total.'" /></p>');
			?>
			<p><input class="checkbox" type="checkbox" <?php checked( $instance[ 'grid' ], 'on' ); ?> id="<?php echo $this->get_field_id( 'grid' ); ?>" name="<?php echo $this->get_field_name( 'grid' ); ?>" /> 
            <label><?php _e('Lưới', 'smartkid'); ?></label></p>
            <?php
        }
        
        // Hàm cập nhật Widget
        function update($new_instance, $old_instance) {
			$instance = $old_instance;
			$instance['total'] = $new_instance['total'];
			$instance['grid'] = $new_instance['grid'];
			return $instance;
			
        }
		
		// Hiển thị nội dung Widget lên website
        function widget($args, $instance) {
			extract($args);
			$instance = !empty($instance) ? $instance : array();
			$post_total = isset($instance['total']) ? $instance['total'] : 6;

				$smartkidpost = new WP_Query(array(
				'post_type'=>'post',
				'post_status'=>'publish',
				'meta_key'  => 'post_views_count', // set custom meta key
                'orderby'    => 'meta_value_num',
                'order'      => 'DESC',
				'posts_per_page'=> $post_total,
				'post__not_in' => get_option("sticky_posts"),
				));
				?>
				<div class="widget-post" style="margin-bottom:20px;background: #fff;border: solid 1px #222;" data-aos="fade-in">
				<div class="widget-post-title"><h2><?php _e('TOP HÌNH', 'smartkid'); ?></h2></div>
				<div class="widget-post-box" <?php if ('on' == isset($instance['grid'])) { echo 'style="display:grid;grid-template-columns: 1fr 1fr 1fr;grid-column-gap: 10px;grid-row-gap: 10px;"'; } ?> >
				<?php
				global $smartkid_options;
				if( $smartkidpost->have_posts() ) {
				while ($smartkidpost->have_posts()) : $smartkidpost->the_post(); ?>
				<div class="lq-widget-post lq-widget-post-new">
				<div class="wg-imageav-view">
				<?php if ( has_post_thumbnail()) { ?>
				<a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>"><img width="150" height="150" title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>" class="lazyload" <?php if(isset($smartkid_options['speed1']) && isset($smartkid_options['speed2'])){echo 'src="'.get_template_directory_uri().'/images/anh-dai-dien.jpg" data-';} ?>src="<?php echo get_the_post_thumbnail_url (get_the_ID()); ?>" /></a>
				<?php }
				// anh dai dien tu dong lay anh dau tien
				else if (!empty(smartkid_anh_dai_dien_nho())){ ?>
				<a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>"><img width="150" height="150" title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>" class="lazyload" <?php if(isset($smartkid_options['speed1']) && isset($smartkid_options['speed2'])){echo 'src="'.get_template_directory_uri().'/images/anh-dai-dien.jpg" data-';} ?>src="<?php echo smartkid_anh_dai_dien_nho(); ?>"/></a>
				<?php } ?>
				<!-- <div class="wg-image-view"><span class="lq-sobai"></span></div> -->
				</div>
				<div>
				<h3 class="title-post"><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php echo wp_trim_words( get_the_title() , 23 ) ?></a></h3>
				<span class="view-lxem"><?php echo get_post_meta( get_the_ID(), 'post_views_count', true ); ?> <?php  _e('tải về', 'smartkid'); ?></span>
				</div>
				</div>
				<?php
				endwhile; } else {echo '<div class="nopost"><span><i class="fa-regular fa-circle-exclamation"></i> '.__('Không có nội dung', 'smartkid'). '</span></div>';}  
				wp_reset_query(); ?>
				</div>
				</div>
			<?php
        }
    }
// WEDGET BÀI VIẾT RANK
    class smartkid_post_rank extends WP_Widget {
        
		// Thông tin Widget
		function __construct() {
			parent::__construct(
			'smartkid_widget12',
			'Smartkid Post rank',
			array(
			'description' => __('Hiển thị bài viết có nhiều lượt xem và thịnh hành', 'smartkid')
			)
			);
        }
		// Hiển thị nội dung Widget lên website
        function widget($args, $instance) {
			extract($args);
			get_template_part( 'widget/post/rank', get_post_type() );
        }
    }
// WEDGET BÀI VIẾT BANNER
    class smartkid_post_banner extends WP_Widget {
        
		// Thông tin Widget
		function __construct() {
			parent::__construct(
			'smartkid_widget13',
			'Smartkid Post banner',
			array(
			'description' => __('Hiển thị bài viết theo dạng banner slide', 'smartkid')
			)
			);
        }
		// Hiển thị nội dung Widget lên website
        function widget($args, $instance) {
			extract($args);
			get_template_part( 'widget/post/banner', get_post_type() );
        }
    }
    
// WEDGET BÀI VIẾT THEO CHUYÊN MỤC SLIDE
    class smartkid_post_pro extends WP_Widget {
        
		// Thông tin Widget
		function __construct() {
			parent::__construct(
			'smartkid_widget14',
			'Smartkid Post pro',
			array(
			'description' => __('Hiển thị bài viết theo chuyên mục slide', 'smartkid')
			)
			);
        }
		
		// Form cập nhật các option cho Widget
        function form($instance) {
			$default = array(
			  'title' => '',
			  'id' => '',
			  'total' => '',
			);
			$instance = wp_parse_args($instance, $default);
			$title = esc_attr($instance['title']);
			$id = esc_attr($instance['id']);
			$total = esc_attr($instance['total']);
			echo ('<p><input type="text" class="widefat" placeholder="'. __('Tên chuyên mục', 'smartkid') .'" name="'.$this->get_field_name('title').'" value="'.$title.'" /></p>');
			// get chuyen muc
			$cats = get_the_category();
                    if( $cats ) {
                    $id = $cats[0]->term_id;
                    }
			wp_dropdown_categories( array(
                    'orderby'    => 'title',
                    'id'         => 'chuyen-muc-sua',
					'hide_empty' => false,
					'name' =>      $this->get_field_name('id'),
                    'class'      => 'form-control',
					'hierarchical' => true,
                    'selected'   => $id,
                    'post__not_in' => get_option("sticky_posts"),
            ) );
			echo '<p>'. __('Số lượng', 'smartkid') .'</p>';
			echo ('<p><input type="number" style="width:80px" class="widefat" name="'.$this->get_field_name('total').'" value="'.$total.'" /></p>');
        }
        
        // Hàm cập nhật Widget
        function update($new_instance, $old_instance) {
			$instance = $old_instance;
			$instance['title'] = $new_instance['title'];
			$instance['id'] = $new_instance['id'];
			$instance['total'] = $new_instance['total'];
			return $instance;
			
        }
		
		// Hiển thị nội dung Widget lên website
        function widget($args, $instance) {
			extract($args);
			$instance = !empty($instance) ? $instance : array();
			$post_id = isset($instance['id']) ? $instance['id'] : 0;
			$post_total = isset($instance['total']) ? $instance['total'] : 8;
			?>
			<div class="widget-post-pro" style="margin-bottom:20px;" data-aos="fade-in">
			<div class="widget-post-title"><i class="fa-regular fa-bolt"></i> <?php if(!empty($instance['title'])){ echo $instance['title'];} else { _e('Bạn nên xem', 'smartkid');} ?> <span class="xemthem" style="float:right;margin-top:0px" ><a href="<?php echo get_category_link( $post_id ); ?>"><?php _e('Thêm', 'smartkid'); ?> <i class="fa-solid fa-arrow-right"></i></a></span></div>
            <div class="top-face2">
            <div class="scrol">
            <?php 
			global $smartkid_options;
			$smartkidpost = new WP_Query(array( 
                    'post_type'=>'post',
                	'post_status'=>'publish',
                	'cat' => $post_id,
                	'orderby' => 'ID',
                	'order' => 'DESC',
                	'posts_per_page'=> $post_total,
                    'post__not_in' => get_option("sticky_posts"),
                    
            ));
			if( $smartkidpost->have_posts() ) {
			while ($smartkidpost->have_posts()) : $smartkidpost->the_post(); ?>
			<div class="itenbai">
				<?php if ( has_post_thumbnail()) { ?>
				<a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>"><img width="150" height="150" title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>" class="facebai lazyload" <?php if(isset($smartkid_options['speed1']) && isset($smartkid_options['speed2'])){echo 'src="'.get_template_directory_uri().'/images/anh-dai-dien.jpg" data-';} ?>src="<?php echo get_the_post_thumbnail_url (get_the_ID()); ?>" /></a>
				<?php }
				// anh dai dien tu dong lay anh dau tien
				else if (!empty(smartkid_anh_dai_dien_nho())){ ?>
				<a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>"><img width="150" height="150" title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>" class="facebai lazyload" <?php if(isset($smartkid_options['speed1']) && isset($smartkid_options['speed2'])){echo 'src="'.get_template_directory_uri().'/images/anh-dai-dien.jpg" data-';} ?>src="<?php echo smartkid_anh_dai_dien_nho(); ?>"/></a>
				<?php } ?>
			<div class="itembai1ten"><a href="<?php the_permalink();?>"><?php echo wp_trim_words( get_the_title() , 12 ) ?></a></div>
			</div>
			<?php endwhile; } else {echo '<div class="nopost"><span><i class="fa-regular fa-circle-exclamation"></i> '.__('Không có nội dung', 'smartkid'). '</span></div>';}
			wp_reset_query() ;?>
			</div>
			</div>
			</div>
<?php
        }
    }
 
// WEDGET BÀI VIẾT BANNER
class smartkid_top_post extends WP_Widget {
	
	// Thông tin Widget
	function __construct() {
		parent::__construct(
		'smartkid_widget16',
		'Smartkid Top post',
		array(
		'description' => __('Hiển thị bài viết mới ở trên cùng', 'smartkid')
		)
		);
	}
	// Hiển thị nội dung Widget lên website
	function widget($args, $instance) {
		extract($args);
		get_template_part( 'widget/post/grid', get_post_type() );
	}
} 
// WEDGET BÀI VIẾT THEO CHUYÊN MỤC PAGE
    class smartkid_post_page extends WP_Widget {
        
		// Thông tin Widget
		function __construct() {
			parent::__construct(
			'smartkid_widget18',
			'Smartkid Post page',
			array(
			'description' => __('Hiển thị bài viết theo chuyên mục có tải trang', 'smartkid')
			)
			);
        }
		
		// Form cập nhật các option cho Widget
        function form($instance) {
			$default = array(
			  'title' => '',
			  'id' => '',
			  'total' => '',
			);
			$instance = wp_parse_args($instance, $default);
			$title = esc_attr($instance['title']);
			$id = esc_attr($instance['id']);
			$total = esc_attr($instance['total']);
			echo ('<p><input type="text" class="widefat" placeholder="Tên chuyên mục" name="'.$this->get_field_name('title').'" value="'.$title.'" /></p>');
			// get chuyen muc
			$cats = get_the_category();
                    if( $cats ) {
                    $id = $cats[0]->term_id;
                    }
			wp_dropdown_categories( array(
                    'orderby'    => 'title',
                    'id'         => 'chuyen-muc-sua',
					'hide_empty' => false,
					'name' =>      $this->get_field_name('id'),
                    'class'      => 'form-control',
					'hierarchical' => true,
                    'selected'   => $id,
                    'post__not_in' => get_option("sticky_posts"),
            ) );
			echo '<p>'. __('Số lượng', 'smartkid') .'</p>';
			echo ('<p><input type="number" style="width:80px" class="widefat" name="'.$this->get_field_name('total').'" value="'.$total.'" /></p>');
        }
        
        // Hàm cập nhật Widget
        function update($new_instance, $old_instance) {
			$instance = $old_instance;
			$instance['title'] = $new_instance['title'];
			$instance['id'] = $new_instance['id'];
			$instance['total'] = $new_instance['total'];
			return $instance;
			
        }
		
		// Hiển thị nội dung Widget lên website
        function widget($args, $instance) {
			extract($args);
			global $pagez, $onpage;
			$instance = !empty($instance) ? $instance : array();
			$post_id = isset($instance['id']) ? $instance['id'] : 0;
			$post_total = isset($instance['total']) ? $instance['total'] : 6;
			?>
				<!-- bai viet theo chuyen muc -->
				<?php
				if(!empty($instance['id'])){$pagez = $onpage = $instance['id'];} else {$pagez = $onpage  = null;}
				$smartkidpost = new WP_Query(array(
				'post_type'=>'post',
				'post_status'=>'publish',
				'cat' => $post_id,
				'orderby' => 'ID',
				'order' => 'DESC',
				'posts_per_page'=> $post_total,
				'paged' => !empty($_GET['pg'. $pagez]) ? absint($_GET['pg'. $pagez]) : 1,
				));
				?>
				<?php if(!empty($instance['title'])){ ?><div class="post-page-title" data-aos="fade-in"><i class="fa-regular fa-bolt"></i> <?php echo $instance['title']; ?></div><?php } ?>
				<div class="main-content" id="onpage<?php echo $onpage; ?>" style="margin-bottom:20px;" data-aos="fade-in">
				<?php
				if( $smartkidpost->have_posts() ) {
				while ($smartkidpost->have_posts()) : $smartkidpost->the_post();
				get_template_part( 'setcard', get_post_type() );
				endwhile;
				if(!empty(myPaginateLinks($smartkidpost))){ echo '<nav class="navigation pagination" aria-label="1"><div class="land-page">'. myPaginateLinks($smartkidpost) .'</div></nav>';}
				} else {echo '<div class="nopost"><span><i class="fa-regular fa-circle-exclamation"></i> '.__('Không có nội dung', 'smartkid'). '</span></div>';} 
				wp_reset_query(); ?>
				</div>
				<?php
        }
    } 
// WEDGET BÀI VIẾT THEO CHUYÊN MỤC SLIDE GRADIENT
    class smartkid_post_gradient extends WP_Widget {
        
		// Thông tin Widget
		function __construct() {
			parent::__construct(
			'smartkid_widget20',
			'Smartkid Post gradient',
			array(
			'description' => __('Hiển thị bài viết theo chuyên mục slide có nền gradient', 'smartkid')
			)
			);
        }
		
		// Form cập nhật các option cho Widget
        function form($instance) {
			$default = array(
			  'title' => '',
			  'id' => '',
			  'total' => '',
			  'color1' => '',
			  'color2' => '',
			);
			$instance = wp_parse_args($instance, $default);
			$title = esc_attr($instance['title']);
			$id = esc_attr($instance['id']);
			$total = esc_attr($instance['total']);
			$color1 = esc_attr($instance['color1']);
			$color2 = esc_attr($instance['color2']);
			echo ('<p><input type="text" class="widefat" placeholder="'. __('Tên chuyên mục', 'smartkid') .'" name="'.$this->get_field_name('title').'" value="'.$title.'" /></p>');
			echo '<p style="font-weight:bold">'. __('Chọn màu nền gradient', 'smartkid') .'</p>';
			echo ('<p><input type="color" style="width:80px;height:50px" class="widefat"  name="'.$this->get_field_name('color1').'" value="'.$color1.'" /></p>');
			echo ('<p><input type="color" style="width:80px;height:50px" class="widefat"  name="'.$this->get_field_name('color2').'" value="'.$color2.'" /></p>');
			// get chuyen muc
			$cats = get_the_category();
                    if( $cats ) {
                    $id = $cats[0]->term_id;
                    }
			wp_dropdown_categories( array(
                    'orderby'    => 'title',
                    'id'         => 'chuyen-muc-sua',
					'hide_empty' => false,
					'name' =>      $this->get_field_name('id'),
                    'class'      => 'form-control',
					'hierarchical' => true,
                    'selected'   => $id,
                    'post__not_in' => get_option("sticky_posts"),
            ) );
			echo '<p>'. __('Số lượng', 'smartkid') .'</p>';
			echo ('<p><input type="number" style="width:80px" class="widefat" name="'.$this->get_field_name('total').'" value="'.$total.'" /></p>');
        }
        
        // Hàm cập nhật Widget
        function update($new_instance, $old_instance) {
			$instance = $old_instance;
			$instance['title'] = $new_instance['title'];
			$instance['id'] = $new_instance['id'];
			$instance['total'] = $new_instance['total'];
			$instance['color1'] = $new_instance['color1'];
			$instance['color2'] = $new_instance['color2'];
			return $instance;
			
        }
		
		// Hiển thị nội dung Widget lên website
        function widget($args, $instance) {
			extract($args);
			$instance = !empty($instance) ? $instance : array();
			$post_id = isset($instance['id']) ? $instance['id'] : 0;
			$post_total = isset($instance['total']) ? $instance['total'] : 8;
			?>
			<div class="widget-post-pro widget-gradient-box" style="margin-bottom:20px;<?php if(!empty($instance['color1']) && !empty($instance['color2'])){ echo 'background: linear-gradient(153deg, '.$instance['color1'].' 0%, '.$instance['color2'].' 100%);';}?>" data-aos="fade-in">
			
            <div class="top-face2">
            <div class="scrol">
            <?php 
			global $smartkid_options;
			// $smartkidpost = get_transient( 'smartkidpost' );

    		// if ( false === $smartkidpost ) {
			$smartkidpost = new WP_Query(array( 
                    'post_type'=>'post',
                	'post_status'=>'publish',
                	'cat' => $post_id,
                	'orderby' => 'ID',
                	'order' => 'DESC',
                	'posts_per_page'=> $post_total,
                    'post__not_in' => get_option("sticky_posts"),
                    
            ));
			// $smartkidpost = $smartkidpost->posts;
			// set_transient( 'smartkidpost', $smartkidpost, DAY_IN_SECONDS );
		// }
			if( $smartkidpost->have_posts() ) {
			while ($smartkidpost->have_posts()) : $smartkidpost->the_post(); 
			$backgrounds = [
				'#fff4fc', // Màu đỏ nhạt
				'#F0FFE8', // Màu cam nhạt
				'#ECF5FF', // Màu vàng nhạt
				'#FFF9E6', // Màu xanh lá nhạt
				'#F8FDF6', // Màu xanh dương nhạt
				'#a0c4ff', // Màu tím nhạt
			];
			$random_background = $backgrounds[array_rand($backgrounds)];
			?>
			<div class="itenbai" style="background-color: <?php echo $random_background; ?>;">
				<?php if ( has_post_thumbnail()) { ?>
				<a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>"><img width="150" height="150" title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>" class="facebai lazyload" <?php if(isset($smartkid_options['speed1']) && isset($smartkid_options['speed2'])){echo 'src="'.get_template_directory_uri().'/images/anh-dai-dien.jpg" data-';} ?>src="<?php echo get_the_post_thumbnail_url (get_the_ID()); ?>" /></a>
				<?php }
				// anh dai dien tu dong lay anh dau tien
				else if (!empty(smartkid_anh_dai_dien_nho())){ ?>
				<a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>"><img width="150" height="150" title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>" class="facebai lazyload" <?php if(isset($smartkid_options['speed1']) && isset($smartkid_options['speed2'])){echo 'src="'.get_template_directory_uri().'/images/anh-dai-dien.jpg" data-';} ?>src="<?php echo smartkid_anh_dai_dien_nho(); ?>"/></a>
				<?php } ?>
			<div class="itembai1ten"><a href="<?php the_permalink();?>"><?php echo wp_trim_words( get_the_title() , 12 ) ?></a></div>
			</div>
			<?php endwhile; } else {echo '<div class="nopost"><span><i class="fa-regular fa-circle-exclamation"></i> '.__('Không có nội dung', 'smartkid'). '</span></div>';}
			wp_reset_query();?>
			</div>
			</div>
			</div>
<?php
        }
    }
	 
	
// WEDGET BÀI VIẾT THEO CHUYÊN MỤC HAT
    class smartkid_post_hat extends WP_Widget {
        
		// Thông tin Widget
		function __construct() {
			parent::__construct(
			'smartkid_widget22',
			'Smartkid Post hat',
			array(
			'description' => __('Hiển thị bài viết theo chuyên mục có đường viền hạt', 'smartkid')
			)
			);
        }
		
		// Form cập nhật các option cho Widget
        function form($instance) {
			$default = array(
			  'title' => '',
			  'id' => '',
			  'total' => '',
			);
			$instance = wp_parse_args($instance, $default);
			$title = esc_attr($instance['title']);
			$id = esc_attr($instance['id']);
			$total = esc_attr($instance['total']);
			echo ('<p><input type="text" class="widefat" placeholder="'. __('Tên chuyên mục', 'smartkid') .'" name="'.$this->get_field_name('title').'" value="'.$title.'" /></p>');
			// get chuyen muc
			$cats = get_the_category();
                    if( $cats ) {
                    $id = $cats[0]->term_id;
                    }
			wp_dropdown_categories( array(
                    'orderby'    => 'title',
                    'id'         => 'chuyen-muc-sua',
					'hide_empty' => false,
					'name' =>      $this->get_field_name('id'),
                    'class'      => 'form-control',
					'hierarchical' => true,
                    'selected'   => $id,
                    'post__not_in' => get_option("sticky_posts"),
            ) );
			echo '<p>'. __('Số lượng', 'smartkid') .'</p>';
			echo ('<p><input type="number" style="width:80px" class="widefat" name="'.$this->get_field_name('total').'" value="'.$total.'" /></p>');
        }
        
        // Hàm cập nhật Widget
        function update($new_instance, $old_instance) {
			$instance = $old_instance;
			$instance['title'] = $new_instance['title'];
			$instance['id'] = $new_instance['id'];
			$instance['total'] = $new_instance['total'];
			return $instance;
			
        }
		
		// Hiển thị nội dung Widget lên website
        function widget($args, $instance) {
			extract($args);
			$instance = !empty($instance) ? $instance : array();
			$post_id = isset($instance['id']) ? $instance['id'] : 0;
			$post_total = isset($instance['total']) ? $instance['total'] : 8;
			?>
			<div class="widget-hat-tit"><?php if(!empty($instance['title'])){ echo $instance['title'];} else { _e('Xem nhanh', 'smartkid');} ?></div>
			<div class="widget-hat-box" data-aos="fade-in">
			<?php 
			global $smartkid_options;
			$smartkidpost = new WP_Query(array( 
                    'post_type'=>'post',
                	'post_status'=>'publish',
                	'cat' => $post_id,
                	'orderby' => 'ID',
                	'order' => 'DESC',
                	'posts_per_page'=> $post_total,
                    'post__not_in' => get_option("sticky_posts"),
                    
            ));
			if( $smartkidpost->have_posts() ) {
			while ($smartkidpost->have_posts()) : $smartkidpost->the_post(); ?>
			<div class="widget-hat-nd">
				<div class="widget-hat-text">
				  <h3><a href="<?php the_permalink();?>"><?php echo wp_trim_words( get_the_title() , 15 ) ?></a></h3>
				</div>
				<?php if ( has_post_thumbnail()) { ?>
				<a class="widget-hat-img" title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>"><img width="150" height="100" title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>" class="lazyload" <?php if(isset($smartkid_options['speed1']) && isset($smartkid_options['speed2'])){echo 'src="'.get_template_directory_uri().'/images/anh-dai-dien.jpg" data-';} ?>src="<?php echo get_the_post_thumbnail_url (get_the_ID()); ?>" /></a>
				<?php }
				// anh dai dien tu dong lay anh dau tien
				else if (!empty(smartkid_anh_dai_dien_nho())){ ?>
				<a class="widget-hat-img" title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>"><img width="150" height="100" title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>" class="lazyload" <?php if(isset($smartkid_options['speed1']) && isset($smartkid_options['speed2'])){echo 'src="'.get_template_directory_uri().'/images/anh-dai-dien.jpg" data-';} ?>src="<?php echo smartkid_anh_dai_dien_nho(); ?>"/></a>
				<?php } ?>
			</div>
			<?php endwhile; ?> 
			<?php } else {echo '<div class="nopost"><span><i class="fa-regular fa-circle-exclamation"></i> '.__('Không có nội dung', 'smartkid'). '</span></div>';}
			wp_reset_query(); ?>
			</div>			
<?php
        }
    }
	 
// WIDGET HIỂN THỊ CHUYÊN MỤC HÌNH ẢNH TUỲ CHỌN
class smartkid_categories_img extends WP_Widget {
		// Thông tin Widget
		function __construct() {
			parent::__construct(
			'smartkid_widget25',
			'Smartkid Categories images',
			array(
			'description' => __('Hiển list chuyên mục hình ảnh', 'smartkid')
			)
			);
        }
        
        // Form cập nhật các option cho Widget
        function form($instance) {
			$default = array(
			  'id1' => '',
			  'id2' => '',
			  'id3' => '',
			  'id4' => '',

			);
			$instance = wp_parse_args($instance, $default);
			$id1 = esc_attr($instance['id1']);
			$id2 = esc_attr($instance['id2']);
			$id3 = esc_attr($instance['id3']);
			$id4 = esc_attr($instance['id4']);
			echo '<br>';
			$cats = get_the_category();
                    if( $cats ) {
                    $id1 = $cats[0]->term_id;
                    }
			wp_dropdown_categories( array(
                    'orderby'    => 'title',
					'hide_empty' => false,
					'name' =>      $this->get_field_name('id1'),
					'hierarchical' => true,
                    'selected'   => $id1
            ) ); echo '<br><br>';
            // get chuyen muc ID2
			$cats = get_the_category();
                    if( $cats ) {
                    $id2 = $cats[0]->term_id;
                    }
			wp_dropdown_categories( array(
                    'orderby'    => 'title',
					'hide_empty' => false,
					'name' =>      $this->get_field_name('id2'),
					'hierarchical' => true,
                    'selected'   => $id2
            ) ); echo '<br><br>';
            // get chuyen muc ID3
			$cats = get_the_category();
                    if( $cats ) {
                    $id3 = $cats[0]->term_id;
                    }
			wp_dropdown_categories( array(
                    'orderby'    => 'title',
					'hide_empty' => false,
					'name' =>      $this->get_field_name('id3'),
					'hierarchical' => true,
                    'selected'   => $id3
            ) ); echo '<br><br>';
            // get chuyen muc ID4
			$cats = get_the_category();
                    if( $cats ) {
                    $id4 = $cats[0]->term_id;
                    }
			wp_dropdown_categories( array(
                    'orderby'    => 'title',
					'hide_empty' => false,
					'name' =>      $this->get_field_name('id4'),
					'hierarchical' => true,
                    'selected'   => $id4
            ) ); echo '<br><br>';
			
        } 
        // Hàm cập nhật Widget
        function update($new_instance, $old_instance) {
			$instance = $old_instance;
			$instance['id1'] = $new_instance['id1'];
			$instance['id2'] = $new_instance['id2'];
			$instance['id3'] = $new_instance['id3'];
			$instance['id4'] = $new_instance['id4'];
			return $instance;
        }

        // Hiển thị nội dung Widget lên website
        function widget($args, $instance) {
			extract($args);
			$instance = !empty($instance) ? $instance : array();
			$post_id1 = isset($instance['id1']) ? $instance['id1'] : 0;
			$post_id2 = isset($instance['id2']) ? $instance['id2'] : 0;
			$post_id3 = isset($instance['id3']) ? $instance['id3'] : 0;
			$post_id4 = isset($instance['id4']) ? $instance['id4'] : 0;
			?>
			<div class="widget-cm-img">
			    <?php
				$category_ids = array($post_id1, $post_id2, $post_id3, $post_id4);
				global $smartkid_options;
				foreach ($category_ids as $post_id) {
					$category_link = get_category_link($post_id);
					$category_name = get_cat_name($post_id);
					// lay image anh
					$term_meta = get_term_meta($post_id, 'custom_term_meta', true);
					$custom_img_url = isset($term_meta['custom_img']) ? esc_url($term_meta['custom_img']) : '';
					?>
					<a href="<?php echo $category_link; ?>">
					<?php 
					if ($custom_img_url) { ?>
					<img alt="<?php echo $category_name; ?>" class="lazyload" <?php if(isset($smartkid_options['speed1']) && isset($smartkid_options['speed2'])){echo 'src="'.get_template_directory_uri().'/images/anh-dai-dien.jpg" data-';} ?>src="<?php echo $custom_img_url; ?>">
					<?php } else { ?>
					<img alt="<?php echo $category_name; ?>" class="lazyload" <?php if(isset($smartkid_options['speed1']) && isset($smartkid_options['speed2'])){echo 'src="'. get_template_directory_uri().'/images/anh-dai-dien.jpg" data-';} ?>src="<?php echo get_template_directory_uri().'/images/anh-dai-dien.jpg'; ?>">
					<?php } ?>
					<span><?php echo wp_trim_words($category_name, 3); ?></span>
					</a>
				<?php } ?>
		    </div>
			<?php
        }
    }	
 

	class Smartkid_Post_Box extends WP_Widget {
		// Khởi tạo Widget
		function __construct() {
			parent::__construct(
				'smartkid_post_box',
				'Smartkid Post Box',
				array('description' => __('Hiển thị hộp đăng bài', 'smartkid'))
			);
		}
	
		// Hiển thị form cấu hình trong Admin (không cần thiết trong trường hợp này)
		function form($instance) {
			// Không có thiết lập nào cần cấu hình
		}
	
		// Lưu cấu hình Widget (không cần thiết trong trường hợp này)
		function update($new_instance, $old_instance) {
			return $old_instance;
		}
	
		// Hiển thị Widget ra giao diện
		function widget($args, $instance) {
			echo $args['before_widget']; 
			$messages = array(
				'Bạn ơi, cùng chia sẻ những mẹo hay nào...',
				'Bạn có mẹo nào thú vị không? Hãy đăng bài!',
				'Cùng lan tỏa kinh nghiệm hữu ích nhé!',
			);
			$random_message = $messages[array_rand($messages)];
			$dangbai_url = home_url().'/dang-tin'; 

			?>
			
			<div class="smartkid-post-box" onclick="window.location.href='<?php echo esc_js($dangbai_url); ?>'">
				<div class="smartkid-post-box-icon">
					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 16 16">
						<circle cx="8" cy="8" r="4" fill="black" />
					</svg>
				</div>
				<span class="smartkid-post-box-text"><?php echo $random_message; ?></span>
			</div>
			<?php
			echo $args['after_widget'];
		}
	} 
 
class Smartkid_Post_Box_Recent extends WP_Widget {
    // Khởi tạo Widget
    function __construct() {
        parent::__construct(
            'smartkid_post_box_recent',
            'Smartkid Post Box Recent',
            array('description' => __('Hiển thị bài viết mới nhất', 'smartkid'))
        );
    }

    // Hiển thị form cấu hình trong Admin (không cần thiết)
    function form($instance) {
        // Không có thiết lập nào cần cấu hình
    }

    // Lưu cấu hình Widget (không cần thiết)
    function update($new_instance, $old_instance) {
        return $old_instance;
    }

    // Hiển thị Widget ra giao diện
    function widget($args, $instance) {
        echo $args['before_widget']; 

        // Truy vấn bài viết mới nhất
        $query_args = array(
            'posts_per_page' => 5,
            'post_status' => 'publish'
        );
        $recent_posts = new WP_Query($query_args);

        if ($recent_posts->have_posts()) {
            echo '<div class="smartkid-post-box-r">';
            while ($recent_posts->have_posts()) {
                $recent_posts->the_post();
                ?>
                <div class="post-item">
                    <div class="post-thumbnail">
                        <?php if (has_post_thumbnail()) {
                            the_post_thumbnail('thumbnail');
                        } else { ?>
                            <img src="https://via.placeholder.com/150" alt="Placeholder">
                        <?php } ?>
                    </div>
                    <div class="post-content">
                        <div class="post-category">
                            <?php echo get_the_category_list(', '); ?>
                        </div>
                        <h3 class="post-title">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h3>
                        <div class="post-meta">
                            <span class="post-author"><?php the_author(); ?></span>
                            <span class="post-comments">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M8 0C3.58 0 0 3.582 0 8c0 1.578.48 3.042 1.295 4.27-.535 2.016-1.775 3.72-1.785 3.74A.5.5 0 0 0 .5 16c2.32 0 4.136-.896 5.185-1.58A7.963 7.963 0 0 0 8 16c4.42 0 8-3.582 8-8s-3.58-8-8-8zM3 7h10v2H3V7z"/>
                                </svg> 
                                <?php comments_number('0', '1', '%'); ?>
                            </span>
                        </div>
                    </div>
                </div>
                <?php
            }
            echo '</div>';
        }
        wp_reset_postdata();

        echo $args['after_widget'];
    }
} 