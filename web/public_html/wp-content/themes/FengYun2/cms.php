<?php include('header_h.php'); ?>
	<!-- end: menu -->
<div id="post">	
<div class="slider_box">
		<?php include (TEMPLATEPATH . '/includes/slider.php'); ?>
		<div class="hot_box">
			<?php include (TEMPLATEPATH . '/includes/hot_n.php'); ?>
			<?php include (TEMPLATEPATH . '/includes/rolling_n.php'); ?>
		</div>
</div>
		<div class="clear12"></div>
	<?php if (get_option('swt_new_p') == '关闭') { ?>
	<?php { echo ''; } ?>
	<?php } else { include(TEMPLATEPATH . '/includes/new_post.php'); } ?>
	<div id="cmsl">
		<?php $display_categories = explode(',', get_option('swt_catl') ); foreach ($display_categories as $category) { ?>
		<?php
			query_posts( array(
				'showposts' => 1,
				'cat' => $category,
				'post__not_in' => $do_not_duplicate
				)
			);
		?>
		<div class="entry_box_h">
			<?php while (have_posts()) : the_post(); ?>
			<div class="box_entry_title_h">
			<span class="cat_name_l"><?php single_cat_title(); ?></span>
				<div class="ico"><?php if (get_option('swt_ico') == '显示') { ?><?php include('includes/cat_ico.php'); ?><?php } else { } ?></div>
					<h3><a href="<?php the_permalink() ?>" rel="bookmark" title="详细阅读 <?php the_title_attribute(); ?>"><?php echo cut_str($post->post_title,40); ?></a></h3>
					<div class="info">
						<span class="date"><?php the_time('Y年m月d日') ?></span>
						<span class="comment"> &#8260; <?php comments_popup_link('暂无评论', '评论数 1', '评论数 %'); ?></span>
						<?php if(function_exists('the_views')) { print ' &#8260; 被围观 '; the_views(); print '+';  } ?>
					</div>
			</div>
			<!-- end: box_entry_title_h -->
			<div class="clear"></div>
			<div class="thumbnail_box_h">
				<?php include('includes/thumbnail.php'); ?>
			</div>
			<div class="cat_box">
				<?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 120,"..."); ?>
			</div>
			<div class="clear"></div>
			<?php endwhile; ?>
			<div class="cat_post_box">
		  		<?php
					query_posts( array(
						'showposts' => get_option('swt_cat_n'),
						'cat' => $category,
						'offset' => 1,
						'post__not_in' => $do_not_duplicate
						)
		 			);
				?>
				<?php while (have_posts()) : the_post(); ?>
				<ul><li>
					<span class="hoem_date"><?php the_time('m/d') ?></span>
					
					<a href="<?php the_permalink() ?>" rel="bookmark" 
					title="
						<?php if (has_excerpt())
						{ ?> 
							<?php the_excerpt() ?>
						<?php
						}
						else{
							echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 190,"...");
						}
						?>">
						<?php echo cut_str($post->post_title,38); ?></a>
					</li></ul>
				<!-- end: cat_post -->
				<?php endwhile; ?>
			</div>
			<!-- end: cat_post_box -->
				<div class="ption">
					<span class="cat_name_c">共有<?php echo wt_get_category_count(); ?>篇文章</span>
					<span class="archive_more"><a href="<?php echo get_category_link($category);?>" rel="bookmark" title="更多<?php single_cat_title(); ?>的文章">更  多</a></span>
				</div>
				<div class="clear"></div>
		</div>
		<!-- end: cat_post_box_h -->
		<div class="cms_box_b">
		</div>
		<?php } ?>
	</div>
	<!-- end: cmsl -->


	<div id="cmsr">
		<?php $display_categories = explode(',', get_option('swt_catr') ); foreach ($display_categories as $category) { ?>
		<?php
			query_posts( array(
				'showposts' => 1,
				'cat' => $category,
				'post__not_in' => $do_not_duplicate
				)
			);
		?>
		<div class="entry_box_h">
			<?php while (have_posts()) : the_post(); ?>
			<div class="box_entry_title_h">
			<span class="cat_name_l"><?php single_cat_title(); ?></span>
				<div class="ico"><?php if (get_option('swt_ico') == '显示') { ?><?php include('includes/cat_ico.php'); ?><?php } else { } ?></div>
					<h3><a href="<?php the_permalink() ?>" rel="bookmark" title="详细阅读 <?php the_title_attribute(); ?>"><?php echo cut_str($post->post_title,40); ?></a></h3>
					<div class="info">
						<span class="date"><?php the_time('Y年m月d日') ?></span>
						<span class="comment"> &#8260; <?php comments_popup_link('暂无评论', '评论数 1', '评论数 %'); ?></span>
						<?php if(function_exists('the_views')) { print ' &#8260; 被围观 '; the_views(); print '+';  } ?>
					</div>
			</div>
			<!-- end: box_entry_title_h -->
			<div class="clear"></div>
			<div class="thumbnail_box_h">
				<?php include('includes/thumbnail.php'); ?>
			</div>
			<div class="cat_box">
				<?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 120,"..."); ?>
			</div>
			<?php endwhile; ?>
			<div class="cat_post_box">
		  		<?php
					query_posts( array(
						'showposts' => get_option('swt_cat_n'),
						'cat' => $category,
						'offset' => 1,
						'post__not_in' => $do_not_duplicate
						)
		 			);
				?>
				<?php while (have_posts()) : the_post(); ?>
				<ul><li>
					<span class="hoem_date"><?php the_time('m/d') ?></span>
					
					<a href="<?php the_permalink() ?>" rel="bookmark" 
					title="
						<?php if (has_excerpt())
						{ ?> 
							<?php the_excerpt() ?>
						<?php
						}
						else{
							echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 190,"...");
						}
						?>">
						<?php echo cut_str($post->post_title,38); ?></a>
					</li></ul>
				<!-- end: cat_post -->
				<?php endwhile; ?>
			</div>
			<!-- end: cat_post_box -->
				<div class="ption">
					<span class="cat_name_c">共有<?php echo wt_get_category_count(); ?>篇文章</span>
					<span class="archive_more"><a href="<?php echo get_category_link($category);?>" rel="bookmark" title="更多<?php single_cat_title(); ?>的文章">更  多</a></span>
				</div>
				<div class="clear"></div>
		</div>
		<!-- end: cat_post_box_h -->
		<div class="cms_box_b">
		</div>
		<?php } ?>
	</div>
	<!-- end: cmsr -->
</div>
<!-- end: post -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>