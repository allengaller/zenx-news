<div class="relatedposts">
<h4>您可能还会对这些文章感兴趣！</h4>
<ol>
	<?php
	$post_num = 8; 
	global $post;
	$tmp_post = $post;
	$tags = ''; $i = 0;
	if ( get_the_tags( $post->ID ) ) {
	foreach ( get_the_tags( $post->ID ) as $tag ) $tags .= $tag->name . ',';
	$tags = strtr(rtrim($tags, ','), ' ', '-');
	$myposts = get_posts('numberposts='.$post_num.'&tag='.$tags.'&exclude='.$post->ID);
	foreach($myposts as $post) {
	setup_postdata($post);
	?>
	<li><a href="<?php the_permalink(); ?>"><?php echo cut_str($post->post_title,52); ?></a></li>
	<?php
	$i += 1;
	}
	}
	if ( $i < $post_num ) {
	$post = $tmp_post; setup_postdata($post);
	$cats = ''; $post_num -= $i;
	foreach ( get_the_category( $post->ID ) as $cat ) $cats .= $cat->cat_ID . ',';
	$cats = strtr(rtrim($cats, ','), ' ', '-');
	$myposts = get_posts('numberposts='.$post_num.'&category='.$cats.'&exclude='.$post->ID);
	foreach($myposts as $post) {
	setup_postdata($post);
	?>
	<li><a href="<?php the_permalink(); ?>"><?php echo cut_str($post->post_title,52); ?></a></li>
	<?php
	}
	}
	$post = $tmp_post; setup_postdata($post);
	?>
</ol>
</div>