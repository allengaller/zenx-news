</div>

<div class="clear"></div>

<div class="foot1">

    <div class="footer_top">

	<div id="menu">

		<?php 

			$catNav = '';

			if (function_exists('wp_nav_menu')) {

				$catNav = wp_nav_menu( array( 'theme_location' => 'footer-menu',  'echo' => false, 'fallback_cb' => '' ) );};

			if ($catNav == '') { ?>

				<ul id="cat-nav" class="nav">

					<?php wp_list_pages('depth=1&sort_column=menu_order&title_li='); ?>

				</ul>

		<?php } else echo($catNav); ?>

	</div>

	<?php wp_reset_query();if ( is_home()){ ?><h2 class="blogtitle">

	<a href="<?php echo stripslashes(get_option('swt_link_s')); ?>" title="申请友链">友情链接</a></h2><?php } ?>

        <?php wp_reset_query();if ( !is_home()){ ?><h2 class="blogtitle">

	<a href="<?php bloginfo('home'); ?>/" title="<?php bloginfo('name'); ?>">返回首页</a></h2><?php } ?>

    </div>

</div>

<!-- 页脚 -->

<?php wp_reset_query();if (is_single() || is_page() || is_archive() || is_search() || is_404()) { ?>

<div class="foot">

    <div class="footer_bottom_a">

	Copyright <?php echo comicpress_copyright(); ?> <a href="<?php bloginfo('home'); ?>/"><?php bloginfo('name'); ?></a>&nbsp;&nbsp;保留所有权利.

	&nbsp;&nbsp;Theme <a target="_blank" href="http://www.zuifengyun.com">FengYun</a>

	<?php echo stripslashes(get_option('swt_track_code')); ?><br>

        申明：本站文字除标明出处外皆为作者原创，转载请注明原文链接。

    </div>

</div>

<?php } ?>

<!-- 首页页脚 -->

<?php wp_reset_query();if ( is_home()){ ?>

<div class="foot">

    <div class="link">

	<?php

		if(function_exists('wp_hto_get_links')){

		wp_hot_get_links();

		}else{

		wp_list_bookmarks('title_li=&categorize=0&category=2&orderby=rand&limit=32&show_images=');

		}

	?><li><a href="<?php echo stripslashes(get_option('swt_link_s')); ?>">更多...</a></li>

	<div class="clear"></div>

    </div>

<!-- end: link -->

    <div class="footer_bottom">

	Copyright <?php echo comicpress_copyright(); ?> <a href="<?php bloginfo('home'); ?>/"><?php bloginfo('name'); ?></a>&nbsp;&nbsp;保留所有权利.

	&nbsp;&nbsp;Theme <a target="_blank" href="http://www.zuifengyun.com">FengYun</a>

	<?php echo stripslashes(get_option('swt_track_code')); ?>

    </div>

<?php } ?>

     <div class="clear"></div>

</div>

<!-- 侧边栏滚动 -->

<?php wp_reset_query();if (!is_home()) { ?>

<script type="text/javascript">// <![CDATA[

/* <![CDATA[ */ (new SidebarFollow()).init({ 	element: jQuery('#sidebar-follow'), 	prevElement: jQuery('#random_r'), 	distanceToTop: 10  }); /* ]]> */

// ]]></script>

<?php } ?>

<?php wp_footer(); ?>

</body></html>

<?php if (get_option('swt_bulletin') == '关闭') { ?>

<?php { echo ''; } ?>

<?php } else { include(TEMPLATEPATH . '/includes/bulletin.php'); } ?>