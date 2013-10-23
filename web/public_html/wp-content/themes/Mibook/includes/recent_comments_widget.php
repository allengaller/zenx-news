<?php 
/* List the most recent comments with Author avatar */

class Mibook_Recent_Comments extends WP_Widget {
	function Mibook_Recent_Comments() {
		$widget_ops = array( 'classname' => 'mibook_recent_comments', 'description' => __( 'List recent comments with gravatar.', 'mibook' ) );
		$this->WP_Widget('mibook-recent-comments', __( 'Mibook Recent Comments', 'mibook' ), $widget_ops);
		$this->alt_option_name = 'mibook_recent_comments';		
	}
	
	function widget($args, $instance) {			
		extract($args);
		$output = '';
		$hide_avatar= isset($instance['hide_avatar']) ? $instance['hide_avatar'] : false;
		$title = apply_filters('widget_title', empty($instance['title']) ? __( 'Comments', 'mibook' ) : $instance['title']);
		if ( !$number = (int) $instance['number'] )
			$number = 10;
		else if ( $number < 1 )
			$number = 1;
		else if ( $number > 15 )
			$number = 15;
			$comments = get_comments( array( 'number' => $number, 'status' => 'approve' ) );
			$output .= $before_widget;
			if ( $title )
				$output .= $before_title . $title . $after_title;
			$list_class = ( $hide_avatar == false ) ? 'recent_comment-list' : 'bullet-list';
			$output .= '<ul class="'.$list_class.'">';
			if ( $comments ) {
			foreach ( (array) $comments as $comment) { 
                	$dir = get_template_directory_uri();
					$default_avatar = $dir . '/images/default_avatar.png'; 
					$avatar_link = get_avatar( $comment, $size='54', $default = $default_avatar );
					if( $hide_avatar == false ) {
						$avatar = sprintf('<div class="recent_comment_avatar">%1$s</div>', $avatar_link );
					$format = '<li class="clearfix">%1$s<div class="recent_comment_data">%2$s '.__('said:','mibook').' %3$s <span class="small"><a href="' . esc_url( get_comment_link($comment->comment_ID) ) . '" title="'. __('View comment on post', 'mibook' ). '" target="_blank">'. __('View Post', 'mibook').'</a></span></div></li>';												
						}
						else
						{
						 $avatar = '';					
						$format = '<li>%2$s: %3$s<br/><span class="small"><a href="' . esc_url( get_comment_link($comment->comment_ID) ) . '" title="'. __('View comment on post', 'mibook' ). '">'. __('View Post', 'mibook').'</a></span></li>';
						 }

					$output.= sprintf( $format, $avatar, get_comment_author_link($comment->comment_ID), $comment->comment_content );  
		}
		}
                $output .= '</ul>';
				echo $output;
            echo $after_widget;
	}
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = (int) $new_instance['number'];
		$instance['hide_avatar'] = isset($new_instance['hide_avatar']) ? true : false;
		return $instance;
	}
	
	
	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'hide_avatar' => false ) );
		$title = esc_attr( $instance['title'] );
		if ( !isset($instance['number']) || !$number = (int) $instance['number'] )
			$number = 5; ?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:', 'mibook' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
		<p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e( 'Number of comments to show:', 'mibook' ); ?></label>
		<input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" /><br />
		<small><?php _e( '(at most 15)', 'mibook' ); ?></small>
        </p>
        <p><label for="<?php echo $this->get_field_id( 'hide_avatar' ); ?>"><?php _e( 'Hide Avatar?', 'mibook' ); ?></label>
        <input class="checkbox" type="checkbox" <?php checked($instance['hide_avatar'], true) ?> id="<?php echo $this->get_field_id('hide_avatar'); ?>" name="<?php echo $this->get_field_name( 'hide_avatar' ); ?>" /><br />
        <small><?php _e( 'If unchecked, it will show author avatar.', 'mibook' ); ?></small>
        </p>                
	<?php }
}?>