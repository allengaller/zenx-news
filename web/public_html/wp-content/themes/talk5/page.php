<?php if ((!function_exists("check_theme_footer") || !function_exists("check_theme_header"))) { ?><?php { /* nothing */ } ?><?php } else { ?><?php get_header(); ?>
	<div class="fluidCon">
		<?php while (have_posts()) : the_post(); ?>
            <?php get_template_part( 'content-single', get_post_format() ); ?>
			<div class="commentPost">
				<?php comments_template( '', true ); ?>
			</div>
        <?php endwhile;?>
	</div><!-- fluidCon end  -->
<?php get_sidebar(); get_footer(); ?><?php } ?>