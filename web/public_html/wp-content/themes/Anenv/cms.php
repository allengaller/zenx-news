<?php get_header(); ?>
<div id="breadcrumbs"> 
<div id="brleft"><?php echo get_option('swt_gg1');?><div class="bdlikebutton"></div></div>
<div id="brrights"><?php include('includes/time.php'); ?></div>
</div>
<div class="wrapindex clearfix">
<div class="homeleft corner5px mb10 slidefix">
<ol id="slide_con">
<?php
$post_num =8; // 设置调用条数
$args = array(
   'post_password' => ”,
   'post_status' => 'publish', // 只选公开的文章.
   'post__not_in' => array($post->ID),//排除当前文章
   'caller_get_posts' => 1, // 排除置頂文章.
   'orderby' => 'comment_count', // 依評論數排序.
   'posts_per_page' => $post_num );
$query_posts = new WP_Query();
$query_posts->query($args);
while( $query_posts->have_posts() ) { $query_posts->the_post(); ?>
<li><a href="<?php the_permalink() ?>" target="_blank">
<img class="thumb" src="<?php echo catch_that_image() ?>" alt="<?php the_title(); ?>" />
</a>
<div class="slcon scon">
<h3 class="mtitle"><a href="<?php the_permalink() ?>" target="_blank" rel="external" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
<p><span><?php the_time('Y年m月d日') ?> / <?php if(function_exists('the_views')) { the_views(); } ?> 人浏览</span></p>
<p><?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 250,"..."); ?></p>
<a class="readmore" href="<?php the_permalink() ?>" target="_blank" rel="nofollow" title="阅读<?php the_title_attribute(); ?>全文">+阅读全文</a>
</div>
</li>
<?php } wp_reset_query();?>
</ol>
</div>
<div class="homeleft corner5px mb10" >
<div class="hotpng"></div>
<div id="imgscroll" class="scroll scrollfix">
<!--<h3>专栏推荐</h3>-->
<?php $posts = query_posts( array('showposts' => get_option('swt_lb_num'),'cat' => get_option('swt_lb_cat')));?>
<?php if( $posts ) : ?>
<?php foreach( $posts as $post ) : setup_postdata( $post ); ?>		  				      
<p><a href="<?php the_permalink() ?>" target="_blank">
<img class="thumb" src="<?php echo catch_that_image() ?>" alt="<?php the_title(); ?>" />
</a></p>
<?php endforeach; ?>
<?php endif; ?> 	
</div>
</div>  
<div class="clear"></div>
<ul <?php post_class(); ?> id="post-<?php the_ID(); ?>">
<?php query_posts( array('showposts' => get_option('swt_blog_num')));?>
<?php while (have_posts()) : the_post(); ?><li>
<div class="homeleft corner5px mb10 excerpt">
<?php $t1=$post->post_date;$t2=date("Y-m-d H:i:s");$diff=(strtotime($t2)-strtotime($t1))/3600;if($diff<24){echo '<span class="new"></span>';} ?>
<h2><a href="<?php the_permalink() ?>" rel="external" title="详细阅读 <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2><a class="readmor" href="<?php the_permalink() ?>" target="_blank" rel="nofollow" title="阅读<?php the_title_attribute(); ?>全文">+阅读全文</a>
<div class="info">作者：<?php the_author() ?> / 发布：<?php An_time_diff( $time_type = 'post' ); ?> / 分类：<?php the_category(', ') ?> / 围观：<?php if(function_exists('the_views')) { the_views(); } ?> 次+ / <?php comments_popup_link ('抢沙发','1条评论','%条评论'); ?> / <?php edit_post_link('编辑'); ?> </div>  
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
</div></li>
<?php endwhile; ?></ul>

<?php $display_categories = explode(',', get_option('swt_cat') ); $i = 1; foreach ($display_categories as $category) { ?>  
<?php query_posts("cat=$category")?>
<div class="homeleft corner5px mb10" >
<div class="mtitle"><span><a rel="nofollow" href="<?php echo get_category_link($category);?>" target="_blank" title="查看更多<?php single_cat_title(); ?>分类下的文章">+more</a></span><a href="<?php echo get_category_link($category);?>" target="_blank" ><?php single_cat_title(); ?></a></div>
<div class="b2"></div>
<div class="column-img clearfix">
<ul>
<?php query_posts( array('showposts' => 2,'cat' => $category,'post__not_in' => $do_not_duplicate));?>
<?php while (have_posts()) : the_post(); ?>
<li>
<div class="thumb">
<a href="<?php the_permalink() ?>" target="_blank">
<img src="<?php echo catch_that_image() ?>" alt="<?php the_title(); ?>" />
</a></div>
<div class="list-info"><div class="list-name"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>" target="_blank" ><?php echo An_cut_str($post->post_title,30); ?></a></div><div class="list-summary"><?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 50,"..."); ?>...</div></div></li>
<?php endwhile; ?></ul></div><!--column-img-->	
<div class="column-list clearfix">
<ul>
<?php query_posts( array('showposts' => get_option('swt_cms_num'),'cat' => $category,'offset' => 2,'post__not_in' => $do_not_duplicate));?>
<?php while (have_posts()) : the_post(); ?>
<li><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>" target="_blank"><?php echo An_cut_str($post->post_title,30); ?>...</a><span><?php the_time('m-d') ?></span></li>
<?php endwhile; ?></ul>
</div><!--column-list-->
</div>
<?php $i++; ?>
<?php } ?>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>