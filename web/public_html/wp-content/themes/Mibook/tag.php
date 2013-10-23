<?php
/* Tag Archives Template*/

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

			<?php if ( have_posts() ) : ?>

				<header class="archive-header">
					<h3 class="archive-page-title">
						<?php printf( __( 'Tag Archives: %s', 'mibook' ), '<span>' . single_tag_title( '', false ) . '</span>' ); ?>
                    </h3>

					<?php
						$tag_description = tag_description();
						if ( ! empty( $tag_description ) )
							echo apply_filters( 'tag_archive_meta', '<div class="tag-archive-meta">' . $tag_description . '</div>' );
					?>
				</header>

				<?php wp_pagenavi();?><!--PageNavi-->

				<?php /* Start the Loop */ ?>
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