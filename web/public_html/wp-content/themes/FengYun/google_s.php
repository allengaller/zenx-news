<?php
/*
Template Name: 谷歌搜索
*/
?>
<?php get_header(); ?>
	<div id="map_box">
		<div id="map_l">
			<div class="browse">现在的位置: <a title="返回首页" href="<?php echo get_settings('Home'); ?>/">首页</a> &gt; 搜索结果</div>
		</div>
		<div id="map_r">
			<div id="feed"><a href="<?php bloginfo('rss2_url'); ?>" title="RSS">RSS</a></div>
		</div>
	</div>
	<div class="clear"></div>
	<div class="entry_box_s_g">
		<div class="search">
			<h3>可以重新搜索</h3>
			<form action="<?php echo get_option('swt_search_link'); ?>" id="cse-search-box">
				<input type="hidden" name="cx" value="<?php echo get_option('swt_search_ID'); ?>" />
				<input type="hidden" name="cof" value="FORID:10" />
				<input type="text" onclick="this.value='';" name="q" id="q" size="26" class="swap_value" />
				<input type="image" src="<?php bloginfo('template_directory'); ?>/images/go.gif" id="go" alt="Search" title="搜索" />
			</form>
		</div>
			<div class="google">
			<!-- 自定义搜索代码 -->
				<div id="cse-search-results"></div>
				<script type="text/javascript">
					var googleSearchIframeName = "cse-search-results";
					var googleSearchFormName = "cse-search-box";
					var googleSearchFrameWidth = 800;
					var googleSearchDomain = "www.google.com";
					var googleSearchPath = "/cse";
				</script>
				<script type="text/javascript" src="http://www.google.com/afsonline/show_afs_search.js"></script>
			<!-- 自定义搜索代码结束 -->
			</div>
		<i class="lt"></i>
		<i class="rt"></i>
	</div>
	<div class="entry_sb_l">
		<i class="lb"></i>
		<i class="rb"></i>
	</div>
<?php get_footer(); ?>