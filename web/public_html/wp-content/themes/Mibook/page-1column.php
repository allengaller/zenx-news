<?php
/*
Template Name: portfolio-1columnar
*/

/* Fetch admin options. */
global $options;
foreach ($options as $value) {
if(isset($value['id']) && isset ($value['std']))
	if (get_option( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_option( $value['id'] );}
}
get_header();
		if (is_page() ) {
			$page_opts = get_post_meta( $post->ID, 'page_options', true );
            $category = $page_opts['category'];				
			$post_per_page = $page_opts['post_per_page'];	
			$post_per_page = empty($post_per_page) ? '6' : $post_per_page;
			if( have_posts() ) : ?>
			<?php while (have_posts()) : the_post();
					the_content ();
				endwhile; 
			endif;
		} //if is_page
		if ($category) {
		if ( get_query_var('paged') ) {
			$paged = get_query_var('paged');
		} elseif ( get_query_var('page') ) {
			$paged = get_query_var('page');
		} else {
			$paged = 1;
		}
			$do_not_show_stickies = 1; // 0 to show stickies
			$args=array(
				'cat' => $category,
				'orderby' => 'date',
				'order' => 'desc',
				'paged' => $paged,
				'posts_per_page' => $post_per_page,
				'ignore_sticky_posts' => $do_not_show_stickies
			);
			$temp = $wp_query;  // assign orginal query to temp variable for later use   
			$wp_query = new WP_Query($args); 
			if( have_posts() ) :
			$count = 1;
			?>
				<ul class="port1">
					<?php while ($wp_query->have_posts()) : $wp_query->the_post();
						$post_opts = get_post_meta( $post->ID, 'post_options', true );?>	
                        <li class="clearfix">
                        	<div class="port1_img foldify">
                        		<?php include('includes/post_thumbnail.php'); ?>
                        	</div>
                            <div class="port1_content">
                                <h2 class="entry-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php printf( esc_attr__( '%s', 'mibook' ), the_title_attribute( 'echo=0' ) ); ?>"><?php the_title(); ?></a></h2> 
                                <div class="entry-meta"><?php mibook_header_meta(); ?></div>                            
                                <p><?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 150,"..."); ?>
                                <a class="btn more-link" href="<?php the_permalink() ?>" rel="bookmark" title="<?php printf( esc_attr__( '%s', 'mibook' ), the_title_attribute( 'echo=0' ) ); ?>"><?php _e( 'Read More', 'mibook' ); ?></a>
								</p>
                            </div> 
                        </li>					
					<?php endwhile; ?>
				</ul><!-- .port1 -->
				<?php if ( $wp_query->max_num_pages > 1 ) :?>
					<?php wp_pagenavi(); ?>
				<?php endif; ?>
				<?php else : ?>
                <h2><?php _e( 'Not Found', 'mibook' ); ?></h2>
                <p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'mibook' ); ?></p>
                <?php get_search_form(); ?>
        <?php endif;
        $wp_query = $temp;  //reset back to original query
    }  // if ($category)
?>			
	</div><!-- .content -->            
	<?php
	$sidebar_opts = '';
	if ( is_page() ) {
			$page_opts = get_post_meta( $post->ID, 'page_options', true );
            $sidebar_opts = (isset($page_opts['sidebar_opts'])) ? $page_opts['sidebar_opts'] : '';
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