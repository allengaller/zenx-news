<?php
/* 404 - Not Found Template */

get_header(); ?>
		<div id="post-0" class="post error404 no-results not-found clearfix">
			<h2><?php _e( 'Not Found!', 'mibook' ); ?></h2>
			<p><?php _e( 'Apologies, but the page you requested could not be found. Perhaps searching will help.', 'mibook' ); ?></p>
			<?php get_search_form(); ?>
		</div><!-- .post-0 -->
	</div><!-- .content -->
	</div><!-- .primary_wrap --> 
</div><!-- .primary -->     
<?php get_footer(); ?>