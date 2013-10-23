<?php
/*
Template Name: tags
*/
?>
<?php get_header(); ?>
<div id="content">
    <div class="post_entry">
        <div class="post_detail">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <h2><?php the_title(); ?></h2>
				<div class="titBar">
					<div class="info">
					作者:<?php the_author_posts_link(); ?> | 分类:<?php the_category(', ') ?><?php if(function_exists("the_tags")) : ?><?php the_tags(' | Tag:') ?> | 评论:<?php comments_popup_link('0', '1', '%'); ?><?php if(function_exists('the_views')) { echo" | 浏览:"; the_views(); } ?><?php endif; ?>&nbsp;<?php edit_post_link('[编辑]'); ?>
					</div>
					<div class="fontSize">字号：<span class="small" title="切换到小字体" id="fontSmall">T</span>|<span class="big" title="切换到大字体" id="fontBig">T</span>
					</div>
				</div>
                <div class="post_content">
					<?php 
						if(get_qintag_option('ads300') !== '') {
							echo "<div class='ads'>".get_qintag_option('ads300')."</div>";
						}
					?>
                    <?php the_content(); ?><!-- 文章内容 -->
                    <?php 
						$html = '<ul class="post_tags clx">';
						foreach (get_tags( array('number' => 100, 'orderby' => 'count', 'order' => 'DESC', 'hide_empty' => false) ) as $tag){
							$color = dechex(rand(0,15000000));
							$tag_link = get_tag_link($tag->term_id);
							$html .= "<li><a href='{$tag_link}' title='{$tag->name} ' style='color:#{$color}'>";
							$html .= "{$tag->name} ({$tag->count})</a></li>";
						}
						$html .= '</ul>';
						echo $html;
                    ?>
					<div class="clear"></div>
					<?php 
						if(get_qintag_option('post_bot_ads') !== '') {
							echo "<div class='post_bot_ads mt10'>".get_qintag_option('post_bot_ads')."</div>";
						}
					?>
                </div><!--post_content end-->
			<?php endwhile; endif; ?>
			<?php include ("includes/post_bottom.php"); ?>
        </div><!-- post_detail end -->
		<?php comments_template( '', true ); ?>
    </div><!-- post_entry end -->
</div><!-- content end -->
<?php get_sidebar(); get_footer(); ?>