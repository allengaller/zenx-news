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
    <div id="wrapindex clearfix">
            <div class="homeleft corner5px mb10 excerpt">
                <div class="post-content">
<div id="page_error"><center>
<img src="<?php bloginfo('template_directory');?>/images/error_404.jpg"/>
    <h2>您打开的"<?php echo wcs_error_currentPageURL(); ?>"这个页面不存在！</h2>
    <p><b>糟糕</b> ... 搞砸了，感谢您发现了<?php bloginfo('name')?>的一个设计缺陷，<b>相信<?php bloginfo('name')?></b>...他一直在努力！</p>
    <h2>下一步该怎么做呢？下边整理的 5 条提示，希望可以帮到您：</h2>
        <ol>
            <li>
            返回 <b><a href="javascript:history.back()">上一页</a></b>。
            </li>
            <li>
            回到网站<b><a href="<?php bloginfo('siteurl');?>">首页</a></b>。
            </li>
            <li>
            尝试刷新页面 <b>（按F5）</b>。
            </li>
            <li>
            从顶部导航栏中选择<b>分类菜单</b>进行浏览。
            </li>
            <li>
            自定义搜索或按照页面、分类、页面进行<b>搜索</b>:
            <div class="error_box">
                <span>搜 索:</span>
                    <div class="error_extends">
                        <form style="margin-left: 0; margin-bottom: 5px;">
                        <input type="text" name="s" id="searchbox" value="输入关键字..." onfocus="if (this.value == '输入关键字...') {this.value = '';}" onblur="if (this.value == '') {this.value = '输入关键字...'}" />
                        <input type="submit" id="searchsubmits" value="搜 索"/>
                        </form>
                    </div>
                <div class="clear"></div>
                <span>按页面:</span>
                    <div class="error_extends">
                        <?php echo wcs_error_pulldown_pages(); ?>
                    </div>
                <div class="clear"></div>
                <span>按分类:</span>
                    <div class="error_extends">
                        <?php echo wcs_error_pulldown_categories(); ?>
                    </div>
                <div class="clear"></div>
                <span>按月份:</span>
                    <div class="error_extends">
                        <?php echo wcs_error_pulldown_archives(); ?>
                    </div>
                <div class="clear"></div>
            </div>
            </li>

        </ol>
</center></div>
                    </div>
            </div>
    </div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>