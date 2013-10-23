<div id="sidebar">
	<div class="widget">
		<?php wp_reset_query();if ( is_home()){ ?>
                <?php if (get_option('swt_email') == 'Hide') { ?>
		<?php { echo ''; } ?>
		<?php } else { include(TEMPLATEPATH . '/includes/feed_email.php'); } ?>
		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('首页小工具1') ) : ?>
		<?php endif; ?>
		<?php } ?>
	</div>

	<div class="widget">
		<?php wp_reset_query();if (is_single() || is_page() || is_archive() || is_search() || is_404()) { ?>
                <?php if (get_option('swt_email') == 'Hide') { ?>
		<?php { echo ''; } ?>
		<?php } else { include(TEMPLATEPATH . '/includes/feed_email.php'); } ?>
		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('其它页面小工具1') ) : ?>
		<?php endif; ?>
		<?php } ?>
	</div>

	<div class="widget">
		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('全部页面小工具') ) : ?>
		<?php endif; ?>
	</div>

	<?php if (get_option('swt_mimg') == '显示') { ?>
	<?php include('includes/mimg.php'); ?>
	<?php } else { } ?>

	<?php if (get_option('swt_mcat') == '显示') { ?>
	<?php wp_reset_query();if (is_single()) { ?>
		<?php include('includes/mcat.php'); ?>
	<?php } ?>
	<?php } else { } ?>

	<div class="widget">
		<?php wp_reset_query();if ( is_home() ){ ?>
		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('首页小工具2') ) : ?>
		<?php endif; ?>
		<?php } ?>
	</div>

        <?php if (get_option('swt_statistics') == '关闭') { ?>
	<?php { echo ''; } ?>
	<?php } else { include(TEMPLATEPATH . '/includes/statistics.php'); } ?>
	<div class="clear"></div>

	<div class="widget">
           <div id="sidebar-follow">
		<?php wp_reset_query();if (is_single() || is_page() || is_archive() || is_search() || is_404()) { ?>
		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('其它页面小工具2') ) : ?>
		<?php endif; ?>
		<?php } ?>
	   </div>
        </div>
</div>