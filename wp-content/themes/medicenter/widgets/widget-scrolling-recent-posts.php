<?php
class scrolling_recent_posts_widget extends WP_Widget 
{
	/** constructor */
    function scrolling_recent_posts_widget() 
	{
		global $themename;
		$widget_options = array(
			'classname' => 'scrolling_recent_posts_widget',
			'description' => 'Displays scrolling recent posts list'
		);
        parent::WP_Widget('medicenter_scrolling_recent_posts', __('Scrolling Recent Posts', 'medicenter'), $widget_options);
    }
	
	/** @see WP_Widget::widget */
    function widget($args, $instance) 
	{
        extract($args);

		//these are our widget options
		$title = $instance['title'];
		$animation = $instance['animation'];
		$count = $instance['count'];

		//get recent posts
		query_posts(array( 
			'post_type' => 'post',
			'post_status' => 'publish',
			'posts_per_page' => $count,
			'order' => 'DESC'
		));
		
		echo $before_widget;
		?>
		<div class="clearfix">
			<div class="header_left">
				<?php
				if($title) 
				{
					echo ((int)$animation ? str_replace("box_header", "box_header animation-slide", $before_title) : str_replace("animation-slide", "", $before_title)) . apply_filters("widget_title", $title) . $after_title;
				}
				?>
			</div>
			<div class="header_right">
				<a href="#" id="footer_recent_posts_prev" class="scrolling_list_control_left icon_small_arrow left_white"></a>
				<a href="#" id="footer_recent_posts_next" class="scrolling_list_control_right icon_small_arrow right_white"></a>
			</div>
		</div>
		<div class="scrolling_list_wrapper">
			<ul class="scrolling_list footer_recent_posts">
				<?php
				if(have_posts()) : while (have_posts()) : the_post();
				?>
				<li class="icon_small_arrow right_white">
					<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
						<?php the_title(); ?>
					</a>
					<abbr title="<?php echo get_time_iso8601(); ?>" class="timeago"><?php echo get_time_iso8601(); ?></abbr>
				</li>
				<?php
				endwhile; endif;
				wp_reset_query();
				?>
			</ul>
		</div>
		<?php
        echo $after_widget;
    }
	
	/** @see WP_Widget::update */
    function update($new_instance, $old_instance) 
	{
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['animation'] = strip_tags($new_instance['animation']);
		$instance['count'] = strip_tags($new_instance['count']);
		return $instance;
    }
	
	 /** @see WP_Widget::form */
	function form($instance) 
	{	
		global $themename;
		$title = esc_attr($instance['title']);
		$animation = esc_attr($instance['animation']);
		$count = esc_attr($instance['count']);
		?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'medicenter'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('animation'); ?>"><?php _e('Title border animation', 'medicenter'); ?></label>
			<select id="<?php echo $this->get_field_id('animation'); ?>" name="<?php echo $this->get_field_name('animation'); ?>">
				<option value="0"><?php _e('no', 'medicenter'); ?></option>
				<option value="1"<?php echo ((int)$animation==1 ? ' selected="selected"' : ''); ?>><?php _e('yes', 'medicenter'); ?></option>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('count'); ?>"><?php _e('Count', 'medicenter'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>" type="text" value="<?php echo $count; ?>" />
		</p>
		<?php
	}
}
//register widget
add_action('widgets_init', create_function('', 'return register_widget("scrolling_recent_posts_widget");'));
?>