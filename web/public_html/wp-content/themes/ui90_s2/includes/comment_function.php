<?php 
/**评论模块的函数集合；
 *请确保您使用notepad++、editplus或者ue编辑器打开此文档的；
 *
 *请修改26行中的http://blog.ui90.com/为自己的网站
 *请修改35、37、112行中的提示部分内容(qintag@sina.com)；
 *
 *胖子马 2013年5月17日
 */
//comments link redirect WordPress评论留言链接优化-加nofollow和url重定向跳转
add_filter('get_comment_author_link', 'add_redirect_comment_link', 5); 
add_filter('comment_text', 'add_redirect_comment_link', 99); 
function add_redirect_comment_link($text = ''){ 
	$text=str_replace('href="', 'href="'.get_option('home').'/?r=', $text); 
	$text=str_replace("href='", "href='".get_option('home')."/?r=", $text); 
	return $text; 
} 
add_action('init', 'redirect_comment_link'); 
function redirect_comment_link(){ 
	$redirect = $_GET['r']; 
	if($redirect){ 
		if(strpos($_SERVER['HTTP_REFERER'],get_option('home')) !== false){ 
			header("Location: $redirect"); 
			exit; 
		}else { 
			header("Location: http://blog.ui90.com/");  //请修改为自己的网站
			exit; 
		}
	} 
}
// -------- END -------------------------------------------------------
/////////////////// 防止假冒站长回复评论/////////////////////////////
function user_check($incoming_comment) {
	$isSpam = 0;
	if (trim($incoming_comment['comment_author']) == 'qintag')//修改成自己的昵称 <<-------------
	$isSpam = 1;
	if (trim($incoming_comment['comment_author_email']) == 'qintag@sina.com') //修改自己的邮箱 <<-------------
	$isSpam = 1;
	if(!$isSpam)
	return $incoming_comment;
	wp_die('Sorry !you are not the administrator!');
}
if(!is_user_logged_in())
add_filter( 'preprocess_comment', 'user_check' );
// -------- END -------------------------------------------------------
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
                <?php if ($comment->comment_approved == '0') : ?>
                    <font color=#d00030>您的评论需要管理员审核...</font>
                <?php endif; ?>
            </div>
            <div class="comment-body">
                <?php comment_text(); ?>
				<!--请把qintag@sina.com改为自己的-->
                <?php if($comment->comment_author_email == "qintag@sina.com") echo "<div id='comment_admin_img'><img src='http://blog.ui90.com/qt_share/admin.gif'></div>" ?>
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
      <p>您可以点击 <a href="' . htmlspecialchars(get_comment_link($parent_id)) . '">查看回应完整内容</a></p>
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
  //设栏位
  function w_tb() {
    if ( is_singular() ) {
      ob_start(create_function('$input', 'return preg_replace("#textarea(.*?)name=([\"\'])comment([\"\'])(.+)/textarea>#",
      "textarea$1name=$2w$3$4/textarea><textarea name=\"comment\" cols=\"60\" rows=\"4\" style=\"display:none\"></textarea>", $input);') );
    }
  }
  //检查
  function gate() {
    ( !empty($_POST['w']) && empty($_POST['comment']) ) ? $_POST['comment'] = $_POST['w'] : $_POST['spam_confirmed'] = 1;
  }
  //处理
  function sink( $comment ) {
    if ( !empty($_POST['spam_confirmed']) ) {
      //方法一:直接挡掉, 将 die(); 前面两斜线删除即可.
      //die();
      //方法二:标记为spam, 留在资料库检查是否误判.
      add_filter('pre_comment_approved', create_function('', 'return "spam";'));
      $comment['comment_content'] = "[ 小牆判断这是Spam! ]\n" . $comment['comment_content'];
    }
    return $comment;
  } 
}
$anti_spam = new anti_spam();
?>