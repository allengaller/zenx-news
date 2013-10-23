<?php get_header(); ?>
	<div class="fluidCon">
        <?php include('includes/explain.php'); ?>
		<?php if(have_posts()) : while (have_posts()) : the_post(); ?>
			<?php get_template_part( 'content-archive', get_post_format() ); ?>
		<?php endwhile; endif; ?>
		<div id="pagenavi">
			<?php if (function_exists('pagenavi')) { pagenavi(); } ?>
		</div>
	</div><!-- fluidCon end  -->
<?php get_sidebar(); get_footer(); ?>