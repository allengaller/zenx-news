<div class="related_img">
	<?php
	query_posts(array('orderby' => 'rand', 'showposts' => 4, 'caller_get_posts' => 4));
	if (have_posts()) :
	while (have_posts()) : the_post();?>
	<div class="related_img_box">
		<?php include('thumbnail.php'); ?>
	</div>
	<?php endwhile;endif; ?>
	<?php wp_reset_query();?>
</div>