<article class="post_detail" id="post-<?php the_ID(); ?>">
	<header>
		<h2><a href="<?php the_permalink(); ?>" target='_blank' title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
		<ul class="post_meta clx">
			<li class="author clx">
            	<span>作者:<?php the_author_posts_link(); ?></span>
                <span>分类:<?php the_category(', ') ?></span>
                <span><?php edit_post_link('[编辑]'); ?></span>
            </li>
			<li class="date"><?php the_time('Y-m-d'); ?></li>
			<li class="tags">
				<?php if(function_exists("the_tags")) : ?>&nbsp;<?php the_tags('') ?>
			</li>
			<li class="views">
				<?php if(function_exists('the_views')) {the_views();} ?><?php endif; ?>
			</li>
			<li class="comments">
            	<?php comments_popup_link('0', '1', '%'); ?>
            </li>
		</ul><!-- post_meta end -->
	</header>
	<div class="post_content">
		<?php the_content(); ?><!-- 文章内容 -->
	</div><!-- post_content end -->
	<footer>
		<a target="_blank" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="moreBnt">继续阅读...</a>
	</footer>
</article><!-- post_detail end -->