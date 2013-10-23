<div class="sidebar_search clx">
	<p class="declare">找累了就试着搜一下～</p>
    <ul class="search_triggers clx">
        <li id="tow1" onclick="setContentTab('tow',1,2)" class="current"><a class="g_site" href="javascript:void(0);">谷歌站内</a></li>
        <li id="tow2" onclick="setContentTab('tow',2,2)"><a class="h_site" href="javascript:void(0);">本站</a></li>
    </ul><!--tabbtn end-->   
    <div class="search_panel" id="con_tow_1">
        <form  method="get" id="google_searchform" action="<?php bloginfo('home'); ?>/site-search">
			<div class="googleSearch1">
				<input type="text" value="" name="q" id="J_g_search" class="inputCss1 googleimg" x-webkit-speech="" required="" />
			</div>
            <button class="btn" value="搜索" id="searchsubmit"><span></span></button>
        </form>
	</div><!-- search_panel end -->    
    <div class="search_panel" id="con_tow_2" style="display:none;">
        <form  method="get" id="" action="<?php bloginfo('home'); ?>/">
            <input type="text" value="请输入文章标题 关键词..." name="s" id="search" class="inputCss" x-webkit-speech="" required="" />
            <button class="btn" value="搜索" id="searchsubmit"><span></span></button>
        </form>
    </div><!-- search_panel end -->
</div><!--sidebar_search end-->