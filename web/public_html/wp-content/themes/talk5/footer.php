<div class="clear"></div>
    <footer id="ft" >
    	<dl class="footWidget" style=" width: 10%;">
			<dt>分类目录</dt>
            <dd><a target="_blank" href="<?php bloginfo('url'); ?>/qintag-themes">june主题</a></dd>
            <dd><a target="_blank" href="<?php bloginfo('url'); ?>/xiaoma-winpe">小马PE</a></dd>
            <dd><a target="_blank" href="<?php bloginfo('url'); ?>/webdesign">web前端</a></dd>
            <dd><a target="_blank" href="<?php bloginfo('url'); ?>/wordpress">wordPress</a></dd>
            <dd><a target="_blank" href="<?php bloginfo('url'); ?>/mapeimapei">心跳回忆</a></dd>
        </dl><!--footWidget end-->
		
    	<dl class="footWidget service clx" style=" width: 18.5%;">
			<dt>服务和合作</dt>
			<dd><a target="_blank" href="<?php bloginfo('url'); ?>/about">关于我们</a></dd>
            <dd><a target="_blank" href="<?php bloginfo('url'); ?>/wordpress-serives">WP主题服务</a></dd>
            <dd><a target="_blank" href="<?php bloginfo('url'); ?>/web-developer">前端服务</a></dd>
            <dd><a target="_blank" href="<?php bloginfo('url'); ?>/adsense">广告合作</a></dd>
            <dd><a target="_blank" href="<?php bloginfo('url'); ?>/contribute">投稿</a></dd>
            <dd><a target="_blank" rel="nofollow" href="http://weibo.com/qintag">新浪微博</a></dd>
            <dd><a target="_blank" rel="nofollow" href="http://t.qq.com/qintag">腾讯微博</a></dd>
            <dd><a target="_blank" rel="nofollow" href="http://twitter.com/qintag">Twitter</a></dd>
            <dd><a target="_blank" rel="nofollow" href="http://www.facebook.com/qintag">Facebook</a></dd>
            <dd><a target="_blank" rel="nofollow" href="#">Google+</a></dd><!-- 未编写 -->
        </dl><!--footWidget end-->

    	<dl class="footWidget sitelinks clx">
			<dt>联盟网站</dt>
            <dd><a target="_blank" href="http://blog.ui90.com">june博客</a></dd>
        </dl><!--footWidget end-->

    	<dl class="footWidget themesDemo clx">
			<dt>主题演示</dt>
			<dd><a target="_blank" rel="nofollow" href="http://fisou.qintag.com">飞鱼主题</a></dd>
            <dd><a target="_blank" rel="nofollow" href="http://q1.qintag.com">Q1主题</a></dd>
            <dd><a target="_blank" rel="nofollow" href="http://q6.qintag.com">Q61主题</a></dd>
            <dd><a target="_blank" rel="nofollow" href="http://seo.qintag.com">Seo主题</a></dd>
            <dd><a target="_blank" rel="nofollow" href="http://l1.qintag.com">L1主题</a></dd>
            <dd><a target="_blank" rel="nofollow" href="http://app.qintag.com">app主题</a></dd>
        </dl><!--footWidget end-->
    	<div class="statistics">
			<ul class="statistics_list clx">
                <h2>网站信息</h2>
                <?php qintag_statistics() ?>
            </ul>
        </div><!--statistics end-->
        
        <div class="clear"></div>

        <div class="statement mt20">
            <p>
                &copy 2012 <a target="_blank" href="<?php bloginfo('url'); ?>/"><?php bloginfo('name');?></a> 版权所有 | 
				<!--不要试图修改以下版权信息，否则主题会报错-->		
                <a target="_blank" rel="nofollow" href="http://wordpress.org/">WordPress</a> 强力驱动 | Theme by <a target="_blank" href="http://www.ui90.com/">ui90</a>
				<!--不要试图修改以上版权信息，否则主题会报错-->	
            </p>
            <p>
				<a target="_blank" href="<?php bloginfo('url'); ?>/sitemap.html">网站地图</a> | 
                <a target="_blank" href="<?php bloginfo('url'); ?>/tags">标签云</a>
                <?php if(get_qintag_option('icpbeian') !== '') { ?>
                    &nbsp;&nbsp;| <a target="_blank" rel="nofollow" href="http://www.miibeian.gov.cn/"> <?php echo get_qintag_option('icpbeian'); ?></a>
                <?php } ?>
                <?php if(get_qintag_option('cnzztongji') !== '') { ?>
                     | <?php echo get_qintag_option('cnzztongji'); ?>
                <?php } ?>
            </p>
        </div><!-- statement end -->
    </footer>
	<div id="back_top"><a href="javascript:void(0);">回到顶部</a></div>
	
	<?php if ( !is_home() ){ ?>
		<script src="<?php bloginfo('template_directory'); ?>/js/sidebar-fixed.js"></script>
	<?php } ?>

	<script src="<?php bloginfo('template_directory'); ?>/js/jquery.common.js"></script>

	<script src="http://mat1.gtimg.com/app/openjs/openjs.js#debug=yes&autoboot=no"></script>
	<script type="text/javascript" id="bdshare_js" data="type=tools&amp;uid=137221" ></script>
	<script type="text/javascript" id="bdshell_js"></script>
	<script type="text/javascript">
		//在这里定义bds_config
		var bds_config = {'snsKey':{'tsina':'3787440247','tqq':'801068691'},'bdText':'@qintag'};
		document.getElementById("bdshell_js").src = "http://share.baidu.com/static/js/shell_v2.js?cdnversion=" + new Date().getHours();
	</script>
</div><!-- wrapper end -->
<?php wp_footer(); ?>
</body>
</html>