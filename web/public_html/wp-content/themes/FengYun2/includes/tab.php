<div id="tabs">
	<ul class="htotabs">
		<li class="widget1"><a href="#tab-widget1">近期热门</a></li>
                <li class="widget2"><a href="#tab-widget2">最新文章</a></li>
		<li class="widget3"><a href="#tab-widget3">年度排行</a></li>
		<div class="clear"></div>
	</ul>
	<div class="tab-inside">
		<ul id="tab-widget1">
			<div class="tab_latest">
				<ul>
				    <?php simple_get_most_viewed(); ?>
				</ul>
				<div class="clear"></div>
			</div>
		</ul>
<ul id="tab-widget2">
			<div class="tab_latest">
				<ul>				
                                        <?php $post_query = new WP_Query('showposts=10');
                                        while ($post_query->have_posts()) : $post_query->the_post();
                                        $do_not_duplicate = $post->ID; ?>
                                        <li><a href="<?php the_permalink(); ?>" rel="bookmark" title="详细阅读：<?php the_title_attribute(); ?>"><?php the_title(); ?></a></li>
                                        <?php endwhile;?>
				</ul>
	<div class="clear"></div>
			</div>
		</ul>
		<ul id="tab-widget3">
			<div class="tab_latest">
				<ul>
					<?php simple_get_most_vieweds(); ?>
				</ul>
			</div>
  		</ul>
	</div>
</div>
<div class="box-bottom">
</div>
<script type="text/javascript">
jQuery(document).ready(function(){
	jQuery( '.htotabs').each(function(){
		jQuery(this).children( 'li').children( 'a:first').addClass( 'selected' ); // Add .selected class to first tab on load
	});
	jQuery( '.tab-inside > *').hide();
	jQuery( '.tab-inside > *:first-child').show();
	jQuery( '.htotabs li a').click(function(evt){ // Init click funtion on Tabs
		var clickd_tab_ref = jQuery(this).attr( 'href' ); // Strore Href value
		jQuery(this).parent().parent().children( 'li').children( 'a').removeClass( 'selected' ); //Remove selected from all tabs
		jQuery(this).addClass( 'selected' );
		jQuery(this).parent().parent().parent().children( '.tab-inside').children( '*').hide();
		jQuery( '.tab-inside ' + clickd_tab_ref).fadeIn(500);
		 evt.preventDefault();
	})
})
</script>