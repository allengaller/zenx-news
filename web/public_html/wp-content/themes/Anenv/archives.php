<?php
/*
Template Name: Archives(文章归档)
*/
?>
<?php get_header(); ?>
<script type="text/javascript">
		/* <![CDATA[ */
			jQuery(document).ready(function() {
                function setsplicon(c, d) {
                    if (c.html()=='+' || d=='+') {
                        c.html('-');
                        c.removeClass('car-plus');
                        c.addClass('car-minus');
                    } else if( !d || d=='-'){
                        c.html('+');
                        c.removeClass('car-minus');
                        c.addClass('car-plus');
                    }
                }
				jQuery('.car-collapse').find('.car-yearmonth').click(function() {
					jQuery(this).next('ul').slideToggle('fast');
                    setsplicon(jQuery(this).find('.car-toggle-icon'));
				});
				jQuery('.car-collapse').find('.car-toggler').click(function() {
					if ( '展开所有月份' == jQuery(this).text() ) {
						jQuery(this).parent('.car-container').find('.car-monthlisting').show();
						jQuery(this).text('折叠所有月份');
                       setsplicon(jQuery('.car-collapse').find('.car-toggle-icon'), '+');
					}
					else {
						jQuery(this).parent('.car-container').find('.car-monthlisting').hide();
						jQuery(this).text('展开所有月份');
                        setsplicon(jQuery('.car-collapse').find('.car-toggle-icon'), '-');
					}
					return false;
				});
			});
		/* ]]> */
</script>
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
            <div class="homeleft corner5px mb10 excerpt">
                <div class="post-content">
<h2 style="color:#f00">文章归档</h2>
<p><strong><?php bloginfo('name'); ?></strong>目前共有文章： <?php echo $hacklog_archives->PostCount();?>篇</p>
<?php echo $hacklog_archives->PostList();?>
                    </div>
            </div>
            <?php endwhile; ?>
        <?php endif; ?>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>