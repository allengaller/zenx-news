<?php 
/* Mini slide show of post thumbnails. */

class Mibook_Content_Slider extends WP_Widget {
	function Mibook_Content_Slider() {
		$widget_ops = array( 'classname' => 'mibook_content_slider', 'description' => __( 'Slide show of your custom HTML content. You can use it for testimonials, or image slide show.', 'mibook') );
		$this->WP_Widget('mibook-content-slider', __( 'Mibook Content Slider', 'mibook' ), $widget_ops);
	}
	
	function widget($args, $instance) {
		extract($args);
		$title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title']);		
			
		if ( !$speed = (int) $instance['speed'] )
			$speed = 400;
		else if ( $speed < 1 )
			$speed = 400;
			
		if ( !$timeout = (int) $instance['timeout'] )
			$timeout = 4000;
		else if ( $timeout < 1 )
			$timeout = 4000;			
						
		$text = $instance['text'];
		$sliderID = empty( $instance['sliderID'] ) ? '' : $instance['sliderID'];
		$fx = $instance['fx'];
			 echo $before_widget; 
             if ( $title ) echo $before_title . $title . $after_title; ?>
             
        <script type="text/javascript">
			var $s = jQuery.noConflict();
			$s(window).load(function(){
				$s('#<?php echo $sliderID; ?>').cycle({	
					fx: '<?php echo $fx; ?>',
					speed: <?php echo $speed; ?>, 
					timeout: <?php echo $timeout; ?>,
					sync:1,
					pause:1,
					next: '#<?php echo $sliderID.'-next'; ?>',
					prev: '#<?php echo $sliderID.'-prev'; ?>'		
				})	
			}) 
        </script> 
        <div class="cs_slider_wrap">
			<div class="cs-controls">
				<a class="cs_prev" href="#" id="<?php echo $sliderID.'-prev'; ?>"></a><a class="cs_next" href="#" id="<?php echo $sliderID.'-next'; ?>"></a>
			</div>
			<ul id="<?php echo $sliderID; ?>" class="cs_slider">
                <?php echo $text; ?>
			</ul>

		</div><!-- .cs_slider_wrap --> 
		<?php echo $after_widget;		

	}
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		if ( in_array( $new_instance['fx'], array( 'fade', 'scrollUp', 'scrollDown' ) ) ) {
			$instance['fx'] = $new_instance['fx'];
		} else {
			$instance['fx'] = 'fade';
		}
		$instance['sliderID'] = strip_tags( $new_instance['sliderID'] );
		$instance['speed'] = (int) $new_instance['speed'];
		$instance['timeout'] = (int) $new_instance['timeout'];
		if ( current_user_can('unfiltered_html') )
			$instance['text'] =  $new_instance['text'];
		else
			$instance['text'] = stripslashes( $new_instance['text'] ); 
		return $instance;
	}
	
	
	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'sliderID' => '', 'fx' => 'fade', 'text' => '' ) );
		$title = esc_attr( $instance['title'] );
		$sliderID = esc_attr( $instance['sliderID'] ); 
		if ( !isset($instance['speed']) || !$speed = (int) $instance['speed'] )
			$speed = 400;
		if ( !isset($instance['timeout']) || !$timeout = (int) $instance['timeout'] )
			$timeout = 4000;
		$text = '';			
		$text = format_to_edit($instance['text']);			
		?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:', 'mibook' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
		<p><label for="<?php echo $this->get_field_id('text'); ?>"><?php _e( 'Your HTML content wrapped in li tags:', 'mibook' ); ?></label>
        <textarea class="widefat" rows="5" cols="20" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo $text; ?></textarea><br />
		<small><?php _e( 'Wrap each entry for slideshow inside li tags.', 'mibook' ); ?></small>
        </p>        
		<p><label for="<?php echo $this->get_field_id('sliderID'); ?>"><?php _e( 'Unique ID name for content slider:', 'mibook' ); ?></label> 
		<input type="text" value="<?php echo $sliderID; ?>" name="<?php echo $this->get_field_name('sliderID'); ?>" id="<?php echo $this->get_field_id('sliderID'); ?>" class="widefat" /><br />
		<small><?php _e( 'Enter a unique ID name. Eg: myslider, slider2, myclients etc. Unique IDs are used to avoid any conflict if this widget is used multiple times on same page.', 'mibook' ); ?></small>
		</p>
        <p>
            <label for="<?php echo $this->get_field_id('fx'); ?>"><?php _e( 'Effect:', 'mibook' ); ?></label>
            <select name="<?php echo $this->get_field_name('fx'); ?>" id="<?php echo $this->get_field_id('fx'); ?>" class="widefat">
            <option value="fade"<?php selected( $instance['fx'], 'fade' ); ?>><?php _e('Fade', 'mibook'); ?></option>
            <option value="scrollUp"<?php selected( $instance['fx'], 'scrollUp' ); ?>><?php _e('Scroll Up', 'mibook'); ?></option>
            <option value="scrollDown"<?php selected( $instance['fx'], 'scrollDown' ); ?>><?php _e('Scroll Down', 'mibook'); ?></option>
            </select>
        </p><br/> 
		<p><label for="<?php echo $this->get_field_id('speed'); ?>"><?php _e( 'Speed:', 'mibook' ); ?></label>
		<input id="<?php echo $this->get_field_id('speed'); ?>" name="<?php echo $this->get_field_name('speed'); ?>" type="text" value="<?php echo $speed; ?>" /><br />
		<small><?php _e( '(in miliseconds)', 'mibook' ); ?></small>
        </p>
		<p><label for="<?php echo $this->get_field_id('timeout'); ?>"><?php _e( 'Timeout:', 'mibook' ); ?></label>
		<input id="<?php echo $this->get_field_id('timeout'); ?>" name="<?php echo $this->get_field_name('timeout'); ?>" type="text" value="<?php echo $timeout; ?>" /><br />
		<small><?php _e( '(in miliseconds)', 'mibook' ); ?></small>
        </p>
	<?php }
}?>