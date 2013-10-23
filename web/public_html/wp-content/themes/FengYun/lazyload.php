<script type="text/javascript" src="<?php bloginfo('template_directory');?>/js/lazyload.js"></script>
<script type="text/javascript">
	$(function() {          
    	$(".entry_box img,.entry_box_h img,#content img").lazyload({
            effect:"fadeIn",
			failurelimit : 4
          });
    	});
</script>