<?php
/*
Template Name: 文章归档
*/
?>
<?php get_header(); ?>
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
<div id="content">
	<!-- menu -->
	<div id="map">
		<div class="browse">现在位置： <a title="返回首页" href="<?php echo get_settings('Home'); ?>/">首页</a> &gt; 文章归档</div>
		<div id="feed"><a href="<?php bloginfo('rss2_url'); ?>" title="RSS">RSS</a></div>
	</div>
	<!-- end: menu -->
	<!-- entry -->
	<div class="clear"></div>
	<div class="entry_box_s">
		<div class="entry">
		<h3>文章归档</h3>
		( 共有：<?php $count_posts = wp_count_posts(); echo $published_posts = $count_posts->publish;?> 篇文章&nbsp;&nbsp;
		<?php echo $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->comments");?>条留言&nbsp;&nbsp;
		于<?php $last = $wpdb->get_results("SELECT MAX(post_modified) AS MAX_m FROM $wpdb->posts WHERE (post_type = 'post' OR post_type = 'page') AND (post_status = 'publish' OR post_status = 'private')");$last = date('Y年n月j日', strtotime($last[0]->MAX_m));echo $last; ?>最后更新
		 )
		<div id="expand_collapse">展开收缩</div>
			<div id="archives">
				<?php archives_list_SHe(); ?>
			</div>
		</div>
		<!-- end: entry -->
		<div class="clear"></div>
	</div>
	<div class="entry_sb">
	</div>
</div>
<!-- end: content -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>