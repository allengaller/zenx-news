<div class="clear"></div>
<?php 
	if(get_qintag_option('footer_ads') !== '') {
		echo "<div class='footer_ads mt20 pl5'>".get_qintag_option('footer_ads')."</div>";
	}
?>
</div><!-- container end -->
<div id="footer">
    <div class="footerbar">
        <div class="center">
            <span class="left">
                &copy 2013 <a target="_blank" href="<?php bloginfo('url'); ?>/"><?php bloginfo('name');?></a> 版权所有 | <a target="_blank" href="http://wordpress.org/">WordPress</a> 强力驱动<a class="hidden" target="_blank" href="http://blog.ui90.com/">wordpress主题</a> | Theme by <a target="_blank" href="http://www.ui90.com/">ui90</a>
			</span>
            <span class="text right">
				<a target="_blank" href="<?php bloginfo('url'); ?>/guestbook">留言板</a> | 
                <a target="_blank" href="<?php bloginfo('url'); ?>/sitemap_baidu.xml">百度地图</a>
				<?php if(get_qintag_option('icpbeian') == '') { ?>
					<?php { /* nothing */ } ?>
				<?php } else { ?>
					| <a target="_blank" rel="nofollow" href="http://www.miibeian.gov.cn/"> <?php echo get_qintag_option('icpbeian'); ?></a>
				<?php } ?>
				<?php if(get_qintag_option('cnzztongji') == '') { ?>
					<?php { /* nothing */ } ?>
				<?php } else { ?>
					 | <?php echo get_qintag_option('cnzztongji'); ?>
				<?php } ?>
            </span>
        </div><!-- center end-->
    </div><!-- footerbar end-->
</div><!-- footer end -->
<?php if(get_qintag_option('floating_adsense') == '') { ?>
	<?php { /* nothing */ } ?>
<?php } else { ?>
	<?php echo get_qintag_option('floating_adsense'); ?>
<?php } ?>
<div id="back_top"></div><!-- 回到顶部 -->
</div><!-- wrapper end -->
<?php if ( is_singular() ){ ?>
	<script src="<?php bloginfo('template_directory'); ?>/js/fancybox/jquery.fancybox.js?v=2.1.4"></script>
	<script src="<?php bloginfo('template_directory'); ?>/js/fancybox/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
<?php } ?>
<script src="<?php bloginfo('template_directory'); ?>/js/jquery.ui90.js"></script>
<script src="http://mat1.gtimg.com/app/openjs/openjs.js"></script>
<?php if ( is_singular() ){ ?>
	<script type="text/javascript" id="bdshare_js" data="type=tools&amp;uid=137221" ></script>
	<script type="text/javascript" id="bdshell_js"></script>
	<script type="text/javascript">
		/**
		 * 在这里定义bds_config
		 */
		var bds_config = {
			'bdPopTitle':'分享和回报是成正比的',	//'请参考自定义pop窗口标题'
			//'searchPic':'1',	//'0为抓取，1为不抓取，默认为0，目前只针对新浪微博'
			'wbUid':'<?php echo get_qintag_option('sinarss_uid'); ?>',		//'请参考自定义微博 id'
			'snsKey':{'tsina':'3114520278','tqq':'801086969'}		//'请参考自定义分享到平台的appkey'
		}
		document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + Math.ceil(new Date()/3600000)
	</script>
<?php } ?>
<?php wp_footer(); ?>
</body>
</html>