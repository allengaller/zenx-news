<?php get_header(); ?>
<?php include('includes/addclass.php'); ?>
<script type="text/javascript">
    function doZoom(size) {
        var zoom = document.all ? document.all['entry'] : document.getElementById('entry');
        zoom.style.fontSize = size + 'px';
    }
</script>
<div id="content">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	 <!-- menu -->
		<div id="map">
			<div class="browse">现在的位置: <a title="返回首页" href="<?php echo get_settings('Home'); ?>/">首页</a> &gt; <?php echo get_the_term_list($post->ID,  'genre', '', ', ', ''); ?> &gt; 正文<!-- <?php the_title();?> --></div>
			<div id="feed"><a href="<?php bloginfo('rss2_url'); ?>" title="RSS">RSS</a></div>
			<div class="font"><a href="javascript:doZoom(12)">小</a> <a href="javascript:doZoom(13)">中</a> <a href="javascript:doZoom(18)">大</a></div>
		</div>
		<!-- end: menu -->
		<div class="entry_box_s">
			<div class="entry_title_box">
				<div class="entry_title"><?php the_title(); ?></div>
				<div class="archive_info">
					<span class="date">发表于<?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . '前'; ?></span>
					<span class="category"> &#8260; <?php echo get_the_term_list($post->ID,  'genre', '', ', ', ''); ?></span>
					<span class="comment"> &#8260; <?php comments_popup_link('暂无评论', '评论数 1', '评论数 %'); ?></span>
					&#8260; <?php echo count_words ($text); ?>
					<?php if(function_exists('the_views')) { print ' &#8260; 被围观 '; the_views(); print '+';  } ?>
					<span class="edit"><?php edit_post_link('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', '  ', '  '); ?></span>
				</div>
			</div>
			<!-- end: entry_title_box -->
			<div class="entry">
				<div id="entry">
					<?php the_content('Read more...'); ?>
					<?php wp_link_pages( array( 'before' => '<p class="pages">' . __( '日志分页:'), 'after' => '</p>' ) ); ?>
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
					<?php the_author_description(); ?>
				</div>
			</div>
			<span class="spostinfo">
				该日志由 <?php the_author() ?> 于<?php the_time('Y年m月d日') ?>发表在<?php the_category(', ') ?>分类下，
				<?php if (('open' == $post-> comment_status) && ('open' == $post->ping_status)) {?>
				你可以<a href="#respond">发表评论</a>，并在保留<a href="<?php the_permalink() ?>" rel="bookmark">原文地址</a>及作者的情况下<a href="<?php trackback_url(); ?>" rel="trackback">引用</a>到你的网站或博客。
				<?php } elseif (('open' == $post-> comment_status) && !('open' == $post->ping_status)) { ?>
				通告目前不可用，你可以至底部留下评论。
				<?php } ?><br/>
				原创文章转载请注明: <a href="<?php the_permalink() ?>" rel="bookmark" title="本文固定链接 <?php the_permalink() ?>"><?php the_title(); ?> | <?php bloginfo('name');?></a><br/>
				<span class="content_tag"><?php the_tags('关键字: ', ', ', ''); ?></span>
			</span>
			<div class="clear"></div>
		</div>
		<div class="entry_sb">
		</div>
		<!-- end: entrymeta -->
	<div class="context_b">
		<?php previous_post_link('【上篇】%link') ?><br/><?php next_post_link('【下篇】%link') ?>
	</div>
	<!-- relatedposts -->
	<?php if (get_option('swt_related') == 'Hide') { ?>
	<?php { echo ''; } ?>
	<?php } else { include(TEMPLATEPATH . '/includes/related_a.php'); } ?>
	<!-- end: relatedposts -->
	<div class="ct"></div>
	<?php comments_template(); ?>
	<?php endwhile; else: ?>
	<?php endif; ?>
</div>
<!-- end: content -->
<?php get_sidebar('img'); ?>
<?php get_footer(); ?>