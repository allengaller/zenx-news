<div class="postBottom mt15 clx">
					<div class="post_sming">
						<p>如无特别说明，本站文章皆为原创，若要转载，务必请注明以下原文信息:<br />
						日志标题:<a href="<?php the_permalink(); ?>">《<?php echo cut_str($post->post_title,60); ?>》</a><br /> 
						日志链接:<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php echo the_permalink(); ?></a><br /> 
						博客名称:<a href="<?php bloginfo('siteurl');?>" title="<?php bloginfo('name');?>"><?php bloginfo('name');?></a></p>
					</div><!--post_sming end-->
					
					<div class="relative mt20" style="height:43px;">
						<!-- Baidu Button BEGIN -->
						<div id="bdshare" class="bdshare_t bds_tools_32 get-codes-bdshare" data="{'text':'<?php the_title(); echo '&nbsp;|&nbsp;';the_excerpt_rss();echo '__';bloginfo('name'); echo '&nbsp;&nbsp;'; ?>}">
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
				</div><!--postBottom end-->

				<div class="postauthor clx">
					<div class="gravatar">
						<?php echo get_avatar( get_the_author_email(), '90' ); ?>
					</div><!--gravatar end-->
					<div class="about">
						<p class="post_author"><?php the_author_nickname(); ?></p>
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