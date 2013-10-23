<div class="mod" id="block-slider">	
	<div class="mod-item">
		<?php
			$mib_block_slider_id = empty( $mib_block_slider_id ) ? '1' : $mib_block_slider_id; 
			$args = array(
				'numberposts'     => 999, //需要提取的文章数
				'offset'          => 0, //以第几篇文章为起始位置   
				'category'        => get_option('mib_block_slider_id'),//分类的ID，多个用逗号将分类编号隔开，或传递编号数组，可指定多个分类编号。  
				'orderby'         => 'post_date',//排序规则（注1）
				'order'           => 'DESC', //升序、降序 'ASC' —— 升序 （低到高）  'DESC' —— 降序 （高到底）
				);
			$posts_array = get_posts( $args );
		?>    
		<div class="item-caption">
        	<h5 class="block_slider_name"> <?php echo $mib_block_slider_name ?></h5>
        </div>
        <div id="left-but" class="box-left"></div>	
        <div class="mod-item-cont">
			<ul id="block-slider-list" class="block-grid">
        	<?php foreach( $posts_array as $post ) : setup_postdata( $post ); ?>	
  				<li class="list-item ">           
					<?php if (has_post_thumbnail()){
						$image_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "Full"); ?>
						<a  href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>" target="_blank" ><img src="<?php echo $image_src[0]; ?>" width="140px" height="100px" /></a>
					<?php }else {?>
						<a class="product-image" href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>" target="_blank" ><img src="<?php echo catch_post_image(); ?>" width="140px" height="100px" /></a>
					<?php } ?>
  					<h5 class="boxCaption">
                		<a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>"><?php the_title_attribute(); ?></a>
                	</h5>
				</li>
            <?php endforeach; ?>
			</ul>
        </div>
        <div id="right-but" class="box-right"></div> 
	</div>	  
</div>