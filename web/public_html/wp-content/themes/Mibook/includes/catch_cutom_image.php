<!-- 如果日志有特色图片 则显示特色图像 -->                                           
<?php if (has_post_thumbnail()){
	$image_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "Full"); ?>
	<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><img src="<?php echo $image_src[0]; ?>" alt="<?php the_title(); ?>" /></a>

<!-- 如果没有特色图片 显示自定义栏目图像 --> 
<?php }else if (get_post_meta($post->ID, 'image', true)) {
	$post_image = get_post_meta($post->ID, 'image', true); ?>
	<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><img src="<?php echo $post_image; ?>" alt="<?php the_title(); ?>" /></a>
 
<!-- 如果前两者都没有则显示内容第一张图像 -->
<?php }else {?>
	<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><img src="<?php echo catch_post_image(); ?>" alt="<?php the_title(); ?>" /></a>
<?php } ?>