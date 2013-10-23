<?php
/* Date Archives Template */

/* Fetch Theme Admin Options */
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

	<?php if ( have_posts() ) : ?>

		<header class="archive-header">
			<h3 class="archive-page-title">
				<?php if ( is_day() ) : ?>
						<?php printf( __( 'Daily Archives: %s', 'mibook' ), '<span>' . get_the_date() . '</span>' ); ?>
					<?php elseif ( is_month() ) : ?>
						<?php printf( __( 'Monthly Archives: %s', 'mibook' ), '<span>' . get_the_date( _x( 'Y F', 'monthly archives date format', 'mibook' ) ) . '</span>' ); ?>
					<?php elseif ( is_year() ) : ?>
						<?php printf( __( 'Yearly Archives: %s', 'mibook' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'mibook' ) ) . '</span>' ); ?>
					<?php else : ?>
						<?php _e( 'Blog Archives', 'mibook' ); ?>
					<?php endif; ?>
				</h3>
			</header>

		<?php wp_pagenavi();?><!--PageNavi-->
    
	<?php while ( have_posts() ) : the_post(); ?>
		<?php
			/* Include the Post-Format-specific template for the content.
			* If you want to overload this in a child theme then include a file
			* called content-___.php (where ___ is the Post Format name) and that will be used instead.
			*/
		get_template_part( 'content', get_post_format() );
		?>
	<?php endwhile; ?>

	<?php wp_pagenavi();?><!--PageNavi-->

	<?php else : ?>
		<article id="post-0" class="post no-results not-found clearfix">
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
    }?>
    </div><!-- .primary_wrap --> 
</div><!-- .primary -->     
<?php get_footer(); ?>