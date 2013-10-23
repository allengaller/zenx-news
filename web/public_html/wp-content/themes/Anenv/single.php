<?php get_header(); ?>
<div id="breadcrumbs"> 
<div id="brleft"><?php An_breadcrunbs(); ?></div>
<div id="brright">
<!-- Baidu Button BEGIN -->
<div id="bdshare" class="bdshare_t bds_tools get-codes-bdshare">
<a class="bds_tsina"></a>
<a class="bds_qzone"></a>
<a class="bds_tqq"></a>
<a class="bds_renren"></a>
<a class="bds_t163"></a>
<a class="bds_fx"></a>
<a class="bds_tqf"></a>
<a class="bds_douban"></a>
<a class="bds_kaixin001"></a>
<a class="bds_bdhome"></a>
<a class="bds_tfh"></a>
<span class="bds_more"></span>
<a class="shareCount"></a>
</div>
<script type="text/javascript" id="bdshare_js" data="type=tools&amp;uid=6628845" ></script>
<script type="text/javascript" id="bdshell_js"></script>
<script type="text/javascript">
var bds_config={"snsKey":{'tsina':'2129764240','tqq':'801331529','t163':'wgkfYbMyuuCHOYaw','tsohu':'zwV2uxA9TKDy7wBc'}}
document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + Math.ceil(new Date()/3600000)
</script>
<!-- Baidu Button END -->
</div>
</div>
<div class="homeleft corner5px mb15">
<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>
<div id="content" class="clearfix">
<div class="post-title">
<h1><?php the_title(); ?></h1>
</div>
<div class="meta_info">作者：<?php the_author() ?> &nbsp; 发布：<?php An_time_diff( $time_type = 'post' ); ?> &nbsp; 围观：<?php if(function_exists('the_views')) { the_views(); } ?> 次+ &nbsp; <?php comments_popup_link ('抢沙发','1人吐槽','%人吐槽'); ?> &nbsp; <?php edit_post_link('编辑', ' [ ', ' ] '); ?> 
</div>
<div class="info-tag"><div class="info-tag-l"><strong>本文标签：</strong><?php An_tags(); ?></div>
<div class="info-tag-r">
<div class="stb_next">
<!-- 前一篇 -->
<?php $prev_post = get_previous_post(); if ($prev_post){ ?>
<a id="stb_btn_prev" href="<?php echo get_permalink( $prev_post->ID ); ?>" title="<?php echo '上一篇: ' ?><?php echo get_the_title( $prev_post->ID ); ?>">prev</a>
<?php } else { ?>
<a id="stb_btn_prev" href="" title="<?php echo '当前为最早发布的文章，木有更早的啦！' ?>"></a>
<?php } ?>
<!-- 下一篇 -->
<?php $next_post = get_next_post(); if ($next_post){ ?>
<a id="stb_btn_next" href="<?php echo get_permalink( $next_post->ID ); ?>" title="<?php echo '下一篇: ' ?><?php echo get_the_title( $next_post->ID ); ?>">next</a>
<?php } else { ?>
<a id="stb_btn_next" href="" title="<?php echo '当前为最新发布的文章，看看其他文章吧，同样精彩哦！' ?>"></a>
<?php } ?>
</div>
<div class="stb_like_btn" id="alipay_btn">
<!--修改下一行的链接地址为你的支付宝收款页面-->
<a href="https://me.alipay.com/anenv" target="_blank" title="捐助作者，与您共勉">.</a>
</div>
<div class="bdlikebutton stb_like_btn">
<div class="bdlikebutton"></div>
</div></div></div>
<div class="clear"></div>
<div class="post-content clearfix">
<?php if (get_option('swt_adz') == 'Display') { ?>
<div id="adr">
<?php echo stripslashes(get_option('swt_adzcode')); ?>
</div>
<?php { echo ''; } ?>
<?php } else { } ?>
<p>
<?php the_content('Read more...'); ?>
</p>
<?php wp_link_pages(array('before' => '<div class="fenye">分页阅读：', 'after' => '', 'next_or_number' => 'next', 'previouspagelink' => '上一页', 'nextpagelink' => "")); ?>   <?php wp_link_pages(array('before' => '', 'after' => '', 'next_or_number' => 'number', 'link_before' =>'<span>', 'link_after'=>'</span>')); ?>   <?php wp_link_pages(array('before' => '', 'after' => '</div>', 'next_or_number' => 'next', 'previouspagelink' => '', 'nextpagelink' => "下一页")); ?>
</br><div class="clear"></div><div class="cut_line"><span>正文部分到此结束</span></div>
<div>      </div>		</div>
		<div class="post_copyright">
<p>本文固定链接: <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_permalink() ?> | <?php bloginfo('name');?></a>&nbsp;|<a href="#" onclick="copy_code('<?php the_permalink() ?>'); return false;"><strong style="color:#666;"> +复制链接 </strong></a></p>
<p>文章转载请注明: <a href="<?php the_permalink() ?>" rel="bookmark" title="本文固定链接 <?php the_permalink() ?>"><?php the_title(); ?> | <?php bloginfo('name');?></a></p>
<?php An_txt_share(); ?>
</div>	
<div id="adb"><?php if (get_option('swt_adb') == 'Display') { ?>
<center><?php echo stripslashes(get_option('swt_adbcode')); ?></center>
<?php { echo ''; } ?>
<?php } else { } ?></div>	
<div class="pre_next">
<?php previous_post_link('〖上一篇文章〗%link') ?><br/>
<?php next_post_link('〖下一篇文章〗%link') ?>
</div>
<div class="post-related">
<?php include('includes/related.php'); ?>
</div>
<div class="comments">
<?php comments_template(); ?>
</div>
</div><!--content-->
<?php endwhile; else: ?>
<?php endif; ?>
	</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>