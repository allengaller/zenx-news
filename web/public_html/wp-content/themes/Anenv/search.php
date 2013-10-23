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
<div class="wrapindex clearfix">
<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>
<ul <?php post_class(); ?> id="post-<?php the_ID(); ?>"><li>
<div class="homeleft corner5px mb10 excerpt">
<?php $t1=$post->post_date;$t2=date("Y-m-d H:i:s");$diff=(strtotime($t2)-strtotime($t1))/3600;if($diff<24){echo '<span class="new"></span>';} ?>
<h2><a href="<?php the_permalink() ?>" rel="external" title="详细阅读 <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2><a class="readmor" href="<?php the_permalink() ?>" target="_blank" rel="nofollow" title="阅读<?php the_title_attribute(); ?>全文">+阅读全文</a>
<div class="info">作者：<?php the_author() ?> / 发布：<?php An_time_diff( $time_type = 'post' ); ?> / 分类：<?php the_category(', ') ?> / 围观：<?php if(function_exists('the_views')) { the_views(); } ?> 次+ | <?php comments_popup_link ('抢沙发','1条评论','%条评论'); ?> / <?php edit_post_link('编辑'); ?></div>
<div class="then">         
<div class="thumbnail_box">
<div class="thumbnail">
<a href="<?php the_permalink() ?>" target="_blank">
<img src="<?php echo catch_that_image() ?>" alt="<?php the_title(); ?>" />
</a></div>
</div>
<div class="entry">
<span><?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 300,"..."); ?></span>
</div>
</div>
<div class="clear"></div>
<?php An_tags(); ?>
</div></li></ul>
<?php endwhile; ?>
<?php else: ?>
<h3><center>什么也找不到.<br/>抱歉,您所找的分类里没有文章!</center></h3>
<?php endif; ?> 
<div class="wpagenavi">
<?php if(function_exists('pagenavi')) { pagenavi(6); } ?>
</div>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>