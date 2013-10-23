<div id="sidebar">
<?php if (get_option('swt_125ads') == 'Display') { ?>
<div class="widget" id="widget_125ads"><h3>广告同样精彩</h3>
<?php echo stripslashes(get_option('swt_125adscode')); ?></div>
<div class="clear"></div>
<?php { echo ''; } ?>
<?php } else { } ?>
<div class="widget" id="widget_tab">
<?php include('includes/widget_tab.php'); ?>
</div>
<div class="widget">
<?php include('includes/widget_category.php'); ?>
</div>
<?php if (get_option('swt_adc') == 'Display') { ?>
<div class="widget" id="widget_ada">
<h3>广告同样精彩</h3><center><?php echo stripslashes(get_option('swt_adccode')); ?></center>
</div>
<?php { echo ''; } ?>
<?php } else { } ?>
<div class="widget" id="widget_rcomments">
<?php include('includes/widget_rcomments.php'); ?>
</div>
<div class="widget">
		<?php wp_reset_query();if ( is_home()){ ?>
		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('首页小工具') ) : ?>
		<?php endif; ?>
		<?php } ?>
	</div>
<div class="widget">
		<?php wp_reset_query();if (is_single() || is_page() || is_archive() || is_search() || is_404()) { ?>
		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('其它页面小工具') ) : ?>
		<?php endif; ?>
		<?php } ?>
	</div>
<div class="widget">
		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('全部页面小工具') ) : ?>
		<?php endif; ?>
	</div>
<div class="widget" id="widget_tcomments">
<?php include('includes/widget_tcomments.php'); ?>
</div>
<?php if ( is_home() ) { ?>
<div class="widget" id="widget_links">
<h3>友情链接</h3>
<ul><?php wp_list_bookmarks('orderby=rand&categorize=0&title_li=&limit=20'); ?></ul></div>
<div class="clear"></div>
<?php } ?>
<div class="widget" id="widget_statistics">
<?php include('includes/widget_statistics.php'); ?>
</div>
<div class="widget" id="widget_user">
<?php include('includes/widget_user.php'); ?>
</div>
</div>