<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes() ?>>
<head>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<?php include('includes/seo.php'); ?>
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/video.css" />
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name'); ?> Atom Feed" href="<?php bloginfo('atom_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/images/favicon.ico" />
<?php if (function_exists('wp_enqueue_script') && function_exists('is_singular')) : ?>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery.min.js" ></script>
<?php wp_head(); ?>
<?php if ( is_singular() ){ ?>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/comments-ajax.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/reply.js"></script>
<?php } ?>
<?php endif; ?>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery.min.js" ></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/custom.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/superfish.js"></script>
<?php include('includes/pirobox_video.php'); ?>
<script type="text/javascript">
// 播放按钮
$(document).ready(function(){
$('.entry_box_s').hover(
	function() {
		$(this).find('.zoom').stop(true,true).fadeIn();
	},
	function() {
		$(this).find('.zoom').stop(true,true).fadeOut();
	}
);
});
</script>
<script type="text/javascript">
$(function () {
$('.thumbnail img,.thumbnail_t img,.box_comment img,#slideshow img,.cat_ico,.cat_name,.r_comments img').hover(
function() {$(this).fadeTo("fast", 0.5);},
function() {$(this).fadeTo("fast", 1);
});
});
</script>
<script type="text/javascript">
// 计算图片数量
$(document).ready(function(){
	var i=$('.cboxElement').size();
	$('#myimg').html('<strong><font color=#000>有: '+i+' 张图片</font></strong>');
})
</script>
<!-- PNG -->
<!--[if lt IE 7]>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/pngfix.js"></script>
<script type="text/javascript">
DD_belatedPNG.fix('.boxCaption,.top_box,.logo,.reply,.imgcat,.zoom a');
</script>
<![endif]-->
<!-- IE6菜单 -->
<script type="text/javascript"><!--//--><![CDATA[//><!--
sfHover = function() {
	if (!document.getElementsByTagName) return false;
	var sfEls = document.getElementById("menu").getElementsByTagName("li");

	for (var i=0; i<sfEls.length; i++) {
		sfEls[i].onmouseover=function() {
			this.className+=" sfhover";
		}
		sfEls[i].onmouseout=function() {
			this.className=this.className.replace(new RegExp(" sfhover\\b"), "");
		}
	}	
	var sfEls = document.getElementById("topnav").getElementsByTagName("li");
	for (var i=0; i<sfEls.length; i++) {
		sfEls[i].onmouseover=function() {
			this.className+=" sfhover";
		}
	}
}
if (window.attachEvent) window.attachEvent("onload", sfHover);
//--><!]]></script>
</head>
<body class="custom-background">
<div class="header clearfix">
<div class="mainbanner">
<div id="header">
		<div class="header_c">
			<?php if (get_option('swt_logo') == '关闭') { ?>
			<h1><a href="<?php echo get_option('home'); ?>/"><?php bloginfo('name'); ?></a><br/><span  class="blog-title"><?php bloginfo('description'); ?></span ></h1>
			<?php { echo ''; } ?>
			<?php } else { include(TEMPLATEPATH . '/includes/logo.php'); } ?>
			<?php include('includes/time.php'); ?>
		</div>
		<div class="clear"></div>
		<!-- end: header_c -->
	</div>
</div>
	<!-- end: header -->
<div id="top">
		<div id='topnav'>
			<div class="left_top ">
				<?php wp_nav_menu( array( 'theme_location' => 'header-menu' ) ); ?> 
			</div>
			<!-- end: left_top --> 
			<div id="searchbar">
				<?php if (get_option('swt_search') == 'google') { ?>
				<?php include('includes/g_search.php'); ?>
				<?php } else { include(TEMPLATEPATH . '/includes/w_search.php'); } ?>
			</div>
			<!-- end: searchbar -->
		</div>
		<!-- end: topnav -->
	</div>
	<!-- end: top -->
</div>
<div id="wrapper">
	<!-- scroll -->
	<?php include('includes/scroll.php'); ?>