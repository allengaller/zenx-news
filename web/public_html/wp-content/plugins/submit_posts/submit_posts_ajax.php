<?php
/*
Plugin Name: wordpress投稿插件
Plugin URI: http://philna.com
Plugin Description: 基于AJAX简单投稿插件. 使用说明:新建一个页面.切换到html编辑模式 在需要插入表单的地方插入'[submit_posts]'即可.另外,你需要写好CSS样式.
Version: 1.0.
Author: yinheli
Author URI: http://philna.com
*/

function submit_posts_ajax(){
	if($_POST['submit_posts_ajax']=='yinheli'){
	$title=strip_tags(trim($_POST['post_title']));
	$name=trim($_POST['your_name']);
	$mail=trim($_POST['your_email']);
	$site=trim($_POST['your_site']);
	$content=stripslashes(trim($_POST['post_content']));
	$tags=strip_tags(trim($_POST['post_tags']));
	
		global $wpdb;
		$db="SELECT post_title FROM $wpdb->posts WHERE post_title = '$title' LIMIT 1";
		if ($wpdb->get_var($db)){
			echo '<div class="ps_errormsg">发现重复文章.你已经发表过了.或者存在该文章</div>';
			die();
		}
		
	if(!empty($site)){
			if(substr($site, 0, 7) != 'http://') $site= 'http://'.$site;
		$author='<a href="'.$site.'" title="'.$name.'">'.$name.'</a>';
		}else{
		$author=$name;
	}
	$info='<div class="post_submit_info">感谢: '.$author.' 的供稿.</div>'."\n\n";
	if(isset($_POST['post_submit'])){
		//错误判断
		if($title==''){
		echo '<div class="ps_errormsg">错误:没有填写标题!</div>';
		die();
		}
		elseif($mail==''){
		echo '<div class="ps_errormsg">错误:没有填写邮箱地址.</div>';
		die();
		}
		elseif($content==''){
		echo '<div class="ps_errormsg">错误:还没有填写内容!!!</div>';
		die();
		}else{
		//提交数据
		$content=$info.$content;
	 	$submitdata=array(
			'post_title'	=>$title,
			'post_content'	=>$content,
			'tags_input'	=>$tags,
			'post_status'	=> 'pending'
		);
		$post_id = wp_insert_post($submitdata,$wp_error = false);
		$subject='您给[ '.get_option('blogname').' ]写了篇文章 标题是: '.$title;
		$message='非常感谢您的供稿.您的稿件已经提交.等待管理员的审核. 以下是您提交的内容:<hr>'.stripslashes(trim($_POST['post_content']));
		yinheli_sendmail_ps($mail,$subject,$message);
		echo '<div class="ps_msg">非常感谢您的供稿.您的稿件已经提交.等待管理员的审核.请耐心等待.</div>';
		@header('Content-type: ' . get_option('html_type') . '; charset=' . get_option('blog_charset'));
		die();
		}
	}
	if(isset($_POST['post_review'])){
		if(''==$content){
		echo '还没有填写内容';
		die();
		}
		if(''==$tags) $tags='您还没有填写 标签 (Tags)';
		echo '<div class="ps_reviewmsg">
			<h2>'.$title.'</h2>
			<div class="ps_reviewcontent">
				'.$info.$content.'
				<p class="ps_reviewtags">标签:'.$tags.'</p>
			</div>
		</div>';
		die();
	}
	die();
	}

}
function yinheli_sendmail_ps($to,$subject,$message){
	$blogname = get_option('blogname');
	$charset = get_option('blog_charset');
	$ps_sendmail_headers  = "From: $blogname \n" ;
	$ps_sendmail_headers .= "MIME-Version: 1.0\n";
	$ps_sendmail_headers .= "Content-Type: text/html;charset=\"$charset\"\n";
	return @wp_mail($to, $subject, $message, $ps_sendmail_headers);
}

function submit_posts_load_js(){
echo "\n".'<script type="text/javascript" src="' . get_bloginfo('wpurl') . '/wp-content/plugins/submit_posts/submit_posts.js"></script>'."\n";
}
add_action('init', 'submit_posts_ajax');
require_once('submit_posts.php');
function submit_posts_display(){
submit_posts_load_js();
$submit_posts_html=submit_posts_html();
return $submit_posts_html;
}
add_shortcode('submit_posts','submit_posts_display');
?>