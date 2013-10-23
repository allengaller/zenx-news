<?php 
/*Template Name: what_i_do*/
?>

<?php get_header(); ?>
	<div class="fluidCon">
		<?php while (have_posts()) : the_post(); ?>
		<div class="post_detail" id="post-<?php the_ID(); ?>">
			<h2><?php the_title(); ?></h2>
			<ul class="post_meta clx">
				<li class="author clx">
					<span>作者:<?php the_author_posts_link(); ?></span>
					<span>分类:<?php the_category(', ') ?></span>
					<span><?php edit_post_link('[编辑]'); ?></span>
					<span class="share"><?php include('includes/share.php'); ?></span>
				</li>
				<li class="date"><?php the_time('Y-m-d'); ?></li>
				<li class="tags">
					<?php if(function_exists("the_tags")) : ?>&nbsp;<?php the_tags('') ?>
				</li>
				<li class="views">
					<?php if(function_exists('the_views')) {the_views();} ?><?php endif; ?>
				</li>
				<li class="comments">
					<?php comments_popup_link('0', '1', '%'); ?>
				</li>
				<li class="fontSize">字号：<span class="small" title="切换到小字体" id="fontSmall">T</span>|<span class="big" title="切换到大字体" id="fontBig">T</span>
				</li>
			</ul><!-- post_meta end -->
			
			<div class="post_content"><!-- 此处广告代码需要优化 -->
				<?php 
					if(get_qintag_option('post_top_ads') !== '') {
						echo "<div class='post_top_ads'>".get_qintag_option('post_top_ads')."</div>";
					}
				?>
				<!-- 文章内容 -->
				<?php the_content(); ?>
				<h3 id="me" class="menu"><i class="pz"></i>june</h3>
				<p>互联网资深产品经理一枚，深谙产品之道，熟掌运营之能，崇尚一切从简的产品设计体验，现居深圳，致力于互联网及移动互联网的产品研究，为用户打造高端优质的互联网及移动互联网产品，所熟识领域：</p>	


				<ul class="serviceBox clx">
					<li class="cs"><a href="#service_a" class="goDown">互联网产品</a></li>
					<li class="dz"><a href="#ztdz" class="goDown">移动互联网产品</a></li>
					<li class="fz"><a href="#ztfz" class="goDown">网络营销</a></li>
					<li class="xg"><a href="#ztxg" class="goDown">广告媒体</a></li>
				</ul>
								
				<dl class="other mt10">
					<dt id="contact">联系方式：</dt>
					<dd>QQ:604314031</dd>
					<dd>Email：cwf200300@126.com</dd>
					<dd>新浪微博：<a href="http://weibo.com/cwf200300" target="_blank">http://weibo.com/cwf200300</a></dd>
					<dd>腾讯微博：<a href="http://t.qq.com/cwf200300850423" target="_blank">http://t.qq.com/cwf200300850423</a></dd>
					<dd>facebook：<a href="http://www.facebook.com/cwf200300" target="_blank">http://www.facebook.com/cwf200300</a></dd>
					<dd>twitteri：<a href="http://twitter.com/cwf200300" target="_blank">http://twitter.com/cwf200300</a></dd>
				</dl>
				
				<h3 id="service_a" class="menu"><i class="ff"></i>主题获取 <a href="javascript:void(0);" class="right t12 goTop mr20 song">返回顶部&uarr;</a></h3>
				<div class="content">
					<p>june有免费和部分收费原创主题作品，免费主题都可以在本站下载到或者在QQ群共享中获得（群号：152590370），收费主题购买流程如下：</p>

					<div class="orderInfo">
						<p class="clx">
							<span class=" bold t14 left">主题购买：</span>
							<span class="right"></span>
						</p>
						<div class="orderState">
							<span class="tit">购买流程</span>
						
							<ul class="orderSteps clx">
								<li class="current">
									<p class="black">选择主题</p>
								</li>
								<li class="current">
									<p class="black">购前咨询</p>
									<p class="tel">QQ：286589914</p>
								</li>
								<li class="current">
									<p class="black">支付宝付款</p>
									<p class="l_black" style="width:130px;">帐号：qintag@163.com</p>
								</li>
								<li class="current">
									<p class="black">发货至邮箱</p>
								</li>
								
								<li class="current">
									<p class="black">启动售后服务</p>
									<p class="l_black"><a href="#free_service" class="goDown">免费服务内容</a></p>
								</li>
							</ul><!--orderSteps end -->
						</div><!--orderState end-->
					</div><!--orderInfo end-->
					<dl id="free_service" class="other mt10">
						<dt>免费提供如下服务：</dt>
						<dd>1、免费提供网站主题和插件安装、调试服务；</dd>
						<dd>2、免费提供网站的更新升级、售后服务和技术支持；</dd>
						<dd>3、免费提供长期的网站细节修改完善服务；</dd>
						<dd>4、需插件实现的部分功能, 可提前备好相关插件, 以便提高开发进度, 确保尽快交付。</dd>
					</dl>
				</div><!--content end-->
				


				<h3 id="service_b" class="menu"><i class="zt"></i>wordPress主题服务<a href="javascript:void(0);" class="right t12 goTop mr20 song">返回顶部&uarr;</a></h3>
				
				<div class="content">
					<p>			june提供的WordPress主题服务大致为：全新设计或根据您提供的设计稿（pad、jpg），或者您所要模仿的样式，或者由我帮您设计，然后制作成 wordpress主题包或在您已有的wordpress主题上做一定的修改。通常会花费1~7个工作日。费用可参考下表：</p>
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
						<tbody>
							<tr class="tit">
								<td width="20%">服务类型</td>
								<td>服务内容</td>
								<td width="20%">参考价格（￥）</td>
							</tr>
							<tr>
								<td id="ztdz" class="t">主题定制</td>
								<td class="c">
									<p>1、根据客户提供的网站需求（网站构思、类型、产品、栏目、页面等）信息设计全新的网站视觉风格；</p>
									<p>2、定制独一无二的高质量网站主题，保证根据客户提出的网站功能需求；</p>
									<p>3、完美实现全站功能, 100%保证和网站效果图一致。</p>
								</td>
								<td class="c">
									<p class="price">博客网站:1580</p>
									<p class="price">企业网站:1980</p>
									<p class="price">CMS网站:1980</p>
								</td>
							</tr>
							<tr>
								<td class="t">PSD转WP</td>
								<td class="c">
									<p>1、根据客户提供的完整设计效果图（PSD、PNG、AI 等格式）开发网站主题；</p>
									<p>2、完全根据客户的设计效果图手工编码实现主题；</p>
									<p>3、完美实现全站功能, 100%保证和网站效果图一致；</p>
								</td>
								<td class="c">
									<p class="price">博客网站:1080</p>
									<p class="price">企业网站:1580</p>
									<p class="price">CMS网站:1580</p>
								</td>
							</tr>
							<tr>
								<td class="t">html转WP</td>
								<td class="c">
									<p>1、根据客户提供的html静态页面开发网站主题；</p>
									<p>2、完美实现全站功能, 100%保证和网站效果图一致；</p>
								</td>
								<td class="c">
									<p class="price">博客网站:880</p>
									<p class="price">企业网站:1080</p>
									<p class="price">CMS网站:1080</p>
								</td>
							</tr>
							<tr>
								<td id="ztfz" class="t">网站转(仿)制</td>
								<td class="c">
									<p>1、根据客户提供网站的风格开发或转制为WordPress网站主题；</p>
									<p>2、根据客户提出的网站需求, 在现有网站风格基础上添加定制功能；</p>
									<p>3、june不承担仿制网站导致的任何版权问题和其他纠纷；</p>
								</td>
								<td class="c">
									<p class="price">博客网站:1080</p>
									<p class="price">企业网站:1580</p>
									<p class="price">CMS网站:1580</p>
								</td>
							</tr>
							<tr>
								<td id="ztxg" class="t">主题修改</td>
								<td class="c">
									<p>1、在客户现有网站主题基础上, 根据客户提出的网站需求, 扩展修改WordPress主题；</p>
									<p>2、完全根据客户提供的网站及需求手工编码实现主题；</p>
									<p>3、完美实现全站功能, 100%保证和网站效果一致；</p>
								</td>
								<td class="c">
									<p class="price">博客网站:180</p>
									<p class="price">企业网站:380</p>
									<p class="price">CMS网站:380</p>
								</td>
							</tr>
						</tbody>
					</table>
					<a href="javascript:void(0);" class="right t12 goTop">返回顶部&uarr;</a>
	
					<dl class="other mt10">
						<dt>免费提供如下服务：</dt>
						<dd>1、免费提供网站主题和插件安装、调试服务；</dd>
						<dd>2、免费提供网站的更新升级、售后服务和技术支持；</dd>
						<dd>3、免费提供长期的网站细节修改完善服务；</dd>
						<dd>4、需插件实现的部分功能, 可提前备好相关插件, 以便提高开发进度, 确保尽快交付。</dd>
					</dl>
					<dl class="other mt10">
						<dt>关于报价：</dt>
						<dd>1、以上所有WordPress主题设计服务价格仅作参考；</dd>
						<dd>2、具体报价分别会从三个环节的需求去分析和确认：设计、前端制作和程序功能开发；</dd>
						<dd>3、风格设计：着重于风格的考虑，因为简洁风格和元素较丰富的复杂风格，从设计到前端制作难度都不尽相同；</dd>
						<dd>4、前端制作：首先会根据版式设计的繁简程度来估计前端制作的工作量，以及页面中需要用到多少JS特效等，其次，需要客户提供浏览器兼容需求，我们默认会兼容IE7/IE8/IE9/Firefox/Chrome/Safari/Opera，如果客户还需要考虑IE6，这个需要明确提出，价格也会受此影响；</dd>
						<dd>5、程序功能：需要客户需要特别定制的功能需求点（特指WordPress默认没有的功能，此些需求都是需要二次开发的），还有需要制作的页面模板数量等（例如普通博客也许只需要2个页面，而企业站点却需要至少5个以上的页面）。</dd>
					</dl>
					<dl class="other mt10">
					<dt>网站主题定制流程：</dt>
						<dd>june为客户提供各种类型的 WordPress 网站定制设计服务，为方便客户了解网站的定制流程，请务必详细阅读以下具体定制流程：</dd>
						<dd>1、<strong>提供定制需求</strong>客户可通过QQ、E-mail等方式向我们提交您的网站定制需求，包括：希望的网站色调风格、网站功能需求以及其他项目要求等；</dd>
						<dd>2、<strong>确定定制需求</strong>我们会根据客户提供的网站定制需求说明，双方及时地沟通交流，充分了解了客户的详细需求及网站定位，为更好地完成下一步的设计任务确定方向，同时，确定网站最终的设计实现方案以及整体的定制费用；</dd>
						<dd>3、<strong>网站风格设计</strong>确定详细网站需求后，客户支付全部定制费用的50%作为预付款，同时，我们会根据客户提供的网站设计需求和资料进行网站的首页风格设计，并最终达到客户的定制需求；</dd>
						<dd>4、<strong>网站功能实现</strong>我们会完全根据客户最终确定的网站设计风格，严格进行网站功能的开发实现，并在此过程中强调程序结构和代码逻辑的严密行，注重搜索优化；</dd>
						<dd>5、<strong>网站在线测试</strong>网站最终完成设计和程序实现后，我们会将所有网站文件上传至我们的测试网站，供客户进行在线浏览操作测试，确保功能需求实现并合格验收；</dd>
						<dd>6、<strong>网站主题交付</strong>客户通过在线测试并合格验收后，支付剩余定制费用后，我们会将所有的网站文件整理打包交付，并协助客户完成后期网站的搭建，至此，整个定制流程完成。</dd>
					</dl>
					<dl class="other mt10">
						<dt>主题定制协议：</dt>
						<dd>1、对于june提供的所有主题设计服务，具体设计报价视主题需求的具体情况而定（设计复杂度、实现功能难易度等）；</dd>
						<dd>2、定制设计主题，june保留主题的设计版权，主题只且只能用于双方协议的网站/博客使用。主题不得用作他用、不得以任何形式转卖他人使用；如有疑问，请及时与june联系协商，否则june不再负责其网站的后期服务；</dd>
						<dd>3、对于客户提交的仿制主题，june不承担任何因此而带来的版权问题和其他纠纷，请慎重选择主题仿制对象；</dd>
						<dd>4、june帮助用户进行主题必需插件的安装、整合、调试，但不保证所有插件的兼容性（毕竟 WordPress 插件鱼龙混杂，插件与插件，插件与程序间都可能会出现不兼容性）；</dd>
						<dd>5、所有主题设计服务，在双方达成一致意见后，定制需求方须预付整个主题设计费用的50%，剩余设计费用在主题提交完成后，准时支付；</dd>
						<dd>6、june不提供其他因主机空间、PHP版本、MYSQL版本等非主题设计因素而导致的主题使用问题，具体解决方法须联系对应服务商解决；</dd>
						<dd>7、对于june发布的原创免费主题，请非商业主题用户尊重主题作者的劳动成果，务必保留主题底部的june的版权链接，june拥有永久设计版权。用户不得随意隐藏或删除主题底部的june版权文字链接，如需隐藏或删除该链接，需额外支付80元的版权费用；</dd>
						<dd>8、主题定制需求一旦提交完成，即为双方都已默认接受该协议。</dd>
					</dl>
				</div><!--content end-->
				<?php 
					if(get_qintag_option('post_bottom_ads') !== '') {
						echo "<div class='post_bottom_ads'>".get_qintag_option('post_bottom_ads')."</div>";
					}
				?>
				<div class="clear"></div>
			</div><!-- post_content end -->

			<div class="postAds clx">
				<p class="tit">Advertising</p>
				<?php if(get_qintag_option('ads200_a') !== '') { ?>
			
					<div class="ads200">
						<?php echo get_qintag_option('ads200_a'); ?>
					</div>
					<div class="ads200">
						<?php echo get_qintag_option('ads200_b'); ?>
					</div>
					<div class="ads200">
						<?php echo get_qintag_option('ads200_c'); ?>
					</div>
				<?php } ?>
			</div><!-- postAds end -->
			<!--友荐相关文章插件-->
			<div class="ujian-hook"></div>

			<div class="postBottom clx"> 
				<div class="post_sming mb20">
					<p>如无特别说明，本站文章皆为原创，若要转载，务必请注明以下原文信息:<br />
					日志标题:<a href="<?php the_permalink(); ?>">《<?php echo cut_str($post->post_title,60); ?>》</a><br /> 
					日志链接:<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php echo the_permalink(); ?></a><br /> 
					博客名称:<a href="<?php bloginfo('siteurl');?>" title="<?php bloginfo('name');?>"><?php bloginfo('name');?></a></p>
				</div><!--post_sming end-->
				<!-- Baidu Button BEGIN -->
				<div id="bdshare" class="bdshare_t bds_tools_32 get-codes-bdshare">
					<a class="bds_qzone"></a>
					<a class="bds_tsina"></a>
					<a class="bds_tqq"></a>
					<a class="bds_renren"></a>
					<span class="bds_more"></span>
					<a class="shareCount"></a>
				</div>
				<!-- Baidu Button END -->
				<div class="post_link"><!-- 上下篇 -->
					<?php previous_post_link('【上一篇】%link') ?><br/>
					<?php next_post_link('【下一篇】%link') ?>
				</div>
			</div>

			<div class="postauthor clx">
				<div class="gravatar">
					<?php echo get_avatar( get_the_author_email(), '80' ); ?>
				</div><!--gravatar end-->
				<div class="about">
					<p class="post_author"><?php the_author_posts_link(); ?></p>
					<p class="description">
						<?php the_author_meta('description'); ?>
					</p>
				</div><!--about end-->
			</div><!-- postauthor end -->

			<div class="postRelated">
				<h3>您可能感兴趣的文章:</h3>
				<ul>
					<?php related_posts() ?>
				</ul>
			</div><!-- postRelated end -->
		</div><!-- post_detail end -->

		<div class="commentPost">
			<?php comments_template( '', true ); ?>
		</div>
        <?php endwhile;?>
	</div><!-- fluidCon end  -->
	<script type="text/javascript" language="javascript">
	$(document).ready(function(){
		// JavaScript Document
		jQuery.fn.anchorGoWhere = function(options){
			var obj = jQuery(this);
			var defaults = {target:1, timer:1000};
			var o = jQuery.extend(defaults,options);

			obj.each(function(i){
				jQuery(obj[i]).click(function(){
					var _rel = jQuery(this).attr("href").substr(1);
					switch(o.target){
						case 1: 
							var targetTop = jQuery("#"+_rel).offset().top;
							jQuery("html,body").animate({scrollTop:targetTop}, o.timer);
							break;
						case 2:
							var targetLeft = jQuery("#"+_rel).offset().left;
							jQuery("html,body").animate({scrollLeft:targetLeft}, o.timer);
							break;
					}
					return false;
				});
			});
		};
		$('.goTop').click(function () {
			$('body,html').animate({scrollTop: 0}, 1000);
			return false;
		});
		//$(".goTop").anchorGoWhere({target:1});
		$(".goDown").anchorGoWhere({target:1});
		$(".goNext").anchorGoWhere({target:1});
		$(".goFront").anchorGoWhere({target:1});
		$(".goVertical").anchorGoWhere({target:2});
		$('ul.serviceBox li').hover(function(){
			$('a', this).stop().animate({left:'0'},{queue:false,duration:200});
		}, function() {
			$('a', this).stop().animate({left:'-150px'},{queue:false,duration:200});
		});
	});
	</script>
<?php get_sidebar(); get_footer(); ?>