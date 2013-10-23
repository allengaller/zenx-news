<script type="text/javascript" src="<?php bloginfo('template_directory');?>/js/jquery.lazyload.js"></script>
<script type="text/javascript">
jQuery(document).ready(function($){
	$(".fluidCon img").lazyload({
		 placeholder : "http://blog.ui90.com/qt_share/grey.gif",
		 effect      : "fadeIn"
	});
});
</script>