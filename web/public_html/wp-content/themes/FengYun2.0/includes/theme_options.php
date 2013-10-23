<?php
$themename = "FengYun 2.0";
$shortname = "swt";
$categories	= get_categories('hide_empty=0&orderby=name');
$wp_cats = array();
foreach	($categories as	$category_list ) {
	   $wp_cats[$category_list->cat_ID]	= $category_list->cat_name;
}
//Stylesheets Reader $alt_stylesheet_path = TEMPLATEPATH	. '/styles/';
$alt_stylesheets = array();
if ( is_dir($alt_stylesheet_path) )	{
	if ($alt_stylesheet_dir	= opendir($alt_stylesheet_path)	) {
		while (	($alt_stylesheet_file =	readdir($alt_stylesheet_dir)) !== false	) {
			if(stristr($alt_stylesheet_file, ".css") !== false)	{
				$alt_stylesheets[] = $alt_stylesheet_file;
			}
		}
	}
}


$number_entries	= array("选择数量:","1","2","3","4","5","6","7","8","9","10", "12","14", "16", "18", "20" );
$options = array (
array( "name" => $themename." Options",
	   "type" => "title"),


//首页布局设置开始
	array( "name" => "首页布局设置",
		   "type" => "section"),
	array( "type" => "open"),


	array(	"name" => "选择首页布局",
			"desc" => "默认CMS布局",
			"id" =>	$shortname."_home",
			"type" => "select",
			"std" => "BLOG",
			"options" => array("CMS", "BLOG")),


//CMS布局首页设置


	array( "type" => "close"),
	array( "name" => "CMS布局设置",
		   "type" => "section"),
	array( "type" => "open"),


	array(	"name" => "首页左侧分类ID设置",
			"desc" => "输入分类ID，显示更多分类，请用英文逗号＂,＂隔开",
			"id" =>	$shortname."_catl",
			"type" => "text",
			"std" => "1,2"),


	array(	"name" => "首页右侧分类ID设置",
			"desc" => "输入分类ID,显示更多分类，请用英文逗号＂,＂隔开",
			"id" =>	$shortname."_catr",
			"type" => "text",
			"std" => "3,4"),


	array(	"name" => "分类列表显示的篇数",
			"desc" => "默认显示4篇",
			"id" =>	$shortname."_cat_n",
			"type" => "text",
			"std" => "4"),


	array(	"name" => "输入首页滚动新闻分类ID",
			"desc" => "多个ID用英文逗号＂,＂隔开",
			"id" =>	$shortname."_roll",
			"type" => "text",
			"std" => "1,2,3"),


	array(	"name" => "滚动新闻篇数",
			"desc" => "默认20篇",
			"id" =>	$shortname."_roll_n",
			"type" => "text",
			"std" => "20"),


	array(	"name" => "最新日志",
			"desc" => "默认显示",
			"id" =>	$shortname."_new_p",
			"type" => "select",
			"std" => "关闭",
			"options" => array("显示", "关闭")),


	array(	"name" => "显示的数量",
			"desc" => "默认显示1篇",
			"id" =>	$shortname."_new_post",
			"std" => "6",
			"type" => "select",
			"options" => $number_entries),


	array(	"name" => "输入最新文章排除的分类ID",
			"desc" => "比如：-1,-2,-3<br/>多个ID用英文逗号隔开",
			"id" =>	$shortname."_new_exclude",
			"type" => "text",
			"std" => ""),


//侧边推荐栏目设置开始


	array( "type" => "close"),
	array( "name" => "侧边推荐栏目设置",
		   "type" => "section"),
	array( "type" => "open"),


	array(	"name" => "输入推荐栏目分类ID",
			"desc" => "输入分类ID，显示更多的分类请用英文逗号＂,＂把ID号隔开",
			"id" =>	$shortname."_cat_h",
			"type" => "text",
			"std" => "1,2,3,4"),


//侧边推荐文章设置


	array( "type" => "close"),
	array( "name" => "侧边推荐文章设置",
		   "type" => "section"),
	array( "type" => "open"),


	array(	"name" => "输入显示的分类ID",
			"desc" => "多个ID用英文逗号＂,＂隔开",
			"id" =>	$shortname."_s_cat",
			"type" => "text",
			"std" => "1,2,3"),


	array(	"name" => "输入显示的篇数",
			"desc" => "默认20篇",
			"id" =>	$shortname."_s_cat_n",
			"type" => "text",
			"std" => "20"),


//各功能模块控制


	array( "type" => "close"),
	array( "name" => "综合功能设置",
		   "type" => "section"),
	array( "type" => "open"),


	array(	"name" => "是否显示LOGO",
			"desc" => "默认显示",
			"id" =>	$shortname."_logo",
			"type" => "select",
			"std" => "关闭",
			"options" => array("显示", "关闭")),


	array(	"name" => "特色图片功能",
			"desc" => "默认闭关。开启后，本地上传图片，会自动生成三张裁剪后的缩略图，选择作为特色图像，主题自动调用裁剪后的缩略图",
			"id" =>	$shortname."_cut_img",
			"type" => "select",
			"std" => "开启",
			"options" => array("关闭", "开启")),




	array(	"name" => "侧边最新文章排除的分类ID",
			"desc" => "比如：-1,-2,-3<br/>多个ID用英文逗号隔开",
			"id" =>	$shortname."_newr_exclude",
			"type" => "text",
			"std" => ""),




	array(	"name" => "暗箱放大特效",
			"desc" => "默认开启",
			"id" =>	$shortname."_pirobox",
			"type" => "select",
			"std" => "关闭",
			"options" => array("开启", "关闭")),


	array(	"name" => "彩色标签云",
			"desc" => "默认显示",
			"id" =>	$shortname."_cumulus",
			"type" => "select",
			"std" => "关闭",
			"options" => array("显示", "关闭")),


	array(	"name" => "分类图标",
			"desc" => "默认不显示",
			"id" =>	$shortname."_ico",
			"type" => "select",
			"std" => "显示",
			"options" => array("关闭", "显示")),


	array(	"name" => "正文底部相关文章",
			"desc" => "默认显示",
			"id" =>	$shortname."_related",
			"type" => "select",
			"std" => "关闭",
			"options" => array("显示", "关闭")),


	array(	"name" => "侧边同分类最新文章",
			"desc" => "默认闭关",
			"id" =>	$shortname."_mcat",
			"type" => "select",
			"std" => "显示",
			"options" => array("关闭", "显示")),


	array(	"name" => "同分类最新文章显示篇数",
			"desc" => "默认显示5篇",
			"id" =>	$shortname."_mcat_n",
			"std" => "5",
			 "type"	=> "text",
			"options" => $number_entries),


	array(	"name" => "输入从侧边固定分类排除的分类ID",
			"desc" => "比如：-1,-2,-3多个ID用英文逗号＂,＂隔开",
			"id" =>	$shortname."_cat_exclude",
			"type" => "text",
			"std" => ""),


	array(	"name" => "侧边本月十佳读者",
			"desc" => "默认关闭",
			"id" =>	$shortname."_wallreaders",
			"type" => "select",
			"std" => "显示",
			"options" => array("关闭", "显示")),


	array(	"name" => "侧边网站统计",
			"desc" => "默认显示",
			"id" =>	$shortname."_statistics",
			"type" => "select",
			"std" => "关闭",
			"options" => array("显示", "关闭")),


	array(	"name" => "建站日期",
			"desc" => "日期格式：2008-02-01",
			"id" =>	$shortname."_builddate",
			"type" => "text",
			"std" => "2008-02-01"),


	array(	"name" => "是否显示表情",
			"desc" => "默认显示",
			"id" =>	$shortname."_smiley",
			"type" => "select",
			"std" => "关闭",
			"options" => array("显示", "关闭")),


	array("name" =>	"全部链接",
			"desc" => "输入友情链接页面地址",
			"id" =>	$shortname."_link_s",
			"type" => "text",
			"std" => "输入你的友情链接页面地址"),


	   array("name"	=> "输入你的商铺地址",
			"desc" => "用于我的商铺独立模版",
			"id" =>	$shortname."_shops",
			"type" => "text",
			"std" => "输入你的商铺地址"),


//SEO设置


	array( "type" => "close"),
	array( "name" => "网站SEO设置及流量统计",
	   "type" => "section"),
	array( "type" => "open"),


	array(	"name" => "首页描述（Description）",
			"desc" => "",
			"id" =>	$shortname."_description",
			"type" => "textarea",
			"std" => "输入你的网站描述，一般不超过200个字符"),


	array(	"name" => "首页关键词（KeyWords）",
			"desc" => "",
			"id" =>	$shortname."_keywords",
			"type" => "textarea",
			"std" => "输入你的网站关键字，一般不超过100个字符"),


	array("name" =>	"流量统计代码",
			"desc" => "",
			"id" =>	$shortname."_track_code",
			"type" => "textarea",
			"std" => ""),

//公告设置
    array( "type" => "close"),
	array( "name" => "公告设置",
			"type" => "section"),
	array( "type" => "open"),

	array(  "name" => "是否开启侧边栏公告",
			"desc" => "默认开启",
            "id" => $shortname."_gg",
            "type" => "select",
            "std" => "Hide",
            "options" => array("Display", "Hide")),

	array(	"name" => "输入公告内容",
            "desc" => "支持html代码，可用&lt;br/&gt;换行",
            "id" => $shortname."_ggao",
            "type" => "textarea",
            "std" => "使用主题有任何问题请到醉风云博客搜索相关教程或在醉风云博客留言板留言，可加Q群279792128交流"),


//微博及订阅设置
    array( "type" => "close"),
	array( "name" => "微博及订阅设置",
			"type" => "section"),
	array( "type" => "open"),

       array("name" => "输入QQ号",
            "desc" => "",
            "id" => $shortname."_qq",
            "type" => "text",
            "std" => "273250950"),

       array("name" => "输入邮箱地址",
            "desc" => "",
            "id" => $shortname."_email",
            "type" => "text",
            "std" => "http://www.zuifengyun.com/jump/?url=http://mail.qq.com/cgi-bin/qm_share?t=qm_mailme&email=ekhNSUhPSkNPSjoLC1QZFRc"),

	   array("name" => "输入腾讯微博地址(包含http://)",
            "desc" => "",
            "id" => $shortname."_qqmblog",
            "type" => "text",
            "std" => "http://www.zuifengyun.com/jump/?url=http://t.qq.com/tianshide-ni"),

       array("name" => "输入新浪微博地址(包含http://)",
            "desc" => "",
            "id" => $shortname."_sinamblog",
            "type" => "text",
            "std" => "http://www.zuifengyun.com/jump/?url=http://weibo.com/520huishao"),

       array("name" => "输入腾讯邮件订阅ID",
            "desc" => "",
            "id" => $shortname."_emailid",
            "type" => "text",
            "std" => "da5aefb0325d18729a2b2dffca28413a7e0650dbc78b315a"),

       array("name" => "输入Feed地址(包含http://)",
            "desc" => "",
            "id" => $shortname."_rsssub",
            "type" => "text",
            "std" => "http://www.zuifengyun.com/rss-2/"),

       array("name" => "输入RSS订阅提示语",
            "desc" => "",
            "id" => $shortname."_rss",
            "type" => "textarea",
            "std" => "Hi! 使用主题有任何问题请到（http://www.zuifengyun.com/tag/fengyun%E4%B8%BB%E9%A2%98）查看相关教程或在醉风云博客留言板留言，可加Q群279792128交流O(∩_∩)O~"),


//"google自定义搜索


	array( "type" => "close"),
	array( "name" => "搜索设置",
			"type" => "section"),
	array( "type" => "open"),


	array(	"name" => "选择搜索方式",
			"desc" => "默认WP程序自带",
			"id" =>	$shortname."_search",
			"type" => "select",
			"std" => "google",
			"options" => array("wp", "google")),


	array(	"name" => "输入你的Google搜索结果页面链接",
			"desc" => "",
			"id" =>	$shortname."_search_link",
			"type" => "text",
			"std" => "http://www.zuifengyun.com/search"),


	array(	"name" => "输入你的Google自定义搜索ID",
			"desc" => "",
			"id" =>	$shortname."_search_ID",
			"type" => "text",
			"std" => "001224030148024446860%3Aeojisabndjs"),


	array( "type" => "close"),
	array( "name" => "广告设置",
			"type" => "section"),
	array( "type" => "open"),


	array(	"name" => "是否显示首页广告",
			"desc" => "默认显示",
			"id" =>	$shortname."_adh",
			"type" => "select",
			"std" => "关闭",
			"options" => array("显示", "关闭")),


	array(	"name" => "输入首页广告代码",
			"desc" => "",
			"id" =>	$shortname."_adh_c",
			"type" => "textarea",
			"std" => '<a href="http://www.zuifengyun.com/blogger" target="_blank"><img src="http://www.zuifengyun.com/wp-content/uploads/2013/02/gg2.jpg" alt="博友大全-博友互访平台" /></a>'),


	array(	"name" => "输入侧边广告代码(小工具)",
			"desc" => "",
			"id" =>	$shortname."_adsc",
			"type" => "textarea",
			"std" => '<a href="http://www.zuifengyun.com/blogger" target="_blank"><img src="http://www.zuifengyun.com/wp-content/uploads/2013/02/gg3.jpg" alt="博友大全-博友互访平台" /></a>'),


	array(	"name" => "是否显示评论框上方广告",
			"desc" => "默认显示",
			"id" =>	$shortname."_adc",
			"type" => "select",
			"std" => "关闭",
			"options" => array("显示", "关闭")),


	array(	"name" => "输入评论框上方广告代码",
			"desc" => "",
			"id" =>	$shortname."_ad_c",
			"type" => "textarea",
			"std" => '<a href="http://www.zuifengyun.com/blogger" target="_blank"><img src="http://www.zuifengyun.com/wp-content/uploads/2013/02/gg2.jpg" alt="博友大全-博友互访平台" /></a>'),


	array(	"name" => "是否显示正文广告",
			"desc" => "默认显示",
			"id" =>	$shortname."_ad_r",
			"type" => "select",
			"std" => "关闭",
			"options" => array("显示", "关闭")),


	array(	"name" => "输入正文广告代码",
			"desc" => "",
			"id" =>	$shortname."_ad_rc",
			"type" => "textarea",
			"std" => '<a href="http://www.zuifengyun.com/blogger" target="_blank"><img src="http://www.zuifengyun.com/wp-content/uploads/2013/02/gg1.jpg" alt="博友大全-博友互访平台" /></a>'),


	array(	"name" => "是否显示正文底部广告",
			"desc" => "默认显示",
			"id" =>	$shortname."_adt",
			"type" => "select",
			"std" => "关闭",
			"options" => array("显示", "关闭")),


	array(	"name" => "输入正文底部广告代码",
			"desc" => "",
			"id" =>	$shortname."_adtc",
			"type" => "textarea",
			"std" => '<a href="http://www.zuifengyun.com/blogger" target="_blank"><img src="http://www.zuifengyun.com/wp-content/uploads/2013/02/gg2.jpg" alt="博友大全-博友互访平台" /></a>'),


	array(	"type" => "close") );
