<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><?php function theme_footer_v() { if (!(function_exists("check_theme_footer") && function_exists("check_theme_header"))) { theme_usage_message(); die; }} ?>
<html xmlns="http://www.w3.org/1999/xhtml">
<html xmlns:wb=“http://open.weibo.com/wb”>
<head>
<meta name="baidu-site-verification" content="87e9884d0c857069105c04fe6b47364a"/>
<script src="http://tjs.sjs.sinajs.cn/open/api/js/wb.js" type="text/javascript" charset="utf-8"></script>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo( 'charset' ); ?>" />
<?php include('includes/seo.php'); ?>
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name'); ?> Atom Feed" href="<?php bloginfo('atom_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<link rel="Shortcut Icon" href="<?php bloginfo('template_directory');?>/images/favicon.ico" type="image/x-icon" />
<link rel="Bookmark" href="<?php bloginfo('template_directory');?>/images/favicon.ico" />
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/style.css" />
<!--[if lt IE 7]><?php include('includes/ie6tip.php'); ?><![endif]-->
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/ui90.css" />
<?php if ( is_singular() ){ ?>
	<link rel="stylesheet"  href="<?php bloginfo('template_directory'); ?>/js/fancybox/jquery.fancybox.css?v=2.1.4" media="screen" />
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/js/fancybox/helpers/jquery.fancybox-buttons.css?v=1.0.5" />
<?php } ?>
<script src="<?php bloginfo('template_directory'); ?>/js/jquery_latest.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/js/jquery.slide-packer.js"></script>
<?php if ( is_singular()&&(get_qintag_option('comment_activate') == 'YES') ){ ?>
	<?php include("includes/comment_function.php"); ?>
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/comment.css" />
	<script src="<?php bloginfo('template_directory'); ?>/comments-ajax.js"></script>
<?php } ?>
<script src="http://tjs.sjs.sinajs.cn/open/api/js/wb.js" type="text/javascript" charset="utf-8"></script>
<?php include('includes/lazyload.php'); ?>
<!--[if IE 6]>
    <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/dd_belatedpng.js"></script>
	<script type="text/javascript">
		DD_belatedPNG.fix('#header .logo a,.sidebar_search .btn span,#footer,#footer .footerTop,#footer .footerCon ');
	</script>
<![endif]-->
<?php wp_head(); ?>
</head>
<body>
<div id="wrapper">
<div id="topNav">
    <div class="center">
        <div class="topNav_left left">
		您好，欢迎光临！
		<?php
			global $current_user, $display_name , $user_email;
			get_currentuserinfo();
			if (!($user_ID)) { 
		?>
			请 <a class="login" target="_blank" href="<?php bloginfo('url'); ?>/wp-login.php">登录</a> | <a class="login" target="_blank" href="<?php bloginfo('url'); ?>/wp-login.php?action=register">免费注册</a>
		<?php } ?>
        </div><!-- topNav_left end -->
        <div class="topNav_right right clx">
			<span><a onclick="AddFavorite('<?php bloginfo('siteurl');?>','<?php bloginfo('name');?>')" href="javascript:void(0);" title="收藏本站">收藏本站</a></span>
            <span><a href="<?php bloginfo('url'); ?>/sitemap.html" target="_blank" title="网站地图">网站地图</a></span>
			<span class="weibo">
				<wb:follow-button uid="1831913170" type="red_2" width="136" height="24" ></wb:follow-button>
			</span>
			
        </div><!-- topNav_right end -->
		<script type="text/javascript">
			function AddFavorite(sURL, sTitle){
				try{
					window.external.addFavorite(sURL, sTitle);
				}catch (e){
					try{
						window.sidebar.addPanel(sTitle, sURL, "");
					}catch (e){
						alert("加入收藏失败，请使用Ctrl+D进行添加");
					}
				}
			}
		</script>
    </div><!-- center end -->
</div><!-- topNav end -->
<div id="header">
    <div class="center clx">
        <div class="logo">
            <a href="<?php bloginfo('siteurl');?>" title="<?php bloginfo('name');?>"><?php bloginfo('name');?></a>
        </div><!-- logo end -->
		<?php wp_nav_menu( 
			array(
				'theme_location' => 'primary',
				'container' => false, 
				'menu_id' => 'access', 
				'fallback_cb' => 'revert_wp_menu_category'
				)
		); ?>
    </div><!-- center end -->
</div><!-- header end -->
<div id="container" class="clx">