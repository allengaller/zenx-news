<?php if ((!function_exists("check_theme_footer") || !function_exists("check_theme_header"))) { ?><?php { /* nothing */ } ?><?php } else { ?><?php get_header(); ?>
	<div class="fluidCon">
		<?php 
            if(get_qintag_option('top_ads') !== '') {
                echo "<div class='ads468'>".get_qintag_option('top_ads')."</div>";
            }
        ?>
		<?php while (have_posts()) : the_post(); ?>
			<?php get_template_part( 'content', get_post_format() ); ?>
		<?php endwhile; ?>
		<div id="pagenavi">
			<?php if (function_exists('pagenavi')) { pagenavi(); } ?>
		</div><!-- pagenavi end -->
	</div><!-- fluidCon end -->
<?php get_sidebar(); get_footer(); ?><?php } ?>