<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php include('includes/seo.php'); ?>
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/style.css" />
<script type="text/javascript" src="//lib.sinaapp.com/js/jquery/1.7.2/jquery.min.js"></script>
<link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/images/favicon.ico" type="image/x-icon"/>
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name'); ?> Atom Feed" href="<?php bloginfo('atom_url'); ?>" />
<?php wp_head(); ?>
<?php if ( is_singular() ){ ?>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/comments-ajax.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/comments.js"></script>
<?php } ?>
<!--[if IE 6]>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/png.js"></script>
<script>DD_belatedPNG.fix('a,#logo,img');</script>
<![endif]-->
</head>
<body>
<div id="ftop">
<div id="ftop_inner">
<h1 id="fblogname"><a href="<?php echo get_option('home'); ?>" title="<?php bloginfo('description'); ?>"><?php bloginfo('name'); ?></a></h1>
<?php An_menu('top_bar'); ?>
<form id="fsearchform" method="get" action="<?php bloginfo('home'); ?>">
<input type="text" name="s" class="field" value="回车站内搜索..." onfocus="if (this.value == '回车站内搜索...') {this.value = '';}" onblur="if (this.value == '') {this.value = '回车站内搜索...'}" />
</form>
<div id="frss"><ul>
<li class="frssfeed"><a href="http://feed.feedsky.com/anenv" target="_blank" class="icon4" title="欢迎订阅<?php bloginfo('name'); ?>"></a></li>
<?php if (get_option('swt_tqq') == 'Display') { ?><li class="tqq"><a href="<?php echo stripslashes(get_option('swt_tqqurl')); ?>" target="_blank" class="icon3" title="我的腾讯微博"></a></li><?php { echo ''; } ?><?php } else { } ?>
<?php if (get_option('swt_tsina') == 'Display') { ?><li class="tsina"><a href="<?php echo stripslashes(get_option('swt_tsinaurl')); ?>" target="_blank" class="icon2" title="我的新浪微博"></a></li><?php { echo ''; } ?><?php } else { } ?>
<?php if (get_option('swt_mailqq') == 'Display') { ?><li class="rssmail"><a href="http://mail.qq.com/cgi-bin/feed?u=<?php bloginfo('rss2_url'); ?>" target="_blank" class="icon1" title="用QQ邮箱阅读空间订阅我的博客"></a></li><?php { echo ''; } ?><?php } else { } ?>
<li class="qq"><a href="http://sighttp.qq.com/authd?IDKEY=a9ffe344d548cc4a60dc40b4440990ceee8c626c3cc694ce" target="_blank" class="icon0" title="点此和我QQ聊天"></a></li></ul></div></div></div>
<div id="toph"></div>
<div class="header clearfix">
<div class="mainnav">
<div class="nav"><?php An_menu('menu'); ?></div></div>
</div>
<div id="wrapmain">
<div class="maincont clearfix">
<?php if (get_option('swt_ada') == 'Display') { ?>
<div id="adt" >
<?php echo stripslashes(get_option('swt_adacode')); ?></div>
<div class="clear"></div>
<?php { echo ''; } ?>
<?php } else { } ?>