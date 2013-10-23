<?php
/*
Template Name: adsense
*/
?>
<?php get_header(); ?>
	<div class="fluidCon" style="min-height:4100px;">
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

					<div class="ads">
						<p>网站上有一些Google Adsense和百度网盟广告，希望能给博客挣点日常维护的费用，希望大家多多支持。<p>
						<p>此外june博客目前也提供以下几种广告合作方式（不接受赌博、色情、私服等类型网站）:<p>
						<h3>A. 图片广告位</h3>
						<p>站内目前提供以下几种尺寸的图片广告位，最低购买时长为一个月，一次性购买三个月，优惠10%。一次性购买半年，优惠15%。具体价格如下：</p>

						<table width="100%" border="0" cellspacing="0" cellpadding="0">
						<tr class="table_text">
							<td width="25%">位 置</td>
							<td width="25%">显示效果</td>
							<td width="25%">尺 寸(px)</td>
							<td width="25%">价 格(元/月)</td>
						</tr>
						<tr>
							<td>网站头部</td>
							<td>首页及列表页显示</td>
							<td>468*60</td>
							<td>120</td>
						</tr>
						<tr>
							<td>文章页面</td>
							<td>文章页面显示</td>
							<td>336*280/468*60</td>
							<td>150/100</td>
						</tr>
						<tr>
							<td rowspan="2">网站边栏</td>
							<td rowspan="2">全站显示</td>
							<td>200*200</td>
							<td>160</td>
						</tr>
						<tr>
						<td>420*240</td>
						<td>200</td>
						</tr>

						</table>
						<h3>B. 链接购买</h3>
						<p>本站可以使用WordPress的自定义链接，将文章链接定义到您的目标地址，然后置顶显示，目前，首页置顶为99元/月</p>
						<h3>C. 关键词链接</h3>
						<p>本站很多文章在Google和百度都拥有良好的关键词排名。你可以选择购买某个页面中的关键词链接，或是购买全站的某个关键词链接。还可以在你指定的文章内添加和你产品相关的广告，提高关联性。</p>
						<p>除了以上形式外，我们也非常乐意接受其它任何能够能够双赢的合作。</p>
						<p>如需要在本站投放广告，可通过下面方式联系june：<fint class="red">QQ: 604314031</font>。<p>
					</div><!--ads end-->
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