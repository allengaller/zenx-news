<?php if (has_post_thumbnail()){
	$image_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "Full"); ?>
	<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>" target="_blank" ><img src="<?php echo $image_src[0]; ?>" width="140px" height="100px" /></a>
<?php }else {?>
	<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>" target="_blank" ><img src="<?php echo catch_post_image(); ?>" width="140px" height="100px" /></a>
<?php } ?>