<?php 
/*Template Name: Archives*/
?>
<?php get_header();?>
	<div class="fluidCon">
		<?php while (have_posts()) : the_post(); ?>
			<div class="post_detail" id="post-<?php the_ID(); ?>">
				<h2><?php the_title(); ?></h2>
				<ul class="post_meta clx">
					<li class="author clx">
						<span>作者:<?php the_author_posts_link(); ?></span>
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

					
				</ul><!-- post_meta end -->
				
				<div class="post_content"><!-- 此处广告代码需要优化 -->
					<?php 
						if(get_qintag_option('post_top_ads') !== '') {
							echo "<div class='post_top_ads'>".get_qintag_option('post_top_ads')."</div>";
						}
					?>
					<!-- 文章内容 -->
					<?php the_content(); ?>
					<?php qintag_archives_list(); ?>
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


<script type="text/javascript">
jQuery(document).ready(function($){
     (function(){
         $('#al_expand_collapse,#archives span.al_mon').css({cursor:"pointer"});
         $('#archives span.al_mon').each(function(){
             var num=$(this).next().children('li').size();
             var text=$(this).text();
             $(this).html(text+'<em> ( '+num+' 篇文章 )</em>');
         });
         var $al_post_list=$('#archives ul.al_post_list'),
             $al_post_list_f=$('#archives ul.al_post_list:first');
         $al_post_list.hide(1,function(){
             $al_post_list_f.show();
         });
         $('#archives span.al_mon').click(function(){
             $(this).next().slideToggle(400);
             return false;
         });
         $('#al_expand_collapse').toggle(function(){
             $al_post_list.show();
         },function(){
             $al_post_list.hide();
         });
     })();
 });
</script>





	</div><!-- fluid end  -->
</div><!-- container end -->
<aside id="sidebar">
    <!-- 谷歌自定义搜索 -->
    <?php include('includes/sidebar_search.php'); ?>
    <!--幻灯片-->
    <?php include('includes/featured.php'); ?>
    <!-- 广告 -->
    <div class="sidebarNobg adsArea" id="J_adsArea">
        <p class="title clx">
            <span class="declare">赞助商链接</span>
            <span class="awithus"><a href="<?php bloginfo('url'); ?>/adsense" target="_blank" title="广告合作">广告合作!</a></span>
        </p><!--title end-->
        <div class="adsCode clx">
            <?php 
                if(get_qintag_option('adsCode1') !== '') {
                    echo "<div class='adsCode_box left'>".get_qintag_option('adsCode1')."</div>";
                };
                if(get_qintag_option('adsCode2') !== '') {
                    echo "<div class='adsCode_box right'>".get_qintag_option('adsCode2')."</div>";
                };
                if(get_qintag_option('adsCode3') !== '') {
                    echo "<div class='adsCode_box mt10 left'>".get_qintag_option('adsCode3')."</div>";
                };
                if(get_qintag_option('adsCode4') !== '') {
                    echo "<div class='adsCode_box mt10 right'>".get_qintag_option('adsCode4')."</div>";
                };
            ?>
        </div><!-- adsCode end -->
        <?php 
            if(get_qintag_option('sidebarAds_a') !== '') {
                echo "<div class='sidebarAds mt10' id='J_sidebarAds_a'>".get_qintag_option('sidebarAds_a')."</div>";
            }
        ?>
    </div><!--sidebarNobg end-->
    <!--最给力的文章-->
    <?php include('includes/sticky.php'); ?>
    <div class="sidebarNobg sidebarAds" id="J_box_tui" >
        <!--作品展示-->
        <div class="goodsBox box_tui clx">
            <?php $previous_posts = get_posts('numberposts=1&meta_key=tui'); foreach($previous_posts as $post) : setup_postdata($post); ?>
                <div class="box_pic">
                    <a target="_blank" href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
                        <?php the_post_thumbnail( 'gallery125cc125', array(
                                'alt' => trim(strip_tags( $post->post_title )),
                                'title' => trim(strip_tags( $post->post_title ))
                                )
                        ); ?>
                    </a> 
                </div><!--box_pic end-->
                <div class="box_txt">
                    <h3><a target="_blank" href="<?php the_permalink() ?>"><?php echo cut_str($post->post_title,40); ?></a></h3>
                    <ul class="box_txt_meta clx">
                        <li class="date"><?php the_time('Y-m-d'); ?></li>
                        <li class="views"><?php if(function_exists('the_views')) {the_views();} ?></li>
                        <li class="comments"><?php comments_popup_link('0', '1', '%'); ?></li>
                    </ul>
                </div><!--box_txt end-->
            <?php endforeach; ?>
        </div><!--goodsBox end-->
    </div><!--sidebarNobg end-->

    <!-- 热评 最新 更新日志 -->
    <?php include('includes/tabsCategory.php'); ?>
    <!--站长推荐-->
    <?php include('includes/goods.php'); ?>
    <!--评论-->
    <?php include('includes/gravatarComment.php'); ?>
    <!--电子目录订阅-->
    <?php include('includes/list_qq.php'); ?>
    <!--站长介绍-->
	<div class="sidebarWidget aboutMe">
		<?php include('includes/about_me.php'); ?>
	</div><!--aboutMe end-->

</aside><!-- sidebar end -->
<?php get_footer(); ?>