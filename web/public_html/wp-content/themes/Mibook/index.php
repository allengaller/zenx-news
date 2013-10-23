<?php
/* Index */

/* Fetch admin options. */
global $options;
foreach ($options as $value) {
	if(isset($value['id']) && isset ($value['std']))
		if (get_option( $value['id'] ) === FALSE) { 
			$$value['id'] = $value['std']; 
		} else { 
		$$value['id'] = get_option( $value['id'] );
	}
}?>

<?php get_header(); ?>

	<?php //if ( have_posts() ) : ?>
    
    	<?php //wp_pagenavi();?><!--PageNavi-->	
    
		<?php //while ( have_posts() ) : the_post(); ?>       
			<?php get_template_part( 'layout', 'index' ); ?>
		<?php //endwhile; ?>
        
        <?php //wp_pagenavi();?><!--PageNavi-->	
        
        <?php //else : ?>
        
		<?php //include('includes/nothing.php'); ?>


	<?php //endif; //End Loop?>
	<?php include (TEMPLATEPATH . '/includes/block-slider.php'); ?>                 
		</div><!-- .content -->            
			<?php
				$sidebar_opts = '';
				if ( is_page() ) {
					$page_opts = get_post_meta( $post->ID, 'page_options', true );
            		$sidebar_opts = $page_opts['sidebar_opts'];
				}
				if ( ( $sidebar_opts == 'right' ) && ( !( $sidebar_opts == 'left' || $sidebar_opts == 'none' ) ) ){
					get_sidebar();
				}
				elseif ( ( $mib_sidebar == 'right' ) && ( !( $sidebar_opts == 'left' || $sidebar_opts == 'none' ) ) ) {
					get_sidebar();
				}
			?>
    	</div><!-- .primary_wrap --> 
	</div><!-- .primary -->     
<?php get_footer(); ?>