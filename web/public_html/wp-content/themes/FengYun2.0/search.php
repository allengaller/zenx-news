<?php get_header(); ?>
<div id="content">
 <!-- menu -->
	<div id="map">
		<div class="browse">现在位置： <a title="返回首页" href="<?php echo get_settings('Home'); ?>/">首页</a> &gt; 搜索结果</div>
		<div id="feed"><a href="<?php bloginfo('rss2_url'); ?>" title="RSS">RSS</a></div>
	</div>
 	<!-- end: menu -->
 	<!-- archive_box -->
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<div class="entry_box">
		<span class="comment_a"><?php comments_popup_link('+0&deg; ', '+1&deg; ', '+%&deg; '); ?></span>
		<div class="archive_box">
			<!-- end: archive_title_box -->
			<div class="archive_title_box">
				<!-- 分类图标 -->
				<div class="ico"><?php if (get_option('swt_ico') == '显示') { ?><?php include('includes/cat_ico.php'); ?><?php } else { } ?></div>
				<!-- end: 分类图标 -->
				<div class="archive_title">
					<h3><a href="<?php the_permalink() ?>" rel="bookmark" title="详细阅读 <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
				</div> 
				<div class="archive_info">
					<span class="date">发表于<?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . '前'; ?></span>
					<span class="category"> &#8260; <?php the_category(', ') ?></span>
					<?php if(function_exists('the_views')) { print ' &#8260; 被围观 '; the_views(); print '+';  } ?>
					<span class="edit"><?php edit_post_link('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', '  ', '  '); ?></span>
				</div>
			</div>
			<!-- end: archive_title_box -->
			<div class="thumbnail_box">
				<?php include('includes/thumbnail.php'); ?>
			</div>
			<div class="archive">
				<?php if (has_excerpt())
				{ ?> 
					<?php the_excerpt() ?>
				<?php
				}
				else{
					echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 400,"...");
				} 
				?>
			</div>
			<div class="clear"></div>
			<span class="posttag"><?php the_tags('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ', ', ', ''); ?></span><span class="archive_more"><a href="<?php the_permalink() ?>" title="详细阅读 <?php the_title(); ?>" rel="bookmark" class="title">阅读全文</a></span>
			<div class="clear"></div>
		</div>
	</div>
	<div class="entry_box_b">
	</div>
	<?php endwhile; else: ?>
	<div class="entry_box">
	<h3 class="center">抱歉!无法搜索到与之相匹配的信息。您可以重新搜索或者直接浏览下面的文章</h3>
		<div class="search_s">
			<form method="get" id="searchform" action="<?php bloginfo('url'); ?>/">
				<input type="text" value="搜索" onclick="this.value='';" name="s" id="s" class="swap_value" />
				<input type="image" src="<?php bloginfo('template_directory'); ?>/images/go.gif" id="go" alt="Search" title="搜索" />
			</form>
		</div>
	 	<div id="expand_collapse">展开收缩</div>
		<div id="archives">
			<?php archives_list_SHe(); ?>
		</div>
		<div class="clear"></div>
	</div>
	<div class="entry_box_b">
	</div>
	<?php endif; ?>
	<!-- end: archive_box --> 
 	<!-- navigation_b -->
    <div class="navigation"><?php pagination($query_string); ?></div>
 	<!-- end: navigation_b -->
<div class="clear"></div>
</div>
<!-- end: content -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>
<script type="text/javascript">
jQuery(function($){
	$('#expand_collapse,.archives-yearmonth').css({cursor:"pointer"});
	$('#archives ul li ul.archives-monthlisting').hide();
	$('#archives ul li ul.archives-monthlisting:first').show();
	$('#archives ul li span.archives-yearmonth').click(function(){$(this).next().slideToggle('fast');return false;});
	//以下是全局的操作
	$('#expand_collapse').toggle(
	function(){
	$('#archives ul li ul.archives-monthlisting').slideDown('fast');
	},
	function(){
	$('#archives ul li ul.archives-monthlisting').slideUp('fast');
	});
	});
</script>