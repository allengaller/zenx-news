<div class="rssblock">
<script type="text/javascript">	
	var s;
	function showMessage(){
	window.clearTimeout(s);
	document.getElementById("message").style.display="block";
	}
	function hiddenMessage(){
	s=window.setTimeout("hidden();",500);
	}
	function hidden(){
	document.getElementById("message").style.display="none";
	}
</script>

	<h3>订阅本站</h3>
	<span onmouseover="showMessage()" onmouseout="hiddenMessage()"><div id="rssfeed"><a href="<?php echo get_option('swt_rsssub'); ?>" title="订阅本站" class="image"><img src="<?php bloginfo('template_directory'); ?>/images/rsssub.png" /></a></div></span>
	<div id="message" style="display:none" onmouseover="showMessage()" onmouseout="hiddenMessage()">
	<?php echo stripslashes(get_option('swt_rss')); ?>
	</div>
	<div class="box-bottom">
		<i class="lb"></i>
		<i class="rb"></i>
	</div>
	<div class="clear"></div>
</div>