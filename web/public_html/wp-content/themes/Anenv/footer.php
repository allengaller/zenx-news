</div></div>
<?php if (get_option('swt_wpshare') == 'Display') { ?>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/wpshare.js"></script>
<?php { echo ''; } ?><?php } else { } ?>
<?php An_show_notify(); ?>
<div id="footer"><div
id="ft_contain"><div
id="ft_1"><ul><li><a
target="_blank" href="http://weibo.com/anenver"><img alt='' src="<?php bloginfo('stylesheet_directory'); ?>/images/sina24.png"/></a></li><li><a
target="_blank" href="http://t.qq.com/anenver"><img alt='' src="<?php bloginfo('stylesheet_directory'); ?>/images/t24.png"/></a></li><li><a
target="_blank" href="http://t.163.com/anenv"><img alt='' src="<?php bloginfo('stylesheet_directory'); ?>/images/16324.png"/></a></li><li><a
target="_blank" href="https://twitter.com/anenver"><img alt='' src="<?php bloginfo('stylesheet_directory'); ?>/images/tw24.png"/></a></li></ul></div><div
id="ft_2">Contact<ul><li><a
target="_blank" href="<?php bloginfo('url'); ?>/about">关于本站</a></li><li><a
target="_blank" href="<?php bloginfo('url'); ?>/ad">投放广告</a></li><li><a
target="_blank" href="<?php bloginfo('url'); ?>/contact">联系站长</a></li><li><a
target="_blank" href="<?php bloginfo('url'); ?>/guestbook">我想留言</a></li></ul></div><div
id="ft_3">Links<ul><li><a
target="_blank" href="<?php bloginfo('url'); ?>/reader/">读者橱窗</a></li><li><a
target="_blank" href="<?php bloginfo('url'); ?>/copy">权利声明</a></li><li><a
target="_blank" href="<?php bloginfo('url'); ?>/links">友情链接</a></li><li><a
target="_blank" href="http://bbs.anenv.com">论坛社区</a></li></ul></div><div
id="ft_4">Partners<ul><li><a
rel="nofollow" target="_blank" href="http://www.anenv.com/go/yihaodian">一号店</a></li><li><a
rel="nofollow" target="_blank" href="http://www.anenv.com/go/vancl">凡客诚品</a></li><li><a
rel="nofollow" target="_blank" href="http://www.anenv.com/go/amazon">卓越亚马逊</a></li><li><a
rel="nofollow" target="_blank" href="http://www.anenv.com/go/taobao">淘宝特惠</a></li></ul></div><div
id="ft_5"><p><?php bloginfo('name'); ?>，是一个致力于分享优秀实用软件、网络素材、建站源码、模版程序、科技资讯、网络技术的个人网络博客。建立本站旨在与更多人分享网络给人们带来的快乐与精彩！</p><p><br/>个人blog转载时请遵循"署名-非商业性使用-相同方式共享"的创作共用协议。<br/>本站为个人站点，本站内容仅供观摩学习交流之用，将不对任何资源负法律责任。<br/>如有侵犯您的权利，请及时联系本站，本站将尽快处理。</p></div></div><div
class="ft_info">
<?php echo An_comicpress_copyright(); ?> <a
rel="nofollow" href="<?php bloginfo('url'); ?>" title="<?php bloginfo('name'); ?>"><?php bloginfo('name'); ?></a>、<a
rel="nofollow" href="http://cn.wordpress.org/" title="由WordPress驱动">WordPress</a>、<a
href="http://www.anenv.com" title="本主题由Anenv设计">Anenv设计</a>、<a
rel="nofollow" target="_blank" href="http://www.miibeian.gov.cn/"><?php get_option('swt_copyr')?></a>、<a
href="/sitemap.html" title="站点地图">站点地图</a>、<a
href="/sitemap_baidu.xml" title="站点地图">百度地图</a>、<a
href="/sitemap.xml" title="站点地图">谷歌地图</a>、<?php get_option('swt_tongj')?>
、<script src="http://s17.cnzz.com/stat.php?id=5041653&web_id=5041653&show=pic" language="JavaScript"></script> 
</div></div>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/cm.js"></script>
<?php if ( is_home() ||is_archive()): ?>
<div id="roll"><div title="回到顶部" id="gotop"></div><div title="转到底部" id="gofall"></div></div>
<?php else:?>
<div id="roll"><div title="回到顶部" id="gotop"></div>
<div title="查看评论" id="goct"></div><div title="转到底部" id="gofall"></div></div>
<?php endif; ?>
<?php wp_footer(); ?>
<div class="rightNav">
	<a href="<?php bloginfo('url'); ?>/google" target="_blank"><em>0</em>全站搜索</a>
 <?php $display_categories = explode(',', get_option('swt_cdh') ); $i = 1; foreach ($display_categories as $category) { ?> 
 <?php query_posts("cat=$category")?>
	<a href="<?php echo get_category_link($category);?>" target="_blank"><em><?php echo($i)?></em><?php single_cat_title(); ?></a>
<?php $i++; ?>
<?php } ?>
<a href="<?php bloginfo('url'); ?>/go/vancl" target="_blank"><em>8</em>凡客诚品</a>
	<a href="<?php bloginfo('url'); ?>/go/taobao" target="_blank"><em>9</em>淘宝特惠</a>
</div>
<script type="text/javascript">
	var btb=$(".rightNav");
	var tempS;
	$(".rightNav").hover(function(){
			var thisObj = $(this);
			tempS = setTimeout(function(){
			thisObj.find("a").each(function(i){
				var tA=$(this);
				setTimeout(function(){ tA.animate({right:"0"},300);},50*i);
			});
		},200);

	},function(){
		if(tempS){ clearTimeout(tempS); }
		$(this).find("a").each(function(i){
			var tA=$(this);
			setTimeout(function(){ tA.animate({right:"-80"},300,function(){
			});},50*i);
		});

	});
	var isIE6 = !!window.ActiveXObject&&!window.XMLHttpRequest;
	if( isIE6 ){ $(window).scroll(function(){ btb.css("top", $(document).scrollTop()+30) }); }
</script>
<script id="bdlike_shell"></script>
<script>
var bdShare_config = {
	"type":"small",
	"color":"blue",
	"uid":"6628845"
};
document.getElementById("bdlike_shell").src="http://bdimg.share.baidu.com/static/js/like_shell.js?t=" + Math.ceil(new Date()/3600000);
</script>
</body>
</html>