function mytheme_add_admin() {
global $themename, $shortname, $options;
if ( $_GET['page'] == basename(__FILE__) ) {
	if ( 'save'	== $_REQUEST['action'] ) {
		foreach	($options as $value) { 		update_option( $value['id'], $_REQUEST[	$value['id'] ] ); }
foreach	($options as $value) { 	if(	isset( $_REQUEST[ $value['id'] ] ) ) { update_option( $value['id'],	$_REQUEST[ $value['id']	]  ); }	else { delete_option( $value['id'] ); }	}
	header("Location: admin.php?page=theme_options.php&saved=true"); die;
} else if( 'reset' ==	$_REQUEST['action']	) {
	foreach	($options as $value) { 		delete_option( $value['id']	); }
	header("Location: admin.php?page=theme_options.php&reset=true"); die;
} }
add_theme_page($themename."	Options", "主题设置", 'edit_themes', basename(__FILE__), 'mytheme_admin'); }
function mytheme_add_init()	{
$file_dir=get_bloginfo('template_directory'); wp_enqueue_style("functions", $file_dir."/includes/options/options.css", false,	"1.0", "all"); wp_enqueue_script("rm_script", $file_dir."/includes/options/rm_script.js", false, "1.0"); } function mytheme_admin() {
global $themename, $shortname, $options; $i=0;
if ( $_REQUEST['saved']	) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' 主题设置已保存</strong></p></div>'; if ( $_REQUEST['reset']	) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' 主题已重新设置</strong></p></div>';
?> <div class="wrap rm_wrap"> <h2><?php echo $themename; ?> 主题设置</h2> <p>当前使用主题: FengYun 2.0版 | 设计者:<a href="http://www.zuifengyun.com"	target="_blank"> huishao</a> <font style="font-size:20px;"color=#ff0000><strong> &hearts; </strong></font> <font color=#000>捐助我，支付宝：<font color=#21759b><strong><a href="https://me.alipay.com/gongxiaohui"	target="_blank">点此捐助</a></strong></font></font>	| <a href="http://www.zuifengyun.com/tag/fengyun" target="_blank">查看主题更新</a> | <a href="http://www.zuifengyun.com/tag/fengyun" target="_blank">主题设置教程</a></p> <div class="rm_opts"> <form method="post"> <?php foreach ($options	as $value) { switch ( $value['type']	) {
case "open": ?>
<?php break;
case "close": ?>
</div> </div> <br	/>
<?php break;
case "title": ?>
<?php break;
case 'text': ?>
<div class="rm_input rm_text"> 	<label for="<?php echo $value['id']; ?>"><?php echo	$value['name'];	?></label> 	<input name="<?php echo	$value['id']; ?>" id="<?php	echo $value['id']; ?>" type="<?php echo	$value['type'];	?>"	value="<?php if	( get_settings(	$value['id'] ) != "") {	echo stripslashes(get_settings(	$value['id'])  ); }	else { echo	$value['std']; } ?>" />  <small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
 </div> <?php break;
case 'textarea': ?>
<div class="rm_input rm_textarea"> 	<label for="<?php echo $value['id']; ?>"><?php echo	$value['name'];	?></label> 	<textarea name="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" cols="" rows=""><?php	if ( get_settings( $value['id']	) != "") { echo	stripslashes(get_settings( $value['id']) );	} else { echo $value['std']; } ?></textarea>  <small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
 </div>
<?php break;
case 'select': ?>
<div class="rm_input rm_select"> 	<label for="<?php echo $value['id']; ?>"><?php echo	$value['name'];	?></label>
<select	name="<?php	echo $value['id']; ?>" id="<?php echo $value['id'];	?>"> <?php foreach ($value['options'] as	$option) { ?> 		<option	<?php if (get_settings(	$value['id'] ) == $option) { echo 'selected="selected"'; } ?>><?php	echo $option; ?></option><?php } ?> </select>
	<small><?php echo $value['desc']; ?></small><div class="clearfix"></div> </div> <?php break;
case "checkbox": ?>
<div class="rm_input rm_checkbox"> 	<label for="<?php echo $value['id']; ?>"><?php echo	$value['name'];	?></label>
<?php if(get_option($value['id'])){	$checked = "checked=\"checked\""; }else{ $checked =	"";} ?> <input type="checkbox" name="<?php echo	$value['id']; ?>" id="<?php	echo $value['id']; ?>" value="true"	<?php echo $checked; ?>	/>
	<small><?php echo $value['desc']; ?></small><div class="clearfix"></div>  </div> <?php break; case "section":
$i++;
?>
<div class="rm_section"> <div class="rm_title"><h3><img src="<?php bloginfo('template_directory')?>/includes/options/clear.png" class="inactive"	alt="""><?php echo $value['name']; ?></h3><span	class="submit"><input name="save<?php echo $i; ?>" type="submit" value="保存设置" /> </span><div	class="clearfix"></div></div> <div class="rm_options">

<?php break;
} }
?>
 <?php
function show_id() {
	global $wpdb;
	$request = "SELECT $wpdb->terms.term_id, name FROM $wpdb->terms	";
	$request .=	" LEFT JOIN	$wpdb->term_taxonomy ON	$wpdb->term_taxonomy.term_id = $wpdb->terms.term_id	";
	$request .=	" WHERE	$wpdb->term_taxonomy.taxonomy =	'category' ";
	$request .=	" ORDER	BY term_id asc";
	$categorys = $wpdb->get_results($request);
	foreach	($categorys	as $category) {
		$output	= '<ul>'.$category->name."&nbsp;&nbsp;ID= <em>".$category->term_id.'</em> </ul>';
		echo $output;
	}
}
?>
 <span class="show_id"><h4>站点所有分类ID</h4><?php	show_id();?></span>
<input type="hidden" name="action" value="save"	/>
</form>
<form method="post">
<p class="submit">
<input name="reset"	type="submit" value="恢复默认设置" />
<input type="hidden" name="action" value="reset" />
</p>
</form>
<p>提示：此按钮将恢复主题初始状态，您的所有设置将消失！</p>
 </div>
<?php
}
?>
<?php
function mytheme_wp_head() {
	$stylesheet	= get_option('swt_alt_stylesheet');
	if($stylesheet != ''){?>
<?php }
}
add_action('wp_head', 'mytheme_wp_head');
add_action('admin_init', 'mytheme_add_init');
add_action('admin_menu', 'mytheme_add_admin');
?>