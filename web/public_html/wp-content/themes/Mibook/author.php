<?php
/* Author Archives Template */
global $options;
foreach ($options as $value) {
	if(isset($value['id']) && isset ($value['std']))
		if (get_option( $value['id'] ) === FALSE) { 
			$$value['id'] = $value['std']; 
		} else { 
		$$value['id'] = get_option( $value['id'] );
	}
}?>

<?php get_header();?>

	<?php if (have_posts()) : ?>

		<?php the_post();?>
               
			<header class="archive-header">
				<h1 class="archive-page-title"><?php printf( __( 'Author Archives: %s', 'mibook' ), '<span class="vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( "ID" ) ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a></span>' ); ?></h1>
			</header>

			<?php rewind_posts(); ?>
                
			<?php wp_pagenavi();?><!--PageNavi-->

			<?php

			if ( get_the_author_meta( 'description' ) ) : ?>
				<div id="author-info">
					<div class="author-avatar">
						<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'mibook_author_bio_avatar_size', 60 ) ); ?>
					</div><!-- #author-avatar -->
					<div class="author-meta">
						<h2><?php printf( __( 'About %s', 'mibook' ), get_the_author() ); ?></h2>
						<?php the_author_meta( 'description' ); ?>
					</div><!-- #author-description	-->
				</div><!-- #author-info -->
				<?php endif; ?>

				<?php while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'content', get_post_format() ); ?>
				<?php endwhile; ?>

				<?php wp_pagenavi();?><!--PageNavi-->

			<?php else : ?>

				<article id="post-0" class="post no-results not-found">
					<header class="entry-header">
						<h1 class="entry-title"><?php _e( 'Nothing Found', 'mibook' ); ?></h1>
					</header><!-- .entry-header -->

					<div class="entry-content">
						<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'mibook' ); ?></p>
						<?php get_search_form(); ?>
					</div><!-- .entry-content -->
				</article><!-- #post-0 -->

			<?php endif; ?>     
    
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