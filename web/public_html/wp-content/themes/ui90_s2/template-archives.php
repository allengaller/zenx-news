<?php /*Template Name: Archives*/
 get_header();
?>
<div id="content">
    <div class="post_entry">
        <div class="post_detail">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <h2><?php the_title(); ?></h2>
				<div class="titBar">
					<div class="info">
					作者:<?php the_author_posts_link(); ?> | 分类:<?php the_category(', ') ?><?php if(function_exists("the_tags")) : ?><?php the_tags(' | Tag:') ?> | 评论:<?php comments_popup_link('0', '1', '%'); ?><?php if(function_exists('the_views')) { echo" | 浏览:"; the_views(); } ?><?php endif; ?>&nbsp;<?php edit_post_link('[编辑]'); ?>
					</div>
					<div class="fontSize">字号：<span class="small" title="切换到小字体" id="fontSmall">T</span>|<span class="big" title="切换到大字体" id="fontBig">T</span>
					</div>
				</div>
                <div class="post_content">
					<?php 
						if(get_qintag_option('ads300') !== '') {
							echo "<div class='ads'>".get_qintag_option('ads300')."</div>";
						}
					?>
                    <?php the_content(); ?><!-- 文章内容 -->
                    <?php qintag_archives_list(); ?>
					<?php 
						if(get_qintag_option('post_bot_ads') !== '') {
							echo "<div class='post_bot_ads mt10'>".get_qintag_option('post_bot_ads')."</div>";
						}
					?>
                </div><!--post_content end-->
			<?php endwhile; endif; ?>
			<?php include ("includes/post_bottom.php"); ?>
        </div><!-- post_detail end -->
		<?php comments_template( '', true ); ?>
    </div><!-- post_entry end -->
</div><!-- content end -->
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
<?php get_sidebar(); get_footer(); ?>