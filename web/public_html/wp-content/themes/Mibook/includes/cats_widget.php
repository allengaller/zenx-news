<?php 
/* Display custom categories by excluding a particular category.*/

class Mibook_Cat_Widget extends WP_Widget {
	function Mibook_Cat_Widget() {
		$widget_ops = array( 'classname' => 'custom_cat', 'description' => __( 'Display a custom list of categories using exclude option.', 'mibook' ) );
		$this->WP_Widget( 'Mibook-Categories', __( 'Mibook Categories', 'mibook' ), $widget_ops );
	}
	function widget( $args, $instance ) {
		extract( $args );	
		$title = apply_filters('widget_title', empty( $instance['title'] ) ? __( 'Categories', 'mibook' ) : $instance['title']);
		$exclude = empty( $instance['exclude'] ) ? '' : $instance['exclude'];
		$h = $instance['hierarchical'] ? '1' : '0';	
		echo $before_widget;
		if ( $title )
			echo $before_title . $title . $after_title;	
		$cat_args = array('orderby' => 'name', 'exclude' => $exclude, 'hierarchical' => $h);?>	
		<ul>
			<?php
            $cat_args['title_li'] = '';
            wp_list_categories(apply_filters('custom_cat_args', $cat_args));
            ?>
		</ul>
		<?php echo $after_widget;
	}
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['hierarchical'] = $new_instance['hierarchical'] ? 1 : 0;
		$instance['exclude'] = strip_tags( $new_instance['exclude'] );
		return $instance;
	}
	
	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'exclude' => '') );
		$title = esc_attr( $instance['title'] );
		$hierarchical = isset( $instance['hierarchical'] ) ? (bool) $instance['hierarchical'] : false;
		$exclude = esc_attr( $instance['exclude'] );?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:', 'mibook' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>
		<p><label for="<?php echo $this->get_field_id('hierarchical'); ?>"><?php _e( 'Show hierarchy ?', 'mibook' ); ?></label>			
        <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('hierarchical'); ?>" name="<?php echo $this->get_field_name('hierarchical'); ?>"<?php checked( $hierarchical ); ?> />		
        </p>
		<p><label for="<?php echo $this->get_field_id('exclude'); ?>"><?php _e( 'Exclude:', 'mibook' ); ?></label> 
		<input type="text" value="<?php echo $exclude; ?>" name="<?php echo $this->get_field_name('exclude'); ?>" id="<?php echo $this->get_field_id('exclude'); ?>" class="widefat" />
		<br />
		<small><?php _e( 'Category IDs, separated by commas.', 'mibook' ); ?></small>
		</p>		
	<?php }
}?>