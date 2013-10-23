<?php 
/* List the most recent posts from the categories you mention */

class Mibook_Mini_Folio extends WP_Widget {
	function Mibook_Mini_Folio() {
		$widget_ops = array( 'classname' => 'mibook_mini_folio', 'description' => __( 'Show a mini portfolio from thumbnails of posts.', 'mibook' ) );
		$this->WP_Widget('mibook-mini-folio', __( 'Mibook Mini Folio', 'mibook' ), $widget_ops);
		$this->alt_option_name = 'mibook_mini_folio';		
		add_action( 'save_post', array(&$this, 'flush_widget_cache') );
		add_action( 'deleted_post', array(&$this, 'flush_widget_cache') );
		add_action( 'switch_theme', array(&$this, 'flush_widget_cache') );
	}
	
	function widget($args, $instance) {
		$cache = wp_cache_get('widget_recent_posts', 'widget');	
		if ( !is_array($cache) )
			$cache = array();		
		if ( isset($cache[$args['widget_id']]) ) {
			echo $cache[$args['widget_id']];
			return;
		}
	
		ob_start();
		extract($args);
		$output = '';
		$cats = empty( $instance['cats'] ) ? '' : $instance['cats'];
		$title = apply_filters('widget_title', empty($instance['title']) ? __( 'Mini Folio', 'mibook' ) : $instance['title']);
		if ( !$number = (int) $instance['number'] )
			$number = 10;
		else if ( $number < 1 )
			$number = 1;
		else if ( $number > 15 )
			$number = 15;
		$r = new WP_Query(array('showposts' => $number, 'nopaging' => 0, 'post_status' => 'publish', 'ignore_sticky_posts' => 1, 'cat' => $cats));
		if ($r->have_posts()) : ?>
			<?php echo $before_widget; ?>
            <?php if ( $title ) echo $before_title . $title . $after_title;?>
            <ul class="minifolio">
				<?php  while ($r->have_posts()) : $r->the_post();
					//$post_opts = get_post_meta( $GLOBALS['post']->ID, 'post_options', true);?>
					<li class="folio_list">
						<?php if (has_post_thumbnail()){
                            $image_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "Full"); ?>
                            <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>" target="_blank"><img src="<?php echo $image_src[0]; ?>" width="54px" height="54px" /></a> 
                        <?php }else {?>
                            <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>" target="_blank"><img src="<?php echo catch_post_image();?>" width="54px" height="54px" /></a>
                        <?php } ?>
                    </li>
                <?php endwhile; ?>
			</ul>
            <?php echo $after_widget; ?>
            <?php wp_reset_query();
		endif;		
		$cache[$args['widget_id']] = ob_get_flush();
		wp_cache_add('widget_recent_posts', $cache, 'widget');
	}
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = (int) $new_instance['number'];
		$instance['cats'] = strip_tags( $new_instance['cats'] );
		$this->flush_widget_cache();		
		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions['mibook_mini_folio']) )
		delete_option('mibook_mini_folio');		
		return $instance;
	}
	
	function flush_widget_cache() {
		wp_cache_delete('widget_recent_posts', 'widget');
	}
	
	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'cats' => '') );
		$title = esc_attr( $instance['title'] );
		$cats = esc_attr( $instance['cats'] );	
		if ( !isset($instance['number']) || !$number = (int) $instance['number'] )
			$number = 4; ?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:', 'mibook' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
		<p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e( 'Number of posts to show:', 'mibook' ); ?></label>
		<input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" /><br />
		<small><?php _e( '(at most 15)', 'mibook' ); ?></small>
        </p>
		<p><label for="<?php echo $this->get_field_id('cats'); ?>"><?php _e( 'Cat IDs to exclude or include:', 'mibook' ); ?></label> 
		<input type="text" value="<?php echo $cats; ?>" name="<?php echo $this->get_field_name('cats'); ?>" id="<?php echo $this->get_field_id('cats'); ?>" class="widefat" />
		<br />
		<small><?php _e( 'Category IDs, separated by commas. Eg: 3,6,7 to include. Or -3,-6,-7 to exclude.', 'mibook' ); ?></small>
		</p>
	<?php }
}?>