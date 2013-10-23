<div class="sidebarNobg" id="J_goods">
	<div class="goodsBox">
		<h2 class="left"><span class="tj"></span>站长推荐</h2>
        <div class="BtnCls right">   
            <span class="brandAdvice_nav">
                <span class="goods_prev">&lt;</span>
                <ul class="switchable-nav">
                    <li class="active">1</li>
                    <li>2</li>
                    <li>3</li>
                </ul>
                <font>/3</font>
                <span class="goods_next">&gt;</span>
            </span><!-- brandAdvice_nav end -->
        </div><!-- BtnCls end -->
        <div class="clear"></div>
        <ul class="goods_list">
			<?php $previous_posts = get_posts('numberposts=3&meta_key=tui'); foreach($previous_posts as $post) : setup_postdata($post); ?>
			<li>
            	<div class="pic">
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
				</div><!-- pic end -->
				<div class="txt">
                    <p class="des"><a target="_blank" href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php echo cut_str($post->post_title,26); ?></a></p>
					<p><?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 60,"......"); ?></p>
                    <p class="price">促销价:<span><?php $key="price"; echo get_post_meta($post->ID, $key, true); ?></span></p>
                    <p class="full"><a class="btn" href="<?php the_permalink() ?>" rel="bookmark" ></a></p>
				</div><!-- txt end -->
			</li>
			<?php endforeach; ?>
        </ul><!--goods_list end-->
	</div><!--goodsBox end-->
</div><!--sidebarNobg end-->