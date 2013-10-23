<h3>最新评论</h3>
<div class="rcomments-content">
<ul>
<?php
$limit_num = '9'; //这里定义显示的评论数量
global $wpdb;
$sql = "SELECT DISTINCT ID, post_title, post_password, comment_ID, comment_post_ID, comment_author, comment_date_gmt, comment_approved, comment_type,comment_author_url,comment_author_email, SUBSTRING(comment_content,1,36) AS com_excerpt FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID = $wpdb->posts.ID) WHERE comment_approved = '1' AND comment_type = '' AND post_password = '' AND user_id='0' ORDER BY comment_date_gmt DESC LIMIT $limit_num";
$comments = $wpdb->get_results($sql);
$output = $pre_HTML;
foreach ($comments as $comment) {$output .= "\n<li><b>".get_avatar( $comment, 38 )." <a href=\"" . get_permalink($comment->ID) ."#comment-" . $comment->comment_ID . "\" title=\"发表在： " .$comment->post_title . "\">" .strip_tags($comment->comment_author)."：<br />". strip_tags($comment->com_excerpt)."</a></b></li>";}
$output .= $post_HTML;
$output = convert_smilies($output);
echo $output;
?>
</ul>
</div>