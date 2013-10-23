<?php
/* Display Social Networking Icons with Links. */

class Mibook_Social_Widget extends WP_Widget {
	function Mibook_Social_Widget() {
		$widget_ops = array( 'classname' => 'mibook_social', 'description' => __( 'A social networking icons widget.', 'mibook') );
		$this->WP_Widget( 'mibook-social', __( 'Mibook Social Icons', 'mibook' ), $widget_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters('widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base);
		$twitter_url = $instance['twitter_url'];
		$twitter = isset($instance['twitter']) ? $instance['twitter'] : false;
		$facebook_url = $instance['facebook_url'];
		$facebook = isset($instance['facebook']) ? $instance['facebook'] : false;
		$flickr_url = $instance['flickr_url'];
		$flickr = isset($instance['flickr']) ? $instance['flickr'] : false;
		$del_url = $instance['del_url'];
		$del = isset($instance['del']) ? $instance['del'] : false;
		$deviant_url = $instance['deviant_url'];
		$deviant = isset($instance['deviant']) ? $instance['deviant'] : false;
		$dribble_url = $instance['dribble_url'];
		$dribble = isset($instance['dribble']) ? $instance['dribble'] : false;
		$in_url = $instance['in_url'];
		$in = isset($instance['in']) ? $instance['in'] : false;
		$myspace_url = $instance['myspace_url'];
		$myspace = isset($instance['myspace']) ? $instance['myspace'] : false;
		$stumb_url = $instance['stumb_url'];
		$stumb = isset($instance['stumb']) ? $instance['stumb'] : false;
		$techno_url = $instance['techno_url'];
		$techno = isset($instance['techno']) ? $instance['techno'] : false;
		$utube_url = $instance['utube_url'];
		$utube = isset($instance['utube']) ? $instance['utube'] : false;
		$vimeo_url = $instance['vimeo_url'];
		$vimeo = isset($instance['vimeo']) ? $instance['vimeo'] : false;
		$rss = isset($instance['rss']) ? $instance['rss'] : false;														
		$rss_url = get_bloginfo('rss2_url');
		echo $before_widget;
		if ( $title )
			echo $before_title . $title . $after_title; 
		
		/* Start output */
		$output = ''; ?>
        <ul class="social">		
		<?php 
		if ( $twitter )
			$output .= '<li><a href="'.$twitter_url.'" class="twitter" title="Twitter" ></a>';
		if ( $facebook )
			$output .= '<li><a href="'.$facebook_url.'" class="facebook" title="Facebook" ></a>';					
		if ( $flickr )
			$output .= '<li><a href="'.$flickr_url.'" class="flickr" title="Flickr" ></a>';	
		if ( $del )
			$output .= '<li><a href="'.$del_url.'" class="del" title="Delicious" ></a>';
		if ( $deviant )
			$output .= '<li><a href="'.$deviant_url.'" class="deviant" title="DeviantArt" ></a>';					
		if ( $dribble )
			$output .= '<li><a href="'.$dribble_url.'" class="dribble" title="Dribble" ></a>';			
		if ( $in )
			$output .= '<li><a href="'.$in_url.'" class="in" title="LinkedIn" ></a>';
		if ( $myspace )
			$output .= '<li><a href="'.$myspace_url.'" class="myspace" title="MySpace" ></a>';					
		if ( $stumb )
			$output .= '<li><a href="'.$stumb_url.'" class="stumb" title="StumbledUpon" ></a>';	
		if ( $techno )
			$output .= '<li><a href="'.$techno_url.'" class="techno" title="Technorati" ></a>';
		if ( $utube )
			$output .= '<li><a href="'.$utube_url.'" class="utube" title="YouTube" ></a>';					
		if ( $vimeo )
			$output .= '<li><a href="'.$vimeo_url.'" class="vimeo" title="Vimeo" ></a>';
		if ( $rss )
			$output .= '<li><a href="'.$rss_url.'" class="rss" title="RSS" ></a>';		
		echo ( $output.'</ul>' );
		echo $after_widget;
	}

	/* Update the widget settings. */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['twitter_url'] = strip_tags( $new_instance['twitter_url'] );
		$instance['twitter'] = isset($new_instance['twitter']) ? true : false;
		$instance['facebook_url'] = strip_tags( $new_instance['facebook_url'] );
		$instance['facebook'] = isset($new_instance['facebook']) ? true : false;
		$instance['flickr_url'] = strip_tags( $new_instance['flickr_url'] );
		$instance['flickr'] = isset($new_instance['flickr']) ? true : false;
		$instance['del_url'] = strip_tags( $new_instance['del_url'] );
		$instance['del'] = isset($new_instance['del']) ? true : false;
		$instance['deviant_url'] = strip_tags( $new_instance['deviant_url'] );
		$instance['deviant'] = isset($new_instance['deviant']) ? true : false;
		$instance['dribble_url'] = strip_tags( $new_instance['dribble_url'] );
		$instance['dribble'] = isset($new_instance['dribble']) ? true : false;		
		$instance['in_url'] = strip_tags( $new_instance['in_url'] );
		$instance['in'] = isset($new_instance['in']) ? true : false;
		$instance['myspace_url'] = strip_tags( $new_instance['myspace_url'] );
		$instance['myspace'] = isset($new_instance['myspace']) ? true : false;
		$instance['stumb_url'] = strip_tags( $new_instance['stumb_url'] );
		$instance['stumb'] = isset($new_instance['stumb']) ? true : false;
		$instance['techno_url'] = strip_tags( $new_instance['techno_url'] );
		$instance['techno'] = isset($new_instance['techno']) ? true : false;
		$instance['utube_url'] = strip_tags( $new_instance['utube_url'] );
		$instance['utube'] = isset($new_instance['utube']) ? true : false;
		$instance['vimeo_url'] = strip_tags( $new_instance['vimeo_url'] );
		$instance['vimeo'] = isset($new_instance['vimeo']) ? true : false;
		$instance['rss'] = isset($new_instance['rss']) ? true : false;		
				
		return $instance;
	}


	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '','twitter' => false, 'twitter_url' => '','facebook' => false, 'facebook_url' => '','flickr' => false, 'flickr_url' => '','del' => false, 'del_url' => '','deviant' => false, 'deviant_url' => '','dribble' => false, 'dribble_url' => '','in' => false, 'in_url' => '','myspace' => false, 'myspace_url' => '','stumb' => false, 'stumb_url' => '','techno' => false, 'techno_url' => '','utube' => false, 'utube_url' => '','vimeo' => false, 'vimeo_url' => '','rss' => false ) );
		$title = esc_attr( $instance['title'] );
		$twitter_url = esc_attr( $instance['twitter_url'] );
		$facebook_url = esc_attr( $instance['facebook_url'] );
		$flickr_url = esc_attr( $instance['flickr_url'] );
		$del_url = esc_attr( $instance['del_url'] );
		$deviant_url = esc_attr( $instance['deviant_url'] );
		$dribble_url = esc_attr( $instance['dribble_url'] );	
		$in_url = esc_attr( $instance['in_url'] );
		$myspace_url = esc_attr( $instance['myspace_url'] );
		$stumb_url = esc_attr( $instance['stumb_url'] );
		$techno_url = esc_attr( $instance['techno_url'] );
		$utube_url = esc_attr( $instance['utube_url'] );
		$vimeo_url = esc_attr( $instance['vimeo_url'] );				
		?>        

        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:', 'mibook' ); ?></label> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('twitter'); ?>"><?php _e( 'Twitter', 'mibook' ); ?></label>
            <input class="checkbox" type="checkbox" <?php checked($instance['twitter'], true) ?> id="<?php echo $this->get_field_id('twitter'); ?>" name="<?php echo $this->get_field_name('twitter'); ?>" /><br /> 
            <input type="text" value="<?php echo $twitter_url; ?>" name="<?php echo $this->get_field_name('twitter_url'); ?>" id="<?php echo $this->get_field_id('twitter_url'); ?>" class="widefat" />
            <br />
            <small><?php _e( 'Full URL of Twitter profile', 'mibook' ); ?>
            </small>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('facebook'); ?>"><?php _e( 'Facebook', 'mibook' ); ?></label>
            <input class="checkbox" type="checkbox" <?php checked($instance['facebook'], true) ?> id="<?php echo $this->get_field_id('facebook'); ?>" name="<?php echo $this->get_field_name('facebook'); ?>" /><br /> 
            <input type="text" value="<?php echo $facebook_url; ?>" name="<?php echo $this->get_field_name('facebook_url'); ?>" id="<?php echo $this->get_field_id('facebook_url'); ?>" class="widefat" />
            <br />
            <small><?php _e( 'Full URL of Facebook profile', 'mibook' ); ?>
            </small>
        </p> 
        <p>
            <label for="<?php echo $this->get_field_id('flickr'); ?>"><?php _e( 'Flickr', 'mibook' ); ?></label>
            <input class="checkbox" type="checkbox" <?php checked($instance['flickr'], true) ?> id="<?php echo $this->get_field_id('flickr'); ?>" name="<?php echo $this->get_field_name('flickr'); ?>" /><br /> 
            <input type="text" value="<?php echo $flickr_url; ?>" name="<?php echo $this->get_field_name('flickr_url'); ?>" id="<?php echo $this->get_field_id('flickr_url'); ?>" class="widefat" />
            <br />
            <small><?php _e( 'Full URL of Flickr Photostream', 'mibook' ); ?>
            </small>
        </p> 
        <p>
            <label for="<?php echo $this->get_field_id('del'); ?>"><?php _e( 'Delicious', 'mibook' ); ?></label>
            <input class="checkbox" type="checkbox" <?php checked($instance['del'], true) ?> id="<?php echo $this->get_field_id('del'); ?>" name="<?php echo $this->get_field_name('del'); ?>" /><br /> 
            <input type="text" value="<?php echo $del_url; ?>" name="<?php echo $this->get_field_name('del_url'); ?>" id="<?php echo $this->get_field_id('del_url'); ?>" class="widefat" />
            <br />
            <small><?php _e( 'Full URL to Delicious account', 'mibook' ); ?>
            </small>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('deviant'); ?>"><?php _e( 'DeviantArt', 'mibook' ); ?></label>
            <input class="checkbox" type="checkbox" <?php checked($instance['deviant'], true) ?> id="<?php echo $this->get_field_id('deviant'); ?>" name="<?php echo $this->get_field_name('deviant'); ?>" /><br /> 
            <input type="text" value="<?php echo $deviant_url; ?>" name="<?php echo $this->get_field_name('deviant_url'); ?>" id="<?php echo $this->get_field_id('deviant_url'); ?>" class="widefat" />
            <br />
            <small><?php _e( 'Full URL to DeviantArt Profile', 'mibook' ); ?>
            </small>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('dribble'); ?>"><?php _e( 'Dribble', 'mibook' ); ?></label>
            <input class="checkbox" type="checkbox" <?php checked($instance['dribble'], true) ?> id="<?php echo $this->get_field_id('dribble'); ?>" name="<?php echo $this->get_field_name('dribble'); ?>" /><br /> 
            <input type="text" value="<?php echo $dribble_url; ?>" name="<?php echo $this->get_field_name('dribble_url'); ?>" id="<?php echo $this->get_field_id('dribble_url'); ?>" class="widefat" />
            <br />
            <small><?php _e( 'Full URL to Dribble', 'mibook' ); ?>
            </small>
        </p> 
        <p>
            <label for="<?php echo $this->get_field_id('in'); ?>"><?php _e( 'LinkedIn', 'mibook' ); ?></label>
            <input class="checkbox" type="checkbox" <?php checked($instance['in'], true) ?> id="<?php echo $this->get_field_id('in'); ?>" name="<?php echo $this->get_field_name('in'); ?>" /><br /> 
            <input type="text" value="<?php echo $in_url; ?>" name="<?php echo $this->get_field_name('in_url'); ?>" id="<?php echo $this->get_field_id('in_url'); ?>" class="widefat" />
            <br />
            <small><?php _e( 'Full URL to LinkedIn Profile', 'mibook' ); ?>
            </small>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('myspace'); ?>"><?php _e( 'MySpace', 'mibook' ); ?></label>
            <input class="checkbox" type="checkbox" <?php checked($instance['myspace'], true) ?> id="<?php echo $this->get_field_id('myspace'); ?>" name="<?php echo $this->get_field_name('myspace'); ?>" /><br /> 
            <input type="text" value="<?php echo $myspace_url; ?>" name="<?php echo $this->get_field_name('myspace_url'); ?>" id="<?php echo $this->get_field_id('myspace_url'); ?>" class="widefat" />
            <br />
            <small><?php _e( 'Full URL to MySpace Profile', 'mibook' ); ?>
            </small>
        </p> 
        <p>
            <label for="<?php echo $this->get_field_id('stumb'); ?>"><?php _e( 'StumbledUpon', 'mibook' ); ?></label>
            <input class="checkbox" type="checkbox" <?php checked($instance['stumb'], true) ?> id="<?php echo $this->get_field_id('stumb'); ?>" name="<?php echo $this->get_field_name('stumb'); ?>" /><br /> 
            <input type="text" value="<?php echo $stumb_url; ?>" name="<?php echo $this->get_field_name('stumb_url'); ?>" id="<?php echo $this->get_field_id('stumb_url'); ?>" class="widefat" />
            <br />
            <small><?php _e( 'Full URL to StumbledUpon Page', 'mibook' ); ?>
            </small>
        </p> 
        <p>
            <label for="<?php echo $this->get_field_id('techno'); ?>"><?php _e( 'Technorati', 'mibook' ); ?></label>
            <input class="checkbox" type="checkbox" <?php checked($instance['techno'], true) ?> id="<?php echo $this->get_field_id('techno'); ?>" name="<?php echo $this->get_field_name('techno'); ?>" /><br /> 
            <input type="text" value="<?php echo $techno_url; ?>" name="<?php echo $this->get_field_name('techno_url'); ?>" id="<?php echo $this->get_field_id('techno_url'); ?>" class="widefat" />
            <br />
            <small><?php _e( 'Full URL to Technorati', 'mibook' ); ?>
            </small>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('utube'); ?>"><?php _e( 'YouTube', 'mibook' ); ?></label>
            <input class="checkbox" type="checkbox" <?php checked($instance['utube'], true) ?> id="<?php echo $this->get_field_id('utube'); ?>" name="<?php echo $this->get_field_name('utube'); ?>" /><br /> 
            <input type="text" value="<?php echo $utube_url; ?>" name="<?php echo $this->get_field_name('utube_url'); ?>" id="<?php echo $this->get_field_id('utube_url'); ?>" class="widefat" />
            <br />
            <small><?php _e( 'Full URL to YouTube Profile', 'mibook' ); ?>
            </small>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('vimeo'); ?>"><?php _e( 'Vimeo', 'mibook' ); ?></label>
            <input class="checkbox" type="checkbox" <?php checked($instance['vimeo'], true) ?> id="<?php echo $this->get_field_id('vimeo'); ?>" name="<?php echo $this->get_field_name('vimeo'); ?>" /><br /> 
            <input type="text" value="<?php echo $vimeo_url; ?>" name="<?php echo $this->get_field_name('vimeo_url'); ?>" id="<?php echo $this->get_field_id('vimeo_url'); ?>" class="widefat" />
            <br />
            <small><?php _e( 'Full URL to Vimeo Profile', 'mibook' ); ?>
            </small>
        </p>        
        <p>
            <label for="<?php echo $this->get_field_id('rss'); ?>"><?php _e( 'RSS', 'mibook' ); ?></label>
            <input class="checkbox" type="checkbox" <?php checked($instance['rss'], true) ?> id="<?php echo $this->get_field_id('rss'); ?>" name="<?php echo $this->get_field_name('rss'); ?>" />
        </p>                                                                                                                                
	<?php
	}
}
?>