<?php 
/* List popular posts based on most number of comments */

class Mibook_Popular_Posts extends WP_Widget {
	function Mibook_Popular_Posts() {
		$widget_ops = array( 'classname' => 'mibook_popular_entries', 'description' => __( 'List popular posts based on most commented.', 'mibook' ) );
		$this->WP_Widget('mibook-popular-posts', __( 'Mibook Popular Posts', 'mibook' ), $widget_ops);
		$this->alt_option_name = 'mibook_popular_entries';		
		add_action( 'save_post', array(&$this, 'flush_widget_cache') );
		add_action( 'deleted_post', array(&$this, 'flush_widget_cache') );
		add_action( 'switch_theme', array(&$this, 'flush_widget_cache') );
	}	
	function widget($args, $instance) {
		$cache = wp_cache_get('widget_popular_posts', 'widget');	
		$hide_thumb= isset($instance['hide_thumb']) ? $instance['hide_thumb'] : false;	
		if ( !is_array($cache) )
			$cache = array();		
		if ( isset($cache[$args['widget_id']]) ) {
			echo $cache[$args['widget_id']];
			return;
		}	
		ob_start();
		extract($args);
		$title = apply_filters('widget_title', empty($instance['title']) ? __( 'Popular', 'mibook' ) : $instance['title']);
		if ( !$number = (int) $instance['number'] )
			$number = 10;
		else if ( $number < 1 )
			$number = 1;
		else if ( $number > 15 )
			$number = 15;
		$t = new WP_Query(array('showposts' => $number, 'nopaging' => 0, 'post_status' => 'publish', 'ignore_sticky_posts' => 1, 'orderby' => 'comment_count'));
		if ($t->have_posts()) :
			//$output = '';
			echo $before_widget;
			if ( $title ) echo $before_title . $title . $after_title; 
			$list_class = ( $hide_thumb == false ) ? 'popular-post-list' : 'bullet-list';
			?>
            <ul class="<?php echo $list_class; ?>">
				<?php  while ($t->have_posts()) : $t->the_post(); ?>
					<?php  if( $hide_thumb == false ) { ?>
						<li>
                            <?php if (has_post_thumbnail()){
                            	$image_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "Full"); ?>
                            	<a href="<?php the_permalink(); ?>" class="popular-post-thumb" rel="bookmark" title="<?php the_title(); ?>" target="_blank"><img src="<?php echo $image_src[0]; ?>" width="54px" height="54px" /></a> 
                        	<?php }else {?>
                            	<a href="<?php the_permalink(); ?>" class="popular-post-thumb" rel="bookmark" title="<?php the_title(); ?>" target="_blank"><img src="<?php echo catch_post_image();?>" width="54px" height="54px" /></a>
                        	<?php } ?>
                        
                        	<a href="<?php the_permalink() ?>" class="popular-post-title" rel="bookmark" title="<?php the_title_attribute();?>" target="_blank"><?php the_title(); ?></a></br>
                        	<?php printf( __( '<div class="popular-post-meta">%1$s %2$s</div>' , 'mibook'),get_the_date('Y-m-d'),get_the_category_list( __( ', ', 'mibook' ) ) )?>
                        </li>
					<?php } else {?>
						<li>
                        	<a href="<?php the_permalink() ?>" class="recent-post-thumb" rel="bookmark" title="<?php the_title(); ?>" target="_blank"><?php the_title(); ?></a>
                            <?php printf( __( '<div class="popular-post-meta">%1$s %2$s</div>' , 'mibook'),get_the_date('Y-m-d'),get_the_category_list( __( ', ', 'mibook' ) ) )?>
                        </li>   
					  <?php }?>
				<?php endwhile; 
                $output .= '</ul>';
				//echo $output;
            echo $after_widget; ?>
            <?php wp_reset_query();  // Restore global post data stomped by the_post().
		endif;		
		$cache[$args['widget_id']] = ob_get_flush();
		wp_cache_add('widget_popular_posts', $cache, 'widget');
	}
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = (int) $new_instance['number'];
		$instance['hide_thumb'] = isset($new_instance['hide_thumb']) ? true : false;
		$this->flush_widget_cache();		
		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions['mibook_popular_entries']) )
		delete_option('mibook_popular_entries');		
		return $instance;
	}
	
	function flush_widget_cache() {
		wp_cache_delete('widget_popular_posts', 'widget');
	}
	
	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'hide_thumb' => false, 'cats' => '') );
		$title = esc_attr( $instance['title'] );
		$cats = esc_attr( $instance['cats'] );	
		if ( !isset($instance['number']) || !$number = (int) $instance['number'] )
			$number = 5; ?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:', 'mibook' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
		<p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e( 'Number of posts to show:', 'mibook' ); ?></label>
		<input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" /><br />
		<small><?php _e( '(at most 15)', 'mibook' ); ?></small>
        </p>
		<p><label for="<?php echo $this->get_field_id( 'hide_thumb' ); ?>"><?php _e( 'Hide Thumbnails?', 'mibook' ); ?></label>
        <input class="checkbox" type="checkbox" <?php checked($instance['hide_thumb'], true) ?> id="<?php echo $this->get_field_id('hide_thumb'); ?>" name="<?php echo $this->get_field_name( 'hide_thumb' ); ?>" /><br />
        <small><?php _e( 'If unchecked, it will show post thumbnails.', 'mibook' ); ?></small>
        </p>                
	<?php }
}?>