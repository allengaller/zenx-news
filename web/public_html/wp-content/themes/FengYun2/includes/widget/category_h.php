<div class="s_category">
	<h3>推荐栏目</h3>	
	<div class="categories">
		<div class="categories_c">
			<?php $display_categories = explode(',', get_option('swt_cat_h') ); foreach ($display_categories as $category) { ?>
				<?php query_posts("showposts=1&cat=$category"); ?>
				<?php while (have_posts()) : the_post(); ?>
				<ul class="cat_h">
					<div class="ico">
						<?php if (get_option('swt_ico') == '显示') { ?>
							<div class="cat_ico">
						        <a href="<?php bloginfo('url'); ?>/category/<?php $catArray = get_the_category(); $cat=$catArray[array_rand($catArray,1)]; echo $cat->category_nicename;?>" title="<?php echo $cat->cat_name;?>">
						        <img src="<?php bloginfo('template_url');?>/images/caticon/<?php echo $cat->category_nicename; ?>.gif" />
						        </a>
							</div>
						<?php } else { } ?>
					</div>
					<span class="cat_name_h">
						<a href="<?php echo get_category_link($category);?>" rel="bookmark" title="更多关于<?php single_cat_title(); ?>的文章"><?php single_cat_title(); ?></a>
						<span class="cat_description"><p><?php echo category_description( $categoryID ); ?></p></span>
					</span>
				</ul>
				<?php endwhile; ?>
			<?php } ?>
 		</div>
		<?php wp_reset_query();?>
		<div class="clear"></div>
	</div>
	<div class="box-bottom">
		<i class="lb"></i>
		<i class="rb"></i>
	</div>
</div>