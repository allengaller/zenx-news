<?php if ((!function_exists("check_theme_footer") || !function_exists("check_theme_header"))) { ?><?php { /* nothing */ } ?><?php } else { ?><?php get_header(); ?>
<div id="content">
    <div class="post_entry">
		<div class="post_detail">
			<?php while (have_posts()) : the_post(); ?>
                <h2><?php echo cut_str($post->post_title,60); ?></h2>
				<div class="titBar">
					<div class="info">
						作者:<?php the_author_posts_link(); ?> | 分类:<?php the_category(', ') ?><?php if(function_exists("the_tags")) : ?><?php the_tags(' | Tag:') ?> | 评论:<?php comments_popup_link('0', '1', '%'); ?><?php if(function_exists('the_views')) { echo" | 浏览:"; the_views(); } ?><?php endif; ?>&nbsp;<?php edit_post_link('[编辑]'); ?>
					</div>
					<div class="fontSize">
						字号：<span class="small" title="切换到小字体" id="fontSmall">T</span>|<span class="big" title="切换到大字体" id="fontBig">T</span>
					</div>
				</div><!--titBar end-->
                <div class="post_content">
					<?php 
						if(get_qintag_option('ads300') !== '') {
							echo "<div class='ads'>".get_qintag_option('ads300')."</div>";
						}
					?>
                    <?php the_content(); ?><!-- 文章内容 -->
					
					<!-- 翻页 -->
					<?php wp_link_pages(array('before' => '<div class="fenye">分页阅读：', 'after' => '</div>', 'next_or_number' => 'number', 'link_before' =>'<span>', 'link_after'=>'</span>')); ?>
					<?php 
						if(get_qintag_option('post_bot_ads') !== '') {
							echo "<div class='post_bot_ads mt10'>".get_qintag_option('post_bot_ads')."</div>";
						}
					?>
                </div><!--post_content end-->
			<?php endwhile; ?>
			<?php include ("includes/post_bottom.php"); ?>
        </div><!-- post_detail end -->
		<?php comments_template( '', true ); ?>
    </div><!-- post_entry end -->
</div><!-- content end -->
<?php get_sidebar(); get_footer(); ?><?php } ?>