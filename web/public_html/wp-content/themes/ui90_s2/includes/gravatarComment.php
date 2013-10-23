<?php 
function get_gravatar_recent_comment() { 
	global $wpdb;
	$sql = "SELECT DISTINCT ID, post_title, post_password, comment_ID, comment_post_ID, comment_author, comment_author_email, comment_date_gmt, comment_approved, comment_type,comment_author_url, SUBSTRING(comment_content,1,50) AS com_excerpt FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID = $wpdb->posts.ID) WHERE comment_approved = '1' AND comment_type = '' AND post_password = '' ORDER BY comment_date_gmt DESC LIMIT 6";
	$comments = $wpdb->get_results($sql);
	$output = $pre_HTML;
	$gravatar_status = 'on'; /* off if not using */
	foreach ($comments as $comment) 
	{
		$avatar = get_avatar($comment->comment_author_email, $size='48', $default='' );
	?>
	
	<?php if($gravatar_status == 'on') { ?>
        <li class="clx">
            <a class="clx" href="<?php echo get_permalink($comment->ID); ?>">
                <div class="gra_img">
					<?php echo $avatar; ?>
				</div>
                <div class="gra_con">
                    <p class="author"><?php echo strip_tags($comment->comment_author); ?>:</p>
                    <p class="content"><?php echo cut_str($comment->com_excerpt,32); ?>...</p>
                </div>
            </a>
        </li>
	<?php } ?>
<?php } ?>
<?php } ?>
<div class="sidebar_box">
    <h3>最新评论</h3>
    <ul class="gravatarComment">
    	<?php get_gravatar_recent_comment(); ?>
    </ul>
</div><!--gravatarComment end-->