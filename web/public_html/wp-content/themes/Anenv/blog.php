<?php get_header(); ?>
<div id="breadcrumbs"> 
<div id="brleft"><?php echo get_option('swt_gg1');?></div>
<div id="brright"><?php include('includes/time.php'); ?></div>
</div>
<div class="wrapindex clearfix">
<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>
<ul <?php post_class(); ?> id="post-<?php the_ID(); ?>"><li>
<div class="homeleft corner5px mb10 excerpt">
<?php $t1=$post->post_date;$t2=date("Y-m-d");$diff=(strtotime($t2)-strtotime($t1))/3600;if($diff<24){echo '<span class="new"></span>';} ?>
<?php if(is_sticky()) : ?>
<div class="post-<?php the_ID(); ?>">
<h2><a href="<?php the_permalink() ?>" rel="external" title="详细阅读 <?php the_title_attribute(); ?>"><?php echo '<img src="'.get_bloginfo('template_directory').'/images/sticky.gif" alt="" /> ';the_title(); ?></a></h2>
</div>
<?php else : ?>
<h2><a href="<?php the_permalink() ?>" rel="external" title="详细阅读 <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2><a class="readmor" href="<?php the_permalink() ?>" target="_blank" rel="nofollow" title="阅读<?php the_title_attribute(); ?>全文">+阅读全文</a>
<div class="info">作者：<?php the_author() ?> / 发布：<?php An_time_diff( $time_type = 'post' ); ?> / 分类：<?php the_category(', ') ?> / 围观：<?php if(function_exists('the_views')) { the_views(); } ?> 次+ / <?php comments_popup_link ('抢沙发','1条评论','%条评论'); ?> / <?php edit_post_link('编辑'); ?></div>           
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
<?php endif; ?>
</div></li></ul>
<?php endwhile; ?>
<?php endif; ?>  
<div class="wpagenavi">
<?php if(function_exists('pagenavi')) { pagenavi(6); } ?>
</div>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>