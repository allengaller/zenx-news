<?php
/* Footer Template */

/* Fetch admin options. */
global $options;
foreach ($options as $value) {
	if(isset($value['id']) && isset ($value['std']))
		if (get_option( $value['id'] ) === FALSE) { 
			$$value['id'] = $value['std']; 
		} else { 
		$$value['id'] = get_option( $value['id'] );
	}
}
$unique_secondarybar = '';
if ( is_page() ) {
	$page_opts = get_post_meta( $posts[0]->ID, 'page_options', true );
	$unique_secondarybar = (isset($page_opts['unique_secondarybar'])) ? $page_opts['unique_secondarybar']: '' ;		
	if ( ( $unique_secondarybar ) && ( is_active_sidebar( $posts[0]->ID.'-secondary-column-1' ) || is_active_sidebar( $posts[0]->ID.'-secondary-column-2' ) || is_active_sidebar( $posts[0]->ID.'-secondary-column-3' ) || is_active_sidebar( $posts[0]->ID.'-secondary-column-4' ) ) ) 
		$show_secondary = 'true'; 
	else 
		$show_secondary = 'false';
} // is page
if ( ( !($unique_secondarybar) ) && (  is_active_sidebar( 'secondary-column-1' ) || is_active_sidebar( 'secondary-column-2' ) || is_active_sidebar( 'secondary-column-3' ) || is_active_sidebar( 'secondary-column-4' ) ) )
	$show_secondary = 'true';

if ( $show_secondary == 'true' ): ?>
<div class="secondary">
    <div class="secondary_wrap">
        <div class="one_fourth">            
        <?php if ( $unique_secondarybar == 'true' ) {
        if ( is_active_sidebar( $posts[0]->ID.'-secondary-column-1' ) )
			dynamic_sidebar( $posts[0]->ID.'-secondary-column-1' ); 
        }
        else {
        if ( is_active_sidebar( 'secondary-column-1' ) )
			dynamic_sidebar( 'secondary-column-1' ); 					
        } ?>
        </div><!-- .one_fourth -->
        <div class="one_fourth">            
        <?php if ( $unique_secondarybar == 'true' ) {
            if ( is_active_sidebar( $posts[0]->ID.'-secondary-column-2' ) )
                dynamic_sidebar( $posts[0]->ID.'-secondary-column-2' ); 
        }
        else {
            if ( is_active_sidebar( 'secondary-column-2' ) )
                dynamic_sidebar( 'secondary-column-2' ); 					
        }
        ?>
        </div><!-- .one_fourth -->
        <div class="one_fourth">            
        <?php if ( $unique_secondarybar == 'true' ) {
            if ( is_active_sidebar( $posts[0]->ID.'-secondary-column-3' ) )
                dynamic_sidebar( $posts[0]->ID.'-secondary-column-3' ); 
        }
        else {
            if ( is_active_sidebar( 'secondary-column-3' ) )
                dynamic_sidebar( 'secondary-column-3' ); 					
        } ?>
        </div><!-- .one_fourth -->                    
        <div class="one_fourth last clearfix">
        <?php if ( $unique_secondarybar == 'true' )
        {
			if ( is_active_sidebar( $posts[0]->ID.'-secondary-column-4' ) )
				dynamic_sidebar( $posts[0]->ID.'-secondary-column-4' ); 
        }
        else {
			if ( is_active_sidebar( 'secondary-column-4' ) )
				dynamic_sidebar( 'secondary-column-4' ); 					
        } ?>
        </div><!-- .one_fourth last -->
    </div><!-- .secondary_wrap -->
</div><!-- .secondary -->
<?php endif; //show secondary ?>

</div><!-- container -->
 
<div id="footer">
    <div class="footer_wrap">
    	<div class="custom-txt">
        	<div class="notes_left"><?php echo stripslashes($mib_footer_left); ?><!--  --></div>       
        	<div class="notes_right"><?php echo stripslashes($mib_footer_right); ?><!-- --></div>  
        </div><!-- .custom-txt -->
        <div class="copyright">
        	<span>Copyright &copy; <?php echo date("Y"); ?> <a href="<?php bloginfo('siteurl');?>/"><?php bloginfo('name');?></a> All rights reserved.</span>
			<span>Powered by <a href="http://www.lyove.com/" target="_blank">Wordpress</a> | Designed by <a href="http://www.lyove.com/"  target="_blank">Chzng</a></span>   
        </div><!-- .copyright -->
        
        <a class="roll_top" href="#" title="<?php _e( 'Scroll to top', 'mibook' ); ?>"></a> 
              
    </div><!-- .footer_wrap -->
</div><!-- #footer -->


<?php wp_footer(); ?>
<script type="text/javascript">// < ![CDATA[
	jQuery(document).ready(function(){
		jQuery("#web_loading div").animate({width:"100%"},800,function(){ 
			setTimeout(function(){jQuery("#web_loading div").fadeOut(500); 
			}); 
		}); 
	});
 
// ]]></script>
</body>
</html>