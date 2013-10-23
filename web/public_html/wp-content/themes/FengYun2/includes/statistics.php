<h3>网站统计</h3>	
<div class="statistics">
	<div class="box_c">
		<ul>日志：<?php $count_posts = wp_count_posts(); echo $published_posts = $count_posts->publish;?>篇</ul>
		<ul>评论：<?php echo $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->comments");?>条</ul>
		<ul>分类：<?php echo $count_categories = wp_count_terms('category'); ?>个</ul>
		<ul>标签：<?php echo $count_tags = wp_count_terms('post_tag'); ?>个</ul>
		<ul>链接：<?php $link = $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->links WHERE link_visible = 'Y'"); echo $link; ?>个</ul>
		<ul>网站运行：<?php echo floor((time()-strtotime(get_option('swt_builddate')))/86400); ?>天</ul>
		最后更新：<?php $last = $wpdb->get_results("SELECT MAX(post_modified) AS MAX_m FROM $wpdb->posts WHERE (post_type = 'post' OR post_type = 'page') AND (post_status = 'publish' OR post_status = 'private')");$last = date('Y年n月j日', strtotime($last[0]->MAX_m));echo $last; ?>
	</div>
	<div class="clear"></div>
</div>
<div class="box-bottom">
</div>