<?php get_header(); ?>
<div id="content">
	<?php if (have_posts()) : ?><?php while (have_posts()) : the_post(); ?>	
	<!-- menu -->
	<div id="map">
		<div class="browse">现在位置 &gt; <a title="返回首页" href="<?php echo get_settings('Home'); ?>/">首页</a> &gt; <?php the_title(); ?></div>
		<div id="feed"><a href="<?php bloginfo('rss2_url'); ?>" title="RSS">RSS</a></div>
	</div>
	<!-- end: menu -->
	<!-- entry -->
	<div class="clear"></div>
	<div class="entry_box_s">
		<div class="entry">
			<div class="page" id="post-<?php the_ID(); ?>">
				<?php the_content('More &raquo;'); ?>
				<div class="clear"></div>
				<?php the_tags('标签: ', ', ', ' '); ?>
				<span class="edit"><?php edit_post_link('<span class="edita">&nbsp&nbsp&nbsp&nbsp&nbsp</span>', '  ', '  '); ?></span>
				<?php if(function_exists('the_views')) { print ' 被围观 '; the_views(); print '+';  } ?>
			</div>
		</div>
		<!-- end: entry -->
		<div class="clear"></div>
	</div>
	<div class="entry_sb">
	</div>
	<div class="ct"></div>
	<?php comments_template(); ?>
	<?php endwhile; ?><?php else : ?>
 
	<p class="center">非常抱歉，无与之相匹配的信息。</p>
	<?php include (TEMPLATEPATH . "/searchform.php"); ?>
	<?php endif; ?>
</div>
<!-- end: content -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>