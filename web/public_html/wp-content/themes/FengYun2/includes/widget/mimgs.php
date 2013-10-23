<div class="box_top">
</div>
<div class="mimg">
	<div class="clear"></div>
	<?php $loop = new WP_Query( array( 'post_type' => 'picture', 'showposts' => get_option('swt_mimg_n') ) );	while ( $loop->have_posts() ) : $loop->the_post();?>
	<div class="mimg_c">
		<div class="thumb_s">
			<?php if ( get_post_meta($post->ID, 'small', true) ) : ?>
			<?php $image = get_post_meta($post->ID, 'small', true); ?>
			<?php $img = get_post_meta($post->ID, 'big', true); ?>
			<a href="<?php the_permalink(); ?>"  rel="bookmark" title="<?php the_title(); ?>"><img src="<?php echo $image; ?>" alt="<?php the_title(); ?>"/></a>
			<?php else: ?>
		</div>
			<!-- НиЭМ -->
		<div class="thumbnail_s">
			<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php if (has_post_thumbnail()) { the_post_thumbnail('hot'); }?></a>
			<?php endif; ?>	
		</div>
	</div>
	<?php endwhile;?>
	<div class="clear"></div>
</div>
<div class="box-bottom">
</div>