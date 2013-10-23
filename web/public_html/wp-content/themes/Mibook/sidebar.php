<?php
/* Sidebar template. */

/* Fetch admin options. */
global $options;
foreach ($options as $value) {
if(isset($value['id']) && isset ($value['std']))
	if (get_option( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_option( $value['id'] );}
}
	if ( is_page() ) {
		$page_opts = get_post_meta( $posts[0]->ID, 'page_options', true );
		$unique_sidebar = (isset($page_opts['unique_sidebar'])) ? $page_opts['unique_sidebar'] : '';		
	}
	?> 	
	<div class="sidebar">
		<?php
        if ( is_page() && $unique_sidebar )
        {
			if ( is_active_sidebar( $posts[0]->ID.'-sidebar') ) :
                dynamic_sidebar( $posts[0]->ID.'-sidebar' );
			endif;
        }
        else
        {
			if ( is_active_sidebar( 'default-sidebar' ) ) :
				dynamic_sidebar( 'default-sidebar' ); 
			endif;
        }
        ?>
    </div><!-- .sidebar -->