<article class="post_entry" id="post-<?php the_ID(); ?>">
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
            <li class="post_thumb">
				<?php if ( has_post_thumbnail() ) { ?>
                    <a target="_blank" href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
                        <?php the_post_thumbnail( 'gallery125cc125', array(
                                'alt' => trim(strip_tags( $post->post_title )),
                                'title' => trim(strip_tags( $post->post_title ))
                                )
                        ); ?>
                    </a>
                <?php } else { ?>
                    <a target="_blank" href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>">
                        <img src="<?php echo get_featcat_image(); ?>" alt="<?php the_title(); ?>" />
                    </a>
                <?php } ?>
            </li>
		</ul><!-- post_meta end -->
	</header>
	<div class="post_content">
		<?php if(has_excerpt()){ ?>
			<?php the_excerpt() ?>
		<?php } else { ?>
			<p>
				<?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 500,"......"); ?>
			</p>
		<?php } ?>
	</div><!-- post_content end -->
	<footer>
		<a target="_blank" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="moreBnt">继续阅读...</a>
	</footer>
</article><!-- post_detail end -->