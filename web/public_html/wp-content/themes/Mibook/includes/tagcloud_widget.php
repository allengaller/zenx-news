<?php
/* Display Tagcloud .*/

class Mibook_Tagcloud_Widget extends WP_Widget {
    function Mibook_Tagcloud_Widget() {
		$widget_ops = array( 'classname' => 'tagcloud', 'description' => __( 'Display a tagcloud.', 'mibook' ) );
		$this->WP_Widget( 'Mibook-Tagcloud', __( 'Mibook Tagcloud', 'mibook' ), $widget_ops );
    }
	function widget( $args, $instance ) {
		extract( $args );		
		$nums = empty($instance['nums'])? 45 : $instance['nums'];
		$ordertag = empty($instance['ordertag'])? 'ASC' : $instance['ordertag'];
		$orderbytag = empty($instance['orderbytag'])? 'name' : $instance['orderbytag'];
		$tagformat = empty($instance['tagformat'])? 'pt' : $instance['tagformat'];
		$tagbigsize = empty($instance['tagbigsize'])? '22' : $instance['tagbigsize'];
		$tagsmallsize = empty($instance['tagsmallsize'])? '8' : $instance['tagsmallsize'];
		$title = apply_filters('widget_title', empty( $instance['title'] ) ? __( 'Tagcloud', 'mibook' ) : $instance['title']);
		echo $before_widget;
		if ( $title )
			echo $before_title . $title . $after_title;
		echo '<div class="tagcloud">';
		wp_tag_cloud( apply_filters('widget_tag_cloud_args', array(
			'smallest' => $tagsmallsize,
			'largest' => $tagbigsize,
			'unit' => $tagformat,
			'number' => $nums,
			'orderby' => $orderbytag,
			'order' => $ordertag
		)));
		echo "</div>\n";
		echo $after_widget;
	}

		function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags(stripslashes($new_instance['title']));
		$instance['nums'] = stripslashes($new_instance['nums']);
		$instance['ordertag'] = stripslashes($new_instance['ordertag']);
		$instance['orderbytag'] = stripslashes($new_instance['orderbytag']);
		$instance['tagformat'] = stripslashes($new_instance['tagformat']);
		$instance['tagbigsize'] = stripslashes($new_instance['tagbigsize']);
		$instance['tagsmallsize'] = stripslashes($new_instance['tagsmallsize']);
		return $instance;
	}


	function form( $instance ){ ?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('title:', 'mibook') ?></label>
		<input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php if (isset ( $instance['title'])) {echo esc_attr( $instance['title'] );} ?>" /></p>
        
	 	<p><label for="<?php echo $this->get_field_id('nums'); ?>"><?php _e('The number of Tags(Default:45):','mibook') ?></label>
		<input type="text" class="widefat" id="<?php echo $this->get_field_id('nums'); ?>" name="<?php echo $this->get_field_name('nums'); ?>" value="<?php if (isset ( $instance['nums'])) {echo esc_attr( $instance['nums'] );} ?>" /></p>

     	<p><label for="<?php echo $this->get_field_id('orderbytag'); ?>"><?php _e('Arrangement:','mibook') ?></label>
		<select  class="widefat" id="<?php echo $this->get_field_id('orderbytag'); ?>" name="<?php echo $this->get_field_name('orderbytag'); ?>">
    		<option value=""> <?php echo __('Select','mibook');?> </option>
    		<option <?php if ( $instance['orderbytag'] == 'name') echo 'selected="SELECTED"'; else echo ''; ?>  value="name"><?php echo __('name','mibook');?></option>
    		<option <?php if ( $instance['orderbytag'] == 'count') echo 'selected="SELECTED"'; else echo ''; ?> value="count"><?php echo __('count','mibook');?></option>
    	</select></p>   	

		<p><label for="<?php echo $this->get_field_id('ordertag'); ?>"><?php _e('Order of Tag:','mibook') ?></label>
		<select  class="widefat" id="<?php echo $this->get_field_id('ordertag'); ?>" name="<?php echo $this->get_field_name('ordertag'); ?>">
    		<option value=""> <?php echo __('Select','mibook');?> </option>
    		<option <?php if ( $instance['ordertag'] == 'ASC') echo 'selected="SELECTED"'; else echo ''; ?>  value="ASC"><?php  echo __('ASC','mibook');?></option>
    		<option <?php if ( $instance['ordertag'] == 'DESC') echo 'selected="SELECTED"'; else echo ''; ?> value="DESC"><?php echo __('DESC','mibook');?></option>
    		<option <?php if ( $instance['ordertag'] == 'RAND') echo 'selected="SELECTED"'; else echo ''; ?> value="RAND"><?php echo __('RAND','mibook');?></option>
    	</select></p>
    	

		<p><label for="<?php echo $this->get_field_id('tagformat'); ?>"><?php _e('Tag Format(Default:pt):','mibook') ?></label>
		<select  class="widefat" id="<?php echo $this->get_field_id('tagformat'); ?>" name="<?php echo $this->get_field_name('tagformat'); ?>">
    		<option value="pt"> <?php echo __('Select','mibook');?> </option>
    		<option <?php if ( $instance['tagformat'] == 'px') echo 'selected="SELECTED"'; else echo ''; ?>  value="px"><?php  echo __('px','mibook');?></option>
    		<option <?php if ( $instance['tagformat'] == 'em') echo 'selected="SELECTED"'; else echo ''; ?> value="em"><?php echo __('em','mibook');?></option>
    		<option <?php if ( $instance['tagformat'] == '%') echo 'selected="SELECTED"'; else echo ''; ?> value="%"><?php echo __('%','mibook');?></option>
    	</select></p>
	
		<p><label for="<?php echo $this->get_field_id('tagsmallsize'); ?>"><?php _e('Mini Tag Size(Default:8):','mibook') ?></label>
		<input type="text" class="widefat" id="<?php echo $this->get_field_id('tagsmallsize'); ?>" name="<?php echo $this->get_field_name('tagsmallsize'); ?>" value="<?php if (isset ( $instance['tagsmallsize'])) {echo esc_attr( $instance['tagsmallsize'] );} ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('tagbigsize'); ?>"><?php _e('Max Tag Size(Default:22):','mibook') ?></label>
		<input type="text" class="widefat" id="<?php echo $this->get_field_id('tagbigsize'); ?>" name="<?php echo $this->get_field_name('tagbigsize'); ?>" value="<?php if (isset ( $instance['tagbigsize'])) {echo esc_attr( $instance['tagbigsize'] );} ?>" /></p>

	<?php
	}
}?>