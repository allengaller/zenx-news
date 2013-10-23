<?php 
function submit_posts_html(){
 ob_end_clean();
 ob_start();
?>
<div id="ps_msg">欢迎给我供稿</div>
<form id="post_submit_form" name="post_submit_form" method="post" action="">
<div class="row">
<input type="hidden" name="submit_posts_ajax" id="submit_posts_ajax" value="yinheli"/>

<label><input type="text" name="post_title" id="post_title" tabindex="1" value="<?php echo strip_tags($_POST['post_title']);?>"/> 投稿标题(必填)</label>
</div>

<div class="row">
<label><input type="text" name="your_name" id="your_name" tabindex="2" value="<?php echo $_POST['your_name'];?>" /> 您的名字或昵称</label>
</div>

<div class="row">
<label><input type="text" name="your_email" id="your_email" tabindex="3" value="<?php echo $_POST['your_email'];?>" /> 您的邮箱(必填)</label>
</div>

<div class="row">
<label><input type="text" name="your_site" id="your_site" tabindex="4" value="<?php echo $_POST['your_site'];?>" />  您的网站</label>
</div>

<div id="ps_allowed_tags">
容许使用的Html标签:<br/><?php echo allowed_tags(); ?> 
</div>

<div class="row">
<textarea name="post_content" cols="50" rows="15" id="post_content" tabindex="5"><?php echo stripslashes($_POST['post_content']);?></textarea>
</div>

<div class="row">
<label><input type="text" name="post_tags" id="post_tags" tabindex="6" value="<?php echo strip_tags($_POST['post_tags']);?>" /> 标签(tags)[每个标签用半角的逗号分开]</label>
</div>

<div id="submit_post">
<input type="submit" name="post_review" id="post_review" value="预览" tabindex="7" />
<input type="submit" name="post_submit" id="post_submit" value="提交" tabindex="8" />
</div>
<div style="clear:both"></div>
</form>
<span id="Sbmit_posts_author">投稿插件由 <a href="http://philna.com">yinheli</a> 提供.</span>
<?php
 $html=ob_get_contents();
 ob_end_clean();
return $html;
}
?>