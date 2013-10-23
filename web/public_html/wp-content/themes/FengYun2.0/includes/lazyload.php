<script type="text/javascript" src="<?php bloginfo('template_directory');?>/js/lazyload.js"></script>
<script type="text/javascript">
	$(function() {          
    	$(".entry_box img,.entry_box_h img,#entry img,.entry_b img").lazyload({
            effect:"fadeIn",
			failurelimit : 30
          });
    	});
</script>