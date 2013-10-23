<?php
	/* The Content */
?>
<article id="post-<?php the_ID();?>" <?php post_class('entry clearfix'); ?> >
	<header class="entry-header">           
		<?php if ( is_sticky() ) : ?>
			<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( '%s', 'mibook' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
			<h3 class="featured-post"><?php _e( 'Featured', 'mibook' ); ?></h3>            
		<?php else : ?>            
			<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( '%s', 'mibook' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
		<?php endif; //end sticky?>
            
		<?php if ( 'post' == get_post_type() ) : ?>
			<div class="entry-meta">
				<?php mibook_header_meta(); ?>
			</div>
		<?php endif; ?>            
		</header><!-- header-meta --> 
            
		<?php if ( is_search() ) : ?>
			<div class="entry-summary"><?php the_excerpt(); ?></div>
		<?php else : ?>                                
		<div class="entry-content">
			<?php the_content( __( 'Continue reading', 'mibook' ), 'false' ); ?>
            <?php wp_link_pages(array('before' => '<div class="page-link"><em>' . __( 'Pages:', 'mibook' ) . '</em>', 'after' => '</div>', 'next_or_number' => 'number', 'link_before' =>'<span>', 'link_after'=>'</span>', )); ?>
		</div><!-- .entry-content -->
		<?php endif; ?>

		<footer class="entry-footer">
        	<div class="entry-meta">
				<?php mibook_footer_meta(); ?>
            </div>
		</footer>
</article><!-- #post-<?php the_ID(); ?> -->