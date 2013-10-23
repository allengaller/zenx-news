<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<html xmlns:wb="http://open.weibo.com/wb">
<head>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo( 'charset' ); ?>" />
<?php include('includes/seo.php'); ?>
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<link rel="Shortcut Icon" href="<?php bloginfo('template_directory');?>/images/favicon.ico" type="image/x-icon" />
<link rel="Bookmark" href="<?php bloginfo('template_directory');?>/images/favicon.ico" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('stylesheet_url' );?>" />
<script type="text/javascript">     
function countDown(secs,surl){
 var jumpTo = document.getElementById('jumpTo');
 jumpTo.innerHTML=secs;  
 if(--secs>0){     
     setTimeout("countDown("+secs+",'"+surl+"')",1000);     
     }     
 else{       
     location.href=surl;     
     }     
 }     
</script>
<style>
body { background:#fbfbfb; }
</style>
</head>
<body>
<div id="box404">
  <div class="notice">
    <h1>欢迎来到 404 页面 >_<..! </h1>
    <p class="mt5">欢迎您的到来. 您会到达这个页面证明您刚刚点击了失效的链接. 当然, 也可能是我们的设计缺陷... 但与其向您展示一个混乱的, 没有任何说明的 404 出错页面，所以我们创建这个页面可以向您解释究竟出了些什么问题。</p>
    <dl class="list mt5">
      <dt>您现在可以:</dt>
      <dd> 1、给站长<a href="<?php bloginfo('url'); ?>/guestbook" target="_blank" title="留言板">留言</a>； </dd>
      <dd> 2、发送邮件<a href="mailto:qintag@qq.com" >告诉我们</a>； </dd>
      <dd> 3、返回<a href="javascript:history.back()">上一页</a>； </dd>
      <dd> 4、回到网站<a href="<?php bloginfo('siteurl');?>">首页</a>。 </dd>
    </dl>
    <div class="back mt5"> <a href="<?php bloginfo('siteurl');?>"><span id="jumpTo">9</span>秒后返回首页</a> </div>
    <p class="Copyright mt20">
		<span>Copyright© 2007-2012 <a target="_blank" href="<?php bloginfo('siteurl');?>">胖子马</a> . All Rights Reserved.</span>
		<span><script src="http://s15.cnzz.com/stat.php?id=4166389&web_id=4166389" language="JavaScript"></script></span>
	</p>
  </div>
  <!-- notice end  -->
</div>
<!-- box404 end -->
<script type="text/javascript">countDown(9,'<?php bloginfo('siteurl');?>');</script>
</body>
</html>