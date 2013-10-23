<?php include('header_video.php'); ?>
<div id="images_content">
	<div id="images_featured">
		<?php $posts = query_posts($query_string . '&orderby=date&showposts=16');?>
		<?php while ( have_posts() ) : the_post(); ?>
		<div class="grid">
			<div class="top_t">
				<?php if ( get_post_meta($post->ID, 'small', true) ) : ?>
				<?php $image = get_post_meta($post->ID, 'small', true); ?>
				<?php $img = get_post_meta($post->ID, 'big', true); ?>
				<a class="example6" href="<?php echo $img; ?>" rel="example6" title="<?php the_title(); ?>"><img src="<?php echo $image; ?>" alt="<?php the_title(); ?>"/></a>
				<?php else: endif;?>
			</div>
			<?php $img = get_post_meta($post->ID, 'big', true); ?>
			<div class="zoom"><a class="example6" href="<?php echo $img; ?>" rel="example6" title="<?php the_title_attribute(); ?>"></a></div>
			<div class="top_box"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">详细内容</a></div>
			<div class="boxCaption">
				<h2><a href="<?php the_permalink(); ?>" title="Permalink to <?php the_title(); ?>"><?php echo cut_str($post->post_title,30); ?></a></h2>
			</div>
		</div>
		<?php endwhile;?>
		<div class="clear"></div>
	</div>
	<div class="navigation"><?php previous_posts_link("上页"); ?> <?php if (function_exists('pagenavi')) { pagenavi(); } ?><?php next_posts_link("下页"); ?></div>
</div>
<?php get_footer(); ?>