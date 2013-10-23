<?php
/* The Content */

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
<?php get_header();  ?>

	<?php while ( have_posts() ) : the_post();  ?>
    
		<div class="nav-single">
			<div class="nav-previous">
			<?php if (get_previous_post()) {
				_e( 'Previous Post:', 'mibook'); previous_post_link( '%link' );
				} else {
				_e( 'Sorry, it is already the newest post.', 'mibook' );
				}
			?>                
			</div>
			<div class="nav-next">
			<?php if (get_next_post()) {
				_e( 'Next post:', 'mibook'); next_post_link( '%link' );
				} else {
				_e( 'Sorry, it is already the earliest post.', 'mibook' );
				} 
			?>                 
			</div>   
		</div><!-- .nav-single -->
            
        <article id="post-<?php the_ID();?>" <?php post_class('entry '); ?> >
            <header class="entry-header">           
				<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( '%s', 'mibook' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
                <div class="entry-meta single-meta"><?php mibook_header_meta(); ?></div>                   
			</header><!-- entry-header --> 
            
		<div class="entry-content">
			<?php the_content(); ?>
			<?php wp_link_pages(array('before' => '<div class="page-link"><em>' . __( 'Pages:', 'mibook' ) . '</em>', 'after' => '</div>', 'next_or_number' => 'number', 'link_before' =>'<span>', 'link_after'=>'</span>', )); ?>                  
                   
		</div><!-- .entry-content -->

 		<?php if ( $mib_author == 'Enable' ): ?>
			<div class="about-author">
				<h3 ><?php printf( __( 'About %s', 'mibook' ), get_the_author() ); ?></h3>                             
				<div class="author-avatar">
					<?php 
						$dir = get_template_directory_uri();
						$default_avatar = $dir . '/images/default_avatar.png';
						echo get_avatar( get_the_author_meta( 'user_email' ), $size='64', $default = $default_avatar );
					?>
                </div>
                <div class="author-meta">
                    <div class="user-email"><?php echo the_author_meta( 'user_email' ); ?></div>	    
                    <div class="user-url"><a href="<?php echo the_author_meta ('user_url') ?>"><?php echo the_author_meta ('user_url') ?></a></div>
                    <div class="user-introduction"><?php echo the_author_meta( 'description' ); ?></div>
                    <div class="user-posts"><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php printf( __( 'View all posts by %s', 'mibook' ), get_the_author() ); ?></a></div>
                </div>
			</div><!-- .about author-->               
		<?php endif;?>		     

		<footer class="entry-footer">
			<div class="entry-meta">
				<?php mibook_footer_meta(); ?>
				<span class="permalink">
                	<span><?php _e( 'Permalink:', 'mibook' ); ?></span><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>" class="permalink"><?php the_title(); ?></a>
				</span>
            </div>                       
		</footer><!-- entry-footer -->
              
	</article><!-- article -->

		<div class="nav-single">
			<div class="nav-previous">
			<?php if (get_previous_post()) {
				_e( 'Previous Post:', 'mibook'); previous_post_link( '%link' );
				} else {
				_e( 'Sorry, it is already the newest post.', 'mibook' );
				}
			?>                
			</div>
			<div class="nav-next">
			<?php if (get_next_post()) {
				_e( 'Next post:', 'mibook'); next_post_link( '%link' );
				} else {
				_e( 'Sorry, it is already the earliest post.', 'mibook' );
				} 
			?>                 
			</div>   
		</div><!-- .nav-single -->

		<?php if ( $mib_rp == 'Enable' ): ?> 
			<?php mibook_related_posts( $mib_rp_taxonomy, $mib_rp_style, $mib_rp_num ); ?>
		<?php endif; ?><!-- Related Posts -->   

<?php comments_template( '', true );?> 

<?php endwhile; ?>

</div><!-- .content --> 
<?php
	$sidebar_opts = '';
    if ( is_single() ) {
		$post_opts = get_post_meta( $post->ID, 'post_options', true );
		$sidebar_opts = $post_opts['sidebar_opts'];
		//$sidebar_opts = (isset($post_opts['sidebar_opts'])) ? $post_opts['sidebar_opts'] : '';
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