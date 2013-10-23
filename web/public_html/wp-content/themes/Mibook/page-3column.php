<?php
/*
Template Name: portfolio-3columnar 
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
			$titles = (isset($page_opts['titles'])) ? $page_opts['titles'] : '' ;
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
				$counter = 1; 
				$thumbClass = '';
				$col = 3; ?>
				<ul class="port2">
					<?php while ($wp_query->have_posts()) : $wp_query->the_post();
						$post_opts = get_post_meta( $post->ID, 'post_options', true ); ?>
                        <li class="<?php echo $thumbClass; ?>">
                        	<div class="port2_img foldify <?php if ( $titles ) echo ( ' title_off' ); ?>">
								<?php if (has_post_thumbnail()){
									$image_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "Full"); ?>
									<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>" target="_blank"><img src="<?php echo $image_src[0]; ?>" alt="<?php the_title(); ?>" width="280px" height="180px" /></a> 
								<?php }else {?>
									<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>" target="_blank"><img src="<?php echo catch_post_image();?>" alt="<?php the_title(); ?>" width="280px" height="180px" /></a>
								<?php } ?>
							</div>
							<?php if ( !$titles ) {?>
                            <div class="port_caption">
                                <a class="port_title" href="<?php the_permalink() ?>" rel="bookmark" title="<?php printf( esc_attr__( '%s', 'mibook' ), the_title_attribute( 'echo=0' ) ); ?>"><?php the_title(); ?></a>
                            </div>   
                        <?php } ?>
                        </li>
                        <?php $counter++; 
                        if($counter > $col){
                        $col = $col + 3; ?>
                        <li class="clear"></li>
                        <?php } ?> 
                    <?php endwhile; ?>
				</ul><!-- .port2 -->	
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
    </div><!-- .primary_wrap --> 
</div><!-- .primary -->     
<?php get_footer(); ?>