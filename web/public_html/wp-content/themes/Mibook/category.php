<?php
/* Category Archives */
global $options;
foreach ($options as $value) {
	if(isset($value['id']) && isset ($value['std']))
		if (get_option( $value['id'] ) === FALSE) {
			$$value['id'] = $value['std']; 
		} else {
		$$value['id'] = get_option( $value['id'] );
	}
}
?>
<?php get_header();?>

<?php if ( have_posts() ) : ?>

	<?php wp_pagenavi();?><!--PageNavi-->			
    
	<?php while ( have_posts() ) : the_post();  ?>

        <article id="post-<?php the_ID();?>" <?php post_class('entry clearfix'); ?> >                             
			<div class="entry-content">
				<div class="blog-post-thumb foldify">
					<?php include('includes/post_thumbnail.php'); ?>
				</div>
            	<div class="blog-post-content">
                    <h3 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( '%s', 'mibook' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
                	<div class="entry-meta">
						<?php mibook_header_meta(); ?>
                	</div>
                    <?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 175,"..."); ?>
				<a class="btn more-link" href="<?php the_permalink() ?>" rel="bookmark" title="<?php printf( esc_attr__( '%s', 'mibook' ), the_title_attribute( 'echo=0' ) ); ?>"><?php _e( 'Read More', 'mibook' ); ?></a>                       		
				</div>      
			</div><!-- .entry-content -->
		</article><!-- #post-<?php the_ID(); ?> -->
    
	<?php endwhile; ?>
    
	<?php wp_pagenavi();?>

<?php else : ?>

	<article id="post-0" class="post no-results not-found clearfix">
		<header class="entry-header">
			<h2 class="entry-title"><?php _e( 'Nothing Found', 'mibook' ); ?></h2>
		</header><!-- .entry-header -->

	<div class="entry-content">
		<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'mibook' ); ?></p>
		<?php get_search_form(); ?>
	</div><!-- .entry-content -->
    
</article><!-- #post-0 -->

<?php endif; //End Loop?>

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
    } ?>
    </div><!-- .primary_wrap --> 
</div><!-- .primary --> 
   
<?php get_footer(); ?>