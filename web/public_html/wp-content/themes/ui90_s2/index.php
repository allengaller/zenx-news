<?php if ((!function_exists("check_theme_footer") || !function_exists("check_theme_header"))) { ?><?php { /* nothing */ } ?><?php } else { ?><?php get_header(); ?>
<div id="content">
	<?php if ( is_home()&&($paged < 1)&&(get_qintag_option('featured_activate') == 'YES') ){ ?>
        <?php include('includes/featured.php'); ?>
    <?php } ?>
    <div class="post_entry">
    	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <div class="post_content clx"> 
            <h2><a href="<?php the_permalink(); ?>" target='_blank' title="<?php the_title(); ?>"><?php echo cut_str($post->post_title,40); ?></a></h2>
            <div class="post_thumb">
			<?php if ( has_post_thumbnail() ) { ?>
                <a target="_blank" href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
                    <?php the_post_thumbnail( 'gallery195cc130', array(
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
            </div><!--post_thumb end-->

            <div class="post_the">
				<?php if(has_excerpt()){ ?>
                    <?php the_excerpt() ?>
                <?php } else { ?>
                    <p>
                    <?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 320,"......"); ?>
                    </p>
                <?php } ?>
            </div><!--post_the end-->
            <div class="post_meta">
                <span><?php if(function_exists("the_tags")) : ?><?php the_tags('关键字:') ?></span>
                <span class="index_comments">评论:<?php comments_popup_link('0', '1', '%'); ?></span>
                <span><?php if(function_exists('the_views')) { echo"浏览次数:"; the_views(); } ?><?php endif; ?></span>
                <span><?php edit_post_link('[编辑]'); ?></span>
                <span class="readMore"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">阅读全文...</a></span>
            </div><!-- post_meta end -->
        </div><!-- post_content end -->
 		<?php endwhile; else : ?>
			<p class="center">抱歉!</p>
			<p class="center">无法搜索到与之相匹配的信息。</p>
		<?php endif; ?>
    </div><!-- post_entry end -->
	<div id="pagenavi">
		<?php pagenavi();?>
	</div>
</div><!-- content end -->
<?php get_sidebar(); get_footer(); ?><?php } ?>