<div class="newarticles">
	<h3>最新文章</h3>	
	<div class="box_r">
		<ul>
			<li>
				<?php
				global $post;
				$args = array( 'numberposts' => 9, 'offset'=> 0, 'caller_get_posts' => 20 );
				$myposts = get_posts( $args );
				foreach( $myposts as $post ) :	setup_postdata($post); ?>
				<a href="<?php the_permalink(); ?>"><?php echo mb_strimwidth(get_the_title(), 0, 31, '');?></a>
				<?php endforeach; ?>
			</li>
		</ul>
		<div class="clear"></div>
	</div>
	<div class="box-bottom">
		<i class="lb"></i>
		<i class="rb"></i>
	</div>
</div>