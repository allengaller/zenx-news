<?php
/*
Template Name: 近期留言
*/
?>
<?php get_header(); ?>
	<?php if (have_posts()) : ?><?php while (have_posts()) : the_post(); ?>	
	<div id="map_box">
		<div id="map_l">
			<div class="browse">现在位置： <a title="返回首页" href="<?php echo get_settings('Home'); ?>/">首页</a> &gt; <?php the_title(); ?></div>
		</div>
		<div id="map_r">
			<div id="feed"><a href="<?php bloginfo('rss2_url'); ?>" title="RSS">RSS</a></div>
		</div>
	</div>
	<div class="clear"></div>
	<div class="entry_box_s_l">
		<div class="message">
			<ul>
				<?php
					global $wpdb;
					$sql = "SELECT DISTINCT ID, post_title, post_password, comment_ID, comment_post_ID, comment_author, comment_date_gmt, comment_approved, comment_type,comment_author_url,comment_author_email, SUBSTRING(comment_content,1,72) AS com_excerpt FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID = $wpdb->posts.ID) WHERE comment_approved = '1' AND comment_type = '' AND post_password = '' AND user_id='0' ORDER BY comment_date_gmt DESC LIMIT 30";
					$comments = $wpdb->get_results($sql);
					$output = $pre_HTML;
					foreach ($comments as $comment) {$output .= "\n<li>".get_avatar(get_comment_author_email(), 32).strip_tags($comment->comment_author).":<br />" . " <a href=\"" . get_permalink($comment->ID) ."#comment-" . $comment->comment_ID . "\" title=\"发表在： " .$comment->post_title . "\">" . strip_tags($comment->com_excerpt)."</a></li>";}
					$output .= $post_HTML;
					echo $output;
				?> 
			</ul>
		</div>
	</div>
	<div class="entry_sb_l">
	</div>
	<?php endwhile; ?>
	<?php endif; ?>
<?php get_footer(); ?>