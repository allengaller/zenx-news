<?php
/*
Template Name: 热门标签
*/
?>
<?php get_header(); ?>
	<?php if (have_posts()) : ?><?php while (have_posts()) : the_post(); ?>	
	<div id="map_box">
		<div id="map_l">
			<div class="browse">现在位置 ＞<a title="返回首页" href="<?php echo get_settings('Home'); ?>/">首页</a> ＞<?php the_title(); ?></div>
		</div>
		<div id="map_r">
			<div id="feed"><a href="<?php echo get_option('swt_rsssub'); ?>" title="RSS">RSS</a></div>
		</div>
	</div>
	<div class="clear"></div>
	<div class="entry_box_s_l">
		<div class="tagall">
		<?php wp_tag_cloud('smallest=14&largest=20&orderby=count&unit=px&number=&order=RAND&exclude&include=');?>
		</div>
	</div>
	<div class="entry_sb_l">
	</div>
	<?php endwhile; ?>
	<?php endif; ?>
<?php get_footer(); ?>