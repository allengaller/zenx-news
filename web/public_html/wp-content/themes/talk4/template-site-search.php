<?php
/*
Template Name: site-search
*/
?>
<?php get_header();?>
	<div class="fluidCon" style="min-height:1398px;">
		<div id="category">
			<h2>谷歌站内搜索到的结果</h2>
		</div>
		<div class="post_detail" id="post-<?php the_ID(); ?>">
			<div class="post_content"><!-- 此处广告代码需要优化 -->
				<div class="google_search">
					<div id="cse" style="width:100%;">正在从Google 加载搜索结果......</div>
					<script src="//www.google.com/jsapi" type="text/javascript"></script>
					<script type="text/javascript"> 
						google.load('search', '1', {language : 'zh-CN'});
						google.setOnLoadCallback(function() {
							var customSearchControl = new google.search.CustomSearchControl('016728113596079249224:j3gjfmmhshs');
							customSearchControl.setResultSetSize(google.search.Search.FILTERED_CSE_RESULTSET);
							customSearchControl.draw('cse');
							var match = location.search.match(/q=([^&]*)(&|$)/);
							if(match && match[1]){
								var search = decodeURIComponent(match[1]);
								customSearchControl.execute(search);
							}	
						}, true);
						</script>
					<link rel="stylesheet" href="//www.google.com/cse/style/look/default.css" type="text/css" />
					<div class="clear"></div>
				</div><!--google_search end-->
			</div><!-- post_content end -->
		</div><!-- post_detail end -->
	</div><!-- fluidCon end  -->
	</div><!-- fluid end  -->
</div><!-- container end -->
<aside id="sidebar">
    <!-- 谷歌自定义搜索 -->
    <?php include('includes/sidebar_search.php'); ?>
    <!--幻灯片-->
    <?php include('includes/featured.php'); ?>
    <!--最给力的文章-->
    <?php include('includes/sticky.php'); ?>
    <!--站长推荐-->
    <?php include('includes/goods.php'); ?>
    <!--站长介绍-->
	<div class="sidebarWidget aboutMe">
		<?php include('includes/about_me.php'); ?>
	</div><!--aboutMe end-->
</aside><!-- sidebar end -->
<?php get_footer(); ?>