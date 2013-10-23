<div id="top-comments">
	<h3>本月十佳青年</h3>
	<div class="box">
		<div class="box_comment">
			<?php
			$counts = $wpdb->get_results("SELECT COUNT(comment_ID) AS cnt, comment_author, comment_author_url, comment_author_email FROM (SELECT * FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->posts.ID=$wpdb->comments.comment_post_ID) WHERE comment_date > date_sub( NOW(), INTERVAL 2 WEEK ) AND user_id='0' AND comment_author_email != '' AND post_password='' AND comment_approved='1' AND comment_type='') AS tempcmt GROUP BY comment_author_email ORDER BY cnt DESC LIMIT 10");
			foreach ($counts as $count) {
			$c_url = $count->comment_author_url;
			if ($c_url == '') $c_url = '';
			$mostactive .= '<ul><li class="mostactive">' . '<a href="/jump/?url='. $c_url . '" rel="nofollow" target="_blank" title="' . $count->comment_author . ' ('. $count->cnt . '个脚印)">' . get_avatar($count->comment_author_email, 44) . '</a></li></ul>';
			}
			echo $mostactive;
			?>
			<div class="clear"></div>
		</div>
	</div>
	<div class="box-bottom">
	</div>
</div>