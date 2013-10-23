<div class="sidebarWidget J_sticky"> 
	<h2 class="mb10"><span class="sticky"></span>最给力的文章</h2>
	<?php $previous_posts = get_posts('numberposts=5&meta_key=geili'); foreach($previous_posts as $post) : setup_postdata($post); ?>
		<div class="sticky_list">
			<h3><a href="<?php the_permalink(); ?>" target='_blank' title="<?php the_title(); ?>"><?php echo cut_str($post->post_title,40); ?></a></h3>
			<p><?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 110,"......"); ?></p>
		</div><!--sticky_list end-->
	<?php endforeach; ?>
</div><!--sidebarWidget end-->