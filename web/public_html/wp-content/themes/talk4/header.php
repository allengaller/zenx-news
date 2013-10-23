<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><?php function theme_footer_v() { if (!(function_exists("check_theme_footer") && function_exists("check_theme_header"))) { theme_usage_message(); die; }} ?>
<html xmlns="http://www.w3.org/1999/xhtml">
<html xmlns:wb="http://open.weibo.com/wb">
<html <?php language_attributes(); ?>>
<head>
<meta property="wb:webmaster" content="46df4eb90ffdbd3d" />
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<?php include('includes/seo.php'); ?>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name'); ?> Atom Feed" href="<?php bloginfo('atom_url'); ?>" />
<link rel="Shortcut Icon" href="<?php bloginfo('template_directory');?>/images/favicon.ico" type="image/x-icon" />
<link rel="Bookmark" href="<?php bloginfo('template_directory');?>/images/favicon.ico" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('stylesheet_url' );?>" />
<?php if (is_singular()) { ?>
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/singular.css" />
<?php } ?>
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/comment.css" />
<!--[if lt IE 8]><?php include('includes/ie6tip.php'); ?><![endif]-->
<link rel="stylesheet"  href="<?php bloginfo('template_directory'); ?>/js/fancybox/jquery.fancybox.css?v=2.1.4" media="screen" />
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/js/fancybox/helpers/jquery.fancybox-buttons.css?v=1.0.5" />
<script src="<?php bloginfo('template_directory'); ?>/js/jquery_latest.js"></script>
<!--[if lt IE 9]>
<script src="<?php bloginfo('template_directory'); ?>/js/html5.js" type="text/javascript"></script>
<script src="<?php bloginfo('template_directory'); ?>/js/css3-mediaqueries.js"></script>
<![endif]-->
<script src="<?php bloginfo('template_directory'); ?>/js/jquery.slide-packer.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/js/scrollbar.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/js/fancybox/jquery.fancybox.js?v=2.1.4"></script>
<script src="<?php bloginfo('template_directory'); ?>/js/fancybox/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
<script src="<?php bloginfo('template_directory'); ?>/comments-ajax.js"></script>
<script src="http://tjs.sjs.sinajs.cn/open/api/js/wb.js" type="text/javascript" charset="utf-8"></script>
<?php include('includes/lazyload.php'); ?>
<?php wp_head(); ?>
</head>
<body>
<div id="wrapper">
<header id="topLevel" class="clx">
	<div class="loginArea">
		<a class="login" target="_blank" href="<?php bloginfo('siteurl');?>/wp-login.php">登录</a> | 
		<a href="<?php bloginfo('siteurl');?>/guestbook" target="_blank" title="guestbook">留言板</a> | 
		<a class="red" href="<?php bloginfo('siteurl');?>/archives" target="_blank" title="archives">Archives</a> | 
		<a href="<?php bloginfo('siteurl');?>/sitemap.xml" target="_blank" title="Sitemap">SiteMap</a>
    </div><!--loginArea end-->
    <ul class="network clx">			
        <li class="logo"><a href="<?php bloginfo('siteurl');?>" title="<?php bloginfo('name');?>"><img src="<?php bloginfo('template_directory');?>/images/logo.png" alt="<?php bloginfo('name');?>" /></a></li>
		<li><a target="_blank" rel="nofollow" href="http://fisou.qintag.com">资讯</a></li>
        <li><a target="_blank" rel="nofollow" href="http://q6.qintag.com">互联网</a></li>
        <li><a target="_blank" rel="nofollow" href="http://seo.qintag.com">移动互联网</a></li>
        <li><a target="_blank" href="<?php bloginfo('siteurl');?>/what-i-do">关于</a></li>
    </ul><!--network end-->
    
    <ul class="channels clx">
		<li class="qqun">作者QQ：<i class="red">604314031</i></li>
        <li class="rss"><a target="_blank" href="<?php bloginfo('siteurl');?>/feed"><img src="<?php bloginfo('template_directory');?>/images/rss_24.png" /></a></li>
		<li class="rss"><a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=604314031&site=qq&menu=yes"><img border="0" src="http://wpa.qq.com/pa?p=2:604314031:45" alt="点击同站长聊天" title="点击同站长聊天"></a></li>
        <li class="qq"><iframe width="208" height="20"  src="http://follow.v.t.qq.com/index.php?c=follow&a=quick&name=cwf200300850423&style=3&t=1370353630633&f=1" frameborder="0" marginwidth="0" marginheight="0" scrolling="auto" allowtransparency="true"></iframe></li>
        <li class="sina"><wb:follow-button uid="1831913170" type="red_1" width="67" height="24" ></wb:follow-button></li>
    </ul><!--channels end-->
	<div class="miniNav clx">
		<a class="miniLogo" href="<?php bloginfo('siteurl');?>" title="<?php bloginfo('name');?>"><img src="<?php bloginfo('template_directory');?>/images/logo.png" alt="<?php bloginfo('name');?>" /></a>
		
		<div class="miniSearch">
			<form  method="get" id="google_searchform" action="<?php bloginfo('home'); ?>/">
				<input type="text" value="输入关键词..." name="s" id="J_search" class="inputCss" x-webkit-speech="" required="" />
				<input class="btn" type="submit" id="searchsubmit" value="搜索" />
			</form>
		</div><!--miniSearch end-->
    </div><!--miniNav end-->
</header><!-- toplevel end -->

<div id="container">
	<div class="fluid clx" id="J_fluid">

		<div id="tipBox">
			<div class="poptip" style="+top: -15px; _top: -45px;">
				<span class="poptip-arrow poptip-arrow-top"><em>◆</em><i>◆</i></span>
				欢迎关注talkweb.me。
			</div>
		</div><!--textBox end-->


		<nav class="fluidSidebar">
			<?php 
				if(get_qintag_option('nav_top_ads') !== '') {
					echo "<div class='ads120'>".get_qintag_option('nav_top_ads')."</div>";
				}
			?>
			<?php wp_nav_menu( 
				array(
					'theme_location' => 'primary',
					'container' => false, 
					'menu_id' => 'access', 
					'fallback_cb' => 'revert_wp_menu_category'
					)
			); ?>

			<?php if (!is_singular()&&get_qintag_option('nav_ads') !== '') {
				echo "<div class='nav_ads'>".get_qintag_option('nav_ads')."</div>";
			}?>
		</nav><!-- fluidSidebar end  -->