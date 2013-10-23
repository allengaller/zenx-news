<div class="tabs">
	<ul class="clx">
		<li class="sel">热评文章</li>
		<li style="margin-left:-1px">随机文章</li>
	</ul>
</div>
<div class="tabscontent">
	<ul class="tabc">
		<?php some_posts( $orderby = 'comment_count' ); ?>
	</ul>

	<ul class="tabc" style="display:none;">
		<?php some_posts( $orderby = 'rand' );  ?>
	</ul>
</div>
<div class="clear"></div>
<script type="text/javascript">
$(".tabs li").hover(function(){
	if($(this).attr("class")!="sel")$(this).addClass("on")
},function(){
	$(this).removeClass("on")
}).mouseenter(function(){
	$(this).siblings().removeClass()
	$(this).attr("class","sel")
	$("ul.tabc:visible").fadeOut(300,function(){
		$("ul.tabc").eq($(".tabs li.sel").index()).fadeIn(500)
	})
})
</script>