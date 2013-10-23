<?php // Do not delete these lines
	if ('comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');
	if (!empty($post->post_password)) { // if there's a password
		if ($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) {  // and it doesn't match the cookie
			?>
			<p class="nocomments">必须输入密码，才能查看评论！</p>
			<?php
			return;
		}
	}

	/* This variable is for alternating comment background */
	$oddcomment = '';
?>
<!-- You can start editing here. -->
<?php if ($comments) : ?>
	<h3 id="comments">目前共有 
    <?php    
        $my_email = get_bloginfo ( 'admin_email' );    
        $str = "SELECT COUNT(*) FROM $wpdb->comments WHERE comment_post_ID = $post->ID  
        AND comment_approved = '1' AND comment_type = '' AND comment_author_email";    
        $count_v = $wpdb->get_var("$str != '$my_email'");    
        $count_h = $wpdb->get_var("$str = '$my_email'");    
        $count_t = $count_v+$count_h;
        echo $count_t, " 条留言 【 访客:", $count_v, " 条, 博主:", $count_h, " 条 】";    
        if ($count_v>$count_h) :    
          if ($count_v-$count_h>=5) :    
          echo " 访客以 ", $count_v, "：", $count_h, " 大幅领先博主！", "";    
          elseif ($count_v-$count_h<5) :    
              echo " 访客以 ", $count_v, "：", $count_h, " 暂时领先博主！", "";    
          endif;    
        elseif ($count_v<$count_h) :    
          if ($count_h-$count_v>=5) :    
          echo " 博主以 ", $count_h, "：", $count_v, " 大幅领先访客！", "";    
          elseif ($count_h-$count_v<5) :    
              echo " 博主以 ", $count_h, "：", $count_v, " 暂时领先访客！", "";    
          endif;    
        elseif ($count_v==$count_h) :    
              if ($count_t==0) :    
          echo "暂时没有评论，", " 还不<a href='#respond'>快枪沙发</a>！ ", "";    
          else :    
          echo "双方以 ", $count_v, "：", $count_h, " 暂时持平 O(∩_∩)O~", "";    
          endif;    
        endif;    
    ?>
         </h3>
	<ol class="commentlist">
	<?php wp_list_comments('type=comment&callback=An_comment&end-callback=An_end_comment&max_depth=23'); ?>
	</ol>
	<div class="navigation">
		<div class="pagination"><?php paginate_comments_links(); ?></div>
	</div>

 <?php else : // this is displayed if there are no comments so far ?>
	<?php if ('open' == $post->comment_status) : ?>
		<!-- If comments are open, but there are no comments. -->
        <h3 id="comments" style="margin-bottom:10px"><?php the_title(); ?>：等您坐沙发呢！</h3>
	 <?php else : // comments are closed ?>
		<!-- If comments are closed. -->
		<p class="nocomments">报歉!评论已关闭.</p>
	<?php endif; ?>
	<?php endif; ?>
	<?php if ('open' == $post->comment_status) : ?>
	<div id="respond_box">
	<div id="respond">
		<h3>发表评论</h3>	
		<div class="cancel-comment-reply">
		<div id="real-avatar">
</div>	
			<small><?php cancel_comment_reply_link(); ?></small>
		</div>
		<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
		<p><?php print '您必须'; ?><a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>"> [ 登录 ] </a>才能发表留言！</p>
    <?php else : ?>
    <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
      <?php if ( $user_ID ) : ?>
      <p><?php print '登录者：'; ?> <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>
      <?php get_author_class($comment->comment_author_email,$comment->user_id)?>
&nbsp;&nbsp;<a href="<?php echo wp_logout_url(get_permalink()); ?>" title="退出账户"><?php print '[ 退出账户 ]'; ?></a>
	<?php elseif ( '' != $comment_author ): ?>
	<div class="author"><?php printf(__('欢迎回来 <strong>%s</strong>'), $comment_author); ?>
			<a href="javascript:toggleCommentAuthorInfo();" id="toggle-comment-author-info">[ 更改用户 ]</a></div>
			<script type="text/javascript" charset="utf-8">
				//<![CDATA[
				var changeMsg = "[ 更改用户 ]";
				var closeMsg = "[ 隐藏信息 ]";
				function toggleCommentAuthorInfo() {
					jQuery('#comment-author-info').slideToggle('slow', function(){
						if ( jQuery('#comment-author-info').css('display') == 'none' ) {
						jQuery('#toggle-comment-author-info').text(changeMsg);
						} else {
						jQuery('#toggle-comment-author-info').text(closeMsg);
				}
			});
		}
				jQuery(document).ready(function(){
					jQuery('#comment-author-info').hide();
				});
				//]]>
			</script>
		</p>
	 <?php endif; ?>
         <?php echo An_WelcomeCommentAuthorBack($comment_author_email); ?>
	<?php if ( ! $user_ID ): ?>
	<div id="comment-author-info">
		<p>
            <label for="author">昵称</label>
			<input type="text" name="author" id="author" class="commenttext" value="<?php echo $comment_author; ?>" size="22" tabindex="1" /><?php if ($req) echo " *"; ?></p>
			<p><label for="email">邮箱<span id="Get_Gravatar"></span></label>
			<input type="text" name="email" id="email" class="commenttext" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" /><?php if ($req) echo " *"; ?></p>
			<p><label for="url">网址</label>
			<input type="text" name="url" id="url" class="commenttext" value="<?php echo $comment_author_url; ?>" size="22" tabindex="3" />
		</p>
	</div>
      <?php endif; ?>
		<!--<p><small><strong>XHTML:</strong> You can use these tags: <code><?php echo allowed_tags(); ?></code></small></p>-->
    <div class="clear"></div>
    <div id="editor_tools">
        <a href="javascript:;" id="comment-smiley">表情</a>
        <a href="javascript:SIMPALED.Editor.strong()">粗体</a>
        <a href="javascript:SIMPALED.Editor.em()">斜体</a>
        <a href="javascript:SIMPALED.Editor.quote()">引用</a>
        <a href="javascript:SIMPALED.Editor.ahref()">链接</a>
        <a href="javascript:SIMPALED.Editor.del()">删除线</a>
        <a href="javascript:SIMPALED.Editor.underline()">下划线</a>
        <a href="javascript:SIMPALED.Editor.code()">插代码</a>
        <a href="javascript:SIMPALED.Editor.img()">插图</a>
    </div>
    <span id="smiley" style="display:none;">
	    <?php include(TEMPLATEPATH . '/smiley.php'); ?>
    </span>
    <textarea name="comment" id="comment" tabindex="4" cols="45" rows="5"></textarea>
	<p>
	<input class="submit" name="submit" type="submit" id="submit" tabindex="5" value="提交留言" />
	<input class="reset" name="reset" type="reset" id="reset" tabindex="6" value="<?php esc_attr_e( '重写' ); ?>" />
		<?php comment_id_fields(); ?>
        <?php do_action('comment_form', $post->ID); ?>
	</p>
		<script type="text/javascript">	//Crel+Enter
		//<![CDATA[
			jQuery(document).keypress(function(e){
				if(e.ctrlKey && e.which == 13 || e.which == 10) { 
					jQuery(".submit").click();
					document.body.focus();
				} else if (e.shiftKey && e.which==13 || e.which == 10) {
					jQuery(".submit").click();
				}          
			})
		// ]]>
		</script>
		<span style="padding:0 0 2px 8px">快捷键：Ctrl+Enter</span>
    </form>

	<div class="clear"></div>
    <?php endif; // If registration required and not logged in ?>
  </div>
  </div>
  <?php endif; // if you delete this the sky will fall on your head ?>