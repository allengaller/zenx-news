<?php get_header(); ?>
<title><?php wp_title('',true); ?> | <?php bloginfo('name'); ?></title>
	<!-- menu -->
	<div id="map_box">
		<div id="map_l">
			<div class="browse">现在位置 &gt; <a title="返回首页" href="<?php echo get_settings('Home'); ?>/">首页</a> &gt; 
			<?php if (have_posts()) : ?> 
			<?php $post = $posts[0]; ?>
			<?php echo get_the_term_list($post->ID,  'genre', '', ', ', ''); ?>
		</div>
		</div>
		<div id="map_r">
			<div id="feed"><a href="<?php bloginfo('rss2_url'); ?>" title="RSS">RSS</a></div>
		</div>
	</div>
	<!-- end: menu -->
	<div class="clear"></div>
	<?php while ( have_posts() ) : the_post(); ?>
	<div class="entry_box_s_l">
  	<div class="archive_box_z">
  		<div class="archive_box">
  			 <!-- end: archive_title_box -->
			<div class="archive_title_box_b">
				<div class="archive_title_b">
					<h3><a href="<?php the_permalink() ?>" rel="bookmark" title="详细阅读 <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
				</div>
				<div class="archive_info_b">
					<span class="date">发表于<?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . '前'; ?></span>
					<span class="category"> &#8260; <?php echo get_the_term_list($post->ID,  'genre', '', ', ', ''); ?></span>
					<span class="comment"> &#8260; <?php comments_popup_link('暂无评论', '评论数 1', '评论数 %'); ?></span>
					<?php if(function_exists('the_views')) { print ' &#8260; 被围观 '; the_views(); print '+';  } ?>
					<span class="edit"><?php edit_post_link('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', '  ', '  '); ?></span>
				</div>
				<div class="clear"></div>
			</div>
 			<!-- end: archive_title_box -->
			<div class="archive_b">
				<?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 140,"......"); ?>
				<div class="clear"></div>
				<span class="archive_more"><a href="<?php the_permalink() ?>" title="详细阅读 <?php the_title(); ?>" rel="bookmark" class="title">阅读全文</a></span>
				<div class="clear"></div>
			</div>
		</div>
		<!-- end: archive_box -->
	</div> 		
	</div>
	<div class="entry_sb_l">
	</div>
	<?php endwhile; ?>
	<?php endif; ?>
 	<!-- navigation -->
	<div class="clear12"></div>
    <div class="navigation"><?php pagination($query_string); ?></div>
 	<!-- end: navigation -->
	<div class="clear"></div>
<?php get_footer(); ?>