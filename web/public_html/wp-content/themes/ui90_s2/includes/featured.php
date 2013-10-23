<div class="featured">
    <div class="featured_box">
        <div class="featured_list">
		<?php $previous_posts = get_posts('numberposts=5&meta_key=tui'); foreach($previous_posts as $post) : setup_postdata($post); ?>
            <div class="slide_content"> 
                <h2><a href="<?php the_permalink(); ?>" target='_blank' title="<?php the_title(); ?>"><?php echo cut_str($post->post_title,40); ?></a></h2>
                <div class="post_thumb">
                    <a target="_blank" href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
                        <?php the_post_thumbnail( 'gallery320cc210', array(
                                'alt' => trim(strip_tags( $post->post_title )),
                                'title' => trim(strip_tags( $post->post_title ))
                                )
                        ); ?>
                    </a>
                </div><!--post_thumb end-->
                
                <div class="post_the">
					<?php if(has_excerpt()){ ?>
                        <?php the_excerpt() ?>
                    <?php } else { ?>
                        <p>
                        <?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 310,"......"); ?>
                        </p>
                    <?php } ?>
                </div><!--post_the end-->
            </div><!-- post_content end -->
		<?php endforeach; ?>
        </div><!-- featured_list end -->
    </div><!-- featured_box end -->  
    <ul class="switchable-nav">
        <li class="active">&bull;</li>
        <li>&bull;</li>
        <li>&bull;</li>
        <li>&bull;</li>
        <li>&bull;</li>
    </ul>
</div><!-- featured end -->