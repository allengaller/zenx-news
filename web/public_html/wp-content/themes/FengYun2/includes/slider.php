<div id="slideshow">
<div class="slideshow">
	<div id="slider_nav"></div>
	<div id="slider" class="clearfix" style="position: relative; width: 350px; height: 248px;">
		<?php
			$args = array(
				'posts_per_page' => 5,
				'meta_key'  => news,
				'caller_get_posts' => 10
			);
			query_posts($args);
			?>
		<?php if (have_posts()) : ?>
			<?php while (have_posts()) : the_post(); ?>
		<div class="featured_post" style="width: 350px; height: 248px;" >
			<div class="slider_image">			
				<?php if ( get_post_meta($post->ID, 'show', true) ) : ?>   
				<?php $image = get_post_meta($post->ID, 'show', true); ?>   
				<?php $url = get_post_meta($post->ID, 'imgurl', true); ?>   
				<a href="<?php echo $url; ?>" rel="bookmark" title="<?php the_title(); ?>"><img src="<?php echo $image; ?>"width="350" height="248" alt="<?php the_title(); ?>"/></a>
				<?php else: ?>  
					<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php if (has_post_thumbnail()) { the_post_thumbnail('show'); }
				else { ?>
					<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><img class="home-thumb" src="<?php echo catch_first_image() ?>" width="350px" height="248px" alt="<?php the_title(); ?>"/>
				<?php } ?></a>
				<?php endif; ?>
			</div>
		</div>
		<?php endwhile; ?>
		<?php endif; ?>	
	</div>
 </div>
 </div>