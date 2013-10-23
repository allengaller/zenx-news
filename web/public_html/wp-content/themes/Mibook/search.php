<?php
/* Search Template */
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
		<?php if ( have_posts() ) : ?>
        
				<header class="archive-header">
					<h1 class="archive-page-title"><?php printf( __( 'Search Results for: %s', 'mibook' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
				</header>
                
               <?php wp_pagenavi();?><!--PageNavi-->

				<?php while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'content', get_post_format() );?>
				<?php endwhile; ?>

				<?php wp_pagenavi();?><!--PageNavi-->

			<?php else : ?>

				<article id="post-0" class="post no-results not-found">
					<header class="entry-header">
						<h1 class="entry-title"><?php _e( 'Nothing Found', 'mibook' ); ?></h1>
					</header><!-- .entry-header -->

					<div class="entry-content">
						<p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'mibook' ); ?></p>
						<?php get_search_form(); ?>
					</div><!-- .entry-content -->
				</article><!-- #post-0 -->

			<?php endif; ?>
	</div><!-- .content -->
    </div><!-- .primary_wrap --> 
</div><!-- .primary -->     
<?php get_footer(); ?>