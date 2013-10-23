<?php
/*
Template Name: 读者墙
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
		<div class="readers">
			<ul>
			<?php
				$query="SELECT COUNT(comment_ID) AS cnt, comment_author, comment_author_url, comment_author_email FROM (SELECT * FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->posts.ID=$wpdb->comments.comment_post_ID) WHERE comment_date > date_sub( NOW(), INTERVAL 12 MONTH ) AND user_id='0' AND comment_author_email != '' AND post_password='' AND comment_approved='1' AND comment_type='') AS tempcmt GROUP BY comment_author_email ORDER BY cnt DESC LIMIT 300";
				$wall = $wpdb->get_results($query);
				foreach ($wall as $comment)
				{
					if( $comment->comment_author_url )
					$url = $comment->comment_author_url;
					else $url="#";
					$r="rel='external nofollow'";
					$imgsize="32";
					$tmp = "<a target='_blank' href='".$url."' title='".$comment->comment_author." (留下".$comment->cnt."个脚印)'><img width='".$imgsize ."' height='".$imgsize ."' src='http://www.gravatar.com/avatar.php?gravatar_id=".md5( strtolower($comment->comment_author_email) )."&size=".$imgsize ."&d=identicon&r=G' alt='".$comment->comment_author."(留下".$comment->cnt."个脚印)' /></a>";
					$output .= $tmp;
				}
				echo $output ;
			?>
			</ul>
				<div class="clear"></div>
		</div>
	</div>
	<div class="entry_sb_l">
	</div>
	<?php endwhile; ?>
	<?php endif; ?>
<?php get_footer(); ?>