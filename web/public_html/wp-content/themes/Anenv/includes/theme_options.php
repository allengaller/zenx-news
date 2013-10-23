<?php
$themename = "An";
$shortname = "swt";
$categories = get_categories('hide_empty=0&orderby=name');
$wp_cats = array();
foreach ($categories as $category_list ) {
       $wp_cats[$category_list->cat_ID] = $category_list->cat_name;
}
$number_entries = array("Select a Number:","1","2","3","4","5","6","7","8","9","10", "12","14", "16", "18", "20" );
$options = array (
	array(  "name" => $themename." Options",
      		"type" => "title"),
//首页布局设置开始
    array( "type" => "close"),
    array( "name" => "首页布局设置",
           "type" => "section"),
    array( "type" => "open"),
	array(  "name" => "选择首页布局",
			"desc" => "默认CMS布局",
            "id" => $shortname."_home",
            "type" => "select",
            "std" => "CMS",
            "options" => array("BLOG", "CMS")),
	array(	"name" => "首页cms列表显示ID",
			"desc" => "输入分类ID，显示更多分类，请用英文逗号＂,＂隔开",
            "id" => $shortname."_cat",
            "type" => "text",
            "std" => "1,2,3,4"),
		array(	"name" => "首页cms列表显示的篇数",
			"desc" => "默认显示8篇",
			"id" => $shortname."_cms_num",
			"type" => "text",
            "std" => "8"),
	array(	"name" => "首页最新文章显示的篇数",
			"desc" => "默认显示3篇",
			"id" => $shortname."_blog_num",
			"type" => "text",
            "std" => "3"),
	array(	"name" => "首页推荐轮播的分类ID",
			"desc" => "默认id为3",
			"id" => $shortname."_lb_cat",
			"type" => "text",
            "std" => "3"),
	array(	"name" => "首页推荐轮播的数量",
			"desc" => "默认显示6篇",
			"id" => $shortname."_lb_num",
			"type" => "text",
            "std" => "6"),
	array(	"name" => "侧边栏导航分类ID-7个",
			"desc" => "默认id为1,2,3,4,5,6,7",
			"id" => $shortname."_cdh",
			"type" => "text",
            "std" => "1,2,3,4,5,6,7"),
	array(	"name" => "备案号",
			"desc" => "备案号",
			"id" => $shortname."_copyr",
			"type" => "text",),
		array(	"name" => "统计代码",
			"desc" => "统计代码",
			"id" => $shortname."_tongj",
			"type" => "text",),
//站点SEO&站点统计设置
    array( "type" => "close"),
	array(  "name" => "站点SEO&站点统计设置(必填)",
			"type" => "section"),
	array(  "type" => "open"),

	array(	"name" => "描述（Description）",
			"desc" => "",
			"id" => $shortname."_description",
			"type" => "textarea",
            "std" => "输入你的网站描述，一般不超过200个字符"),

	array(	"name" => "关键词（KeyWords）",
            "desc" => "",
            "id" => $shortname."_keywords",
            "type" => "textarea",
            "std" => "输入你的网站关键字，一般不超过100个字符"),

	array(	"name" => "用户名",
			"desc" => "",
			"id" => $shortname."_user",
            "type" => "text",
            "std" => "Anenv"),

	array(	"name" => "建站日期",
            "desc" => "",
            "id" => $shortname."_builddate",
            "type" => "text",
            "std" => "2012-02-18"),

//综合功能开关设置
    array(  "type" => "close"),
    array(  "name" => "综合功能开关设置",
            "type" => "section"),
    array(  "type" => "open"),

	array(  "name" => "是否开启头像缓存",
			"desc" => "默认开启",
            "id" => $shortname."_type",
            "type" => "select",
            "std" => "Hide",
            "options" => array("Display", "Hide")),
	array(  "name" => "是否开启选中内容分享到微博",
			"desc" => "默认不开启",
            "id" => $shortname."_wpshare",
            "type" => "select",
            "std" => "Display",
            "options" => array("Hide", "Display")),
	array(	"name" => "输入从侧边固定分类排除的分类ID",
            "desc" => "比如：-1,-2,-3多个ID用英文逗号＂,＂隔开",
            "id" => $shortname."_cat_exclude",
            "type" => "text",
            "std" => ""),
	array(  "name" => "彩色标签云",
			"desc" => "默认显示",
            "id" => $shortname."_cumulus",
            "type" => "select",
            "std" => "关闭",
            "options" => array("显示", "关闭")),

//基本功能设置
    array(  "type" => "close"),
	array(  "name" => "基本功能设置",
			"type" => "section"),
	array(  "type" => "open"),

	array(  "name" => "是否显示顶部QQ邮箱订阅",
			"desc" => "默认不显示",
            "id" => $shortname."_mailqq",
            "type" => "select",
            "std" => "Display",
            "options" => array("Hide", "Display")),

	array(  "name" => "是否显示顶部新浪微博",
			"desc" => "默认不显示",
            "id" => $shortname."_tsina",
            "type" => "select",
            "std" => "Display",
            "options" => array("Hide", "Display")),

	array(	"name" => "输入新浪微博地址",
            "desc" => "",
            "id" => $shortname."_tsinaurl",
            "type" => "text",
            "std" => "http://weibo.com/anenver"),
						
	array(  "name" => "是否显示顶部腾讯微博",
			"desc" => "默认不显示",
            "id" => $shortname."_tqq",
            "type" => "select",
            "std" => "Dispatch",
            "options" => array("Hide", "Display")),

	array(	"name" => "输入腾讯微博地址",
            "desc" => "",
            "id" => $shortname."_tqqurl",
            "type" => "text",
            "std" => "http://t.qq.com/anenver"),

	array(  "name" => "是否显示其他域名来访欢迎词",
			"desc" => "默认不显示",
            "id" => $shortname."_welcome",
            "type" => "select",
            "std" => "Display",
            "options" => array("Hide", "Display")),

	array(	"name" => "输入Feed订阅地址",
            "desc" => "",
            "id" => $shortname."_feedurl",
            "type" => "text",
            "std" => "http://feed.anenv.com"),

//主题公告设置
    array(  "type" => "close"),
	array(  "name" => "主题公告设置",
			"type" => "section"),
	array(  "type" => "open"),

	array(  "name" => "是否开启公告栏",
			"desc" => "默认不开启",
            "id" => $shortname."_bulletin",
            "type" => "select",
            "std" => "Display",
            "options" => array("Hide", "Display")),
			
    array(  "name" => "请输入公告内容",
            "desc" => "注意：长度最好在30个汉字以内",
            "id" => $shortname."_gg1",
            "type" => "textarea",
            "std" => "公告一",),

//站点广告设置
    array(  "type" => "close"),
	array(  "name" => "站点广告设置",
			"type" => "section"),
	array(  "type" => "open"),

	array(  "name" => "是否显示daoh广告",
			"desc" => "默认不显示",
            "id" => $shortname."_ada",
            "type" => "select",
            "std" => "Display",
            "options" => array("Hide", "Display")),

	array(	"name" => "广告代码(推荐728*90)",
            "desc" => "",
            "id" => $shortname."_adacode",
            "type" => "textarea",
            "std" => ""),
	
	array(  "name" => "是否显示文章中广告",
			"desc" => "默认不显示",
            "id" => $shortname."_adz",
            "type" => "select",
            "std" => "Display",
            "options" => array("Hide", "Display")),

	array(	"name" => "广告代码(推荐250*250)",
            "desc" => "",
            "id" => $shortname."_adzcode",
            "type" => "textarea",
            "std" => ""),

	array(  "name" => "是否显示文章底部广告",
			"desc" => "默认不显示",
            "id" => $shortname."_adb",
            "type" => "select",
            "std" => "Display",
            "options" => array("Hide", "Display")),

	array(	"name" => "广告代码(推荐728*90)",
            "desc" => "默认不显示",
            "id" => $shortname."_adbcode",
            "type" => "textarea",
            "std" => ""),

	array(  "name" => "是否显示侧边栏广告（最新评论上）",
			"desc" => "默认不显示",
            "id" => $shortname."_adc",
            "type" => "select",
            "std" => "Display",
            "options" => array("Hide", "Display")),

	array(	"name" => "广告代码(推荐宽度300)",
            "desc" => "",
            "id" => $shortname."_adccode",
            "type" => "textarea",
            "std" => ""),

	array(  "name" => "是否显示侧边栏广告（侧边栏最上）",
			"desc" => "默认不显示",
            "id" => $shortname."_125ads",
            "type" => "select",
            "std" => "Display",
            "options" => array("Hide", "Display")),

	array(	"name" => "广告代码(推荐宽度300))",
            "desc" => "",
            "id" => $shortname."_125adscode",
            "type" => "textarea",
            "std" => ""),
);

