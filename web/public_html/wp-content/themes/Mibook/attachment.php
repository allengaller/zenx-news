<?php
/* Attachmemnt Template */

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
get_header(); ?>

		<nav  class="nav-single">
			<span class="nav-previous">
			 	<?php _e( 'Previous Link:', 'mibook'); previous_image_link(false);?>
			</span>
			<span class="nav-next">
				<?php _e( 'Next Link:', 'mibook'); next_image_link(false);?>	
			</span>
		</nav>

		<?php while (have_posts()) : the_post(); ?>
        
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header class="entry-header">
					<h2 class="entry-title"><?php the_title(); ?></h2>

					<div class="entry-meta">
						<?php
							$metadata = wp_get_attachment_metadata();
							printf( __( '<span class="entry-date">Published<abbr class="published" title="%1$s">%2$s</abbr></span> <span class="image-size"> at <a href="%3$s" title="Link to full-size image">%4$s &times; %5$s</a></span> <span class="image-in">in <a href="%6$s" title="%7$s" rel="gallery">%8$s</a></span>', 'mibook' ),
								esc_attr( get_the_time() ),
								get_the_date(),
								esc_url( wp_get_attachment_url() ),
								$metadata['width'],
								$metadata['height'],
								esc_url( get_permalink( $post->post_parent ) ),
								esc_attr( strip_tags( get_the_title( $post->post_parent ) ) ),
								get_the_title( $post->post_parent )
							);
						?>
						<?php edit_post_link( __( 'Edit', 'mibook' ), '<span class="edit-link">', '</span>' ); ?>
					</div><!-- .entry-meta -->

				</header><!-- .entry-header -->

				<div class="entry-content">

					<div class="entry-attachment">
						<div class="attachment">
						<?php
							$attachments = array_values( get_children( array( 'post_parent' => $post->post_parent, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID' ) ) );
							foreach ( $attachments as $k => $attachment ) {
								if ( $attachment->ID == $post->ID )
								break;
							}
							$k++;
							// If there is more than 1 attachment in a gallery
							if ( count( $attachments ) > 1 ) {
								if ( isset( $attachments[ $k ] ) )
									// get the URL of the next image attachment
									$next_attachment_url = get_attachment_link( $attachments[ $k ]->ID );
								else
								// or get the URL of the first image attachment
								$next_attachment_url = get_attachment_link( $attachments[ 0 ]->ID );
							} else {
							// or, if there's only 1 image, get the URL of the image
							$next_attachment_url = wp_get_attachment_url();
							}
						?>
						<a href="<?php echo esc_url( $next_attachment_url ); ?>" title="<?php the_title_attribute(); ?>" rel="attachment"><?php $attachment_size = apply_filters( 'mibook_attachment_size', 848 ); echo wp_get_attachment_image( $post->ID, array( $attachment_size, 1024 ) ); ?></a>

						<?php if ( ! empty( $post->post_excerpt ) ) : ?>
						<div class="entry-caption">
							<?php the_excerpt(); ?>
						</div>
						<?php endif; ?>
					</div><!-- .attachment -->

				</div><!-- .entry-attachment -->

				<div class="entry-description">
					<?php the_content(); ?>
					<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'mibook' ) . '</span>', 'after' => '</div>' ) ); ?>
				</div><!-- .entry-description -->

			</div><!-- .entry-content -->

		</article><!-- post-<?php the_ID(); ?> -->
                                 
		<?php comments_template( '', true );?>            
		<?php endwhile; ?>
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