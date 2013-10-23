<h3>关注本站</h3>
<div class="feed-mail">
	<div class="box">
		<ul id="contact-li">
			<li class="qq"><a rel="nofollow" target="_blank" href="http://wpa.qq.com/msgrd?V=1&Menu=yes&Uin=<?php echo stripslashes(get_option('swt_qq')); ?>" title="有急事请Q我">QQ联系</a></li>
			<li class="email"><a rel="nofollow" target="_blank" href="<?php echo stripslashes(get_option('swt_email')); ?>" title="发邮件给我">邮件</a></li>
			<li class="qqmblog"><a rel="nofollow" target="_blank" href="<?php echo stripslashes(get_option('swt_qqmblog')); ?>" title="收听我的腾讯微博">腾讯微博</a></li>
			<li class="sinamblog"><a rel="nofollow" target="_blank" href="<?php echo stripslashes(get_option('swt_sinamblog')); ?>" title="收听我的新浪微博">新浪微博</a></li>
			<li class="rss"><a rel="nofollow" target="_blank" href="<?php echo get_option('swt_rsssub'); ?>" title="通过RSS订阅我的博客">RSS订阅</a></li>
		</ul>
	</div>
		<form action="http://list.qq.com/cgi-bin/qf_compose_send" target="_blank" method="post">
			<input type="hidden" name="t" value="qf_booked_feedback">
			<input type="hidden" name="id" value="<?php echo stripslashes(get_option('swt_emailid')); ?>">
			<input id="to" onfocus="if (this.value == '输入邮箱 订阅本站') {this.value = '';}" onblur="if (this.value == '') {this.value = '输入邮箱 订阅本站';}" value="输入邮箱 订阅本站" name="to" type="text" class="feed-mail-input"><input class="feed-mail-btn" type="submit" value="订阅">
		</form>
		<?php if (get_option('swt_gg') == 'Hide') { ?>
		<?php { echo ''; } ?>
		<?php } else { include(TEMPLATEPATH . '/includes/gg.php'); } ?>
		<div class="clear"></div>
</div>