function mytheme_add_admin() {
global $themename, $shortname, $options;
if ( $_GET['page'] == basename(__FILE__) ) {
	if ( 'save' == $_REQUEST['action'] ) {
		foreach ($options as $value) {
	update_option( $value['id'], $_REQUEST[ $value['id'] ] ); }
foreach ($options as $value) {
	if( isset( $_REQUEST[ $value['id'] ] ) ) { update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); } else { delete_option( $value['id'] ); } }
	header("Location: admin.php?page=theme_options.php&saved=true");
die;
}
else if( 'reset' == $_REQUEST['action'] ) {
	foreach ($options as $value) {
		delete_option( $value['id'] ); }
	header("Location: admin.php?page=theme_options.php&reset=true");
die;
}
}
add_theme_page($themename." Options", "当前主题设置", 'edit_themes', basename(__FILE__), 'mytheme_admin');
}
function mytheme_add_init() {
$file_dir=get_bloginfo('template_directory');
wp_enqueue_style("functions", $file_dir."/includes/options/options.css", false, "1.0", "all");
wp_enqueue_script("rm_script", $file_dir."/includes/options/rm_script.js", false, "1.0");
}
function mytheme_admin() {
global $themename, $shortname, $options;
$i=0;
if ( $_REQUEST['saved'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' 主题设置已保存</strong></p></div>';
if ( $_REQUEST['reset'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' 主题已重新设置</strong></p></div>';
?>

<div class="wrap rm_wrap">
<h2><?php echo $themename; ?> 设置</h2>
<p>当前使用主题: An | 设计者: <a href="http://www.anenv.com" target="_blank">Anenv</a></p> 
<div class="rm_opts">
<form method="post"> 
<?php foreach ($options as $value) {
switch ( $value['type'] ) {
case "open":
?>
<?php break; case "close": ?>
</div>
</div>
<br />
<?php break; case "title": ?>
<?php break; case 'text': ?>
<div class="rm_input rm_text">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
 	<input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_settings( $value['id'] ) != "") { echo stripslashes(get_settings( $value['id'])  ); } else { echo $value['std']; } ?>" />
 <small><?php echo $value['desc']; ?></small><div class="clear"></div>
 </div>
<?php break; case 'textarea': ?>
<div class="rm_input rm_textarea">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
 	<textarea name="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" cols="" rows=""><?php if ( get_settings( $value['id'] ) != "") { echo stripslashes(get_settings( $value['id']) ); } else { echo $value['std']; } ?></textarea>
 <small><?php echo $value['desc']; ?></small><div class="clear"></div>
 </div>
<?php break; case 'select': ?>
<div class="rm_input rm_select">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
	<select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
<?php foreach ($value['options'] as $option) { ?>
		<option value="<?php echo $option;?>" <?php if (get_settings( $value['id'] ) == $option) { echo 'selected="selected"'; } ?>>
		<?php
		if ((empty($option) || $option == '' ) && isset($value['default_option_value'])) {
			echo $value['default_option_value'];
		} else {
			echo $option; 
		}?>
		
		</option><?php } ?>
</select>
	<small><?php echo $value['desc']; ?></small><div class="clear"></div>
</div>
<?php break; case "checkbox": ?>
<div class="rm_input rm_checkbox">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
<?php if(get_option($value['id'])){ $checked = "checked=\"checked\""; }else{ $checked = "";} ?>
<input type="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> />
	<small><?php echo $value['desc']; ?></small><div class="clear"></div>
 </div>
<?php break; case "section": $i++; ?>
<div class="rm_section">
<div class="rm_title"><h3><img src="<?php bloginfo('template_directory')?>/includes/options/clear.png" class="inactive" alt="""><?php echo $value['name']; ?></h3><span class="submit"><input name="save<?php echo $i; ?>" type="submit" value="保存设置" /></span><div class="clear">
</div>
</div>
<div class="rm_options">
<?php break; }} ?>
<input type="hidden" name="action" value="save" />
</form>
<form method="post">
<p class="submit">
<input name="reset" type="submit" value="恢复默认设置" /> <font color=#ff0000>提示：此按钮将恢复主题初始状态，您的所有设置将消失！</font>
<input type="hidden" name="action" value="reset" />
</p>
</form></div>
<?php } 
add_action('admin_init', 'mytheme_add_init');
add_action('admin_menu', 'mytheme_add_admin');
?>