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
			<div class="browse">现在的位置: <a title="返回首页" href="<?php echo get_settings('Home'); ?>/">首页</a> &gt; <?php $categories = get_the_category(); echo(get_category_parents($categories[0]->term_id, TRUE, ' &gt; '));  ?>正文</div>
			<div id="feed"><a href="<?php bloginfo('rss2_url'); ?>" title="RSS">RSS</a></div>
			<div class="font"><a href="javascript:doZoom(12)">小</a> <a href="javascript:doZoom(13)">中</a> <a href="javascript:doZoom(18)">大</a></div>
		</div>
		<!-- end: menu -->
		<div class="entry_box_s">
			<div class="context">
				<div class="context_t">
					<?php previous_post_link('%link', '上篇', TRUE); ?>
					<?php next_post_link('%link', '下篇', TRUE); ?>
				</div>
			</div>
			<div class="entry_title_box">
				<!-- 分类图标 -->
				<div class="ico"><?php if (get_option('swt_ico') == '显示') { ?><?php include('includes/cat_ico.php'); ?><?php } else { } ?></div>
				<!-- end: 分类图标 -->
				<div class="entry_title"><?php the_title(); ?></div>
				<div class="archive_info">
					<span class="date"><?php the_time('Y年m月d日') ?></span>
					<span class="category"> &#8260; <?php the_category(', ') ?></span>
					<?php include('includes/source.php'); ?>
					&#8260; <?php echo count_words ($text); ?>
					<span class="comment"> &#8260; <?php comments_popup_link('暂无评论', '评论数 1', '评论数 %'); ?></span>
					<?php if(function_exists('the_views')) { print ' &#8260; 被围观 '; the_views(); print '+';  } ?>
					<span class="edit"><?php edit_post_link('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', '  ', '  '); ?></span>
				</div>
			</div>
			<!-- end: entry_title_box -->
			<div class="entry">
				<div id="entry">
					<?php if (get_option('swt_ad_r') == '关闭') { ?>
					<?php { echo ''; } ?>
					<?php } else { include(TEMPLATEPATH . '/includes/ad_r.php'); } ?>
					<?php the_content('Read more...'); ?>
					<?php wp_link_pages( array( 'before' => '<p class="pages">' . __( '日志分页:'), 'after' => '</p>' ) ); ?>
					<div class="clear"></div>
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
					<li>该日志由 <?php the_author() ?> 于<?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . '前'; ?>发表在<?php the_category(', ') ?>分类下</li>
					<li>转载请注明: <a href="<?php the_permalink() ?>" rel="bookmark" title="本文固定链接 <?php the_permalink() ?>"><?php the_title(); ?> | <?php bloginfo('name');?></a><a href="#" onclick="copy_code('<?php the_permalink() ?>'); return false;"> +复制链接</a></li>
					<li class="content_tag"><?php the_tags('关键字: ', ', ', ''); ?></li>
				</ul>
			</span>
			<div class="clear"></div>
		</div>
		<div class="entry_sb">
		</div>
		<!-- end: entrymeta -->
                <!-- ad -->
		<?php if (get_option('swt_adt') == '关闭') { ?>
		<?php { echo ''; } ?>
		<?php } else { include(TEMPLATEPATH . '/includes/adt.php'); } ?>
	<div class="context_b">
		<?php previous_post_link('【上篇】%link') ?><br/><?php next_post_link('【下篇】%link') ?>
	</div>
	<!-- relatedposts -->
	<?php if (get_option('swt_related') == '关闭') { ?>
	<?php { echo ''; } ?>
	<?php } else { include(TEMPLATEPATH . '/includes/related_a.php'); } ?>
	<!-- end: relatedposts -->
	<div class="ct"></div>
	<?php comments_template(); ?>
	<?php endwhile; else: ?>
	<?php endif; ?>
</div>
<!-- end: content -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>