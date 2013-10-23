<?php
/*
Template Name: GuestBook
*/
?>
<?php get_header(); ?>
	<div class="fluidCon" style="min-height:8000px;">
		<?php while (have_posts()) : the_post(); ?>
            <div class="post_detail" id="post-<?php the_ID(); ?>">
                <h2><?php the_title(); ?></h2>
                <ul class="post_meta clx">
                    <li class="author clx">
                        <span>作者:<?php the_author_posts_link(); ?></span>
                        <span>分类:<?php the_category(', ') ?></span>
                        <span><?php edit_post_link('[编辑]'); ?></span>
                        <span class="share"><?php include('includes/share.php'); ?></span>
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
                    <li class="fontSize">字号：<span class="small" title="切换到小字体" id="fontSmall">T</span>|<span class="big" title="切换到大字体" id="fontBig">T</span>
                    </li>
                </ul><!-- post_meta end -->
                
                <div class="post_content"><!-- 此处广告代码需要优化 -->
                    <?php 
                        if(get_qintag_option('post_top_ads') !== '') {
                            echo "<div class='post_top_ads'>".get_qintag_option('post_top_ads')."</div>";
                        }
                    ?>
                    <!-- 文章内容 -->
                    <?php the_content();?>
					<!-- 读者墙 start -->
					<?php
						$query="SELECT COUNT(comment_ID) AS cnt, comment_author, comment_author_url, comment_author_email FROM (SELECT * FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->posts.ID=$wpdb->comments.comment_post_ID) WHERE comment_date > date_sub( NOW(), INTERVAL 24 MONTH ) AND user_id='0' AND comment_author_email != 'qintag@qq.com' AND post_password='' AND comment_approved='1' AND comment_type='') AS tempcmt GROUP BY comment_author_email ORDER BY cnt DESC LIMIT 36";//大家把管理员的邮箱改成你的,目的是从读者墙里面排除博客作者，最后的数字36是读者的个数，可以按照自己的情况修改！
						$wall = $wpdb->get_results($query);
						$maxNum = $wall[0]->cnt;
						foreach ($wall as $comment)
						{
						$width = round(40 / ($maxNum / $comment->cnt),2);//此处是对应的血条的宽度
						if( $comment->comment_author_url )
						$url = $comment->comment_author_url;
						else $url="#";
						$avatar = get_avatar( $comment->comment_author_email, $size = '44' );
						$tmp = "<li><a target=\"_blank\" href=\"".$comment->comment_author_url."\">".$avatar."<em>".$comment->comment_author."</em> <strong>+".$comment->cnt."</strong></br>".$comment->comment_author_url."</a></li>";
						$output .= $tmp;
						} 
						$output = "<ul class=\"readers-list\">".$output."</ul>"; 
						echo $output ;
						?>
					<!-- 读者墙 end -->
					<?php 
                        if(get_qintag_option('post_bottom_ads') !== '') {
                            echo "<div class='post_bottom_ads'>".get_qintag_option('post_bottom_ads')."</div>";
                        }
                    ?>
                    <div class="clear"></div>
                </div><!-- post_content end -->
                <div class="postAds clx">
                    <p class="tit">Advertising</p>
                    <?php if(get_qintag_option('ads200_a') !== '') { ?>
                
                        <div class="ads200">
                            <?php echo get_qintag_option('ads200_a'); ?>
                        </div>
                        <div class="ads200">
                            <?php echo get_qintag_option('ads200_b'); ?>
                        </div>
                        <div class="ads200">
                            <?php echo get_qintag_option('ads200_c'); ?>
                        </div>
                    <?php } ?>
                </div><!-- postAds end -->
                <div class="postBottom clx"> 
                    <div class="post_sming mb20">
                        <p>如无特别说明，本站文章皆为原创，若要转载，务必请注明以下原文信息:<br />
                        日志标题:<a href="<?php the_permalink(); ?>">《<?php echo cut_str($post->post_title,60); ?>》</a><br /> 
                        日志链接:<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php echo the_permalink(); ?></a><br /> 
                        博客名称:<a href="<?php bloginfo('siteurl');?>" title="<?php bloginfo('name');?>"><?php bloginfo('name');?></a></p>
                    </div><!--post_sming end-->
                    <!-- Baidu Button BEGIN -->
                    <div id="bdshare" class="bdshare_t bds_tools_32 get-codes-bdshare">
                        <a class="bds_qzone"></a>
                        <a class="bds_tsina"></a>
                        <a class="bds_tqq"></a>
                        <a class="bds_renren"></a>
                        <span class="bds_more"></span>
                        <a class="shareCount"></a>
                    </div>
                    <!-- Baidu Button END -->
                    <div class="post_link"><!-- 上下篇 -->
                        <?php previous_post_link('【上一篇】%link') ?><br/>
                        <?php next_post_link('【下一篇】%link') ?>
                    </div>
                </div>
                <div class="postauthor clx">
                    <div class="gravatar">
                        <?php echo get_avatar( get_the_author_email(), '80' ); ?>
                    </div><!--gravatar end-->
                    <div class="about">
                        <p class="post_author"><?php the_author_posts_link(); ?></p>
                        <p class="description">
                            <?php the_author_meta('description'); ?>
                        </p>
                    </div><!--about end-->
                </div><!-- postauthor end -->
            
                <div class="postRelated">
                    <h3>您可能感兴趣的文章:</h3>
                    <ul>
                        <?php related_posts() ?>
                    </ul>
                </div><!-- postRelated end -->
            </div><!-- post_detail end -->
			<div class="commentPost">
				<?php comments_template( '', true ); ?>
			</div>
        <?php endwhile;?>
	</div><!-- fluidCon end  -->
<?php get_sidebar(); get_footer(); ?>