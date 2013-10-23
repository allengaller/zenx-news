</div><!-- fluid end  -->
</div><!-- container end -->
<aside id="sidebar">
    <!-- 谷歌自定义搜索 -->
    <?php include('includes/sidebar_search.php'); ?>
    <!--幻灯片-->
    <?php include('includes/featured.php'); ?>
    <!-- 广告 -->
	<?php include('includes/adsense.php'); ?>
    <!--最给力的文章-->
    <?php include('includes/sticky.php'); ?>
    <div class="sidebarNobg sidebarAds" id="J_box_tui" >
        <!--作品展示-->
        <div class="goodsBox box_tui clx">
            <?php $previous_posts = get_posts('numberposts=1&meta_key=tui'); foreach($previous_posts as $post) : setup_postdata($post); ?>
                <div class="box_pic">
                    <a target="_blank" href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
                        <?php the_post_thumbnail( 'gallery125cc125', array(
                                'alt' => trim(strip_tags( $post->post_title )),
                                'title' => trim(strip_tags( $post->post_title ))
                                )
                        ); ?>
                    </a> 
                </div><!--box_pic end-->
                <div class="box_txt">
                    <h3><a target="_blank" href="<?php the_permalink() ?>"><?php echo cut_str($post->post_title,40); ?></a></h3>
                    <ul class="box_txt_meta clx">
                        <li class="date"><?php the_time('Y-m-d'); ?></li>
                        <li class="views"><?php if(function_exists('the_views')) {the_views();} ?></li>
                        <li class="comments"><?php comments_popup_link('0', '1', '%'); ?></li>
                    </ul>
                </div><!--box_txt end-->
            <?php endforeach; ?>
        </div><!--goodsBox end-->
    </div><!--sidebarNobg end-->

    <!-- 热评 最新 更新日志 -->
    <?php include('includes/tabsCategory.php'); ?>
    <!--站长推荐-->
    <?php include('includes/goods.php'); ?>
    <!--评论-->
    <?php include('includes/gravatarComment.php'); ?>
    <!--电子目录订阅-->
    <?php include('includes/list_qq.php'); ?>
    <div class="sidebarTwo clx" id="J_sidebarTwo">
        <div class="area left" style="width:159px;">
            <!--热门标签-->
            <div class="tagsArea">
                <h2>热门标签</h2>
                <?php 
					$html = '<ul class="clx">';
					foreach (get_tags( array('number' => 16, 'orderby' => 'count', 'order' => 'DESC', 'hide_empty' => false) ) as $tag){
						$tag_link = get_tag_link($tag->term_id);
						$html .= "<li><a href='{$tag_link}' title='{$tag->name}'>";
						$html .= "{$tag->name} ({$tag->count})</a></li>";
					}
					$html .= '</ul>';
					echo $html;
                ?>
            </div><!-- tagsArea end -->
            <ul class="area_list clx">
                <h2>文章归档</h2>
                <?php $args = array(
                    'type'            => 'monthly',
                    'limit'           => 12,
                    'show_post_count' => true
                    );
					wp_get_archives( $args ); 
                ?>
            </ul><!-- area_list end -->
            <?php if (is_home()&&!is_paged()) { ?>
                <!--友情链接-->
                <ul class="area_list clx">
                    <h2><a target="_blank" href="<?php bloginfo('url'); ?>/links">友情链接</a></h2>
                    <?php wp_list_bookmarks('title_li=&categorize=&category=&orderby=rand'); ?>
                </ul><!-- area_list end -->
            <?php } ?>
            <!-- 广告 -->
			<?php if ((!is_home()||is_paged())&&(get_qintag_option('sidebarAds_b') !== '')) { ?>
				<?php echo get_qintag_option('sidebarAds_b'); ?>
			<?php } ?>
        </div><!-- area end -->

        <div class="area left" style="width:239px;">
            <!--微博同步-->
            <h2>微博同步</h2>
            <p class="mb10"><em class="weibo_icon left"></em><wb:follow-button uid="1831913170" type="red_2" width="120" height="24" ></wb:follow-button></p>
			<div class="scr_con">
				<div id="dv_scroll">
					<div class="Scroller-Container" id="dv_scroll_text">
						<ul class="weibo">
							<?php 
								$sinarss_uid = get_qintag_option('sinarss_uid'); 
								$sinarss_feed = get_bloginfo('template_directory');
								require_once (ABSPATH . WPINC . '/class-feed.php');
								$feed = new SimplePie();
								$feed->set_feed_url(''.$sinarss_feed.'/includes/sinarss2.php?id=1831913170');
								$feed->set_cache_location($_SERVER['DOCUMENT_ROOT'] . '/wp-content/cache');
								$feed->set_file_class('WP_SimplePie_File');
								$feed->set_cache_duration(1800);
								$feed->init();
								$feed->handle_content_type();
								$items = $feed->get_items(0,20);
								foreach($items as $item) {
									echo '<li><a rel="nofollow" target="_blank" href="'.$item->get_link().'" >'.$item->get_description().'</a></li>';
								}  ?>
						</ul><!--weibo end-->
					</div><!---Scroller-Container end-->
				</div><!--dv_scroll end-->
				<div id="dv_scroll_bar">
					<div class="Scrollbar-Track" id="dv_scroll_track">
						<div class="Scrollbar-Handle">&nbsp;</div>
					</div>
				</div><!--dv_scroll_bar end-->
			</div><!--scr_con end-->

        </div><!--area end-->
    </div><!--sidebarWidget end-->

    <div id="J_tqqWidget">
		<div id="float" class="div1">
			<div class="sidebarWidget aboutMe" style="margin-top:0;">
				<?php include('includes/about_me.php'); ?>
			</div><!--aboutMe end-->
		</div><!--float end-->
	</div><!--J_tqqWidget end-->
</aside><!-- sidebar end -->