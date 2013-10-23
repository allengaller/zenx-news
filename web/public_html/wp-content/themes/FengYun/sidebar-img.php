<div id="sidebar">
	<?php wp_reset_query();if (is_single() || is_page() || is_archive() || is_search()) { ?>
	<?php if (get_option('swt_tab') == 'Hide') { ?>
	<?php { echo ''; } ?>
	<?php } else { include(TEMPLATEPATH . '/includes/tab.php'); } ?>
	<?php } ?>
	<div class="widget">
		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('相册、视频和公告模版小工具') ) : ?>
		<?php endif; ?>
	</div>
	<div class="clear"></div>
</div>