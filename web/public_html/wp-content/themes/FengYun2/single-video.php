<?php include('header_video_s.php'); ?>
<?php include('includes/addclass.php'); ?>
<div id="content">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	 <!-- menu -->
		<div id="map">
			<div class="browse">现在的位置: <a title="返回首页" href="<?php echo get_settings('Home'); ?>/">首页</a> &gt; <?php echo get_the_term_list($post->ID,  'videos', '', ', ', ''); ?> &gt; 正文<!-- <?php the_title();?> --></div>
			<div id="feed"><a href="<?php bloginfo('rss2_url'); ?>" title="RSS">RSS</a></div>
		</div>
		<!-- end: menu -->
		<div class="entry_box_s">
			<div class="img_title_box">
				<div class="entry_title"><?php the_title(); ?></div>
			</div>
				<div class="img_info">
					<ul class="date">发布日期：<?php the_time('Y年m月d日') ?>&nbsp;&nbsp;&nbsp;&nbsp;<span class="edit"><?php edit_post_link('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', '  ', '  '); ?></span></ul>
					<ul class="category">所属分类：<?php echo get_the_term_list($post->ID,  'videos', '', ', ', ''); ?></ul>
					<ul class="comment"><?php comments_popup_link('沙发目前空缺', '只有板凳了', '共有 % 人发表了评论'); ?></ul>
					<ul class="comment"> <?php if(function_exists('the_views')) { print '该视频被浏览了 '; the_views(); print ' 次';  } ?></ul>
				</div>				
			<!-- end: entry_title_box -->
			<div class="entry">
				<div class="entry_c">
					<!-- thumbnail -->
					<div class="pic">
						<div class="top_t">
							<?php if ( get_post_meta($post->ID, 'small', true) ) : ?>
							<?php $image = get_post_meta($post->ID, 'small', true); ?>
							<?php $img = get_post_meta($post->ID, 'big', true); ?>
							<a class="example6" href="<?php echo $img; ?>" rel="example6" title="<?php the_title(); ?>"><img src="<?php echo $image; ?>" alt="<?php the_title(); ?>"/></a>
							<?php else: endif;?>
							<?php $img = get_post_meta($post->ID, 'big', true); ?>
							<div class="zoom"><a class="example6" href="<?php echo $img; ?>" rel="example6" title="<?php the_title_attribute(); ?>"></a></div>
						</div>
					</div>
					<!-- end: thumbnail -->
					<?php the_content('Read more...'); ?>
				</div>
			</div>
			<div class="back_b">
				<a href="javascript:void(0);" onclick="history.back();">返回</a>
			</div>
			<div class="clear"></div>
			<!-- end: entry -->
		</div>
		<div class="entry_sb">
		</div>
		<!-- entrymeta -->
		<div class="entrymeta">
			<div class="authorbio">
				<div class="author_pic">
					<?php echo get_avatar( get_the_author_email(), '48' ); ?>
				</div>
				<div class="clear"></div>
				<div class="author_text">
					<h4>作者: <span><?php the_author_posts_link('namefl'); ?></span></h4>
				</div>
			</div>
			<span class="spostinfo">
				<ul>
					<li>该日志由 <?php the_author() ?> 于<?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . '前'; ?>发表在 <?php echo get_the_term_list($post->ID,  'videos', '', ', ', ''); ?> 分类下</li>
					<li>转载请注明: <a href="<?php the_permalink() ?>" rel="bookmark" title="本文固定链接 <?php the_permalink() ?>"><?php the_title(); ?> | <?php bloginfo('name');?></a><a href="#" onclick="copy_code('<?php the_permalink() ?>'); return false;"> +复制链接</a></li>
					<li class="content_tag"><?php echo get_the_term_list($post->ID,  'video_tags', '关键字：', ', ', ''); ?></li>
				</ul>
			</span>
			<div class="clear"></div>
		</div>
		<div class="entry_sb">
		</div>
		<!-- end: entrymeta -->
	<div class="context_b">
		<?php previous_post_link('【上篇】%link') ?><br/><?php next_post_link('【下篇】%link') ?>
	</div>
	<div class="ct"></div>
	<?php comments_template(); ?>
	<?php endwhile; else: ?>
	<?php endif; ?>
</div>
<!-- end: content -->
<?php get_sidebar('img'); ?>
<?php get_footer(); ?>