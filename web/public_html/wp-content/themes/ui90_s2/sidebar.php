<div id="sidebar">
	<div class="sidebar_search clx">
		<form method="get" id="searchform" action="<?php bloginfo('home'); ?>/">
			<input type="text" name="s" class="input" id="search" value="请输入文章标题 关键词..." x-webkit-speech="" required=""/>
			<button class="btn" value="搜索" id="searchsubmit"><span></span></button>
		</form>
	</div><!--sidebar_search end-->
	<?php 
        if(get_qintag_option('sidebar_ads') !== '') {
            echo "<div id='sidebar_ads'>".get_qintag_option('sidebar_ads')."</div>";
        }
    ?>
	<?php include ("includes/sidebar_tab.php"); ?>
	<ul class="sidebar_list">
		<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar(1)) : ?>
		<?php endif; ?>
	</ul><!-- sidebarlist end -->
	
    <!--评论-->
    <?php include('includes/gravatarComment.php'); ?>
	
	<?php if ( !is_singular() ){ ?>	
		<?php 
			if(get_qintag_option('sidebar_ads2') == '') {
				echo "";
			}else{
				echo "<div id='sidebar_ads'>".get_qintag_option('sidebar_ads2')."</div>";
			}
		?>
	<?php } ?>
	<?php if (is_home()) { ?><!-- 仅在首页显示友情连接 -->
    <div class="sidebar_box">
		<h3><a target="_blank" href="<?php bloginfo('url'); ?>/links">友情连接</a></h3>
			<ul class="flinks">
				<?php wp_list_bookmarks('orderby=id&categorize=0&category=&orderby=rand&title_li='); ?>
				<li><a href="http://egouz.com/" target="_blank">优秀国外网站推荐</a></li>
                <li><a href="http://masterchat.cn" target="_blank">产品经理必备网站</a></li>
				<li><a href="http://www.jisuhudong.com/" target="_blank">极速互动传媒</a></li>
				<div class="clear"></div>
			</ul>
    </div><!-- sidebar_box end -->
	<?php } ?>

    <div id="J_floatDiv">
		<div id="float" class="div1">
			<?php if(get_qintag_option('sidebar_ads') !== '') {
					echo "<div id='sidebar_ads'>".get_qintag_option('sidebar_ads3')."</div>";}
			?>
		</div><!--float end-->
	</div><!--J_tqqWidget end-->
</div><!-- sidebar end -->