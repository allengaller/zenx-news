<div class="top-bar">
<script type="text/javascript">
today=new Date();
var day; var date; var hello;
hour=new Date().getHours()
if(hour < 6)hello='  凌晨好! '
else if(hour < 9)hello=' 早上好! '
else if(hour < 12)hello=' 上午好! '
else if(hour < 14)hello=' 中午好! '
else if(hour < 17)hello=' 下午好! '
else if(hour < 19)hello=' 傍晚好! '
else if(hour < 22)hello=' 晚上好! '
else {hello='夜深了! '}
var webUrl = webUrl;
document.write(' '+hello);
</script>
<?php if($_COOKIE["comment_author_" . COOKIEHASH]!=""): ?>
<?php printf(__('%s Welcome Back! ','misa'), $_COOKIE["comment_author_" . COOKIEHASH]) ?>
<?php endif; ?>
 &nbsp;
<span id=localtime>
<script type="text/javascript">
　today=new Date(); var tdate,tday, x,year; var x = new Array("星期日", "星期一", "星期二", "星期三", "星期四", "星期五","星期六");
　　var MSIE=navigator.userAgent.indexOf("MSIE");
　　if(MSIE != -1)
　　 year =(today.getFullYear());
　　else
　　 year = (today.getYear()+1900);
　　tdate= year+ "年" + (today.getMonth() + 1 ) + "月" + today.getDate() + "日" + " " + x[today.getDay()];
　　document.write(tdate); 
//-->
</script>
</span> &nbsp;
<?php
	global $user_identity,$user_level;
	get_currentuserinfo();
	if ($user_identity) { ?>
	  您已经登录：<?php echo $user_identity; ?>
       &nbsp;
	  <?php wp_register('', ''); ?>
       &nbsp;
      <a href="<?php echo wp_logout_url( get_bloginfo('url') ); ?>" title="">退出</a>
	<?php } ?>
</div><!-- .topbar -->